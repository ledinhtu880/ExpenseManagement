@extends('layouts.master')

@section('title', 'Tài khoản')

@section('content')
    <div class="container-fluid">
        <div class="user-panel d-flex align-items-center justify-content-start gap-3 mb-3">
            <img src="{{ Auth::user()->gender == 0 ? asset('images/default-avatar-male.svg') : asset('images/default-avatar-female.svg') }}"
                class="img-circle object-fit-cover" style="width: 150px !important;" alt="User Image">
            <div class="user-info">
                <h4 class="h2 mb-1 text-dark">{{ Auth::user()->name }}</h4>
                <h5 class="h3 mb-0 text-muted">{{ Auth::user()->email }}</h5>
            </div>
        </div>
        <nav class="list-feature-account px-5">
            <ul class="list-group flex-column gap-3">
                <a class="list-group-item text-dark text-lg text-medium" href="{{ route('accounts.index') }}">
                    <i style="width: 25px;" class="mr-1 fas fa-user-cog"></i>
                    Quản lý tài khoản
                </a>
                <a href="#" type="button" class="list-group-item text-dark text-lg text-medium"
                    data-bs-toggle="modal" data-bs-target="#walletsModal">
                    <i style="width: 25px;" class="mr-1 fas fa-wallet"></i>
                    Ví của tôi
                </a>

                <!-- List wallets -->
                <div class="modal fade" id="walletsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="walletsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="text-primary-color mb-0">Ví của tôi</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 class="mb-1 text-muted fw-bold">Tổng cộng số dư</h5>
                                <div class="card rounded-4 border-primary-color shadow-none mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-start gap-3"
                                            style="border-bottom-color: var(--primary-color) !important">
                                            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                class="img-circle elevation-2" width="60" alt="User Image">
                                            <div class="d-flex flex-column justify-content-between">
                                                <h4 class="m-0">
                                                    Tổng cộng
                                                </h4>
                                                <h6 class="m-0 fw-medium">{{ $user->total_balance }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mb-1 text-muted fw-bold">Danh sách ví</h5>
                                <div class="card rounded-4 border-primary-color shadow-none ">
                                    <div class="card-body">
                                        @foreach ($user->wallets as $wallet)
                                            <div
                                                class="d-flex align-items-center justify-content-between @if (!$loop->last) mb-4 @endif">
                                                <div class="d-flex justify-content-start gap-3">
                                                    <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                        class="img-circle elevation-2" width="60" alt="User Image">
                                                    <div class="d-flex flex-column justify-content-between">
                                                        <h4 class="m-0">
                                                            {{ $wallet->name }}
                                                        </h4>
                                                        <h6 class="m-0 fw-medium">{{ $wallet->formatted_balance }}</h6>
                                                    </div>
                                                </div>
                                                <div class="btn btn-lg btn-outline-primary-color" data-bs-toggle="modal"
                                                    data-bs-target="#editWallet-{{ $wallet->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-lg btn-outline-primary-color w-100" data-bs-toggle="modal"
                                data-bs-target="#addWallet">
                                <i class="fa-solid fa-plus me-2"></i>Thêm ví
                            </button>
                        </div>
                    </div>
                </div>
                {{-- /. list wallets --}}

                <div class="modal fade" id="addWallet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="text-primary-color fw-bold m-0">Thêm ví mới</h4>
                                <button type="button" class="btn-close" data-bs-target="#walletsModal"
                                    data-bs-toggle="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card rounded-3 border-primary-color shadow-none">
                                    <div class="card-body">
                                        <form id="formWallet-create" method="POST" action="{{ route('wallets.store') }}">
                                            @csrf
                                            <!-- Wallet name -->
                                            <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                    class="img-circle elevation-2" width="60" alt="User Image">
                                                <input type="text" name="name" id="name"
                                                    class="form-control form-control-lg shadow-none" placeholder="Tên ví">
                                            </div>

                                            <!-- Divider with text -->
                                            <div class="d-flex align-items-center gap-2 mb-3">
                                                <hr class="flex-grow-1 border-2">
                                                <span class="text-muted fw-bold">Số dư ban đầu</span>
                                                <hr class="flex-grow-1 border-2">
                                            </div>

                                            <!-- Initial balance -->
                                            <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                <div class="p-1 rounded-2 border border-secondary"
                                                    style="min-width: 60px;">
                                                    <h5 class="h5 text-center m-0">{{ Auth::user()->currency }}</h5>
                                                </div>
                                                <input type="number" name="amount" id="amount"
                                                    class="form-control form-control-lg shadow-none" value="0"
                                                    min="0">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-lg btn-outline-secondary"
                                    data-bs-target="#walletsModal" data-bs-toggle="modal">Hủy</button>
                                <button type="submit" form="formWallet-create"
                                    class="btn btn-lg btn-primary-color">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($user->wallets as $wallet)
                    <!-- Edit wallet modal -->
                    <div class="modal fade" id="editWallet-{{ $wallet->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="text-primary-color mb-0">Sửa ví</h4>
                                    <button type="button" class="btn-close" data-bs-target="#walletsModal"
                                        data-bs-toggle="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card rounded-3 border-primary-color shadow-none">
                                        <div class="card-body">
                                            <form id="formWallet-update-{{ $wallet->id }}" method="POST"
                                                action="{{ route('wallets.update', $wallet->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <!-- Wallet name -->
                                                <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                    <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                        class="img-circle elevation-2" width="60" alt="User Image">
                                                    <input type="text" name="name" id="name"
                                                        class="form-control form-control-lg shadow-none border-top-0 border-left-0 border-right-0"
                                                        value="{{ $wallet->name }}">
                                                </div>

                                                <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                    <div class="text-center" style="min-width: 60px;">
                                                        <h5 class="h5 text-center m-0">
                                                            <i class="fa-solid fa-wallet"></i>
                                                        </h5>
                                                    </div>
                                                    <input type="text" name="currency" id="currency" readonly
                                                        class="form-control form-control-lg shadow-none"
                                                        value="{{ Auth::user()->currency }}">
                                                </div>

                                                {{-- <label for="amount" class="form-label m-0">Số dư hiện tại của ví</label> --}}

                                                <!-- Wallet balance -->
                                                <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                    <div class="text-center" style="min-width: 60px;">
                                                        <h5 class="h5 text-center m-0">
                                                            {{ Auth::user()->currency }}</h5>
                                                    </div>
                                                    <input type="number" name="amount" id="amount"
                                                        class="form-control form-control-lg shadow-none border-top-0 border-left-0 border-right-0"
                                                        value="{{ $wallet->balance }}" min="0">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-center gap-3">
                                    <button type="button" class="btn btn-lg btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteWalletConfirm-{{ $wallet->id }}">
                                        Xóa ví
                                    </button>
                                    <button type="submit" form="formWallet-update-{{ $wallet->id }}"
                                        class="btn btn-lg btn-primary-color">
                                        Lưu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. edit wallet modal -->

                    <!-- Delete wallet confirmation modal -->
                    <div class="modal fade" id="deleteWalletConfirm-{{ $wallet->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-primary-color fw-bold">Xác nhận xóa</h5>
                                    <button type="button" class="btn-close"
                                        data-bs-target="#editWallet-{{ $wallet->id }}" data-bs-toggle="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <p class="mb-0">Bạn có chắc chắn muốn xóa ví này?</p>
                                </div>
                                <div class="modal-footer d-flex justify-content-center gap-3">
                                    <form action="{{ route('wallets.destroy', $wallet->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-lg btn-primary-color text-white">Xác
                                            nhận</button>
                                    </form>
                                    <button type="button" class="btn btn-lg btn-outline-secondary"
                                        data-bs-target="#editWallet-{{ $wallet->id }}" data-bs-toggle="modal">
                                        Hủy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. delete wallet confirmation modal -->
                @endforeach

                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-university"></i>
                    Liên kết ngân hàng
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="{{ route('bank-branches.index') }}">
                    <i style="width: 25px;" class="mr-1 fas fa-location-crosshairs"></i>
                    Tìm kiếm ngân hàng
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-bell"></i>
                    Sự kiện
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-calendar-check"></i>
                    Giao dịch định kỳ
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-file-invoice"></i>
                    Hóa đơn
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-hand-holding-usd"></i>
                    Sổ nợ
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-tools"></i>
                    Công cụ
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-plane"></i>
                    Chế độ du lịch
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-store"></i>
                    Cửa hàng
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-headset"></i>
                    Hỗ trợ
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-cog"></i>
                    Cài đặt
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-info-circle"></i>
                    Giới thiệu
                </a>
            </ul>
        </nav>
    </div>
@endsection
