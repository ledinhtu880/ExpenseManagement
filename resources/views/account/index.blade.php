@extends('layouts.master')

@section('title', 'Quản lý tài khoản')

@section('content')
    <div class="container-fluid">
        <x-header-tab text="Quản lý tài khoản" />

        <div class="d-flex align-items-center justify-content-center flex-column mb-4">
            <img src="{{ Auth::user()->gender == 0 ? asset('images/default-avatar-male.svg') : asset('images/default-avatar-female.svg') }}"
                class="img-circle object-fit-cover" style="width: 150px !important;" alt="User Image">
            <h4 class="h2 mb-1 text-dark">{{ Auth::user()->name }}</h4>
            <h5 class="h3 mb-0 text-muted">{{ Auth::user()->email }}</h5>
        </div>

        <div class="list-">
            <ul class="list-group flex-column gap-3">
                <a href="{{ route('accounts.edit') }}"
                    class="list-group-item fw-bold text-primary-color text-lg text-medium text-center border-primary-color">
                    Cập nhật thông tin
                </a>
                <a href="#"
                    class="list-group-item fw-bold text-primary-color text-lg text-medium text-center border-primary-color">
                    Thay đổi mật khẩu
                </a>
                <div class="my-4"></div>
                <a href="{{ route('logout') }}"
                    class="list-group-item fw-bold text-danger text-lg text-medium text-center border-primary-color">
                    Đăng xuất
                </a>
                <a href="{{ route('accounts.index') }}"
                    class="list-group-item fw-bold text-danger text-lg text-medium text-center border-primary-color">
                    Xóa tài khoản
                </a>
            </ul>
        </div>
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

            function changePassword() {
                const currentPassword = $('#currentPassword').val();
                const newPassword = $('#newPassword').val();
                const confirmPassword = $('#confirmPassword').val();

                if (!currentPassword || !newPassword || !confirmPassword) {
                    alert('Vui lòng điền đầy đủ thông tin');
                    return;
                }

                if (newPassword !== confirmPassword) {
                    alert('Mật khẩu mới không khớp');
                    return;
                }

                // Add password change logic here
                $('#passwordModal').modal('hide');
                alert('Đổi mật khẩu thành công');
            }

            function deleteAccount() {
                // Add delete account logic here
                $('#deleteModal').modal('hide');
                alert('Tài khoản đã được xóa');
                // Redirect to login page
            }

            $('.logout').click(function() {
                if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
                    // Add logout logic here
                    alert('Đăng xuất thành công');
                    // Redirect to login page
                }
            });

            $("#btnBack").on('click', () => {
                window.history.back();

            })
        });
    </script>
@endpush
