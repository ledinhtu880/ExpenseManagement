<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Love - Loading</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #6c63ff;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .loading-container {
            text-align: center;
        }

        .loading-container img {
            width: 300px;
            height: 300px;
            margin-bottom: 20px;
            filter: invert(1);
        }

        .loading-container h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        .loading-container p {
            font-size: 1rem;
            margin-top: 10px;
            font-style: italic;
        }

        .loading-footer {
            position: absolute;
            bottom: 20px;
            text-align: center;
            width: 100%;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="loading-container">
        <img src="{{ asset('images/pigmoney.png') }}" alt="Logo">
        <h1>Money Love</h1>
        <p>Phù hợp với lứa tuổi sinh viên</p>
    </div>
    <div class="loading-footer">
        Nhóm 2 Cụm 2 63HTTT1 - ThuyLoi University
    </div>
    <script>
        // Chờ 2 giây và chuyển hướng đến trang chủ
        setTimeout(() => {
            window.location.href = "{{ route('home') }}";
        }, 2000);
    </script>
</body>
</html>
