@extends('includes.master')
@section('title', 'Edit Reminder')
@section('content')
<main id="main" class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <!-- Form Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="fw-bold text-primary mb-1">
                                    <i class="bi bi-bell-fill me-2"></i>
                                    Edit Reminder
                                </h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('reminders.index') }}">Reminders</a></li>
                                        <li class="breadcrumb-item active">Edit {{ $reminder->title }}</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="badge bg-{{ 
                                $reminder->due_date < now() ? 'danger' : 
                                ($reminder->due_date < now()->addDays(3) ? 'warning' : 'success') 
                            }} text-white">
                                {{ $reminder->due_date < now() ? 'Overdue' : 
                                   ($reminder->due_date < now()->addDays(3) ? 'Due Soon' : 'Upcoming') }}
                            </div>
                        </div>
    
                        <!-- Edit Reminder Form -->
                        <form action="{{ route('reminders.update', $reminder) }}" method="POST" class="needs-validation" novalidate>
                            @method('PUT')
                            @csrf
                            <div class="row g-3">
                                <!-- Title Field -->
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="title" class="form-control" id="titleInput" 
                                               value="{{ old('title', $reminder->title) }}" 
                                               placeholder="Follow up call" required>
                                        <label for="titleInput" class="form-label">
                                            <i class="bi bi-card-heading text-muted me-2"></i>Reminder Title
                                        </label>
                                        <div class="invalid-feedback">
                                            Please provide a reminder title.
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Due Date Field -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="due_date" class="form-control" id="dueDateInput" 
                                            value="{{ old('due_date', \Carbon\Carbon::parse($reminder->due_date)->format('Y-m-d')) }}" required
                                            min="{{ date('Y-m-d') }}">
                            
                                        <label for="dueDateInput" class="form-label">
                                            <i class="bi bi-calendar-date text-muted me-2"></i>Due Date
                                        </label>
                                        <div class="invalid-feedback">
                                            Please select a valid due date.
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Priority Field -->
                                {{-- <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="priority" class="form-select" id="prioritySelect">
                                            <option value="Low" @selected(old('priority', $reminder->priority) == 'Low')>Low</option>
                                            <option value="Medium" @selected(old('priority', $reminder->priority) == 'Medium')>Medium</option>
                                            <option value="High" @selected(old('priority', $reminder->priority) == 'High')>High</option>
                                        </select>
                                        <label for="prioritySelect" class="form-label">
                                            <i class="bi bi-exclamation-triangle text-muted me-2"></i>Priority
                                        </label>
                                    </div>
                                </div> --}}
                            
                                <!-- Client Selection -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="client_id" class="form-select" id="clientSelect">
                                            <option value="">-- None --</option>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}" @selected(old('client_id', $reminder->client_id) == $client->id)>
                                                    {{ $client->name }} @if($client->company)({{ $client->company }})@endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="clientSelect" class="form-label">
                                            <i class="bi bi-person text-muted me-2"></i>Client (Optional)
                                        </label>
                                    </div>
                                </div>
                            
                                <!-- Project Selection -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="project_id" class="form-select" id="projectSelect">
                                            <option value="">-- None --</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}" @selected(old('project_id', $reminder->project_id) == $project->id)>
                                                    {{ $project->title }} @if($project->client)({{ $project->client->name }})@endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="projectSelect" class="form-label">
                                            <i class="bi bi-folder text-muted me-2"></i>Project (Optional)
                                        </label>
                                    </div>
                                </div>
                            
                                <!-- Notes Field -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="notes" class="form-control" id="notesInput" 
                                                  placeholder="Additional notes" style="height: 120px">{{ old('notes', $reminder->notes) }}</textarea>
                                        <label for="notesInput" class="form-label">
                                            <i class="bi bi-journal-text text-muted me-2"></i>Notes
                                        </label>
                                    </div>
                                </div>
                            
                                <!-- Form Actions -->
                                <div class="col-12 mt-4">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('reminders.index') }}" class="btn btn-outline-secondary px-4">
                                            <i class="bi bi-arrow-left me-1"></i> Cancel
                                        </a>
                                        <div class="d-flex gap-3">
                                            <button type="reset" class="btn btn-outline-danger px-4">
                                                <i class="bi bi-eraser-fill me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="bi bi-save-fill me-1"></i> Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        /* Custom Form Styling */
        .form-floating label {
            padding-left: 2.5rem;
        }
        
        .form-floating .bi {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding-left: 2.5rem;
            border: 1px solid #e0e0e0;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #3b7ddd;
            box-shadow: 0 0 0 0.25rem rgba(59, 125, 221, 0.25);
        }
        
        .card {
            border-radius: 12px;
            border: none;
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 500;
        }
        
        .invalid-feedback {
            padding-left: 2.5rem;
        }
        
        .badge.bg-danger {
            background-color: #dc3545 !important;
        }
        
        .badge.bg-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }
        
        .badge.bg-success {
            background-color: #198754 !important;
        }
    </style>
    
    <script>
        // Form validation
        (function () {
            'use strict'
            
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')
            
            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>  
</main>
@endsection
