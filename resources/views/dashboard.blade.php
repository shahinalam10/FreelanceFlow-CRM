@extends('includes.master')
@section('title', 'Dashboard')
@section('content')
<main id="main" class="main">
    <section class="section dashboard">
        <!-- Page Title with Breadcrumb -->
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
    
        <div class="container-fluid">
            <!-- Top Cards Row - Perfectly Aligned -->
            <div class="row">
                <!-- Total Clients Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="d-flex p-4" style="background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); color: white;">
                                <div class="flex-grow-1">
                                    <span class="fs-6 fw-semibold">Total Clients</span>
                                    <h2 class="mt-2 mb-0 fw-bold">{{ $clientCount }}</h2>
                                </div>
                                <div class="flex-shrink-0 align-self-center">
                                    <span class="avatar-title bg-white-10 rounded-circle p-3 fs-4">
                                        <i class="bi bi-people-fill"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="p-3 bg-light">
                                <a href="{{ route('clients.index') }}" class="text-primary text-decoration-none">
                                    View all clients <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Total Projects Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="d-flex p-4" style="background: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%); color: white;">
                                <div class="flex-grow-1">
                                    <span class="fs-6 fw-semibold">Total Projects</span>
                                    <h2 class="mt-2 mb-0 fw-bold">{{ $projectCount }}</h2>
                                </div>
                                <div class="flex-shrink-0 align-self-center">
                                    <span class="avatar-title bg-white-10 rounded-circle p-3 fs-4">
                                        <i class="bi bi-folder-fill"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="p-3 bg-light">
                                <a href="{{ route('projects.index') }}" class="text-success text-decoration-none">
                                    View all projects <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Project Status Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="d-flex p-4" style="background: linear-gradient(135deg, #7209b7 0%, #b5179e 100%); color: white;">
                                <div class="flex-grow-1">
                                    <span class="fs-6 fw-semibold">Project Status</span>
                                    <div class="d-flex flex-wrap gap-2 mt-2">
                                        @foreach ($statusSummary as $status)
                                        <span class="badge bg-white text-dark">{{ $status->status }}: {{ $status->total }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="flex-shrink-0 align-self-center">
                                    <span class="avatar-title bg-white-10 rounded-circle p-3 fs-4">
                                        <i class="bi bi-pie-chart-fill"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="p-3 bg-light">
                                <a href="#" class="text-purple text-decoration-none">
                                    View details <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Middle Section - Deadlines & Reminders -->
            <div class="row mt-4">
                <!-- Upcoming Deadlines -->
                <div class="col-lg-6">
                    <div class="card shadow-sm" style="border: 1px solid #e9ecef;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title fw-semibold mb-0" style="font-family: 'Manrope', sans-serif; color: #4361ee;">
                                    <i class="bi bi-calendar2-event text-primary me-2"></i>
                                    Upcoming Deadlines
                                </h5>
                                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            
                            <div class="timeline">
                                @forelse ($upcomingProjects as $project)
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-primary">
                                        <i class="bi bi-calendar2-check"></i>
                                    </div>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <h6 class="mb-1" style="font-family: 'Manrope', sans-serif; color: #212529;">{{ $project->title }}</h6>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($project->deadline)->format('M d, Y') }}</small>
                                        </div>
                                        <p class="mb-1 text-muted" style="font-size: 0.875rem;">Client: {{ $project->client->name }}</p>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-light text-dark me-2">
                                                <i class="bi bi-clock-history me-1"></i>
                                                {{ \Carbon\Carbon::parse($project->deadline)->diffForHumans() }}
                                            </span>
                                            <a href="{{ route('projects.index') }}" class="text-primary text-decoration-none small">View Project</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-4">
                                    <img src="assets/img/no-data.svg" alt="No deadlines" style="height: 100px;" class="mb-3">
                                    <p class="text-muted">No upcoming deadlines found</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Upcoming Reminders -->
                <div class="col-lg-6">
                    <div class="card shadow-sm" style="border: 1px solid #e9ecef;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title fw-semibold mb-0" style="font-family: 'Manrope', sans-serif; color: #f8961e;">
                                    <i class="bi bi-bell-fill text-warning me-2"></i>
                                    Upcoming Reminders
                                </h5>
                                <a href="{{ route('reminders.index') }}" class="btn btn-sm btn-outline-warning">View All</a>
                            </div>
                            
                            <div class="timeline">
                                @forelse($upcomingReminders as $reminder)
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-warning">
                                        <i class="bi bi-bell"></i>
                                    </div>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <h6 class="mb-1" style="font-family: 'Manrope', sans-serif; color: #212529;">{{ $reminder->title }}</h6>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($reminder->due_date)->format('M d, Y') }}</small>
                                        </div>
                                        @if ($reminder->client)
                                        <p class="mb-1 text-muted" style="font-size: 0.875rem;">Client: {{ $reminder->client->name }}</p>
                                        @endif
                                        @if ($reminder->project)
                                        <p class="mb-1 text-muted" style="font-size: 0.875rem;">Project: {{ $reminder->project->title }}</p>
                                        @endif
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-light text-dark me-2">
                                                <i class="bi bi-clock-history me-1"></i>
                                                {{ \Carbon\Carbon::parse($reminder->due_date)->diffForHumans() }}
                                            </span>
                                            <a href="{{ route('reminders.index') }}" class="text-warning text-decoration-none small">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-4">
                                    <img src="assets/img/no-notification.svg" alt="No reminders" style="height: 100px;" class="mb-3">
                                    <p class="text-muted">No reminders for next 7 days</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
           <!-- Recent Interactions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm" style="border: 1px solid #e9ecef;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title fw-bold mb-0" style="font-family: 'Manrope', sans-serif; color: #4895ef;">
                                    <i class="bi bi-chat-left-text-fill text-info me-2"></i> Recent Client Interactions
                                </h5>
                                <a href="{{ route('interaction-logs.index') }}" class="btn btn-sm btn-outline-info" style="font-family: 'Manrope', sans-serif;">
                                    View All
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="font-family: 'Manrope', sans-serif; font-weight: 600;">Client</th>
                                            <th style="font-family: 'Manrope', sans-serif; font-weight: 600;">Type</th>
                                            <th style="font-family: 'Manrope', sans-serif; font-weight: 600;">Date</th>
                                            <th style="font-family: 'Manrope', sans-serif; font-weight: 600;">Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentInteractions as $interaction)
                                            <tr class="border-bottom">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="fw-semibold" style="font-family: 'Manrope', sans-serif;">
                                                            {{ $interaction->client->name }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill bg-light text-{{ $interaction->type === 'call' ? 'info' : ($interaction->type === 'email' ? 'success' : 'warning') }}" style="font-family: 'Manrope', sans-serif; border: 1px solid #dee2e6;">
                                                        <i class="bi bi-{{ $interaction->type === 'call' ? 'telephone' : ($interaction->type === 'email' ? 'envelope' : 'chat-left-text') }}-fill me-1"></i>
                                                        {{ ucfirst($interaction->type) }}
                                                    </span>
                                                </td>
                                                <td style="font-family: 'Manrope', sans-serif;">{{ \Carbon\Carbon::parse($interaction->interaction_date)->format('M d, Y') }}</td>
                                                <td>
                                                    @if($interaction->notes)
                                                        <button class="btn btn-sm btn-outline-info" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#notesModal{{ $interaction->id }}"
                                                                title="View Notes"
                                                                style="font-family: 'Manrope', sans-serif;">
                                                            <i class="bi bi-journal-text"></i> Notes
                                                        </button>
                                                    @else
                                                        <span class="text-muted" style="font-family: 'Manrope', sans-serif;">No notes</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5">
                                                    <img src="assets/img/no-interaction.svg" alt="No interactions" style="height: 120px;" class="mb-3">
                                                    <p class="text-muted" style="font-family: 'Manrope', sans-serif;">No recent interactions found</p>
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

            
            <!-- Notes Modals -->
            @foreach($recentInteractions as $interaction)
            @if($interaction->notes)
            <div class="modal fade" id="notesModal{{ $interaction->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" style="font-family: 'Manrope', sans-serif;">
                                <i class="bi bi-journal-text me-2"></i>
                                Notes for {{ $interaction->client->name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($interaction->notes)) !!}
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
        </div>
    </section>
    
    <style>
        /* Custom CSS for Premium Dashboard */
        .bg-purple {
            background-color: #6f42c1 !important;
        }
        .text-purple {
            color: #6f42c1 !important;
        }
        
        .card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        
        .avatar-title {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .timeline {
            position: relative;
            padding-left: 50px;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }
        
        .timeline-point {
            position: absolute;
            left: -40px;
            top: 0;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .timeline-point-primary {
            background-color: #3b7ddd;
        }
        
        .timeline-point-warning {
            background-color: #f5b73d;
        }
        
        .timeline-event {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid #e9ecef;
        }
        
        .table-borderless td, .table-borderless th {
            border: none;
        }
        
        .btn-soft-primary {
            background-color: rgba(59, 125, 221, 0.1);
            color: #3b7ddd;
        }
        
        .btn-soft-primary:hover {
            background-color: #3b7ddd;
            color: white;
        }
        
        /* Custom Styles */
        .btn-soft-info {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0;
            border: none;
        }
        
        .btn-soft-info:hover {
            background-color: #0dcaf0;
            color: white;
        }
        
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
    </style>
</main><!-- End #main -->
@endsection