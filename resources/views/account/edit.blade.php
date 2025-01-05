@extends('layouts.master')

@section('title', 'Quản lý tài khoản')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body py-0">
                <div class="row">
                    <div
                        class="col-md-3 d-flex align-items-center justify-content-center flex-column border-end border-2 py-3">
                        <img src="{{ Auth::user()->gender == 0 ? asset('images/default-avatar-male.svg') : asset('images/default-avatar-female.svg') }}"
                            class="img-circle object-fit-cover" style="width: 150px !important;" alt="User Image">
                        <h4 class="h2 mb-1 text-dark">{{ Auth::user()->name }}</h4>
                    </div>
                    <div class="col-md-9 py-3 ps-3">
                        <h4 class="h4 mb-3 text-medium">Thông tin người dùng</h4>
                        <form method="POST" action="{{ route('accounts.update', Auth::user()->user_id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Họ và tên</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control form-control-lg" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthday" class="form-label">Ngày sinh</label>
                                        <input type="date" name="birthday" id="birthday"
                                            class="form-control form-control-lg"
                                            value="{{ \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email cá nhân</label>
                                        <input type="text" name="email" id="email"
                                            class="form-control form-control-lg" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email_education" class="form-label">Email sinh viên</label>
                                        <input type="text" name="email_education" id="email_education"
                                            class="form-control form-control-lg"
                                            value="{{ $user->email_education ?? 'Chưa có thông tin' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender" class="form-label">Giới tính</label>
                                        <input type="text" name="gender" id="gender"
                                            class="form-control form-control-lg" value="{{ $user->formatted_gender }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="identify_card" class="form-label">Căn cước công dân</label>
                                        <input type="text" name="identify_card" id="identify_card"
                                            class="form-control form-control-lg"
                                            value="{{ $user->identify_card ?? 'Chưa có thông tin' }}">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <input type="file" name="" id="" class="form-control form-lg">
                                    <button class="btn btn-primary-color btn-lg" type="submit">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
