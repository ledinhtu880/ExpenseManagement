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
        }

        .user-message {
            text-align: right;
            color: blue;
        }

        .bot-message {
            text-align: left;
            color: green;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">ChatBot - Create Transaction</h2>
        <div id="chat-box" class="mb-3">
            <!-- Chat messages will be appended here -->
        </div>
        <form id="chat-form">
            <div class="input-group">
                <input type="text" id="message" class="form-control" placeholder="Type your message..." required>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#chat-form').submit(function (e) {
                e.preventDefault();
                const message = $('#message').val();
                $('#chat-box').append(`<div class="message user-message">You: ${message}</div>`);
                $('#message').val('');

                // Send message to server
                $.ajax({
                    url: '/chatbot/create-transaction',
                    method: 'POST',
                    data: {
                        message: message,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#chat-box').append(`<div class="message bot-message">Bot: ${response.message}</div>`);
                    },
                    error: function () {
                        $('#chat-box').append(`<div class="message bot-message">Bot: Something went wrong.</div>`);
                    }
                });
            });
        });
    </script>
</body>

</html>