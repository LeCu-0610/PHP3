<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    

    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 240px;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main {
            flex: 1;
            padding: 20px;
        }
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('admin.product') }}">🛒 Product</a>
        <a href="{{ route('admin.category') }}">📂 Category</a>
                        <a href="{{ route('admin.order.index') }}">📦 Đơn hàng</a>
        
        <hr class="bg-light">
        <a href="#">⚙️ Cài đặt</a>
        <a href="#">🔐 Đăng xuất</a>
        <a class="btn btn-outline-danger" href="{{ url('/dashboard') }}">Trang Người Dùng</a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Quản trị hệ thống</span>
            </div>
        </nav>

        <!-- Nội dung page -->
        <div>
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
