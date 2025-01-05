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
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-wallet"></i>
                    Ví của tôi
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-university"></i>
                    Liên kết ngân hàng
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

@push('js')
    <script>
        $(document).ready(function() {
            const message = '{{ session('message') }}';
            const type = '{{ session('type') }}';

            if (message && type) {
                showToast(message, type);
            }
        });
    </script>
@endpush
