@extends('includes.master')
@section('title', 'Clients')    
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
                                    <i class="bi bi-people-fill me-2"></i>
                                    All Clients
                                </h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Clients</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i> Add Client
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
    
                        <!-- Search Form -->
                        <form method="GET" class="row g-3 mb-4">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="bi bi-search text-muted"></i>
                                    </span>
                                    <input name="search" value="{{ request('search') }}" 
                                           class="form-control" 
                                           placeholder="Search by name, email, or company">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">
                                    <i class="bi bi-funnel me-1"></i> Filter
                                </button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </form>
    
                        <!-- Clients Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Client</th>
                                        <th>Contact</th>
                                        <th>Company</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-soft-primary rounded-circle">
                                                        {{ substr($client->name, 0, 1) }}
                                                    </span>
                                                </div> --}}
                                                <div>
                                                    <h6 class="mb-0">{{ $client->name }}</h6>
                                                    {{-- <small class="text-muted">ID: {{ $client->id }}</small> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="mailto:{{ $client->email }}" class="text-primary">
                                                    <i class="bi bi-envelope me-1"></i> {{ $client->email }}
                                                </a>
                                            </div>
                                            <div class="mt-1">
                                                <a href="tel:{{ $client->phone }}" class="text-muted">
                                                    <i class="bi bi-telephone me-1"></i> {{ $client->phone }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            @if($client->company)
                                            <span class="badge bg-soft-primary">
                                                <i class="bi bi-building me-1"></i> {{ $client->company }}
                                            </span>
                                            @else
                                            <span class="text-muted">Not specified</span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <!-- Notes Button -->
                                                <button class="btn btn-sm btn-soft-info" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#notesModal{{ $client->id }}"
                                                        title="View Notes">
                                                    <i class="bi bi-journal-text"></i>
                                                </button>
                                                
                                                <!-- Edit Button -->
                                                <a href="{{ route('clients.edit', $client) }}" 
                                                   class="btn btn-sm btn-soft-warning"
                                                   title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                
                                                <!-- Delete Form -->
                                                <form action="{{ route('clients.destroy', $client) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this client?')">
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
                        @if($clients->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ $clients->firstItem() }} to {{ $clients->lastItem() }} of {{ $clients->total() }} entries
                            </div>
                            <div>
                                {{ $clients->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notes Modals -->
    @foreach($clients as $client)
    <div class="modal fade" id="notesModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="bi bi-journal-text me-2"></i>
                        Notes for {{ $client->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($client->notes)
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($client->notes)) !!}
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="bi bi-journal-x" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-2">No notes available for this client</p>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    <style>
        /* Custom Styles */
        .avatar-sm {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .avatar-title {
            font-size: 1rem;
            font-weight: 600;
        }
        
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
        
        .btn-soft-info:hover, .btn-soft-warning:hover, .btn-soft-danger:hover {
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
        
        .bg-soft-primary {
            background-color: rgba(59, 125, 221, 0.1);
            color: #3b7ddd;
        }
    </style>
</main>
@endsection
