@extends('layouts.master')

@section('title', 'Ngan sach')

@push('css')
    <style>
        .report-section {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .tab-navigation {
            display: flex;
            background: #f8f9fa;
            border-radius: 20px;
            padding: 5px;
            margin-bottom: 15px;
        }

        .tab-item {
            flex: 1;
            text-align: center;
            padding: 8px;
            cursor: pointer;
            border-radius: 15px;
        }

        .expense-chart {
            height: 200px;
            background: #f8f9fa;
            border-radius: 10px;
            margin: 15px 0;
        }

        .top-expenses {
            margin-top: 20px;
        }

        .expense-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .expense-info {
            display: flex;
            align-items: center;
        }

        .expense-percentage {
            color: #dc3545;
            font-weight: bold;
        }

        .recent-transactions {
            margin-top: 20px;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .amount-positive {
            color: #28a745;
        }

        .amount-negative {
            color: #dc3545;
        }

        .add-transaction-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #6f42c1;
            color: white;
            border: none;
            font-size: 24px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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
    <button type="button" class="position-absolute btn btn-primary-color rounded-circle p-5"
        style="bottom: 50px; right: 50px;">
        <i class="fa-solid fa-plus" style="font-size: 30px;"></i>
    </button>
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
