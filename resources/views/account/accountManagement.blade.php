<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tài Khoản</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
        }
        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
            border: 3px solid #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-info {
            text-align: center;
            margin-bottom: 30px;
        }
        .action-button {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            text-align: left;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .action-button:hover {
            transform: translateX(5px);
        }
        .change-password {
            background: #f8f9fa;
            color: #007bff;
        }
        .logout {
            background: #f8f9fa;
            color: #dc3545;
        }
        .delete-account {
            background: #f8f9fa;
            color: #dc3545;
        }
        .modal-header, .modal-footer {
            border: none;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="nav-buttons">
                <button class="btn btn-outline-secondary" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </button>
                <h4 class="mb-0">Quản Lý Tài Khoản</h4>
                <div style="width: 40px;"></div>
            </div>

            <div class="profile-container">
                <div class="profile-info">
                    <img src="public/images/logouser.jpg" alt="Profile" class="profile-image">
                    <h4>dphuongha212003</h4>
                    <p class="text-muted">dphuongha212003@gmail.com</p>
                </div>

                <button class="action-button change-password" data-toggle="modal" data-target="#passwordModal">
                    <i class="fas fa-key mr-2"></i> Thay Đổi Mật Khẩu
                </button>

                <button class="action-button logout">
                    <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                </button>

                <button class="action-button delete-account" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash-alt mr-2"></i> Xóa tài khoản
                </button>
            </div>
        </div>
    </div>

    <!-- Password Change Modal -->
    <div class="modal fade" id="passwordModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Thay Đổi Mật Khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm">
                        <div class="form-group">
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="currentPassword">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" class="form-control" id="newPassword">
                        </div>
                        <div class="form-group">
                            <label>Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="confirmPassword">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" onclick="changePassword()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Xóa Tài Khoản</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa tài khoản? Hành động này không thể hoàn tác.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" onclick="deleteAccount()">Xóa tài khoản</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function changePassword() {
            const currentPassword = $('#currentPassword').val();
            const newPassword = $('#newPassword').val();
            const confirmPassword = $('#confirmPassword').val();

            if (!currentPassword || !newPassword || !confirmPassword) {
                alert('Vui lòng điền đầy đủ thông tin');
                return;
            }

            if (newPassword !== confirmPassword) {
                alert('Mật khẩu mới không khớp');
                return;
            }

            // Add password change logic here
            $('#passwordModal').modal('hide');
            alert('Đổi mật khẩu thành công');
        }

        function deleteAccount() {
            // Add delete account logic here
            $('#deleteModal').modal('hide');
            alert('Tài khoản đã được xóa');
            // Redirect to login page
        }

        $('.logout').click(function() {
            if(confirm('Bạn có chắc chắn muốn đăng xuất?')) {
                // Add logout logic here
                alert('Đăng xuất thành công');
                // Redirect to login page
            }
        });
    </script>
</body>
</html>