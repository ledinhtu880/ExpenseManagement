@extends('layouts.master')

@section('title', 'Ngan sach')

@push('css')
    <style>
        /* Custom styles for the switch */
        .custom-switch .form-check-input {
            width: 3em;
            height: 1.5em;
            background-color: #ccc;
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
        }

        .custom-switch .form-check-input:checked {
            background-color: #6c63ff;
            /* Màu tím khi được chọn */
        }

        .custom-switch .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(108, 99, 255, 0.25);
            /* Hiệu ứng khi focus */
        }
    </style>
@endpush

@section('content')
    <div class="card rounded-3 border-primary-color">
        <div class="card-body">
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            width="60" alt="User Image">
                        <h5 class="h5 mb-0">Ăn uống</h5>
                    </div>
                    <div class="d-flex align-items-end justify-content-center flex-column gap-1">
                        <h5 class="h5 mb-0 text-danger">1.000.000</h5>
                        <h6 class="h6 mb-0 text-muted fw-normal">Còn lại 900.000</h6>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <div class="progress rounded-5 w-50 border-primary-color" role="progressbar" aria-label="Basic example"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-primary-color" style="width: 25%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="position-absolute btn btn-primary-color rounded-circle p-5" data-bs-toggle="modal"
        data-bs-target="#addBudget" style="bottom: 50px; right: 50px;">
        <i class="fa-solid fa-plus" style="font-size: 30px;"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addBudget" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addBudgetLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom-color: var(--primary-color) !important">
                    <button type="button" class="btn p-0 m-0 text-muted" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ</button>
                    <h1 class="text-primary-color fw-bold fs-5 m-0" id="addBudgetLabel">Thêm ngân sách</h1>
                    <div></div>
                </div>
                <div class="modal-body">
                    <div class="card rounded-3 border-primary-color shadow-none">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                    class="img-circle elevation-2" width="60" alt="User Image" style="min-width: 80px;">
                                <select name="groups" id="groups" class="form-select form-select-lg shadow-none">
                                    <option default selected value="default">Chon nhom</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                <div class="p-1 rounded-2 border border-secondary" style="min-width: 80px;">
                                    <h5 class="h5 text-center m-0">{{ Auth::user()->currency }}</h5>
                                </div>
                                <input type="number" name="amount" id="amount" class="form-control form-control-lg"
                                    shadow-none value="0" min="0">
                            </div>
                            <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                <div class="p-1" style="min-width: 80px;">
                                    <div class="h4 text-center m-0"><i class="fa-solid fa-calendar"></i></div>
                                </div>
                                <select name="date" id="date" class="form-select form-select-lg shadow-none">
                                    <option default selected value="default">Chon khoang thoi gian</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                <div class="p-1" style="min-width: 80px;">
                                    <div class="h4 text-center m-0"><i class="fa-solid fa-wallet"></i></div>
                                </div>
                                <select name="wallet" id="wallet" class="form-select form-select-lg shadow-none">
                                    <option default selected value="default">Chon vi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-3 border-primary-color shadow-none">
                        <div class="d-flex align-items-center justify-content-between p-3">
                            <div>
                                <h5 class="h5 m-0 text-primary-color">Lặp lại ngân sách này</h5>
                                <h5 class="h5 m-0 text-muted">Ngân sách được tự động lặp lại ở kỳ hạn tiếp theo</h5>
                            </div>
                            <div class="form-check form-switch custom-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary-color">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection
