<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot Transaction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        #chat-box {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            max-width: 60%;
        }

        .user-message {
            text-align: right;
            color: blue;
            background-color: #e0f7fa;
            margin-left: auto;
        }

        .bot-message {
            text-align: left;
            color: green;
            background-color: #e8f5e9;
            margin-right: auto;
        }
    </style>
</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#chat-form').submit(function (e) {
                e.preventDefault();
                const message = $('#message').val();
                $('#chat-box').append(`<div class="message user-message"><strong>You:</strong> ${message}</div>`);
                $('#message').val('');

                // Send message to server
                $.ajax({
                    url: '{{ route('chat.createTransaction') }}',
                    method: 'POST',
                    data: {
                        message: message,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#chat-box').append(`<div class="message bot-message"><strong>Bot:</strong> ${response.message}</div>`);
                    },
                    error: function () {
                        $('#chat-box').append(`<div class="message bot-message"><strong>Bot:</strong> Something went wrong.</div>`);
                    }
                });
            });
        });
    </script>
</body>

</html>