<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Love - Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Logo */
        .logo-container {
            position: fixed;
            top: 10px;
            left: 10px;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            z-index: 1000;
        }

        .logo-container img {
            width: 60px;
            height: 60px;
        }

        .logo-container span {
            font-size: 1.2rem;
        }

        /* Registration Container */
        .registration-container {
            max-width: 600px;
            margin: 80px auto 50px;
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
            font-weight: 700;
            font-size: 1.8rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        .btn-primary {
            background-color: #6c63ff;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #5a55e0;
        }

        .form-text {
            color: #6c63ff;
            text-align: center;
            font-weight: 500;
        }

        .form-text a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: bold;
        }

        .form-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo-container">
        <img src="{{ asset('images/pigmoney.png') }}" alt="Logo">
        <span>Money Love</span>
    </div>

    <!-- Registration Form -->
    <div class="registration-container">
        <div class="registration-header">
            <h2>Đăng Ký Tài Khoản</h2>
        </div>
        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            <!-- Họ và tên -->
            <div class="mb-3">
                <label for="name" class="form-label">Họ và tên (*)</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
            </div>

            <!-- Email cá nhân -->
            <div class="mb-3">
                <label for="email" class="form-label">Email cá nhân (*)</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email cá nhân" required>
            </div>

            <!-- Email sinh viên -->
            <div class="mb-3">
                <label for="student_email" class="form-label">Email sinh viên (Không bắt buộc)</label>
                <input type="email" class="form-control" id="student_email" name="student_email" placeholder="Nhập email sinh viên">
            </div>

            <!-- Giới tính -->
            <div class="mb-3">
                <label for="gender" class="form-label">Giới tính (*)</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="" disabled selected>Chọn giới tính</option>
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                    <option value="other">Khác</option>
                </select>
            </div>

            <!-- Ngày tháng năm sinh -->
            <div class="mb-3">
                <label for="dob" class="form-label">Ngày tháng năm sinh (*)</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>

            <!-- Căn cước công dân -->
            <div class="mb-3">
                <label for="identity_card" class="form-label">Căn cước công dân (*)</label>
                <input type="text" class="form-control" id="identity_card" name="identity_card" placeholder="Nhập số căn cước công dân" required>
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Tiếp tục</button>
            </div>
            <p class="form-text mt-3">
                Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
