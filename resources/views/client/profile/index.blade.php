@extends('layouts.client')

@section('title', 'Hồ sơ cá nhân')

@section('content')
<style>
    .profile-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .profile-header {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2.5rem;
    }
    
    .profile-body {
        padding: 30px;
    }
    
    .form-section {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .form-section h4 {
        color: #2c3e50;
        margin-bottom: 20px;
        border-bottom: 2px solid #667eea;
        padding-bottom: 10px;
    }
    
    .btn-update {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .alert {
        border-radius: 10px;
        border: none;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background: linear-gradient(45deg, #51cf66 0%, #40c057 100%);
        color: white;
    }
    
    .alert-danger {
        background: linear-gradient(45deg, #ff6b6b 0%, #ee5a52 100%);
        color: white;
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar">
            <i class="fas fa-user"></i>
        </div>
        <h2>{{ $user->name }}</h2>
        <p class="mb-0">{{ $user->email }}</p>
    </div>
    
    <div class="profile-body">
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
        
        <!-- Thông tin cá nhân -->
        <div class="form-section">
            <h4><i class="fas fa-user-edit me-2"></i>Thông tin cá nhân</h4>
            <form method="POST" action="{{ route('client.profile.update') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Vai trò</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-update">
                    <i class="fas fa-save me-2"></i>Cập nhật thông tin
                </button>
            </form>
        </div>
        
        <!-- Đổi mật khẩu -->
        <div class="form-section">
            <h4><i class="fas fa-lock me-2"></i>Đổi mật khẩu</h4>
            <form method="POST" action="{{ route('client.profile.change-password') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" name="current_password" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-warning btn-update">
                    <i class="fas fa-key me-2"></i>Đổi mật khẩu
                </button>
            </form>
        </div>
        
        <!-- Thông tin tài khoản -->
        <div class="form-section">
            <h4><i class="fas fa-info-circle me-2"></i>Thông tin tài khoản</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Ngày tạo:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Cập nhật lần cuối:</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>ID tài khoản:</strong> #{{ $user->id }}</p>
                    <p><strong>Trạng thái:</strong> 
                        <span class="badge bg-success">Hoạt động</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
