<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .login-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.8rem;
        }
        
        .login-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-floating input {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .form-floating input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .form-floating label {
            color: #6c757d;
        }
        
        .btn-login {
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        .login-footer {
            text-align: center;
            padding: 20px 30px;
            border-top: 1px solid #e9ecef;
            background: #f8f9fa;
        }
        
        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .login-footer a:hover {
            color: #764ba2;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background: linear-gradient(45deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
        }
        
        .alert-success {
            background: linear-gradient(45deg, #51cf66 0%, #40c057 100%);
            color: white;
        }
        
        .input-group-text {
            background: transparent;
            border: 2px solid #e9ecef;
            border-right: none;
            color: #6c757d;
        }
        
        .input-group input {
            border-left: none;
        }
        
        .input-group input:focus + .input-group-text {
            border-color: #667eea;
        }
        
        .social-login {
            margin-top: 20px;
            text-align: center;
        }
        
        .social-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin: 0 5px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            transform: translateY(-2px);
            color: white;
        }
        
        .social-btn.facebook {
            background: #1877f2;
        }
        
        .social-btn.google {
            background: #db4437;
        }
        
        .social-btn.github {
            background: #333;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-sign-in-alt me-2"></i>Đăng nhập</h2>
            <p>Chào mừng bạn quay trở lại!</p>
        </div>
        
        <div class="login-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder="Email" 
                           value="{{ old('email') }}" required>
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Email
                    </label>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="Mật khẩu" required>
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Mật khẩu
                    </label>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                    <a href="#" class="text-decoration-none" style="color: #667eea;">
                        Quên mật khẩu?
                    </a>
                </div>
                
                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                </button>
            </form>
            
            <div class="social-login">
                <p class="text-muted mb-3">Hoặc đăng nhập với</p>
                <a href="#" class="social-btn facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-btn google">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#" class="social-btn github">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </div>
        
        <div class="login-footer">
            <p class="mb-0">
                Chưa có tài khoản? 
                <a href="{{ route('auth.register') }}">Đăng ký ngay</a>
            </p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
