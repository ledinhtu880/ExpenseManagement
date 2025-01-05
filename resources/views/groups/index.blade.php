<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhóm</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 10px 20px;
            background-color: #f8f9fa;
            position: relative;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header .back-btn {
            display: flex;
            align-items: center;
            color: #999;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
        }
        .header .back-btn i {
            font-size: 16px;
            margin-right: 5px;
        }
        .header .title {
            color: #6c63ff;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            flex: 1;
        }
        .header .underline {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #6c63ff;
        }
        .tabs-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .tab-btn {
            flex: 1;
            text-align: center;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: transparent;
            border: none;
            outline: none;
            color: black;
            font-weight: 500;
            border-radius: 10px;
            transition: background-color 0.3s;
        }
        .tab-btn.active {
            background-color: #fff;
            color: black;
            font-weight: bold;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .group-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .group-content {
            width: 90%; /* Không sát lề */
            max-width: 700px;
        }
        .group-card {
            border: 2px solid #6c63ff; /* Border to hơn */
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .group-title {
            font-weight: 700;
            font-size: 22px; /* Ý chính to hơn */
            color: #6c63ff;
            padding: 15px;
            border-bottom: 1px solid #ccc; /* Gạch dưới dài hết border */
            margin: 0;
        }
        .group-title i {
            margin-right: 10px;
            color: black; /* Màu đen cho biểu tượng */
        }
        .group-item {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Gạch dưới kéo dài */
            padding: 10px 15px; /* Padding đều cho mục */
            font-size: 16px; /* Ý phụ kích thước như yêu cầu */
            color: #6c63ff;
            margin: 0;
            border-bottom: 1px solid #ccc; /* Gạch dưới dài hết viền */
        }

        .group-item i {
            flex-shrink: 0; /* Đảm bảo biểu tượng không bị co lại */
            width: 20px; /* Giữ biểu tượng có cùng kích thước */
            text-align: center; /* Căn giữa biểu tượng */
            margin-right: 10px;
            color: black;
        }
        .group-item span {
            flex-grow: 1; /* Đảm bảo text nằm thẳng hàng với biểu tượng */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <a href="#" class="back-btn">
                <i class="fas fa-caret-left"></i> Quay lại
            </a>
            <div class="title">Nhóm</div>
            <div class="underline"></div>
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <button class="tab-btn active" onclick="showTab('expenses')">Khoản chi</button>
            <button class="tab-btn" onclick="showTab('incomes')">Khoản thu</button>
            <button class="tab-btn" onclick="showTab('debts-loans')">Vay/Nợ</button>
        </div>

        <!-- Content -->
        <div class="group-container">
            <div class="group-content">
                <!-- Tab content: Khoản chi -->
                <div id="expenses" class="tab-content">
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-utensils"></i> Ăn uống</div>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-receipt"></i> Hóa đơn & Tiện ích</div>
                        <ul>
                            <li class="group-item"><i class="fas fa-home"></i> <span>Thuê nhà</span></li>
                            <li class="group-item"><i class="fas fa-tint"></i> <span>Hóa đơn nước</span></li>
                            <li class="group-item"><i class="fas fa-phone"></i> <span>Hóa đơn điện thoại</span></li>
                            <li class="group-item"><i class="fas fa-bolt"></i> <span>Hóa đơn điện</span></li>
                            <li class="group-item"><i class="fas fa-fire"></i> <span>Hóa đơn gas</span></li>
                            <li class="group-item"><i class="fas fa-tv"></i> <span>Hóa đơn TV</span></li>
                            <li class="group-item"><i class="fas fa-wifi"></i> <span>Hóa đơn Internet</span></li>
                            <li class="group-item"><i class="fas fa-tools"></i> <span>Hóa đơn tiện ích khác</span></li>
                        </ul>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-shopping-cart"></i> Mua sắm</div>
                        <ul>
                            <li class="group-item"><i class="fas fa-tshirt"></i> <span>Đồ dùng cá nhân</span></li>
                            <li class="group-item"><i class="fas fa-couch"></i> <span>Đồ gia dụng</span></li>
                            <li class="group-item"><i class="fas fa-brush"></i> <span>Làm đẹp</span></li>
                        </ul>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-home"></i> Gia đình</div>
                        <ul>
                            <li class="group-item"><i class="fas fa-tools"></i> <span>Sửa & Trang trí nhà</span></li>
                            <li class="group-item"><i class="fas fa-concierge-bell"></i> <span>Dịch vụ gia đình</span></li>
                            <li class="group-item"><i class="fas fa-paw"></i> <span>Vật nuôi</span></li>
                        </ul>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-car"></i> Di chuyển</div>
                        <ul>
                            <li class="group-item"><i class="fas fa-tools"></i> <span>Bảo dưỡng xe</span></li>
                        </ul>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-heartbeat"></i> Sức khỏe</div>
                        <ul>
                            <li class="group-item"><i class="fas fa-user-md"></i> <span>Khám sức khỏe</span></li>
                            <li class="group-item"><i class="fas fa-dumbbell"></i> <span>Thể dục thể thao</span></li>
                        </ul>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-graduation-cap"></i> Giáo dục</div>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-laugh-beam"></i> Giải trí</div>
                        <ul>
                            <li class="group-item"><i class="fas fa-desktop"></i> <span>Dịch vụ trực tuyến</span></li>
                            <li class="group-item"><i class="fas fa-gamepad"></i> <span>Vui chơi</span></li>
                        </ul>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-gift"></i> Quà tặng & Quyên góp</div>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-shield-alt"></i> Bảo hiểm</div>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-chart-line"></i> Đầu tư</div>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-money-check-alt"></i> Các chi phí khác</div>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-exchange-alt"></i> Tiền chuyển đi</div>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-credit-card"></i> Trả lãi</div>
                    </div>
                    <div class="group-card">
                        <div class="group-title"><i class="fas fa-question-circle"></i> Chưa phân loại</div>
                    </div>
            </div>
            <!-- Tab content: Khoản thu -->
            <div id="incomes" class="tab-content" style="display: none;">
                <div class="group-card">
                    <div class="group-title"><i class="fas fa-wallet"></i> Lương</div>
                </div>
                <div class="group-card">
                    <div class="group-title"><i class="fas fa-hand-holding-usd"></i> Thu nhập khác</div>
                </div>
                <div class="group-card">
                    <div class="group-title"><i class="fas fa-exchange-alt"></i> Tiền chuyển đến</div>
                </div>
                <div class="group-card">
                    <div class="group-title"><i class="fas fa-coins"></i> Thu lãi</div>
                </div>
                <div class="group-card">
                    <div class="group-title"><i class="fas fa-question-circle"></i> Chưa phân loại</div>
                </div>
            </div>
            <!-- Tab content: Vay/Nợ -->
            <div id="debts-loans" class="tab-content" style="display: none;">
                <div class="group-card">
                    <div class="group-title"><i class="fas fa-hand-holding-usd"></i> Cho vay</div>
                </div>
                <div class="group-card">
                    <div class="group-title"><i class="fas fa-exclamation-circle"></i> Trả nợ</div>
                </div>
                <div class="group-card">
                    <div class="group-title"><i class="fas fa-handshake"></i> Thu nợ</div>
                </div>
                <div class="group-card">
                    <div class="group-title"><i class="fas fa-money-bill-wave"></i> Đi vay</div>
                </div>
            </div>

        </div>
    </div>
</div>

    <script>
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab-btn');
            tabs.forEach(tab => tab.classList.remove('active'));

            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.style.display = 'none');

            document.querySelector(`.tab-btn[onclick="showTab('${tabId}')"]`).classList.add('active');
            document.getElementById(tabId).style.display = 'block';
        }
    </script>
</body>
</html>
