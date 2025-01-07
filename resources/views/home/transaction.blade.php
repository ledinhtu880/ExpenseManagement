@extends('layouts.master')

@section('title', 'Quan ly giao dich')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form id="filterForm" method="GET" action="{{ route('home.transaction') }}">
                    <select class="form-select form-select-lg border-primary-color" name="wallet_id" id="wallet_id"
                        style="width: 250px;" aria-label="Default select example">
                        <option value="total" selected>Tất cả</option>
                        @foreach ($user->wallets as $wallet)
                            <option value="{{ $wallet->wallet_id }}">{{ $wallet->name }}</option>
                        @endforeach
                    </select>
                </form>
                <ul class="nav nav-underline list-transaction nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark active" id="pills-previous-month-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-previous-month" type="button" role="tab"
                            aria-controls="pills-previous-month" aria-selected="false">Tháng trước</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="pills-current-month-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-current-month" type="button" role="tab"
                            aria-controls="pills-current-month" aria-selected="false">Tháng này</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-previous-month" role="tabpanel"
                        aria-labelledby="pills-previous-month-tab" tabindex="0">
                        {{-- Opening Balance and Closing Balance --}}
                        <div class="card rounded-3 border-primary-color">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư đầu</h5>
                                    <h5 id="previousMonthOpeningBalance">
                                        {{ $previousMonthBalance->formatted_opening_balance }}</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư cuối cùng</h5>
                                    <h5 id="previousMonthClosingBalance">
                                        {{ $previousMonthBalance->formatted_closing_balance }}</h5>
                                </div>
                                <div class="d-flex justify-content-center align-items-end flex-column">
                                    <div class="line mb-2" style="width: 200px; height: 2px;"></div>
                                    <h5 id="previousMonthTotalBalance">{{ $previousMonthBalance->balance }}</h5>
                                </div>
                                <div class="text-center">
                                    <a href="#" class="text-primary-color fw-bold">Xem báo cáo cho giai đoạn này</a>
                                </div>
                            </div>
                        </div>
                        {{-- /. opening balance and closing balance --}}

                        {{-- List transaction for previous month --}}
                        <div id="previousMonthTransactionsContainer">
                            @foreach ($previousMonthTransactions as $each)
                                <div class="card rounded-3 border-primary-color">
                                    <div class="card-header border-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-end justify-content-center gap-2">
                                                <h5 class="h5 mb-0">{{ $each->day }}</h5>
                                                <span class="text-muted text-sm fw-medium">{{ $each->detailDate }}</span>
                                            </div>
                                            <h5
                                                class="h5 mb-0 {{ $each->totalAmount < 0 ? 'text-danger' : 'text-success' }}">
                                                {{ $each->formatted_total_amount }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-column gap-2">
                                            @foreach ($each->listTransactions as $transaction)
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                            class="img-circle elevation-2" width="60" alt="User Image">
                                                        <h5 class="h5 mb-0">{{ $transaction->category->name }}</h5>
                                                    </div>
                                                    <h5
                                                        class="h5 mb-0 {{ $transaction->groupType->name === 'Khoản chi' ? 'text-danger' : 'text-success' }}">
                                                        {{ $transaction->formatted_amount }}
                                                    </h5>
                                                </div>
                                                @if (!$loop->last)
                                                    <div class="line"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- /.list transaction --}}
                    </div>
                    <div class="tab-pane fade" id="pills-current-month" role="tabpanel"
                        aria-labelledby="pills-current-month-tab" tabindex="0">
                        {{-- Opening Balance and Closing Balance --}}
                        <div class="card rounded-3 border-primary-color">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư đầu</h5>
                                    <h5 id="currentMonthOpeningBalance">
                                        {{ $currentMonthBalance->formatted_opening_balance }}</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư cuối cùng</h5>
                                    <h5 id="currentMonthClosingBalance">
                                        {{ $currentMonthBalance->formatted_closing_balance }}</h5>
                                </div>
                                <div class="d-flex justify-content-center align-items-end flex-column">
                                    <div class="line mb-2" style="width: 200px; height: 2px;"></div>
                                    <h5 id="currentMonthTotalBalance">{{ $currentMonthBalance->balance }}</h5>
                                </div>
                                <div class="text-center">
                                    <a href="#" class="text-primary-color fw-bold">Xem báo cáo cho giai đoạn này</a>
                                </div>
                            </div>
                        </div>
                        {{-- /. opening balance and closing balance --}}

                        {{-- List transaction for current month --}}
                        <div id="currentMonthTransactionsContainer">
                            @foreach ($currentMonthTransactions as $each)
                                <div class="card rounded-3 border-primary-color">
                                    <div class="card-header border-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-end justify-content-center gap-2">
                                                <h5 class="h5 mb-0">{{ $each->day }}</h5>
                                                <span class="text-muted text-sm fw-medium">{{ $each->detailDate }}</span>
                                            </div>
                                            <h5
                                                class="h5 mb-0 {{ $each->totalAmount < 0 ? 'text-danger' : 'text-success' }}">
                                                {{ $each->formatted_total_amount }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-column gap-2">
                                            @foreach ($each->listTransactions as $transaction)
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                            class="img-circle elevation-2" width="60"
                                                            alt="User Image">
                                                        <h5 class="h5 mb-0">{{ $transaction->category->name }}</h5>
                                                    </div>
                                                    <h5
                                                        class="h5 mb-0 {{ $transaction->groupType->name === 'Khoản chi' ? 'text-danger' : 'text-success' }}">
                                                        {{ $transaction->formatted_amount }}
                                                    </h5>
                                                </div>
                                                @if (!$loop->last)
                                                    <div class="line"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- /.list transaction --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add transaction modal -->
    <button type="button" class="position-absolute btn btn-primary-color rounded-circle p-5" data-bs-toggle="modal"
        data-bs-target="#addTransaction" style="bottom: 50px; right: 50px;">
        <i class="fa-solid fa-plus" style="font-size: 30px;"></i>
    </button>

    <div class="modal fade" id="addTransaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addTransactionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-primary-color fw-bold fs-5 m-0" id="addTransactionLabel">Thêm giao dịch</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card rounded-3 border-primary-color shadow-none">
                        <div class="card-body">
                            <form id="formTransaction" method="POST" action="{{ route('transactions.store') }}">
                                @csrf
                                <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <div class="p-1 rounded-2 border border-secondary" style="min-width: 80px;">
                                        <h5 class="h5 text-center m-0">{{ Auth::user()->currency }}</h5>
                                    </div>
                                    <input type="number" name="amount" id="amount"
                                        class="form-control form-control-lg" shadow-none value="0" min="0">
                                </div>
                                <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                        class="img-circle elevation-2" width="60" alt="User Image"
                                        style="min-width: 80px;">
                                    <select name="category_id" id="category_id"
                                        class="form-select form-select-lg shadow-none">
                                        <option default selected disabled value="default">Chọn nhóm</option>
                                        @foreach ($categories as $each)
                                            <option value="{{ $each->category_id }}">{{ $each->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <div class="p-1" style="min-width: 80px;">
                                        <div class="h4 text-center m-0"><i class="fa-solid fa-note-sticky"></i></div>
                                    </div>
                                    <textarea name="note" id="note" class="form-control form-control-lg shadow-none" rows="2"
                                        placeholder="Ghi chú"></textarea>
                                </div>
                                <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <div class="p-1" style="min-width: 80px;">
                                        <div class="h4 text-center m-0"><i class="fa-solid fa-calendar"></i></div>
                                    </div>
                                    <input type="date" name="date" id="date"
                                        class="form-select form-select-lg shadow-none"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <div class="p-1" style="min-width: 80px;">
                                        <div class="h4 text-center m-0"><i class="fa-solid fa-wallet"></i></div>
                                    </div>
                                    <select name="wallet_id" id="wallet_id"
                                        class="form-select form-select-lg shadow-none">
                                        @foreach ($user->wallets as $each)
                                            <option value="{{ $wallet->wallet_id }}">{{ $wallet->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary-color" id="saveBtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    {{-- /.add transaction --}}
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            const message = '{{ session('message') }}';
            const type = '{{ session('type') }}';

            if (message && type) {
                showToast(message, type);
            }

            // Validate form before submission
            $('#saveBtn').click(function() {
                const amount = $('#amount').val();
                const categoryId = $('#category_id').val();
                if (amount <= 0) {
                    showToast('Số tiền phải lớn hơn 0.', 'warning');
                    return false;
                }
                if (categoryId === 'default') {
                    showToast('Vui lòng chọn nhóm.', 'warning');
                    return false;
                }
                $('#formTransaction').submit();
            });

            // Constants
            const CONFIG = {
                DEFAULT_USER_IMAGE: 'https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg',
                EXPENSE_TYPE: 'Khoản chi'
            };

            // Helper functions
            const createTransactionCard = (transaction, index, array) => {
                const isLastItem = index === array.length - 1;
                const colorClass = transaction.category.group_type.name === CONFIG.EXPENSE_TYPE ?
                    'text-danger' : 'text-success';

                return `
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <img src="${CONFIG.DEFAULT_USER_IMAGE}" class="img-circle elevation-2" width="60" alt="User Image">
                <h5 class="h5 mb-0">${transaction.category.name}</h5>
            </div>
            <h5 class="h5 mb-0 ${colorClass}">
                ${transaction.formatted_balance}
            </h5>
        </div>
        ${isLastItem ? '' : '<div class="line"></div>'}
    `;
            };

            const createDayCard = (dayData) => {
                const colorClass = dayData.totalAmount < 0 ? 'text-danger' : 'text-success';

                return `
        <div class="card rounded-3 border-primary-color">
            <div class="card-header border-0">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-end justify-content-center gap-2">
                        <h5 class="h5 mb-0">${dayData.day}</h5>
                        <span class="text-muted text-sm fw-medium">${dayData.detailDate}</span>
                    </div>
                    <h5 class="h5 mb-0 ${colorClass}">
                        ${dayData.formatted_total_amount}
                    </h5>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-2">
                    ${dayData.listTransactions.map(createTransactionCard).join('')}
                </div>
            </div>
        </div>
    `;
            };

            const renderTransactions = (containerId, transactions) => {
                const container = $(`#${containerId}`);
                container.html('');
                const html = transactions.map(createDayCard).join('');
                container.append(html);
            };

            // Event handler
            $('#wallet_id').change(function() {
                const walletId = $(this).val();
                const loader = $("#loader");

                loader.show();

                $.ajax({
                    url: '{{ route('home.transaction') }}',
                    type: 'GET',
                    data: {
                        wallet_id: walletId
                    },
                    success: function(response) {
                        // Update transactions
                        renderTransactions('previousMonthTransactionsContainer', response
                            .previousMonthTransactions);
                        renderTransactions('currentMonthTransactionsContainer', response
                            .currentMonthTransactions);

                        // Update balances
                        $('#previousMonthOpeningBalance').text(response.previousMonthBalance
                            .formatted_opening_balance);
                        $('#previousMonthClosingBalance').text(response.previousMonthBalance
                            .formatted_closing_balance);
                        $('#previousMonthTotalBalance').text(response.previousMonthBalance
                            .balance);

                        $('#currentMonthOpeningBalance').text(response.currentMonthBalance
                            .formatted_opening_balance);
                        $('#currentMonthClosingBalance').text(response.currentMonthBalance
                            .formatted_closing_balance);
                        $('#currentMonthTotalBalance').text(response.currentMonthBalance
                            .balance);
                    },
                    error: function(xhr) {
                        console.error('Transaction fetch failed:', xhr.responseText);
                        alert("Đã có lỗi xảy ra, xin vui lòng thử lại");
                    },
                    complete: function() {
                        loader.hide();
                    }
                });
            });
        });
    </script>
@endpush
