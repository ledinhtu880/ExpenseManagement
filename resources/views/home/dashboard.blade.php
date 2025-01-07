@extends('layouts.master')

@section('title', 'Budget')

@section('content')
    <div class="container-fluid">
        <div class="card rounded-3 border-primary-color">
            <div class="card-body">
                <div class="d-flex gap-2 align-items-between justify-content-center flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-md fw-bold m-0">Ví của tôi</h5>
                        <a href="#" class="text-primary-color text-sm fw-bold">Xem tất cả</a>
                    </div>
                    <div class="line"></div>
                    <div class="d-flex justify-content-between align-items-start flex-column gap-3">
                        @foreach ($user->topWallets() as $wallet)
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-flex gap-3 align-items-center justify-content-center">
                                    <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                        class="img-circle elevation-2" width="30" alt="Wallet icon">
                                    <span class="text-lg fw-semibold">{{ $wallet->name }}</span>
                                </div>
                                <h5 class="text-lg fw-semibold m-0">{{ $wallet->formatted_balance }}</h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Report -->
        <div class="card rounded-3 border-primary-color">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 id="tab-content-title">Báo cáo tuần này</h5>
                    <a href="#" class="text-primary-color text-sm fw-bold">Xem báo cáo</a>
                </div>
                <div class="d-flex align-items-center justify-content-center tab-navigation-wrapper">
                    <ul class="nav nav-pills nav-fill mb-3 w-25 bg-body-secondary rounded-3 p-2" id="report-pills-tab"
                        role="tablist">
                        <li class="nav-item text-lg" role="presentation">
                            <button class="nav-link text-dark rounded-3 active" id="report-pills-week-tab"
                                data-bs-toggle="pill" data-bs-target="#report-pills-week" type="button" role="tab"
                                aria-controls="report-pills-week" aria-selected="true">Tuần</button>
                        </li>
                        <li class="nav-item text-lg" role="presentation">
                            <button class="nav-link text-dark rounded-3" id="report-pills-month-tab" data-bs-toggle="pill"
                                data-bs-target="#report-pills-month" type="button" role="tab"
                                aria-controls="report-pills-month" aria-selected="false">Tháng</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="report-pills-tabContent">
                    <div class="tab-pane fade show active" id="report-pills-week" role="tabpanel"
                        aria-labelledby="report-pills-week-tab" tabindex="0">
                        <div id="weekly-expense-chart" style="height: 300px;"></div>
                    </div>
                    <div class="tab-pane fade" id="report-pills-month" role="tabpanel"
                        aria-labelledby="report-pills-month-tab" tabindex="0">
                        <div id="monthly-expense-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.report -->

        <!-- Most spend -->
        <div class="card rounded-3 border-primary-color">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Chi tiêu nhiều nhất</h5>
                    <a href="#" class="text-primary-color text-sm fw-bold">Xem chi tiết</a>
                </div>
                <div class="d-flex align-items-center justify-content-center tab-navigation-wrapper">
                    <ul class="nav nav-pills nav-fill mb-3 w-25 bg-body-secondary rounded-3 p-2" id="category-pills-tab"
                        role="tablist">
                        <li class="nav-item text-lg" role="presentation">
                            <button class="nav-link text-dark rounded-3 active" id="category-pills-week-tab"
                                data-bs-toggle="pill" data-bs-target="#category-pills-week" type="button" role="tab"
                                aria-controls="category-pills-week" aria-selected="true">Tuần</button>
                        </li>
                        <li class="nav-item text-lg" role="presentation">
                            <button class="nav-link text-dark rounded-3" id="category-pills-month-tab" data-bs-toggle="pill"
                                data-bs-target="#category-pills-month" type="button" role="tab"
                                aria-controls="category-pills-month" aria-selected="false">Tháng</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content list-transaction" id="category-pills-tabContent">
                    <div class="tab-pane fade show active" id="category-pills-week" role="tabpanel"
                        aria-labelledby="category-pills-week-tab" tabindex="0">
                        <div class="list-group">
                            @foreach ($user->getWeeklyCategoryExpenses() as $expense)
                                <div class="list-group-item border-0 bg-body-secondary rounded-4">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                            class="img-circle elevation-2" width="80" alt="Category Image">
                                        <div class="d-flex align-items-between justify-content-center flex-column">
                                            <h6>{{ $expense['name'] }}</h6>
                                            <strong class="text-muted">{{ $expense['total'] }}</strong>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold text-danger">{{ $expense['percentage'] }}</h5>
                                </div>
                                @if (!$loop->last)
                                    <div class="my-2"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="category-pills-month" role="tabpanel"
                        aria-labelledby="category-pills-month-tab" tabindex="0">
                        <div class="list-group">
                            @foreach ($user->getMonthlyCategoryExpenses() as $expense)
                                <div class="list-group-item border-0 bg-body-secondary rounded-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                            class="img-circle elevation-2" width="80" alt="Category Image">
                                        <div class="d-flex align-items-between justify-content-center flex-column">
                                            <h6>{{ $expense['name'] }}</h6>
                                            <strong class="text-muted">{{ $expense['total'] }}</strong>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold text-danger">{{ $expense['percentage'] }}</h5>
                                </div>
                                @if (!$loop->last)
                                    <div class="my-2"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.most spend -->

        <!-- Recent transaction -->
        <div class="card rounded-3 border-primary-color">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Giao dịch hôm nay</h5>
                </div>

                @if ($user->getTodayTransactions()->isEmpty())
                    <h5 class="text-center">Hôm nay chưa có giao dịch nào</h5>
                @else
                    <div class="list-transaction mt-3">
                        <div class="list-group">
                            @foreach ($user->getTodayTransactions() as $transaction)
                                <div class="list-group-item border-0 bg-body-secondary rounded-4">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                            class="img-circle elevation-2" width="80" alt="User Image">
                                        <div class="d-flex align-items-between justify-content-center flex-column">
                                            <h6>{{ $transaction->category->name }}</h6>
                                            <strong class="text-muted">{{ $transaction->formatted_amount }}</strong>
                                        </div>
                                    </div>
                                    <div class="btn btn-lg text-primary-color"><i class="fa-solid fa-eye"></i></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- /.recent transaction -->

        {{-- <button type="button" class="position-absolute btn btn-primary-color rounded-circle p-5"
            style="bottom: 50px; right: 50px;">
            <i class="fa-solid fa-plus" style="font-size: 30px;"></i>
        </button> --}}
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            const message = '{{ session('message') }}';
            const type = '{{ session('type') }}';

            if (message && type) {
                showToast(message, type);
            }

            $('.tab-item').click(function() {
                $('.tab-item').removeClass('active');
                $(this).addClass('active');
            });

            // Initialize expense charts
            const weeklyExpenses = @json($user->getWeeklyExpenses());
            const monthlyExpenses = @json($user->getMonthlyExpenses());

            function initializeChart(ctxSelector, data, label) {
                const ctx = document.createElement('canvas');
                $(ctxSelector).append(ctx);
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data),
                        datasets: [{
                            label: label,
                            data: Object.values(data),
                            backgroundColor: '#6f42c1'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }

            initializeChart('#weekly-expense-chart', weeklyExpenses, 'Chi tiêu hàng tuần');
            initializeChart('#monthly-expense-chart', monthlyExpenses, 'Chi tiêu hàng tháng');

            // Format currency
            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'decimal',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(amount) + ' đ';
            }

            function updateTabContentTitle(targetId) {
                if (targetId === '#report-pills-week') {
                    $('#category-pills-week-tab').tab('show');
                    $("#tab-content-title").text('Báo cáo tuần này');
                } else if (targetId === '#report-pills-month') {
                    $('#category-pills-month-tab').tab('show');
                    $("#tab-content-title").text('Báo cáo tháng này');
                }
            }

            $('#report-pills-tab button').on('shown.bs.tab', function(e) {
                updateTabContentTitle($(e.target).attr('data-bs-target'));
            });

            $('#category-pills-tab button').on('shown.bs.tab', function(e) {
                updateTabContentTitle($(e.target).attr('data-bs-target'));
            });
        });
    </script>
@endpush
