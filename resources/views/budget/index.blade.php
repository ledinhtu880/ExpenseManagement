<!-- budget.index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Tracker</title>
    <!-- AdminLTE 3 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .budget-circle {
            position: relative;
            width: 300px;
            height: 300px;
            margin: 0 auto;
        }
        
        .budget-amount {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        
        .budget-amount h3 {
            color: #28a745;
            font-size: 2rem;
            margin-bottom: 0;
        }
        
        .budget-amount p {
            color: #6c757d;
            margin-top: 0;
        }
        
        .budget-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            text-align: center;
        }
        
        .budget-stat-item {
            color: #6c757d;
        }
        
        .budget-stat-item h4 {
            margin-bottom: 5px;
        }
        
        .budget-category {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .progress {
            height: 8px;
        }
        
        .create-budget-btn {
            background: #6f42c1;
            border: none;
            color: white;
            padding: 10px 30px;
            border-radius: 20px;
            margin: 20px 0;
            width: 25%;
            margin-left: 37.5%;
        }
        
        .budget-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .budget-header img {
            width: 30px;
            margin-right: 10px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="budget-header">
                                    <img src="path/to/vietnam-flag.png" alt="Flag">
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="budgetDropdown" data-toggle="dropdown">
                                            Ngân sách đang áp dụng
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Budget 1</a>
                                            <a class="dropdown-item" href="#">Budget 2</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="budget-circle">
                                    <div class="budget-amount">
                                        <h3>992,000.00</h3>
                                        <p>Số tiền bạn có thể chi</p>
                                    </div>
                                </div>

                                <div class="budget-stats">
                                    <div class="budget-stat-item">
                                        <h4>1 M</h4>
                                        <p>Tổng ngân sách</p>
                                    </div>
                                    <div class="budget-stat-item">
                                        <h4>8 K</h4>
                                        <p>Tổng đã chi</p>
                                    </div>
                                    <div class="budget-stat-item">
                                        <h4>4 ngày</h4>
                                        <p>Đến cuối tháng</p>
                                    </div>
                                </div>

                                <button class="btn create-budget-btn btn-block">Tạo Ngân sách</button>

                                <div class="budget-categories">
                                    <div class="budget-category">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="path/to/food-icon.png" alt="Food" style="width: 40px; margin-right: 10px;">
                                                <span>Ăn uống</span>
                                            </div>
                                            <div class="text-right">
                                                <h5>1,000,000.00</h5>
                                                <small class="text-muted">Còn lại 992,000.00</small>
                                            </div>
                                        </div>
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0.8%" aria-valuenow="0.8" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Add budget category
            $('.create-budget-btn').click(function() {
                // Add your logic for creating a new budget
                alert('Creating new budget...');
            });

            // Update progress bars
            function updateProgress() {
                $('.budget-category').each(function() {
                    let total = parseFloat($(this).find('h5').text().replace(/,/g, ''));
                    let remaining = parseFloat($(this).find('small').text().replace(/[^0-9.]/g, ''));
                    let percentage = ((total - remaining) / total) * 100;
                    $(this).find('.progress-bar').css('width', percentage + '%');
                });
            }

            // Initial progress update
            updateProgress();

            // Format currency
            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'decimal',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(amount);
            }
        });
    </script>
</body>
</html>