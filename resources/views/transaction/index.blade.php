<!-- transaction.index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
    <!-- AdminLTE 3 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .transaction-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .transaction-header img {
            width: 500px;
            align-items: right;
            justify-content: right;
        }
        
        .month-navigation {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .month-item {
            padding: 5px 15px;
            cursor: pointer;
            color: #6c757d;
        }
        
        .month-item.active {
            color: #6f42c1;
            border-bottom: 2px solid #6f42c1;
        }
        
        .balance-summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .balance-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
        
        .transaction-day {
            margin: 20px 0;
        }
        
        .day-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .transaction-info {
            display: flex;
            align-items: center;
        }
        
        .transaction-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 15px;
        }
        
        .transaction-amount {
            color: #dc3545;
        }
        
        .transaction-amount.positive {
            color: #28a745;
        }
        
        .add-transaction-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #6f42c1;
            color: white;
            border: none;
            font-size: 24px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .view-report-link {
            color: #6f42c1;
            text-decoration: none;
            display: block;
            text-align: center;
            padding: 10px;
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
                                <div class="transaction-header">
                                    <img src="path/to/vietnam-flag.png" alt="Flag">
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="totalDropdown" data-toggle="dropdown">
                                            Tổng cộng
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Option 1</a>
                                            <a class="dropdown-item" href="#">Option 2</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="month-navigation">
                                    <div class="month-item">9/2024</div>
                                    <div class="month-item">10/2024</div>
                                    <div class="month-item">Tháng trước</div>
                                    <div class="month-item active">Tháng này</div>
                                    <div class="month-item">Tương lai</div>
                                </div>

                                <div class="balance-summary">
                                    <div class="balance-row">
                                        <span>Số dư đầu</span>
                                        <span>0.00 đ</span>
                                    </div>
                                    <div class="balance-row">
                                        <span>Số dư cuối</span>
                                        <span>+9,991,000.00 đ</span>
                                    </div>
                                    <div class="balance-row">
                                        <strong>Tổng cộng</strong>
                                        <strong>+9,991,000.00 đ</strong>
                                    </div>
                                </div>

                                <a href="#" class="view-report-link">Xem báo cáo cho giai đoạn này</a>

                                <div class="transaction-day">
                                    <div class="day-header">
                                        <h5>20</h5>
                                        <span>Thứ 6, tháng 12 2024</span>
                                        <span>-4,000.00</span>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="transaction-info">
                                            <img src="path/to/icon.png" alt="Transaction" class="transaction-icon">
                                            <div>
                                                <div>Cho vay</div>
                                            </div>
                                        </div>
                                        <div class="transaction-amount">2,000.00</div>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="transaction-info">
                                            <img src="path/to/icon.png" alt="Transaction" class="transaction-icon">
                                            <div>
                                                <div>Ăn uống</div>
                                            </div>
                                        </div>
                                        <div class="transaction-amount">2,000.00</div>
                                    </div>
                                </div>

                                <div class="transaction-day">
                                    <div class="day-header">
                                        <h5>18</h5>
                                        <span>Thứ 6, tháng 12 2024</span>
                                        <span>-4,000.00</span>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="transaction-info">
                                            <img src="path/to/icon.png" alt="Transaction" class="transaction-icon">
                                            <div>
                                                <div>Cho vay</div>
                                            </div>
                                        </div>
                                        <div class="transaction-amount">2,000.00</div>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="transaction-info">
                                            <img src="path/to/icon.png" alt="Transaction" class="transaction-icon">
                                            <div>
                                                <div>Ăn uống</div>
                                            </div>
                                        </div>
                                        <div class="transaction-amount">2,000.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <button class="add-transaction-btn">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            // Month navigation
            $('.month-item').click(function() {
                $('.month-item').removeClass('active');
                $(this).addClass('active');
            });

            // Format currency
            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'decimal',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(amount) + ' đ';
            }

            // Add transaction button
            $('.add-transaction-btn').click(function() {
                // Add your logic for adding a new transaction
                alert('Adding new transaction...');
            });

            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>