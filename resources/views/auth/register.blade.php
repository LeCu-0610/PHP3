<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - E-Commerce</title>
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
            padding: 20px 0;
        }
        
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
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
        
        .register-header {
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .register-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.8rem;
        }
        
        .register-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .register-body {
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
        
        .btn-register {
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .register-footer {
            text-align: center;
            padding: 20px 30px;
            border-top: 1px solid #e9ecef;
            background: #f8f9fa;
        }
        
        .register-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .register-footer a:hover {
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
        
        .password-strength {
            margin-top: 5px;
            font-size: 0.8rem;
        }
        
        .strength-weak {
            color: #dc3545;
        }
        
        .strength-medium {
            color: #ffc107;
        }
        
        .strength-strong {
            color: #28a745;
        }
        
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        .terms-link {
            color: #667eea;
            text-decoration: none;
        }
        
        .terms-link:hover {
            color: #764ba2;
        }
        
        .social-register {
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
    <div class="register-container">
        <div class="register-header">
            <h2><i class="fas fa-user-plus me-2"></i>Đăng ký</h2>
            <p>Tạo tài khoản mới để bắt đầu mua sắm!</p>
        </div>
        
        <div class="register-body">
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
            
            <form method="POST" action="{{ route('auth.register') }}" id="registerForm">
                @csrf
                
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" placeholder="Họ và tên" 
                           value="{{ old('name') }}" required>
                    <label for="name">
                        <i class="fas fa-user me-2"></i>Họ và tên
                    </label>
                </div>
                
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder="Email" 
                           value="{{ old('email') }}" required>
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Email
                    </label>
                </div>
                
                <div class="form-floating">
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                           id="phone" name="phone" placeholder="Số điện thoại" 
                           value="{{ old('phone') }}">
                    <label for="phone">
                        <i class="fas fa-phone me-2"></i>Số điện thoại (tùy chọn)
                    </label>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="Mật khẩu" required>
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Mật khẩu
                    </label>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" name="password_confirmation" 
                           placeholder="Xác nhận mật khẩu" required>
                    <label for="password_confirmation">
                        <i class="fas fa-lock me-2"></i>Xác nhận mật khẩu
                    </label>
                </div>
                
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="agree" name="agree" required>
                    <label class="form-check-label" for="agree">
                        Tôi đồng ý với <a href="#" class="terms-link">Điều khoản sử dụng</a> và 
                        <a href="#" class="terms-link">Chính sách bảo mật</a>
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-register">
                    <i class="fas fa-user-plus me-2"></i>Đăng ký
                </button>
            </form>
            
            <div class="social-register">
                <p class="text-muted mb-3">Hoặc đăng ký với</p>
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
        
        <div class="register-footer">
            <p class="mb-0">
                Đã có tài khoản? 
                <a href="{{ route('auth.login') }}">Đăng nhập ngay</a>
            </p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('passwordStrength');
            let strength = 0;
            let message = '';
            
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            if (strength < 2) {
                message = '<span class="strength-weak">Mật khẩu yếu</span>';
            } else if (strength < 4) {
                message = '<span class="strength-medium">Mật khẩu trung bình</span>';
            } else {
                message = '<span class="strength-strong">Mật khẩu mạnh</span>';
            }
            
            strengthDiv.innerHTML = message;
        });
        
        // Password confirmation checker
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            
            if (confirmation && password !== confirmation) {
                this.setCustomValidity('Mật khẩu không khớp');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>
