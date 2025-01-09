<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm ATM/Bank</title>

    <!-- Thêm Leaflet CSS và JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <style>
        #map {
            height: 720px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Tìm kiếm ATM/Bank</h1>

    <form method="POST" action="{{ route('bank-branches.search') }}">
        @csrf
        <input type="text" name="query" placeholder="Tên ngân hàng" value="{{ old('query', $query) }}">
        <input type="hidden" name="latitude" value="21.007118"> <!-- Đại học Thủy Lợi -->
        <input type="hidden" name="longitude" value="105.825195"> <!-- Đại học Thủy Lợi -->
        <button type="submit">Tìm kiếm</button>
    </form>
    <!-- Bản đồ -->
    <div id="map"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const branches = @json($branches);
        
            // Tọa độ mặc định (nếu người dùng không cấp quyền)
            const defaultLatitude = 21.007118; // Tọa độ Đại học Thủy Lợi
            const defaultLongitude = 105.825195; // Tọa độ Đại học Thủy Lợi
        
            // Hàm khởi tạo bản đồ
            function initMap(lat, lon) {
                const map = L.map('map').setView([lat, lon], 16); // Zoom mức 16
            
                // Thêm lớp bản đồ OSM
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);
            
                // Marker tùy chỉnh màu đỏ cho vị trí hiện tại
                const currentLocationIcon = L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png', // Marker màu đỏ
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png', // Shadow mặc định
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                });
            
                // Thêm marker màu đỏ cho vị trí hiện tại
                const currentLocationMarker = L.marker([lat, lon], { icon: currentLocationIcon }).addTo(map);
                currentLocationMarker.bindPopup(`<strong>Vị trí hiện tại của bạn</strong>`).openPopup();
            
                // Thêm marker màu xanh mặc định cho các chi nhánh
                branches.forEach(branch => {
                    const marker = L.marker([branch.latitude, branch.longitude]).addTo(map);
                    marker.bindPopup(`<strong>${branch.name}</strong>`);
                });
            }
        
            // Sử dụng Geolocation API để lấy vị trí người dùng
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userLatitude = position.coords.latitude;
                        const userLongitude = position.coords.longitude;
                    
                        // Khởi tạo bản đồ với vị trí người dùng
                        initMap(userLatitude, userLongitude);
                    },
                    (error) => {
                        console.error("Lỗi khi lấy vị trí: ", error);
                        // Nếu người dùng từ chối hoặc xảy ra lỗi, sử dụng tọa độ mặc định
                        initMap(defaultLatitude, defaultLongitude);
                    }
                );
            } else {
                // Nếu trình duyệt không hỗ trợ Geolocation API
                console.error("Trình duyệt của bạn không hỗ trợ Geolocation.");
                initMap(defaultLatitude, defaultLongitude);
            }
        });
        
    </script>
</body>
</html>
