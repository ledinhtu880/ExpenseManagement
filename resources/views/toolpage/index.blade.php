@include('layouts.sidebar')
@extends('layouts.master')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Công cụ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .tools-container {
            padding: 20px;
        }

        .tool-card {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s;
            background: white;
            cursor: pointer;
        }

        .tool-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: #007bff;
        }

        .tool-icon {
            font-size: 24px;
            margin-right: 15px;
            color: #007bff;
        }

        .tool-header {
            display: flex;
            align-items: center;
        }

        .back-button {
            margin: 20px;
            padding: 8px 15px;
            border: none;
            background: #f8f9fa;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: #e9ecef;
        }

        .page-title {
            color: #333;
            margin: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #007bff;
            display: inline-block;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <button class="back-button">
                <i class="fas fa-arrow-left"></i> Quay lại
            </button>

            <h2 class="page-title">Công cụ</h2>

            <div class="tools-container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="tool-card" data-tool="atm">
                            <div class="tool-header">
                                <i class="fas fa-money-bill-wave tool-icon"></i>
                                <h4>Tìm ATM</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="tool-card" data-tool="bank">
                            <div class="tool-header">
                                <i class="fas fa-university tool-icon"></i>
                                <h4>Tìm ngân hàng</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="tool-card" data-tool="tip">
                            <div class="tool-header">
                                <i class="fas fa-calculator tool-icon"></i>
                                <h4>Tính tiền tip</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="tool-card" data-tool="interest">
                            <div class="tool-header">
                                <i class="fas fa-percentage tool-icon"></i>
                                <h4>Lãi suất</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="tool-card" data-tool="tax">
                            <div class="tool-header">
                                <i class="fas fa-file-invoice-dollar tool-icon"></i>
                                <h4>Tính thuế TNCN</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tool-card').click(function() {
                const tool = $(this).data('tool');
                // Handle tool click
                console.log(`Opening ${tool} tool`);
            });

            $('.back-button').click(function() {
                window.history.back();
            });
        });
    </script>
</body>

</html>
