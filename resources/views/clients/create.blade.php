<!-- create.blade.php -->
@extends('includes.master')
@section('title', 'Create Client')
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
                            <i class="bi bi-person-plus-fill me-2"></i>
                            Add New Client
                        </h2>
                        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back to Clients
                        </a>
                    </div>

                    <!-- Client Form -->
                    <form action="{{ route('clients.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="nameInput" 
                                        value="{{ old('name', $client->name ?? '') }}" 
                                        placeholder="John Doe" required>
                                    <label for="nameInput" class="form-label">
                                        <i class="bi bi-person-fill text-muted me-2"></i>Full Name
                                    </label>
                                    <div class="invalid-feedback">
                                        Please provide a valid name.
                                    </div>
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="emailInput" 
                                        value="{{ old('email', $client->email ?? '') }}" 
                                        placeholder="john@example.com" required>
                                    <label for="emailInput" class="form-label">
                                        <i class="bi bi-envelope-fill text-muted me-2"></i>Email Address
                                    </label>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                     @enderror
                                    <div class="invalid-feedback">
                                        Please provide a valid email.
                                    </div>
                                </div>
                            </div>

                            <!-- Phone Field -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" name="phone" class="form-control" id="phoneInput" 
                                        value="{{ old('phone', $client->phone ?? '') }}" 
                                        placeholder="+1 (123) 456-7890" required>
                                    <label for="phoneInput" class="form-label">
                                        <i class="bi bi-telephone-fill text-muted me-2"></i>Phone Number
                                    </label>
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                     @enderror
                                    <div class="invalid-feedback">
                                        Please provide a valid phone number.
                                    </div>
                                </div>
                            </div>

                            <!-- Company Field -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="company" class="form-control" id="companyInput" 
                                        value="{{ old('company', $client->company ?? '') }}" 
                                        placeholder="Acme Inc.">
                                    <label for="companyInput" class="form-label">
                                        <i class="bi bi-building-fill text-muted me-2"></i>Company
                                    </label>
                                </div>
                            </div>

                            <!-- Notes Field -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="notes" class="form-control" id="notesInput" 
                                            placeholder="Additional notes" style="height: 120px">{{ old('notes', $client->notes ?? '') }}</textarea>
                                    <label for="notesInput" class="form-label">
                                        <i class="bi bi-pencil-fill text-muted me-1"></i>Notes
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
                                        <i class="bi bi-save-fill me-1"></i> Save Client
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

  
