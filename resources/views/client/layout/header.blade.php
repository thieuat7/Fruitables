<body>
    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                            class="text-white">123 Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                            class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="/" class="navbar-brand">
                    <h1 class="text-primary display-6">Fruitables</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="/" class="nav-item nav-link active">Home</a>
                        <a href="/product" class="nav-item nav-link">Shop</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="cart.html" class="dropdown-item">Cart</a>
                                <a href="chackout.html" class="dropdown-item">Chackout</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        @if(auth()->check())
                        <!-- Nếu đã đăng nhập -->
                        <div class="dropdown my-auto dropdown-hover me-4">
                            <a href="#" class="position-relative" role="button" id="notificationDropdown"
                                aria-expanded="false">
                                <i class="fas fa-bell fa-2x"></i>
                                <!-- Số lượng thông báo -->
                                <span
                                    class="position-absolute bg-danger rounded-circle d-flex align-items-center justify-content-center text-white px-1"
                                    style="top: -5px; right: -5px; height: 20px; min-width: 20px;">
                                    3
                                </span>
                            </a>
                        </div>
                        <div class="dropdown my-auto dropdown-hover me-4">
                            <a href="/cart" class="position-relative" role="button" id="cartDropdown"
                                aria-expanded="false">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                                <!-- Số lượng sản phẩm trong giỏ hàng -->
                                <span
                                    class="position-absolute bg-danger rounded-circle d-flex align-items-center justify-content-center text-white px-1"
                                    style="top: -5px; right: -5px; height: 20px; min-width: 20px;">
                                    5
                                </span>
                            </a>
                        </div>

                        <!-- Icon người dùng -->
                        <div class="dropdown my-auto dropdown-hover">
                            <a href="#" class="position-relative me-4 my-auto" role="button" id="dropdownMenuLink"
                                aria-expanded="false" data-bs-toggle="dropdown">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-4" aria-labelledby="dropdownMenuLink">
                                <li class="d-flex align-items-center flex-column" style="min-width: 300px;">
                                    <img loading="lazy" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; display: flex;
                justify-content: center; align-items: center; object-fit: cover;"
                                        src="{{ asset('storage/avatars/' . auth()->user()->user_avatar) }}" />
                                    <div class="text-center my-3">
                                        {{ auth()->user()->user_name }}
                                    </div>
                                </li>
                                <li><a class="dropdown-item" href="/user-profile">Quản lý tài khoản</a></li>
                                <li><a class="dropdown-item" href="/order-history">Lịch sử mua hàng</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @else
                        <!-- Nếu chưa đăng nhập -->
                        <a href="/login" class="my-auto text-decoration-none">
                            <i class="fas fa-sign-in-alt"></i>
                            Đăng nhập
                        </a>
                        @endif
                    </div>

                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
</body>