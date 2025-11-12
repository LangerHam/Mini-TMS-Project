<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::withCount([
            'tasks',
            'tasks as pending_tasks_count' => function ($q) {
                $q->where('status', 'Pending');
            },
            'tasks as in_progress_tasks_count' => function ($q) {
                $q->where('status', 'In Progress');
            },
            'tasks as completed_tasks_count' => function ($q) {
                $q->where('status', 'Completed');
            },
        ]);

        // Search by employee name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Filter by designation
        if ($request->filled('designation')) {
            $query->where('designation', $request->designation);
        }

        $employees = $query->latest()->paginate(10);
        
        // Get filter dropdown
        $designations = Employee::select('designation')
            ->distinct()
            ->whereNotNull('designation')
            ->pluck('designation');

        // Overall statistics
        $totalEmployees = Employee::count();
        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 'Pending')->count();
        $inProgressTasks = Task::where('status', 'In Progress')->count();
        $completedTasks = Task::where('status', 'Completed')->count();

        return view('dashboard', compact(
            'employees',
            'designations',
            'totalEmployees',
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks'
        ));
    }
}
