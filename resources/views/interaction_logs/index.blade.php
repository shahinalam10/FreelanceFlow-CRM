@extends('includes.master')
@section('title', 'Manage Interaction Log')
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
                                    <i class="bi bi-chat-left-text-fill me-2"></i>
                                    All Interaction Logs
                                </h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Interaction Logs</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('interaction-logs.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i> Add Log
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

                        <!-- Search and Filter Form -->
                        <form method="GET" action="{{ route('interaction-logs.index') }}" class="row g-3 mb-4">
                            <div class="col-md-3">
                                <select name="type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="call" @selected(request('type') == 'call')>Call</option>
                                    <option value="email" @selected(request('type') == 'email')>Email</option>
                                    <option value="meeting" @selected(request('type') == 'meeting')>Meeting</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="client_id" class="form-select">
                                    <option value="">All Clients</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" @selected(request('client_id') == $client->id)>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-funnel me-1"></i> Filter
                                    </button>
                                    <a href="{{ route('interaction-logs.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Logs Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Client</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($logs as $log)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h6 class="mb-0">{{ $log->client->name }}</h6>
                                                    @if($log->client->company)
                                                    <small class="text-muted">{{ $log->client->company }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ 
                                                $log->type == 'call' ? 'info' : 
                                                ($log->type == 'email' ? 'success' : 'warning')
                                            }} text-white">
                                                <i class="bi bi-{{ 
                                                    $log->type == 'call' ? 'telephone' : 
                                                    ($log->type == 'email' ? 'envelope' : 'people')
                                                }}-fill me-1"></i>
                                                {{ ucfirst($log->type) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span>{{ \Carbon\Carbon::parse($log->interaction_date)->format('M d, Y') }}</span>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($log->interaction_date)->diffForHumans() }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <!-- Notes View Button -->
                                                @if($log->notes)
                                                <button class="btn btn-sm btn-soft-info" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#notesModal{{ $log->id }}"
                                                        title="View Notes">
                                                    <i class="bi bi-journal-text"></i>
                                                </button>
                                                @endif
                                                
                                                <!-- Edit Button -->
                                                <a href="{{ route('interaction-logs.edit', $log) }}" 
                                                   class="btn btn-sm btn-soft-warning"
                                                   title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('interaction-logs.destroy', $log) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger" 
                                                            title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this log?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <i class="bi bi-chat-square-text" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">No interaction logs found</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($logs->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} entries
                            </div>
                            <div>
                                {{ $logs->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notes Modals -->
    @foreach($logs as $log)
    @if($log->notes)
    <div class="modal fade" id="notesModal{{ $log->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="bi bi-journal-text me-2"></i>
                        Interaction Notes
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($log->notes)) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    
    <style>
        /* Custom Styles */
        .table-hover tbody tr {
            transition: all 0.2s ease;
        }
        
        .table-hover tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        
        .btn-soft-info {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0;
        }
        
        .btn-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .btn-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .btn-soft-info:hover, 
        .btn-soft-warning:hover, 
        .btn-soft-danger:hover {
            color: white;
        }
        
        .btn-soft-info:hover {
            background-color: #0dcaf0;
        }
        
        .btn-soft-warning:hover {
            background-color: #ffc107;
        }
        
        .btn-soft-danger:hover {
            background-color: #dc3545;
        }
        
        .badge.bg-info {
            background-color: #0dcaf0 !important;
        }
        
        .badge.bg-success {
            background-color: #198754 !important;
        }
        
        .badge.bg-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }
    </style>
</main>
@endsection