@extends('layouts.master')

@section('title', 'Budget')

@push('css')
    <style>
        .report-section {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .tab-navigation {
            display: flex;
            background: #f8f9fa;
            border-radius: 20px;
            padding: 5px;
            margin-bottom: 15px;
        }

        .tab-item {
            flex: 1;
            text-align: center;
            padding: 8px;
            cursor: pointer;
            border-radius: 15px;
        }

        @extends('layouts.master')

        @section('title', 'Budget')

        @push('css')


        .expense-chart {
            height: 200px;
            background: #f8f9fa;
            border-radius: 10px;
            margin: 15px 0;
        }

        .top-expenses {
            margin-top: 20px;
        }

        .expense-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .expense-info {
            display: flex;
            align-items: center;
        }

        .expense-percentage {
            color: #dc3545;
            font-weight: bold;
        }

        .recent-transactions {
            margin-top: 20px;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .amount-positive {
            color: #28a745;
        }

        .amount-negative {
            color: #dc3545;
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card p-3">
            <div class="d-flex gap-2 align-items-between justify-content-center flex-column">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-md fw-bold m-0">Ví của tôi</h5>
                    <a href="#" class="text-primary-color text-sm fw-bold">Xem tất cả</a>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3 align-items-center justify-content-center">
                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            width="36" alt="Wallet icon">
                        <span class="text-lg fw-semibold">Tiền mặt</span>
                    </div>
                    <h5 class="text-lg fw-semibold m-0">9.9991.000 đ</h5>
                </div>
            </div>
        </div>

        <div class="report-section">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Báo cáo tháng này</h5>
                <a href="#" class="text-primary">Xem báo cáo</a>
            </div>

            <div class="tab-navigation">
                <div class="tab-item active">Tuần</div>
                <div class="tab-item">Tháng</div>
            </div>

            <div>
                <div class="text-muted">Tổng đã chi tháng này</div>
                <h4>28.000.00 đ</h4>
            </div>

            <div class="expense-chart"></div>
        </div>

        <div class="top-expenses">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Chi tiêu nhiều nhất</h5>
                <a href="#" class="text-primary">Xem chi tiết</a>
            </div>

            <div class="expense-item">
                <div class="expense-info">
                    <img src="path/to/icon.png" alt="Category" class="wallet-icon" />
                    <div>
                        <div>Hóa đơn & Tiện ích</div>
                        <div class="text-muted">20.000.00 đ</div>
                    </div>
                </div>
                <div class="expense-percentage">72%</div>
            </div>

            <div class="expense-item">
                <div class="expense-info">
                    <img src="path/to/icon.png" alt="Category" class="wallet-icon" />
                    <div>
                        <div>Ăn uống</div>
                        <div class="text-muted">8.000.00 đ</div>
                    </div>
                </div>
                <div class="expense-percentage">28%</div>
            </div>
        </div>

        <div class="recent-transactions">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Giao dịch gần đây</h5>
                <a href="#" class="text-primary">Xem tất cả</a>
            </div>

            <div class="transaction-item">
                <div class="expense-info">
                    <img src="path/to/icon.png" alt="Transaction" class="wallet-icon" />
                    <div>
                        <div>Cho vay</div>
                        <div class="text-muted">
                            Thứ 6, 20 tháng 12 2024
                        </div>
                    </div>
                </div>
                <div class="amount-negative">2,000.00</div>
            </div>

            <div class="transaction-item">
                <div class="expense-info">
                    <img src="path/to/icon.png" alt="Transaction" class="wallet-icon" />
                    <div>
                        <div>Ăn uống</div>
                        <div class="text-muted">
                            Thứ 6, 20 tháng 12 2024
                        </div>
                    </div>
                </div>
                <div class="amount-negative">2,000.00</div>
            </div>

            <div class="transaction-item">
                <div class="expense-info">
                    <img src="path/to/icon.png" alt="Transaction" class="wallet-icon" />
                    <div>
                        <div>Thu nhập khác</div>
                        <div class="text-muted">
                            Thứ 6, 20 tháng 12 2024
                        </div>
                    </div>
                </div>
                <div class="amount-positive">5,010,000.00</div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Tab navigation
            $('.tab-item').click(function() {
                $('.tab-item').removeClass('active');
                $(this).addClass('active');
            });

            // Initialize expense chart
            const ctx = document.createElement('canvas');
            $('.expense-chart').append(ctx);
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                    datasets: [{
                        label: 'Chi tiêu',
                        data: [12, 19, 3, 5, 2, 3, 8],
                        backgroundColor: '#6f42c1'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
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
        });
    </script>
@endpush
