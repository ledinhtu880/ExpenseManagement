@extends('layouts.master')

@section('title', 'Quan ly giao dich')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <select class="form-select form-select-lg border-primary-color" style="width: 250px;"
                    aria-label="Default select example">
                    <option selected>Tong cong</option>
                    <option value="1">Vi 1</option>
                    <option value="2">Vi 2</option>
                    <option value="3">Vi 3</option>
                </select>

                <ul class="nav nav-underline list-transaction nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark active" id="pills-current-month-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-current-month" type="button" role="tab"
                            aria-controls="pills-current-month" aria-selected="false">Tháng trước</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="pills-last-month-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-last-month" type="button" role="tab"
                            aria-controls="pills-last-month" aria-selected="false">Tháng này</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-current-month" role="tabpanel"
                        aria-labelledby="pills-current-month-tab" tabindex="0">
                        <div class="card rounded-3 border-primary-color">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư đầu</h5>
                                    <h5>0d</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư cuối cùng</h5>
                                    <h5>0d</h5>
                                </div>
                                <div class="d-flex justify-content-center align-items-end flex-column">
                                    <div class="line mb-2" style="width: 200px; height: 2px;"></div>
                                    <h5>0d</h5>
                                </div>
                                <div class="text-center">
                                    <a href="#" class="text-primary-color fw-bold">Xem báo cáo cho giai đoạn
                                        này</a>
                                </div>
                            </div>
                        </div>

                        {{-- List transaction --}}
                        <div class="card rounded-3 border-primary-color">
                            <div class="card-header border-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-end justify-content-center gap-2">
                                        <h5 class="h5 mb-0">05/01/2024</h5>
                                        <span class="text-muted text-sm fw-medium">Chủ Nhật, ngày 5 tháng 1 năm
                                            2025</span>
                                    </div>
                                    <h5 class="h5 mb-0">-4.000</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center justify-content-center gap-3">
                                            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                class="img-circle elevation-2" width="60" alt="User Image">
                                            <h5 class="h5 mb-0">Cho vay</h5>
                                        </div>
                                        <h5 class="h5 mb-0 text-danger">2.000</h5>
                                    </div>
                                    <div class="line"></div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center justify-content-center gap-3">
                                            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                class="img-circle elevation-2" width="60" alt="User Image">
                                            <h5 class="h5 mb-0">Cho vay</h5>
                                        </div>
                                        <h5 class="h5 mb-0 text-danger">2.000</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-3 border-primary-color">
                            <div class="card-header border-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-end justify-content-center gap-2">
                                        <h5 class="h5 mb-0">05/01/2024</h5>
                                        <span class="text-muted text-sm fw-medium">Chủ Nhật, ngày 5 tháng 1 năm
                                            2025</span>
                                    </div>
                                    <h5 class="h5 mb-0">-4.000</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center justify-content-center gap-3">
                                            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                class="img-circle elevation-2" width="60" alt="User Image">
                                            <h5 class="h5 mb-0">Cho vay</h5>
                                        </div>
                                        <h5 class="h5 mb-0 text-danger">2.000</h5>
                                    </div>
                                    <div class="line"></div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center justify-content-center gap-3">
                                            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                class="img-circle elevation-2" width="60" alt="User Image">
                                            <h5 class="h5 mb-0">Cho vay</h5>
                                        </div>
                                        <h5 class="h5 mb-0 text-danger">2.000</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- /.list transaction --}}
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="position-absolute btn btn-primary-color rounded-circle p-5"
            style="bottom: 50px; right: 50px;">
            <i class="fa-solid fa-plus" style="font-size: 30px;"></i>
        </button>
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
