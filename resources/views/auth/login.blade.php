<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <style>
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: none;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div id="cover-spin"></div>
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h3 class="card-title text-center mb-4">Đăng nhập</h3>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Nhập email" value="{{ old('email') }}">
                            <div class="error-message" id="email-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Nhập mật khẩu">
                            <div class="error-message" id="password-error"></div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                        </div>
                        <div class="mb-3 d-grid">
                            <button id="btnLogin" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/toast.js') }}"></script>
    <script>
        $(document).ready(function() {
            const message = '{{ session('message') }}';
            const type = '{{ session('type') }}';

            if (message && type) {
                showToast(message, type);
            }

            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/;

            $('#email').on('input', function() {
                hideError($(this).next());
            });

            $('#password').on('input', function() {
                hideError($(this).next());
            });

            $(document).on('keypress', function(e) {
                if (e.which == 13) { // Enter key
                    $('#btnLogin').click();
                }
            });

            $('#btnLogin').on('click', function(e) {
                const isEmailValid = validateEmail();
                const isPasswordValid = validatePassword();

                if (isEmailValid && isPasswordValid) {
                    $("#cover-spin").show();
                    $.ajax({
                        type: 'POST',
                        url: "/login",
                        data: {
                            email: $('#email').val(),
                            password: $('#password').val(),
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                window.location.href = response.url
                            } else {
                                showToast(response.message, response.status);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
                        },
                        complete: function() {
                            $("#cover-spin").hide();
                        }
                    });
                }
            });

            function validateEmail() {
                const email = $('#email').val();
                const errorElement = $('#email-error');

                if (!email) {
                    showError(errorElement, 'Vui lòng nhập tên đăng nhập');
                    return false;
                }

                if (!emailPattern.test(email)) {
                    showError(errorElement, 'Tên đăng nhập phải từ 6-20 ký tự và chỉ chứa chữ cái hoặc số');
                    return false;
                }

                hideError(errorElement);
                return true;
            }

            function validatePassword() {
                const password = $('#password').val();
                const errorElement = $('#password-error');

                if (!password) {
                    showError(errorElement, 'Vui lòng nhập mật khẩu');
                    return false;
                }

                if (!passwordPattern.test(password)) {
                    showError(errorElement, 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm cả chữ cái và số');
                    return false;
                }

                hideError(errorElement);
                return true;
            }

            function showError(element, message) {
                element.text(message).show();
                element.prev('input').addClass('is-invalid');
            }

            function hideError(element) {
                element.hide();
                element.prev('input').removeClass('is-invalid');
            }
        });
    </script>
</body>

</html>
