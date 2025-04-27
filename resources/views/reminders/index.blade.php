@extends('includes.master')
@section('title', 'Reminders Due This Week')
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
                                    <i class="bi bi-bell-fill me-2"></i>
                                    Reminders Due This Week
                                </h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Reminders</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('reminders.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i> Add Reminder
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
    
                        <!-- Reminders Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Title</th>
                                        <th>Client</th>
                                        <th>Project</th>
                                        <th>Due Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reminders as $reminder)
                                    <tr>
                                        <td class="ps-4">
                                            <strong>{{ $reminder->title }}</strong>
                                        </td>
                                        <td>
                                            @if($reminder->client)
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="avatar-xs me-2">
                                                    <span class="avatar-title bg-soft-primary rounded-circle">
                                                        {{ substr($reminder->client->name, 0, 1) }}
                                                    </span>
                                                </div> --}}
                                                <span>{{ $reminder->client->name }}</span>
                                            </div>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($reminder->project)
                                            <span class="badge bg-soft-primary">
                                                {{ $reminder->project->title }}
                                            </span>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span>{{ \Carbon\Carbon::parse($reminder->due_date)->format('M d, Y') }}</span>
                                                <small class="text-{{ 
                                                    $reminder->due_date < now() ? 'danger' : 
                                                    ($reminder->due_date < now()->addDays(3) ? 'warning' : 'muted')
                                                }}">
                                                    {{ \Carbon\Carbon::parse($reminder->due_date)->diffForHumans() }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ 
                                                $reminder->due_date < now() ? 'danger' : 
                                                ($reminder->due_date < now()->addDays(3) ? 'warning' : 'success')
                                            }}">
                                                {{ $reminder->due_date < now() ? 'Overdue' : 
                                                   ($reminder->due_date < now()->addDays(3) ? 'Due Soon' : 'Upcoming') }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <!-- Notes Button -->
                                                <button class="btn btn-sm btn-soft-info" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#notesModal{{ $reminder->id }}"
                                                        title="View Notes">
                                                    <i class="bi bi-journal-text"></i>
                                                </button>
                                                
                                                <!-- Edit Button -->
                                                <a href="{{ route('reminders.edit', $reminder) }}" 
                                                   class="btn btn-sm btn-soft-warning"
                                                   title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('reminders.destroy', $reminder) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this reminder?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="bi bi-check-circle" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">No reminders due this week</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notes Modals -->
    @foreach($reminders as $reminder)
    <div class="modal fade" id="notesModal{{ $reminder->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="bi bi-journal-text me-2"></i>
                        Notes for {{ $reminder->title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($reminder->notes)
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($reminder->notes)) !!}
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="bi bi-journal-x" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-2">No notes available for this reminder</p>
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
        .avatar-xs {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .avatar-title {
            font-size: 0.75rem;
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

