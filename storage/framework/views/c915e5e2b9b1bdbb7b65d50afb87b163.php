<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Roboto', sans-serif;
        }
        .registration-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .registration-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .registration-header h2 {
            color: #6c63ff;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #6c63ff;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 1rem;
        }
        .btn-primary:hover {
            background-color: #5a55e0;
        }
        .form-text {
            color: #6c63ff;
            text-align: center;
        }
        .form-text a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: bold;
        }
        .form-text a:hover {
            text-decoration: underline;
        }
        .header-logo {
            position: fixed;
            top: 10px;
            left: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 1000;
            background-color: #fff;
            padding: 5px 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header-logo i {
            font-size: 1.5rem;
            color: #6c63ff;
        }
        .header-logo span {
            font-size: 1.2rem;
            font-weight: bold;
            color: #6c63ff;
        }
    </style>
</head>
<body>
    <!-- Logo cố định -->
    <div class="header-logo">
        <i class="fas fa-piggy-bank"></i>
        <span>Money Love</span>
    </div>

    <div class="registration-container">
        <div class="registration-header">
            <i class="fas fa-piggy-bank fa-3x" style="color: #6c63ff;"></i>
            <h2>Đăng Ký Tài Khoản</h2>
        </div>
        <form method="POST" action="<?php echo e(route('register.submit')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="name" class="form-label">Họ và tên (*)</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh (*)</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại (*)</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email (*)</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Tạo mật khẩu (*)</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Tạo mật khẩu" required>
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Nhập lại mật khẩu (*)</label>
                <input type="password" class="form-control" id="confirm-password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Tiếp tục</button>
            </div>
            <p class="form-text mt-3">
                Bạn đã có tài khoản? <a href="<?php echo e(route('login')); ?>">Đăng nhập</a>
            </p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\ExpenseManagement\resources\views/register.blade.php ENDPATH**/ ?>