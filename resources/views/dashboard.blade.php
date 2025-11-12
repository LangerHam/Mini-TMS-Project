@extends('layouts.app')

@section('title', 'Dashboard - Task Management System')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Employees</h6>
                            <h2 class="mb-0">{{ $totalEmployees }}</h2>
                        </div>
                        <div>
                            <i class="bi bi-people fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Tasks</h6>
                            <h2 class="mb-0">{{ $totalTasks }}</h2>
                        </div>
                        <div>
                            <i class="bi bi-list-task fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Pending</h6>
                            <h2 class="mb-0">{{ $pendingTasks }}</h2>
                        </div>
                        <div>
                            <i class="bi bi-hourglass-split fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">In Progress</h6>
                            <h2 class="mb-0">{{ $inProgressTasks }}</h2>
                        </div>
                        <div>
                            <i class="bi bi-arrow-repeat fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Completed</h6>
                            <h2 class="mb-0">{{ $completedTasks }}</h2>
                        </div>
                        <div>
                            <i class="bi bi-check-circle fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label for="search" class="form-label">Search Employee</label>
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <label for="designation" class="form-label">Filter by Designation</label>
                    <select name="designation" id="designation" class="form-select">
                        <option value="">All Designations</option>
                        @foreach($designations as $designation)
                            <option value="{{ $designation }}" {{ request('designation') === $designation ? 'selected' : '' }}>
                                {{ $designation }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label d-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Employees and Tasks Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employees and Their Tasks</h5>
            <div>
                <a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary me-2">
                    <i class="bi bi-person-plus"></i> Add Employee
                </a>
                <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-success">
                    <i class="bi bi-plus-circle"></i> Add Task
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($employees->isEmpty())
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> No employees found. <a href="{{ route('employees.create') }}">Add your first employee</a>.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Designation</th>
                                <th>Contact</th>
                                <th>Total Tasks</th>
                                <th>Pending</th>
                                <th>In Progress</th>
                                <th>Completed</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <strong>{{ $employee->name }}</strong>
                                </td>
                                <td><span class="badge bg-info">{{ $employee->designation }}</span></td>
                                <td>
                                    <small>{{ $employee->email }}<br>{{ $employee->phone }}</small>
                                </td>
                                <td><span class="badge bg-secondary">{{ $employee->tasks_count }}</span></td>
                                <td><span class="badge bg-warning text-dark">{{ $employee->pending_tasks_count }}</span></td>
                                <td><span class="badge bg-primary">{{ $employee->in_progress_tasks_count }}</span></td>
                                <td><span class="badge bg-success">{{ $employee->completed_tasks_count }}</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $employees->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
