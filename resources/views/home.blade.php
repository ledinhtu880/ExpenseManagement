<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Love</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            font-family: 'Inter', sans-serif;
        }

        .logo-container {
            position: fixed;
            top: 10px;
            left: 10px;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            z-index: 1000; /* Đảm bảo logo luôn hiển thị phía trên */
        }

        .logo-container img {
            width: 60px;
            height: 60px;
        }

        .logo-container span {
            font-size: 1.2rem;
        }

        .language-button {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000; /* Đảm bảo nút luôn hiển thị phía trên */
        }

        .language-button button {
            background-color: #6c63ff;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
        }

        .container {
            max-width: 800px;
            margin: 100px auto;
            text-align: center;
        }

        .carousel-container {
            margin-top: 20px;
            position: relative;
        }

        .carousel-inner {
            position: relative;
            min-height: 380px;
        }

        .carousel-item {
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            height: 100%;
        }

        .carousel-item img {
            max-width: 100%;
            max-height: 300px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .list-group-item {
            font-size: 1.2rem;
            font-weight: 500;
            border: 1px solid #6c63ff !important;
            border-radius: 10px !important;
            padding: 10px;
            text-align: center;
            margin-bottom: 50px;
        }

        .list-group-item i {
            font-size: 1.5rem;
            color: #6c63ff;
        }

        .carousel-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-top: 20px;
        }

        .carousel-indicators {
            position: absolute;
            bottom: -50px; /* Đẩy các chấm xuống phía dưới slideshow */
            display: flex; /* Đảm bảo các chấm nằm trên một hàng */
            justify-content: center; /* Căn giữa chấm bên trong container */
            gap: 10px; /* Khoảng cách giữa các chấm */
        }

        .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #6c63ff; /* Màu chấm */
        }

        .carousel-indicators .active {
            background-color: #4a4ae6; /* Màu chấm được chọn */
        }

        .btn-primary {
            background-color: #6c63ff;
            border: none;
            font-size: 0.9rem;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-secondary {
            background-color: #fff;
            color: #6c63ff;
            border: 2px solid #6c63ff;
            font-size: 0.9rem;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .action-buttons {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo-container">
        <img src="{{ asset('images/pigmoney.png') }}" alt="Logo">
        <span>Money Love</span>
    </div>

    <!-- Language Button -->
    <div class="language-button">
        <button>TIẾNG VIỆT</button>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Slideshow -->
        <div class="carousel-container">
            <div id="slideshow" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#slideshow" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#slideshow" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div>
                            <div class="list-group-item">
                                <i class="fas fa-cut"></i> Giảm các khoản chi không cần thiết
                            </div>
                            <div class="list-group-item">
                                <i class="fas fa-piggy-bank"></i> Tiết kiệm đều đặn hàng tháng
                            </div>
                            <div class="list-group-item">
                                <i class="fas fa-chart-line"></i> Quản lý tất cả ở một nơi
                            </div>
                            <h3 class="carousel-title">Quản lý tài chính hiệu quả với Money Love</h3>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div>
                            <img src="{{ asset('images/image1.png') }}" alt="Sinh viên tin tưởng" class="img-fluid">
                            <h3 class="carousel-title">Hàng nghìn sinh viên tin tưởng và yêu mến</h3>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <div>
                            <img src="{{ asset('images/image2.png') }}" alt="Hành trình tài chính" class="img-fluid">
                            <h3 class="carousel-title">Bắt đầu hành trình quản lý tài chính của bạn</h3>
                        </div>
                    </div>
                </div>
                <!-- Nút điều khiển -->
                <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
        <!-- Buttons -->
    <div class="action-buttons">
        <a href="{{ route('register') }}" class="btn btn-primary">ĐĂNG KÝ MIỄN PHÍ</a>
        <a href="{{ route('login') }}" class="btn btn-secondary">ĐĂNG NHẬP</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
