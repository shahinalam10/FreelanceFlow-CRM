<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeLanceFlow-CRM | Register</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #6c63ff;
            --secondary-color: #4d44db;
            --accent-color: #ff6584;
        }
        
        body {
            background-color: #f8f9fa;
            background-image: url({{asset('backendAsset')}}/assets/img/register.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .auth-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
        }
        
        .auth-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .auth-logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .auth-logo span {
            color: var(--accent-color);
        }
        
        .auth-body {
            padding: 2rem;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(108, 99, 255, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .auth-link {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .auth-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
        }
        
        .input-icon input {
            padding-left: 40px !important;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .password-strength {
            height: 4px;
            background: #e9ecef;
            margin-top: 8px;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="auth-card">
                    <div class="auth-header">
                        <div class="auth-logo">Free<span>Lance</span>Flow-CRM</div>
                        <p>Create your account to manage your freelance business</p>
                    </div>
                    
                    <div class="auth-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <!-- Name -->
                            <div class="mb-4 input-icon">
                                <i class="bi bi-person"></i>
                                <input id="name" class="form-control" type="text" name="name" 
                                       value="{{ old('name') }}" required autofocus 
                                       placeholder="Full Name">
                            </div>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            
                            <!-- Email Address -->
                            <div class="mb-4 input-icon">
                                <i class="bi bi-envelope"></i>
                                <input id="email" class="form-control" type="email" name="email" 
                                       value="{{ old('email') }}" required 
                                       placeholder="Email Address">
                            </div>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            
                            <!-- Password -->
                            <div class="mb-3 input-icon">
                                <i class="bi bi-lock"></i>
                                <input id="password" class="form-control" type="password" 
                                       name="password" required autocomplete="new-password"
                                       placeholder="Password">
                                <div class="password-strength">
                                    <div class="password-strength-bar" id="password-strength-bar"></div>
                                </div>
                            </div>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            
                            <!-- Confirm Password -->
                            <div class="mb-4 input-icon">
                                <i class="bi bi-lock-fill"></i>
                                <input id="password_confirmation" class="form-control" 
                                       type="password" name="password_confirmation" required 
                                       placeholder="Confirm Password">
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a class="auth-link" href="{{ route('login') }}">
                                    <i class="bi bi-arrow-left-short"></i> {{ __('Already registered?') }}
                                </a>
                                
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }} <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Password Strength Indicator -->
    <script>
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('password-strength-bar');
            let strength = 0;
            
            // Length check
            if (password.length > 7) strength += 25;
            if (password.length > 11) strength += 25;
            
            // Character type checks
            if (password.match(/[a-z]/)) strength += 10;
            if (password.match(/[A-Z]/)) strength += 10;
            if (password.match(/[0-9]/)) strength += 10;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 20;
            
            // Update strength bar
            strengthBar.style.width = Math.min(strength, 100) + '%';
            
            // Update color
            if (strength < 40) {
                strengthBar.style.backgroundColor = '#dc3545'; // Red
            } else if (strength < 70) {
                strengthBar.style.backgroundColor = '#fd7e14'; // Orange
            } else if (strength < 90) {
                strengthBar.style.backgroundColor = '#ffc107'; // Yellow
            } else {
                strengthBar.style.backgroundColor = '#28a745'; // Green
            }
        });
    </script>
</body>
</html>