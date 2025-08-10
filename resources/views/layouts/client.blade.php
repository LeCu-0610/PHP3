<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - E-Commerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            padding: 0.5rem 1rem !important;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background: rgba(255,255,255,0.1);
        }

        .navbar-nav .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white !important;
        }

        .btn-admin {
            background: #e74c3c;
            border: none;
            border-radius: 20px;
            color: white;
            padding: 0.5rem 1rem;
        }

        .btn-admin:hover {
            background: #c0392b;
            color: white;
        }

        .main-content {
            min-height: calc(100vh - 120px);
            padding: 1rem 0;
        }

        .page-header {
            background: white;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-left: 4px solid #667eea;
        }

        .page-title {
            color: #2c3e50;
            font-weight: bold;
            margin: 0;
            font-size: 1.5rem;
        }

        .footer {
            background: #2c3e50;
            color: white;
            padding: 1rem 0;
            margin-top: 2rem;
        }

        .cart-badge {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center;
                margin-top: 0.5rem;
            }
            
            .page-title {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('client.dashboard') }}">
                🛍️ E-Commerce
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#clientNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="clientNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('client.dashboard') ? 'active' : '' }}" 
                           href="{{ route('client.dashboard') }}">
                            <i class="fas fa-home"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('client.product*') ? 'active' : '' }}" 
                           href="{{ route('client.product') }}">
                            <i class="fas fa-box"></i> Sản phẩm
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('client.cart.*') ? 'active' : '' }} cart-badge"
                               href="{{ route('client.cart.index') }}">
                                <i class="fas fa-shopping-cart"></i> Giỏ hàng
                                <span class="cart-count">{{ $cartCount ?? 0 }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('client.order.*') ? 'active' : '' }}" 
                               href="{{ route('client.order.index') }}">
                                <i class="fas fa-list-alt"></i> Đơn hàng
                            </a>
                        </li>
                    @endauth
                </ul>

                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-cog me-2"></i>Trang quản trị
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2"></i>Cài đặt
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-admin ms-2" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-cog"></i> Quản trị
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.login') }}">
                                <i class="fas fa-sign-in-alt"></i> Đăng nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.register') }}">
                                <i class="fas fa-user-plus"></i> Đăng ký
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            @if(!request()->routeIs('client.product.show'))
                <div class="page-header">
                    <h1 class="page-title">
                        @yield('title', 'Trang chủ')
                    </h1>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="mb-0">🛍️ E-Commerce Store</h6>
                </div>
                <div class="col-md-6 text-end">
                    <small>&copy; {{ date('Y') }} E-Commerce Store. Tất cả quyền được bảo lưu.</small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add active class to current nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
