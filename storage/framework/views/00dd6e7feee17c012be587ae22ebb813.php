<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Roboto', sans-serif;
        }
        .carousel {
            position: relative;
            width: 100%;
            max-width: 960px;
            margin: 96px auto;
        }
        .carousel-inner {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height: 400px;
            border: 3px solid #6c63ff; 
        }
        
        .carousel-item h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .carousel-item img {
            max-height: 300px;
            width: auto;
            border-radius: 15px;
            margin: 0 auto;
        }
        .header-icons {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .header-icons i {
            font-size: 1.5rem;
            margin-left: 15px;
            color: #6c63ff;
            cursor: pointer;
        }
        .header-logo {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header-logo i {
            font-size: 2rem;
            color: #6c63ff;
        }
        .header-logo span {
            font-size: 1.5rem;
            font-weight: bold;
            color: #6c63ff;
        }
        .btn-primary {
            background-color: #6c63ff;
            border: none;
            font-size: 1rem;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-secondary {
            background-color: #fff;
            color: #6c63ff;
            border: 2px solid #6c63ff;
            font-size: 1rem;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .action-buttons {
            position: relative;
            margin-top: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }
        .list-group-item {
            font-size: 1.2rem;
            font-weight: 500;
            border: 1px solid #6c63ff; 
            display: flex;
            align-items: center;
            margin-bottom: 0; 
            justify-content: center;
            border-radius: 10px; 
            padding: 10px; 
            height: calc((400px - 100px) / 3); 
        }
        .list-group-item i {
            font-size: 1.5rem;
            color: #6c63ff;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="header-logo">
            <i class="fas fa-piggy-bank"></i>
            <span>Money Love</span>
        </div>
        <div class="header-icons">
            <i class="fas fa-globe"></i>
        </div>
        <div class="text-center">
            <div id="slideshow" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <h3>Quản lý tài chính hiệu quả với Money Love</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="fas fa-cut"></i> Giảm các khoản chi không cần thiết
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-piggy-bank"></i> Tiết kiệm đều đặn hàng tháng
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-chart-line"></i> Quản lý tất cả ở một nơi
                            </li>
                        </ul>
                    </div>
                    <div class="carousel-item">
                        <h3>Hàng nghìn sinh viên tin tưởng và yêu mến</h3>
                        <img src="<?php echo e(asset('images/image1.png')); ?>" class="d-block mx-auto" alt="Sinh viên tin tưởng">
                    </div>
                    <div class="carousel-item">
                        <h3>Bắt đầu hành trình tài chính của bạn</h3>
                        <img src="<?php echo e(asset('images/image2.png')); ?>" class="d-block mx-auto" alt="Hành trình tài chính">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="action-buttons">
                <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">ĐĂNG KÝ MIỄN PHÍ</a>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-secondary">ĐĂNG NHẬP</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\ExpenseManagement\resources\views/home.blade.php ENDPATH**/ ?>