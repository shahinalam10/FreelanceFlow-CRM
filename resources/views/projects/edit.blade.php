@extends('includes.master')
@section('title', 'Edit Clients')
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
                                    <i class="bi bi-pencil-square me-2"></i>
                                    Edit Project
                                </h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                                        <li class="breadcrumb-item active">Edit {{ $project->title }}</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="badge bg-soft-{{ 
                                $project->status == 'Completed' ? 'success' : 
                                ($project->status == 'Ongoing' ? 'warning' : 'secondary') 
                            }} text-{{ 
                                $project->status == 'Completed' ? 'success' : 
                                ($project->status == 'Ongoing' ? 'warning' : 'secondary') 
                            }} fs-6">
                                {{ $project->status }}
                            </div>
                        </div>
    
                        <!-- Edit Project Form -->
                        <form action="{{ route('projects.update', $project) }}" method="POST" class="needs-validation" novalidate>
                            @method('PUT')
                            @csrf
                            
                            <div class="row g-3">
                                <!-- Title Field -->
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="title" class="form-control" id="titleInput" 
                                               value="{{ old('title', $project->title) }}" 
                                               placeholder="Website Redesign" required>
                                        <label for="titleInput" class="form-label">
                                            <i class="bi bi-card-heading text-muted me-2"></i>Project Title
                                        </label>
                                        <div class="invalid-feedback">
                                            Please provide a project title.
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Client Selection -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="client_id" class="form-select" id="clientSelect" required>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}" @selected(old('client_id', $project->client_id) == $client->id)>
                                                    {{ $client->name }} @if($client->company)({{ $client->company }})@endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="clientSelect" class="form-label">
                                            <i class="bi bi-person-vcard text-muted me-2"></i>Client
                                        </label>
                                        <div class="invalid-feedback">
                                            Please select a client.
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Budget Field -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" name="budget" class="form-control" id="budgetInput" 
                                               value="{{ old('budget', $project->budget) }}" step="0.01" min="0"
                                               placeholder="5000.00" required>
                                        <label for="budgetInput" class="form-label">
                                            <i class="bi bi-currency-dollar text-muted me-2"></i>Budget
                                        </label>
                                        <div class="invalid-feedback">
                                            Please provide a valid budget.
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Deadline Field -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="deadline" class="form-control" id="deadlineInput" 
                                               value="{{ old('deadline', $project->deadline) }}" required>
                                        <label for="deadlineInput" class="form-label">
                                            <i class="bi bi-calendar-check text-muted me-2"></i>Deadline
                                        </label>
                                        <div class="invalid-feedback">
                                            Please select a valid deadline.
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Status Selection -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="status" class="form-select" id="statusSelect" required>
                                            @foreach(['Pending', 'Ongoing', 'Completed'] as $status)
                                                <option value="{{ $status }}" @selected(old('status', $project->status) == $status)>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="statusSelect" class="form-label">
                                            <i class="bi bi-clipboard-check text-muted me-2"></i>Status
                                        </label>
                                        <div class="invalid-feedback">
                                            Please select a status.
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Form Actions -->
                                <div class="col-12 mt-4">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary px-4">
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
        /* Custom Styles */
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
        
        .bg-soft-success {
            background-color: rgba(25, 135, 84, 0.1);
        }
        
        .bg-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
        }
        
        .bg-soft-secondary {
            background-color: rgba(108, 117, 125, 0.1);
        }
        
        .text-success {
            color: #198754 !important;
        }
        
        .text-warning {
            color: #ffc107 !important;
        }
        
        .text-secondary {
            color: #6c757d !important;
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