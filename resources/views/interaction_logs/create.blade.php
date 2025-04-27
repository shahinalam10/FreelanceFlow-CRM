@extends('includes.master')
@section('title', 'Create Interaction Log')
@section('content')
<main id="main" class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <!-- Form Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="fw-bold text-primary mb-0">
                                <i class="bi bi-chat-left-text-fill me-2"></i>
                                Add Interaction Log
                            </h2>
                            <a href="{{ route('interaction-logs.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Back to Logs
                            </a>
                        </div>
    
                        <!-- Interaction Log Form -->
                        <form method="POST" action="{{ route('interaction-logs.store') }}" class="needs-validation" novalidate>
                            @csrf
                            
                            <div class="row g-3">
                                <!-- Client Selection -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="client_id" class="form-select" id="clientSelect" required>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}" @selected(old('client_id') == $client->id)>
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
    
                                <!-- Interaction Type -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="type" class="form-select" id="typeSelect" required>
                                            <option value="call" @selected(old('type') == 'call')>
                                                <i class="bi bi-telephone me-1"></i> Call
                                            </option>
                                            <option value="email" @selected(old('type') == 'email')>
                                                <i class="bi bi-envelope me-1"></i> Email
                                            </option>
                                            <option value="meeting" @selected(old('type') == 'meeting')>
                                                <i class="bi bi-people me-1"></i> Meeting
                                            </option>
                                        </select>
                                        <label for="typeSelect" class="form-label">
                                            <i class="bi bi-chat-dots text-muted me-2"></i>Interaction Type
                                        </label>
                                        <div class="invalid-feedback">
                                            Please select an interaction type.
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Interaction Date -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="interaction_date" class="form-control" id="dateInput" 
                                               value="{{ old('interaction_date', date('Y-m-d')) }}" required
                                               max="{{ date('Y-m-d') }}">
                                        <label for="dateInput" class="form-label">
                                            <i class="bi bi-calendar-date text-muted me-2"></i>Date
                                        </label>
                                        <div class="invalid-feedback">
                                            Please select a valid date.
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Notes Field -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="notes" class="form-control" id="notesInput" 
                                                  placeholder="Interaction details" style="height: 120px">{{ old('notes') }}</textarea>
                                        <label for="notesInput" class="form-label">
                                            <i class="bi bi-journal-text text-muted me-2"></i>Notes
                                        </label>
                                    </div>
                                </div>
    
                                <!-- Form Actions -->
                                <div class="col-12 mt-4">
                                    <div class="d-flex justify-content-end gap-3">
                                        <button type="reset" class="btn btn-outline-danger px-4">
                                            <i class="bi bi-eraser-fill me-1"></i> Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-save-fill me-1"></i> Save Interaction
                                        </button>
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