<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #007bff;
            --hover-color: #0056b3;
            --text-light: #6c757d;
        }

        .user-panel {
            border-bottom: 1px solid #4f5962;
            padding: 20px;
            position: relative;
        }
        
        .user-panel img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            transition: transform 0.3s;
        }

        .user-panel img:hover {
            transform: scale(1.1);
            cursor: pointer;
        }
        
        .user-info {
            padding: 10px 0;
        }

        .edit-profile {
            position: absolute;
            top: 20px;
            right: 20px;
            color: var(--text-light);
            cursor: pointer;
            transition: color 0.3s;
        }

        .edit-profile:hover {
            color: var(--primary-color);
        }
        
        .menu-item {
            padding: 12px 20px;
            border-radius: 5px;
            margin: 5px 0;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .menu-item:hover {
            background-color: var(--primary-color);
            color: white;
            cursor: pointer;
            transform: translateX(5px);
        }

        .menu-item .badge {
            transition: all 0.3s;
        }

        .menu-item:hover .badge {
            background-color: white;
            color: var(--primary-color);
        }
        
        .menu-item i {
            margin-right: 10px;
            width: 20px;
        }
        
        .active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .email-text {
            color: var(--text-light);
            font-size: 0.9em;
        }

        .content-wrapper {
            background-color: #f4f6f9;
        }

        .content-header {
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .loading-spinner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Dark mode styles */
        .dark-mode .content-wrapper {
            background-color: #1a1a1a;
            color: white;
        }

        .dark-mode .content-header,
        .dark-mode .stat-card {
            background-color: #2d2d2d;
            color: white;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Loading Spinner -->
        <div class="loading-spinner">
            <i class="fas fa-spinner fa-spin fa-3x"></i>
        </div>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="user-panel text-center">
                <i class="fas fa-edit edit-profile"></i>
                <img src="public/images/logouser.jpg" alt="User Image" class="img-circle elevation-2">
                <div class="user-info">
                    <h5 class="mb-1">dphuongha212003</h5>
                    <span class="email-text">dphuongha212003@gmail.com</span>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <div class="menu-item active" data-page="account">
                            <div><i class="fas fa-user-cog"></i> Quản lý tài khoản</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="wallet">
                            <div><i class="fas fa-wallet"></i> Ví của tôi</div>
                            <span class="badge badge-primary">4</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="groups">
                            <div><i class="fas fa-users"></i> Nhóm</div>
                            <span class="badge badge-primary">2</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="bank">
                            <div><i class="fas fa-university"></i> Liên kết ngân hàng</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="events">
                            <div><i class="fas fa-bell"></i> Sự kiện</div>
                            <span class="badge badge-danger">3</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="recurring">
                            <div><i class="fas fa-calendar-check"></i> Giao dịch định kỳ</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="invoice">
                            <div><i class="fas fa-file-invoice"></i> Hóa đơn</div>
                            <span class="badge badge-info">New</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="debt">
                            <div><i class="fas fa-hand-holding-usd"></i> Sổ nợ</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="tools">
                            <div><i class="fas fa-tools"></i> Công cụ</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="travel">
                            <div><i class="fas fa-plane"></i> Chế độ du lịch</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="export">
                            <div><i class="fas fa-file-export"></i> Xuất dữ liệu tới Google Trang tính</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="store">
                            <div><i class="fas fa-store"></i> Cửa hàng</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="support">
                            <div><i class="fas fa-headset"></i> Hỗ trợ</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="settings">
                            <div><i class="fas fa-cog"></i> Cài đặt</div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="menu-item" data-page="about">
                            <div><i class="fas fa-info-circle"></i> Giới thiệu</div>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Theme Toggle -->
            <div class="p-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="darkMode">
                    <label class="custom-control-label" for="darkMode">Dark Mode</label>
                </div>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Quản lý tài khoản</h1>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="stat-card">
                                <h3>Số dư</h3>
                                <p class="text-primary">5,000,000 VND</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="stat-card">
                                <h3>Giao dịch</h3>
                                <p class="text-success">+15 hôm nay</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="stat-card">
                                <h3>Thông báo</h3>
                                <p class="text-warning">3 chưa đọc</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="stat-card">
                                <h3>Trạng thái</h3>
                                <p class="text-success">Hoạt động</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Menu item click handler
            $('.menu-item').click(function() {
                $('.menu-item').removeClass('active');
                $(this).addClass('active');
                
                // Show loading spinner
                $('.loading-spinner').show();
                
                // Simulate page load
                setTimeout(function() {
                    $('.loading-spinner').hide();
                }, 500);

                // Update header text
                $('.content-header h1').text($(this).find('div:first').text().trim());
            });

            // Profile image click handler
            $('.user-panel img').click(function() {
                alert('Click to change profile picture');
            });

            // Edit profile handler
            $('.edit-profile').click(function() {
                alert('Edit profile clicked');
            });

            // Dark mode toggle
            $('#darkMode').change(function() {
                $('body').toggleClass('dark-mode');
            });

            // Stat card hover animation
            $('.stat-card').hover(
                function() {
                    $(this).find('p').addClass('text-bold');
                },
                function() {
                    $(this).find('p').removeClass('text-bold');
                }
            );
        });
    </script>
</body>
</html>