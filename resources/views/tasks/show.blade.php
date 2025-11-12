@extends('layouts.app')

@section('title', 'Task Details - Task Management System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><i class="bi bi-list-task"></i> Task Details</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $task->title }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p class="mt-2">{{ $task->description ?? 'No description provided.' }}</p>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Status:</strong><br>
                                @if($task->status === 'Pending')
                                    <span class="badge bg-warning text-dark fs-6">{{ $task->status }}</span>
                                @elseif($task->status === 'In Progress')
                                    <span class="badge bg-primary fs-6">{{ $task->status }}</span>
                                @else
                                    <span class="badge bg-success fs-6">{{ $task->status }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Due Date:</strong><br>
                                @if($task->due_date)
                                    {{ $task->due_date->format('F d, Y') }}
                                    @if($task->due_date->isPast() && $task->status !== 'Completed')
                                        <br><span class="badge bg-danger">Overdue</span>
                                    @endif
                                @else
                                    <span class="text-muted">No due date set</span>
                                @endif                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Created:</strong><br>{{ $task->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Last Updated:</strong><br>{{ $task->updated_at->format('M d, Y H:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @if($task->employee)
                        <h6>{{ $task->employee->name }}</h6>
                        <p class="mb-1"><small><i class="bi bi-envelope"></i> {{ $task->employee->email }}</small></p>
                        <p class="mb-1"><small><i class="bi bi-telephone"></i> {{ $task->employee->phone }}</small></p>
                        <p class="mb-3"><span class="badge bg-info">{{ $task->employee->designation }}</span></p>
                        
                        <a href="{{ route('employees.show', $task->employee) }}" class="btn btn-sm btn-outline-info w-100">
                            <i class="bi bi-eye"></i> View Employee
                        </a>
                    @else
                        <p class="text-muted">No employee assigned</p>
                    @endif
                </div>                        <i class="bi bi-eye"></i> View Employee
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
