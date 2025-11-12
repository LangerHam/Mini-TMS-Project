@extends('layouts.app')

@section('title', 'Employee Details - Task Management System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><i class="bi bi-person"></i> Employee Details</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Employee Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong><br>{{ $employee->name }}</p>
                    <p><strong>Email:</strong><br>{{ $employee->email }}</p>
                    <p><strong>Phone:</strong><br>{{ $employee->phone }}</p>
                    <p><strong>Designation:</strong><br><span class="badge bg-info">{{ $employee->designation }}</span></p>
                    <p><strong>Joined:</strong><br>{{ $employee->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tasks ({{ $employee->tasks->count() }})</h5>
                    <a href="{{ route('tasks.create', ['employee_id' => $employee->id]) }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Task
                    </a>
                </div>
                <div class="card-body">
                    @if($employee->tasks->isEmpty())
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No tasks assigned yet.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employee->tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            @if($task->status === 'Pending')
                                                <span class="badge bg-warning text-dark">{{ $task->status }}</span>
                                            @elseif($task->status === 'In Progress')
                                                <span class="badge bg-primary">{{ $task->status }}</span>
                                            @else
                                                <span class="badge bg-success">{{ $task->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}</td>                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning" aria-label="Edit task">
                                                    <i class="bi bi-pencil"></i>
                                                </a>                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                    <button type="submit" class="btn btn-sm btn-danger" aria-label="Delete task">
                                                        <i class="bi bi-trash"></i>
                                                    </button>                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
