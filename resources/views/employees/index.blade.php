@extends('layouts.app')

@section('title', 'Employees - Task Management System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><i class="bi bi-people"></i> Employees</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Employee
            </a>
        </div>
    </div>

    @if($employees->isEmpty())
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> No employees found. <a href="{{ route('employees.create') }}">Add your first employee</a>.
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Tasks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td><span class="badge bg-info">{{ $employee->designation }}</span></td>
                                <td>
                                    <span class="badge bg-secondary">Total: {{ $employee->tasks_count }}</span>
                                    <span class="badge bg-warning text-dark">Pending: {{ $employee->pending_tasks_count }}</span>
                                    <span class="badge bg-primary">In Progress: {{ $employee->in_progress_tasks_count }}</span>
                                    <span class="badge bg-success">Completed: {{ $employee->completed_tasks_count }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {{ $employees->links() }}
        </div>
    @endif
</div>
@endsection
