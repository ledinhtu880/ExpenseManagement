@extends('layouts.master')

@section('title', 'Quan ly tai khoan')

@section('content')
    <div class="container-fluid">
        <div class="user-panel d-flex align-items-center justify-content-start gap-3 mb-3">
            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle object-fit-cover"
                style="width: 150px !important;" alt="User Image">
            <div class="user-info">
                <h4 class="h2 mb-1 text-dark">Ten nguoi dung</h4>
                <h5 class="h3 mb-0 text-muted">Email</h5>
            </div>
        </div>
        <nav class="list-feature-account px-5">
            <ul class="list-group flex-column gap-3" data-widget="treeview" role="menu">
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-user-cog"></i> Quản lý tài khoản
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-wallet"></i> Ví của tôi
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-university"></i> Liên kết ngân hàng
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-bell"></i> Sự kiện
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-calendar-check"></i> Giao dịch định kỳ
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-file-invoice"></i> Hóa đơn
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-hand-holding-usd"></i> Sổ nợ
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-tools"></i> Công cụ
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-plane"></i> Chế độ du lịch
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-store"></i> Cửa hàng
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-headset"></i> Hỗ trợ
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-cog"></i> Cài đặt
                </li>
                <li class="list-group-item text-lg text-medium">
                    <i class="fas fa-info-circle"></i> Giới thiệu
                </li>
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
