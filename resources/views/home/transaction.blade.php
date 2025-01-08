@extends('layouts.master')

@section('title', 'Quan ly giao dich')

@push('css')
    <style>
        .category-item.active {
            background-color: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }

        #categoryTabs .active {
            color: #333;
            font-weight: 700;
        }

        #categoryTabs.nav-pills .nav-link:not(.active):hover {
            color: var(--primary-color);
        }
    </style>
@endpush

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

    <button type="button" class="btn btn-primary-color text-white rounded-circle" data-bs-toggle="modal"
        data-bs-target="#addTransaction"
        style="position: fixed; bottom: 30px; right: 30px; z-index: 999; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
        <i class="fa-solid fa-plus" style="font-size: 24px;"></i>
    </button>

    <!-- First modal - Transaction form -->
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
                                        class="form-control form-control-lg shadow-none" value="0" min="0">
                                </div>
                                <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                        class="img-circle elevation-2" width="60" alt="User Image"
                                        style="min-width: 80px;">
                                    <input type="hidden" name="category_id" id="category_id" value="default">
                                    <button type="button" id="categorySelector"
                                        class="form-control form-control-lg text-start shadow-none" data-bs-toggle="modal"
                                        data-bs-target="#selectCategory">
                                        <span id="selectedCategoryText">Chọn nhóm</span>
                                    </button>
                                </div>

                                <!-- Rest of the form remains the same -->
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
    <!-- /.first modal -->

    <!-- Second modal - Category selection -->
    <div class="modal fade" id="selectCategory" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="selectCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-primary-color fw-bold fs-5 m-0" id="addTransactionLabel">Chọn nhóm</h1>
                    <button type="button" class="btn-close" data-bs-target="#addTransaction" data-bs-toggle="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tabs -->
                    <div class="tab-navigation-wrapper">
                        <ul class="nav nav-pills nav-fill mb-3 bg-body-secondary rounded-3 p-2" id="categoryTabs"
                            role="tablist">
                            @foreach ($groupTypes as $groupType)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="tab-{{ $groupType->group_type_id }}" data-bs-toggle="tab"
                                        data-bs-target="#content-{{ $groupType->group_type_id }}" type="button"
                                        role="tab">
                                        {{ $groupType->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Tab Contents -->
                    <div class="tab-content" id="categoryTabsContent">
                        @foreach ($groupTypes as $groupType)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="content-{{ $groupType->group_type_id }}" role="tabpanel">
                                <div class="row g-3">
                                    @foreach ($categories->where('group_type_id', $groupType->group_type_id) as $category)
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="category-item btn btn-outline-primary-color w-100 text-start p-3"
                                                data-category-id="{{ $category->category_id }}"
                                                data-category-name="{{ $category->name }}"
                                                data-bs-target="#addTransaction" data-bs-toggle="modal">
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="text-dark fas fa-envelope fs-4"></i>
                                                    <span>{{ $category->name }}</span>
                                                </div>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.second modal -->
@endsection

@push('js')
    <script>
        // Constants
        const CONFIG = {
            DEFAULT_USER_IMAGE: 'https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg',
            EXPENSE_TYPE: 'Khoản chi',
            ENDPOINTS: {
                TRANSACTIONS: '{{ route('home.transaction') }}'
            },
            SELECTORS: {
                FORM: '#formTransaction',
                AMOUNT: '#amount',
                CATEGORY: '#category_id',
                WALLET: '#wallet_id',
                SAVE_BTN: '#saveBtn',
                LOADER: '#loader',
                CONTAINERS: {
                    PREV_MONTH: '#previousMonthTransactionsContainer',
                    CURR_MONTH: '#currentMonthTransactionsContainer'
                },
                BALANCES: {
                    PREV_MONTH: {
                        OPENING: '#previousMonthOpeningBalance',
                        CLOSING: '#previousMonthClosingBalance',
                        TOTAL: '#previousMonthTotalBalance'
                    },
                    CURR_MONTH: {
                        OPENING: '#currentMonthOpeningBalance',
                        CLOSING: '#currentMonthClosingBalance',
                        TOTAL: '#currentMonthTotalBalance'
                    }
                }
            }
        };

        const ToastManager = {
            show(message, type) {
                showToast(message, type);
            },
            showError(message) {
                this.show(message, 'warning');
            }
        };

        class TransactionFormValidator {
            static validate() {
                const amount = $(CONFIG.SELECTORS.AMOUNT).val();
                const categoryId = $(CONFIG.SELECTORS.CATEGORY).val();

                if (categoryId === 'default') {
                    ToastManager.showError('Vui lòng chọn nhóm.');
                    return false;
                }
                if (amount <= 0) {
                    ToastManager.showError('Số tiền phải lớn hơn 0.');
                    return false;
                }
                return true;
            }
        }

        // HTML Template generators
        class TransactionTemplates {
            static createTransactionCard(transaction, index, array) {
                const isLastItem = index === array.length - 1;
                const colorClass = transaction.category.group_type.name === CONFIG.EXPENSE_TYPE ?
                    'text-danger' : 'text-success';

                return `
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <img src="${CONFIG.DEFAULT_USER_IMAGE}" class="img-circle elevation-2" width="60" alt="User Image">
                    <h5 class="h5 mb-0">${transaction.category.name}</h5>
                </div>
                <h5 class="h5 mb-0 ${colorClass}">${transaction.formatted_balance}</h5>
            </div>
            ${isLastItem ? '' : '<div class="line"></div>'}`;
            }

            static createDayCard(dayData) {
                const colorClass = dayData.totalAmount < 0 ? 'text-danger' : 'text-success';
                const transactionCards = dayData.listTransactions
                    .map((t, i, arr) => TransactionTemplates.createTransactionCard(t, i, arr))
                    .join('');

                return `
            <div class="card rounded-3 border-primary-color">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-end justify-content-center gap-2">
                            <h5 class="h5 mb-0">${dayData.day}</h5>
                            <span class="text-muted text-sm fw-medium">${dayData.detailDate}</span>
                        </div>
                        <h5 class="h5 mb-0 ${colorClass}">${dayData.formatted_total_amount}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column gap-2">
                        ${transactionCards}
                    </div>
                </div>
            </div>`;
            }
        }

        // Transaction data manager
        class TransactionManager {
            static async fetchTransactions(walletId) {
                const loader = $(CONFIG.SELECTORS.LOADER);
                loader.show();

                try {
                    const response = await $.ajax({
                        url: CONFIG.ENDPOINTS.TRANSACTIONS,
                        type: 'GET',
                        data: {
                            wallet_id: walletId
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                    this.updateUI(response);
                } catch (error) {
                    console.error('Transaction fetch failed:', error);
                    ToastManager.showError("Đã có lỗi xảy ra, xin vui lòng thử lại");
                } finally {
                    loader.hide();
                }
            }

            static updateUI(response) {
                // Update transactions
                this.renderTransactions(CONFIG.SELECTORS.CONTAINERS.PREV_MONTH, response.previousMonthTransactions);
                this.renderTransactions(CONFIG.SELECTORS.CONTAINERS.CURR_MONTH, response.currentMonthTransactions);

                // Update balances
                this.updateBalances('PREV_MONTH', response.previousMonthBalance);
                this.updateBalances('CURR_MONTH', response.currentMonthBalance);
            }

            static renderTransactions(containerId, transactions) {
                const container = $(containerId);
                const html = transactions
                    .map(data => TransactionTemplates.createDayCard(data))
                    .join('');
                container.html(html);
            }


            static updateBalances(period, balanceData) {
                const selectors = CONFIG.SELECTORS.BALANCES[period];
                $(selectors.OPENING).text(balanceData.formatted_opening_balance);
                $(selectors.CLOSING).text(balanceData.formatted_closing_balance);
                $(selectors.TOTAL).text(balanceData.balance);
            }
        }

        // Initialize application
        $(document).ready(function() {
            // Check for session messages
            const message = '{{ session('message') }}';
            const type = '{{ session('type') }}';

            if (message && type) {
                ToastManager.show(message, type);
            }

            $('.category-item').click(function() {
                // Remove highlight from all categories
                $('.category-item').removeClass('active');

                // Add highlight to selected category
                $(this).addClass('active');

                const categoryId = $(this).data('category-id');
                const categoryName = $(this).data('category-name');

                // Update hidden input and button text in first modal
                $('#category_id').val(categoryId);
                $('#selectedCategoryText').text(categoryName);

                // Close category selection modal
                $('#selectCategory').modal('hide');
            });

            // When opening category modal
            $('#selectCategory').on('show.bs.modal', function() {
                const selectedCategoryId = $('#category_id').val();

                // Remove all highlights first
                $('.category-item').removeClass('active');

                // Add highlight to previously selected category if exists
                if (selectedCategoryId) {
                    $(`.category-item[data-category-id="${selectedCategoryId}"]`).addClass('active');
                }
            });

            // Set up event handlers
            $(CONFIG.SELECTORS.SAVE_BTN).click(function() {
                if (TransactionFormValidator.validate()) {
                    $(CONFIG.SELECTORS.FORM).submit();
                }
            });

            $(CONFIG.SELECTORS.WALLET).change(function() {
                TransactionManager.fetchTransactions($(this).val());
            });
        });
    </script>
@endpush
