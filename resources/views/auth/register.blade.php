<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Đăng ký tài khoản</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Notyf -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div id="cover-spin"></div>
                <main>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Nhập họ và tên" required>
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Ngày sinh <span class="text-danger">(*)</span></label>
                        <input type="date" class="form-control" id="birthday" name="birthday" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Giới tính</label>
                        <div class="d-flex gap-3">
                            <div>
                                <input class="form-check-input" type="radio" name="gender" id="male"
                                    value="0" checked>
                                <label for="male">Nam</label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="gender" id="female"
                                    value="1">
                                <label for="female">Nữ</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">(*)</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Nhập email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu <span class="text-danger">(*)</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Nhập lại mật khẩu <span
                                class="text-danger">(*)</span></label>
                        <input type="password" class="form-control" id="confirm-password" name="password_confirmation"
                            placeholder="Nhập lại mật khẩu" required>
                    </div>
                    <button class="button btn-primary" id="btnSubmit">Register</button>
                </main>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
                    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                    $(document).ready(function() {
                        const btnSubmit = $("#btnSubmit");

                    })
                </script>
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
            const namePattern = /^[\p{L}\s]{2,50}$/u;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/;

            function showError(input, message) {
                const errorDiv = input.next('.error-message');
                if (errorDiv.length === 0) {
                    $('<div class="error-message"></div>').insertAfter(input);
                }
                input.addClass('is-invalid');
                input.next('.error-message').text(message).show();
            }

            function clearError(input) {
                input.removeClass('is-invalid');
                input.next('.error-message').hide();
            }

            function validateInput(input, validationFn) {
                if (input.data('touched')) {
                    validationFn(input);
                }
            }

            function validateName(input) {
                const name = input.val();
                if (!name) {
                    showError(input, 'Họ và tên không được để trống');
                } else if (!namePattern.test(name)) {
                    showError(input, 'Họ và tên chỉ được chứa chữ cái và khoảng trắng, độ dài 2-50 ký tự');
                } else {
                    clearError(input);
                }
            }

            function validateBirthday(input) {
                const birthdayValue = input.val();
                const birthday = birthdayValue ? new Date(birthdayValue) : null;
                const today = new Date();
                const minAge = new Date();
                const maxDate = new Date('2100-12-31');
                const minDate = new Date('1900-01-01');

                minAge.setFullYear(today.getFullYear() - 18);

                if (!birthdayValue || birthdayValue === "mm/dd/yyyy") {
                    showError(input, 'Ngày sinh không được để trống hoặc là giá trị mặc định');
                } else if (isNaN(birthday.getTime())) {
                    showError(input, 'Ngày sinh không hợp lệ');
                } else if (birthday > maxDate || birthday < minDate) {
                    showError(input, 'Ngày sinh phải nằm trong khoảng 1900-2100');
                } else if (birthday > today) {
                    showError(input, 'Ngày sinh không thể là ngày trong tương lai');
                } else if (birthday > minAge) {
                    showError(input, 'Bạn phải đủ 18 tuổi');
                } else {
                    clearError(input);
                }
            }

            function validateEmail(input) {
                const email = input.val();
                if (!email) {
                    showError(input, 'Email không được để trống');
                } else if (!emailPattern.test(email)) {
                    showError(input, 'Email không hợp lệ');
                } else {
                    clearError(input);
                }
            }

            function validatePassword(input) {
                const password = input.val();
                if (!password) {
                    showError(input, 'Mật khẩu không được để trống');
                } else if (!passwordPattern.test(password)) {
                    showError(input, 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ và số');
                } else {
                    clearError(input);
                }
            }

            function validateConfirmPassword(input) {
                const confirmPassword = input.val();
                const password = $('#password').val();
                if (!confirmPassword) {
                    showError(input, 'Vui lòng xác nhận mật khẩu');
                } else if (confirmPassword !== password) {
                    showError(input, 'Mật khẩu xác nhận không khớp');
                } else {
                    clearError(input);
                }
            }

            // Mark fields as touched on blur
            $('input').on('blur', function() {
                $(this).data('touched', true);
            });

            // Validate on input only if field has been touched
            $('#name').on('input', function() {
                validateInput($(this), validateName);
            });

            $('#birthday').on('change', function() {
                validateInput($(this), validateBirthday);
            });

            $('#email').on('input', function() {
                validateInput($(this), validateEmail);
            });

            $('#password').on('input', function() {
                validateInput($(this), validatePassword);
            });

            $('#confirm-password').on('input', function() {
                validateInput($(this), validateConfirmPassword);
            });
            $('#btnSubmit').on('click', function(e) {
                e.preventDefault();
                const inputs = ['name', 'birthday', 'gender', 'email', 'password', 'confirm-password'];
                let isValid = true;
                let formData = {};

                inputs.forEach(id => {
                    const input = $(`#${id}`);
                    input.data('touched', true);
                    input.trigger('input');
                    if (input.hasClass('is-invalid')) {
                        isValid = false;
                    }
                    formData[id] = input.val();
                });

                formData['gender'] = $('input[name="gender"]:checked').val();

                if (isValid) {
                    $("#cover-spin").show();
                    $.ajax({
                        url: '/register',
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                setTimeout(() => {
                                    window.location.href = response.url;
                                }, 500);
                            } else {
                                showToast(response.message, response.status);
                            }
                        },
                        error: function(xhr) {
                            alert("Có lỗi xảy ra, xin vui lòng thử lại!");
                            console.log(xhr.responseText);
                        },
                        complete: function() {
                            $("#cover-spin").hide();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
