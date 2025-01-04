<aside class="main-sidebar sidebar-light-purple elevation-4" style="background-color: #6C63FF">
    <!-- Brand Logo -->
    <a href="#" class="brand-link border-0">
        <div class="d-flex align-items-center justify-content-center gap-3">
            <svg width="62" height="63" viewBox="0 0 62 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M41 28.0695V28.1032M8.24333 19.2334C6.78133 18.0974 5.65847 16.5749 4.99887 14.8341C4.33926 13.0932 4.16859 11.2019 4.50572 9.36915C4.84285 7.53639 5.67464 5.83355 6.90917 4.44883C8.14371 3.06412 9.7329 2.05146 11.5011 1.52276C13.2693 0.994073 15.1477 0.969943 16.9286 1.45304C18.7096 1.93614 20.3237 2.90765 21.5926 4.26021C22.8616 5.61276 23.7359 7.29369 24.119 9.1172C24.5021 10.9407 24.379 12.8358 23.7633 14.593"
                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M44.3333 4.47974V17.2957C48.4585 19.7092 51.5993 23.5284 53.1933 28.0695H57.6633C58.5474 28.0695 59.3952 28.4245 60.0204 29.0565C60.6455 29.6885 60.9967 30.5457 60.9967 31.4394V38.1794C60.9967 39.0731 60.6455 39.9303 60.0204 40.5623C59.3952 41.1943 58.5474 41.5493 57.6633 41.5493H53.19C52.07 44.7508 50.1667 47.6153 47.6633 49.8833V56.7142C47.6633 58.0548 47.1366 59.3406 46.1989 60.2886C45.2612 61.2365 43.9894 61.7691 42.6633 61.7691C41.3373 61.7691 40.0655 61.2365 39.1278 60.2886C38.1901 59.3406 37.6633 58.0548 37.6633 56.7142V54.7495C36.5619 54.9367 35.4469 55.0302 34.33 55.0292H20.9967C19.8798 55.0302 18.7648 54.9367 17.6633 54.7495V56.7142C17.6633 58.0548 17.1365 59.3406 16.1989 60.2886C15.2612 61.2365 13.9894 61.7691 12.6633 61.7691C11.3372 61.7691 10.0655 61.2365 9.1278 60.2886C8.19012 59.3406 7.66333 58.0548 7.66333 56.7142V49.8833C4.6432 47.1535 2.51425 43.5608 1.55827 39.5808C0.602294 35.6008 0.864366 31.4212 2.3098 27.5951C3.75523 23.769 6.31587 20.4769 9.65278 18.1545C12.9897 15.8321 16.9455 14.589 20.9967 14.5896H29.33L44.3333 4.47974Z"
                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <h6 class="text-white m-0">Money Love</h6>
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar px-0 mt-5">
        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item text-center">
                    <a href="{{route('dashboard.index') }}" class="nav-link rounded-0 py-3 text-white fw-bold text-uppercase active">
                    TỔNG QUAN
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a href="{{route('transaction.index') }}"  class="nav-link rounded-0 py-3 text-white fw-bold text-uppercase">
                    SỐ GIAO DỊCH
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a href="{{route('indexBudget') }}"  class="nav-link rounded-0 py-3 text-white fw-bold text-uppercase">
                    NGÂN SÁCH </a>
                </li>
                <li class="nav-item text-center">
                    <a href="{{route('account.index') }}" class="nav-link rounded-0 py-3 text-white fw-bold text-uppercase">
                    TÀI KHOẢN
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <a href="#" class="position-absolute w-100 text-center py-3 text-white text-uppercase fw-bold" style="bottom: 0; left: 0;">Đăng xuất</a>
</aside>