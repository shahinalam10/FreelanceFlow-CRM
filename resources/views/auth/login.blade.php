<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeLanceFlow-CRM | Login</title>
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
            background-image: url({{asset('backendAsset')}}/assets/img/loginb.jpg);
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
        
        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .forgot-link:hover {
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
        
        .remember-me {
            color: #555;
        }
        
        .remember-me input {
            margin-right: 8px;
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
                        <p>Manage your freelance business efficiently</p>
                    </div>
                    
                    <div class="auth-body">
                        <!-- Session Status -->
                        @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email Address -->
                            <div class="mb-4 input-icon">
                                <i class="bi bi-envelope"></i>
                                <input id="email" class="form-control" type="email" name="email" 
                                       value="{{ old('email') }}" required autofocus 
                                       placeholder="Enter your email">
                            </div>
                            @error('email')
                                <div class="text-danger mb-3">{{ $message }}</div>
                            @enderror
                            
                            <!-- Password -->
                            <div class="mb-4 input-icon">
                                <i class="bi bi-lock"></i>
                                <input id="password" class="form-control" type="password" 
                                       name="password" required autocomplete="current-password" 
                                       placeholder="Enter your password">
                            </div>
                            @error('password')
                                <div class="text-danger mb-3">{{ $message }}</div>
                            @enderror
                            
                            <!-- Remember Me -->
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="remember-me">
                                    <input id="remember_me" type="checkbox" name="remember">
                                    <label for="remember_me">{{ __('Remember me') }}</label>
                                </div>
                                
                                @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                                @endif
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> {{ __('Log in') }}
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
</body>
</html>