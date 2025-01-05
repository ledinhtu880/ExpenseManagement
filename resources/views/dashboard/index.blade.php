<!-- main.index.php -->
@include('layouts.sidebar')
@extends('layouts.master')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
    <!-- AdminLTE 3 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .user-panel {
            border-bottom: 1px solid #4f5962;
            padding: 1rem;
        }

        .user-panel img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .sidebar-menu .nav-item {
            border-bottom: 1px solid #f8f9fa;
        }

        .sidebar-menu .nav-link {
            color: #343a40;
            padding: 1rem;
            display: flex;
            align-items: center;
        }

        .sidebar-menu .nav-link:hover {
            background-color: #f8f9fa;
        }

        .sidebar-menu .nav-link i {
            margin-right: 10px;
        }

        .nav-link.active {
            color: #007bff !important;
            background-color: #f8f9fa;
        }

        .content-wrapper {
            background-color: #f4f6f9;
            min-height: 100vh;
        }

        .main-content {
            padding: 20px;
        }
    </style>
</head>

<body class="sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Sidebar -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- User Panel -->
            <div class="user-panel">
                <div class="d-flex align-items-center">
                    <div class="image">
                        <img src="/api/placeholder/50/50" alt="User Image" class="img-circle elevation-2">
                    </div>
                    <div class="info ml-3">
                        <div>dphuongha212003</div>
                        <small class="text-muted">dphuongha212003@gmail.com</small>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column sidebar-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-user"></i>
                            <p>Quản lý tài khoản</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-wallet"></i>
                            <p>Ví của tôi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>Nhóm</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-university"></i>
                            <p>Liên kết ngân hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Sự kiện</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-clock"></i>
                            <p>Giao dịch định kỳ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-invoice"></i>
                            <p>Hóa đơn</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-alt"></i>
                            <p>Sổ nợ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-tools"></i>
                            <p>Công cụ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-plane"></i>
                            <p>Chế độ du lịch</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-export"></i>
                            <p>Xuất dữ liệu tới Google Trang tính</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-store"></i>
                            <p>Cửa hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-question-circle"></i>
                            <p>Hỗ trợ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <p>Cài đặt</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-info-circle"></i>
                            <p>Giới thiệu</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="main-content">
                <div class="container-fluid">
                    <h1 class="h3 mb-4">Quản lý tài khoản</h1>
                    <!-- Add your main content here -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle sidebar menu item clicks
            $('.nav-link').click(function(e) {
                e.preventDefault();
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
            });

            // Initialize AdminLTE
            $('body').Layout('fixLayoutHeight');
        });
    </script>
</body>

</html>
