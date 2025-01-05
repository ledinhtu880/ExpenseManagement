<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Love - Chọn Đơn Vị Tiền Tệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Logo */
        .logo-container {
            position: fixed;
            top: 10px;
            left: 10px;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            z-index: 1000;
        }

        .logo-container img {
            width: 60px;
            height: 60px;
        }

        .logo-container span {
            font-size: 1.2rem;
        }

        /* Currency Container */
        .currency-container {
            max-width: 400px;
            margin: 100px auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        .currency-header h2 {
            color: #6c63ff;
            font-weight: bold;
        }

        .currency-header p {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 20px;
        }

        .form-select {
            font-size: 1rem;
            padding: 10px;
            border-radius: 10px;
            border: 2px solid #6c63ff;
        }

        .btn-primary {
            background-color: #6c63ff;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 1rem;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #5a55e0;
        }
    </style>
</head>

<body>
    <!-- Logo -->
    <div class="logo-container">
        <img src="{{ asset('images/pigmoney.png') }}" alt="Logo">
        <span>Money Love</span>
    </div>

    <!-- Currency Form -->
    <div class="currency-container">
        <div class="currency-header">
            <h2>Chọn đơn vị tiền tệ bạn sử dụng</h2>
            <p>Bạn có thể thay đổi sang đơn vị tiền khác bất cứ lúc nào</p>
        </div>
        <form method="POST" action="{{ route('currency.submit') }}">
            @csrf
            <div class="mb-3">
                <select class="form-select" id="currency" name="currency" required>
                    <option value="VND" selected>🇻🇳 Việt Nam Đồng</option>
                    <option value="USD">🇺🇸 Đô la Mỹ</option>
                    <option value="EUR">🇪🇺 Euro</option>
                    <option value="JPY">🇯🇵 Yên Nhật</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">TIẾP TỤC</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
