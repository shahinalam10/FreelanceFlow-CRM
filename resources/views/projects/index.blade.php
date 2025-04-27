@extends('includes.master')
@section('title', 'Manage Clients')
@section('content')
<main id="main" class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <!-- Page Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="fw-bold text-primary mb-0">
                                    <i class="bi bi-folder me-2"></i>
                                    All Projects
                                </h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Projects</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('projects.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i> Add Project
                            </a>
                        </div>
    
                        <!-- Success Alert -->
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
    
                        <!-- Filter Form -->
                        <form method="GET" class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="bi bi-funnel text-muted"></i>
                                    </span>
                                    <select name="status" class="form-select">
                                        <option value="">All Statuses</option>
                                        @foreach(['Pending', 'Ongoing', 'Completed'] as $status)
                                            <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">
                                    <i class="bi bi-filter me-1"></i> Filter
                                </button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </form>
    
                        <!-- Projects Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Project</th>
                                        <th>Client</th>
                                        <th>Budget</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-soft-primary rounded-circle">
                                                        {{ substr($project->title, 0, 1) }}
                                                    </span>
                                                </div> --}}
                                                <div>
                                                    <h6 class="mb-0">{{ $project->title }}</h6>
                                                    <small class="text-muted">Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('M d, Y') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="avatar-xs me-2">
                                                    <span class="avatar-title bg-soft-secondary rounded-circle">
                                                        {{ substr($project->client->name, 0, 1) }}
                                                    </span>
                                                </div> --}}
                                                <span>{{ $project->client->name }}</span>
                                            </div>
                                        </td>
                                        <td class="fw-bold">${{ number_format($project->budget, 2) }}</td>
                                        <td>
                                            <span class="badge bg-soft-{{ 
                                                $project->status == 'Completed' ? 'success' : 
                                                ($project->status == 'Ongoing' ? 'warning' : 'secondary') 
                                            }} text-{{ 
                                                $project->status == 'Completed' ? 'success' : 
                                                ($project->status == 'Ongoing' ? 'warning' : 'secondary') 
                                            }} rounded-pill">
                                                {{ $project->status }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('projects.edit', $project) }}" 
                                                   class="btn btn-sm btn-soft-warning"
                                                   title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                
                                                <form action="{{ route('projects.destroy', $project) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this project?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger" title="Delete">
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
    
                        <!-- Pagination -->
                        @if($projects->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} entries
                            </div>
                            <div>
                                {{ $projects->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        /* Custom Styles */
        .avatar-sm {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .avatar-xs {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .avatar-title {
            font-weight: 600;
        }
        
        .table-hover tbody tr {
            transition: all 0.2s ease;
        }
        
        .table-hover tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        
        .btn-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .btn-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .btn-soft-warning:hover, .btn-soft-danger:hover {
            color: white;
        }
        
        .btn-soft-warning:hover {
            background-color: #ffc107;
        }
        
        .btn-soft-danger:hover {
            background-color: #dc3545;
        }
        
        .bg-soft-primary {
            background-color: rgba(59, 125, 221, 0.1);
            color: #3b7ddd;
        }
        
        .bg-soft-success {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }
        
        .bg-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .bg-soft-secondary {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }
    </style>    
</main>
@endsection