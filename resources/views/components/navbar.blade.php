<!-- header start -->
<style>
    @media screen and (max-width: 768px) {
        #contact-btn {
            width: 25% !important;
            padding-left: 5px !important;
        }

        .count-mobile {
            position: absolute;
            text-align: center;
            border-radius: 50%;
            width: 15px;
            height: 15px;
            background-color: #ff6161;
            color: #f0f0f0;
            line-height: 15px;
            font-size: 11px;
            font-weight: 200;
            font-family: inter_semi_bold;
            top: -6px;
            right: -2px;
        }
    }

    / Show cart count for both mobile and desktop / #cart-count-mobile {
        display: block;/ Show on both mobile and desktop /
    }

    / Ensure dropdown menu is visible against white background / .navbar-dark .dropdown-menu {
        background-color: #343a40;/ Darker background for dropdown / border: none;
    }

    .navbar-dark .dropdown-item {
        color: #ffffff;/ White text color for dropdown items /
    }

    .navbar-dark .dropdown-item:hover {
        background-color: #495057;/ Slightly lighter on hover /
    }

    .count {
        position: absolute;
        text-align: center;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        background-color: #ff6161;
        color: #f0f0f0;
        line-height: 16px;
        font-size: 18px;
        font-weight: 500;
        font-family: inter_semi_bold;
        top: -5px;/ Adjust this value to position correctly / right: -10px;/ Adjust this value to position correctly /
    }
    @media (max-width: 767.98px) {
    .dropdown-menu {
        left: auto !important; /* Override Bootstrap default */
        right: 0; /* Align to the right edge of the parent */
        top: 100%; /* Position it below the dropdown toggle */
    }
    @media (max-width: 576px) {
            .nav-link .badge {
                position: relative;
                top: -9px;
                right: 6px;
                font-size: 0.7rem;
                padding: 2px 4px;

            }

            .navbar-toggler {

                margin-left: 12px;
                padding: 5px !important;
                font-size: 16px !important;
                color: white;
            }

            .navbar-toggler-icon {
                background-image: url('data:image/svg+xml;charset=UTF8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="white"><path stroke="white" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"/></svg>') !important;
                background-repeat: no-repeat;
                background-position: center;
                background-size: 100%;
            }
            .navbar-toggler:focus
            {
                box-shadow: none;
            }

        }
}
</style>

<nav class="navbar navbar-expand-lg"
    style="background-color: transparent; box-shadow: rgba(100, 100, 111, 0.076) 0px 7px 29px 0px;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 60px;">
        </a>
        <div class="d-flex align-items-center mb-3">
            <li class="d-flex gap-2 flex-wrap d-block d-lg-none">
                {{-- <a href="https://www.facebook.com/share/Y2w7gJhzAD6dw24C/?mibextid=LQQJ4d" class="nav-link text-white" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/ROBOTkombucha?t=XrYdYGleIYpjJXPndt1ogA&s=08" class="nav-link text-white" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="https://www.instagram.com/robotkombucha1?igsh=cGFrcXl0a3hsN3E0&utm_source=qr" class="nav-link text-white" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.tiktok.com/@robotkombucha?_t=8m21UCxxXwg&_r=1" class="nav-link text-white" target="_blank"><i class="fab fa-tiktok"></i></a> --}}
                <a href="mailto:info@robotkombucha.co.uk" class="nav-link text-white text-decoration-none mx-1"><i class="fas fa-envelope"></i></a>
                @if ($sales_status == 1)
                <div class="position-relative">
                    <div class="count-mobile" id="cart-count-mobile">0</div>
                    <a href="{{ route('cart.store') }}" class="nav-link text-white text-decoration-none mx-1"><i class="fa fa-shopping-cart"></i></a>
                </div>
                @endif
                @auth
                    <div class="position-relative mb-1">
                        <a href="#" class="nav-link text-white text-decoration-none mx-1" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->image != '')
                                <img src="{{ asset('images/profile_image/thumb/' . Auth::user()->image) }}" alt="avatar" class="rounded-circle img-fluid" style="width:25px;">
                            @else
                                <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width:25px;">
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('user.login') }}" class="nav-link text-white text-decoration-none mx-1"><i class="fas fa-user"></i></a>
                @endauth
            </li>
            
            <button class="navbar-toggler text-center" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation" style="border: 1px solid white;">
            <span class="navbar-toggler-icon text-center"></span>
        </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('honey.cola') }}">Honey Cola</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{ route('pineapple.mango') }}">Pineapple & Mango</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{ route('cherry.cola') }}">Cherry Cola</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{ route('science') }}">History & Science</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('userPress.index') }}">Press/PR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('userBlog.index') }}">Blogs</a>
                </li>
                <li class="nav-item me-4 ms-2 fs-6 mt-1">
                    <a class="nav-link text-white rounded-4 px-auto px-lg-2 py-1 text-center" id="contact-btn"
                        href="{{ route('contact') }}" style="background-color:#F2A71B;">Contact Us</a>
                </li>
                <li class="nav-item d-lg-flex gap-2 flex-wrap d-none position-relative">
                    <a href="https://www.facebook.com/share/Y2w7gJhzAD6dw24C/?mibextid=LQQJ4d"
                        class="nav-link text-white" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://twitter.com/ROBOTkombucha?t=XrYdYGleIYpjJXPndt1ogA&s=08"
                        class="nav-link text-white" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.instagram.com/robotkombucha1?igsh=cGFrcXl0a3hsN3E0&utm_source=qr"
                        class="nav-link text-white" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@robotkombucha?_t=8m21UCxxXwg&_r=1" class="nav-link text-white"
                        target="_blank"><i class="fab fa-tiktok"></i></a>
                    <a href="mailto:info@robotkombucha.co.uk" class="nav-link text-white text-decoration-none mx-1"><i
                            class="fas fa-envelope"></i></a>
                            @if ($sales_status == 1)
                    <div class="position-relative">
                        <div class="count" id="cart-count">0</div>
                        <a href="{{ route('cart.store') }}" class="nav-link text-white text-decoration-none mx-1"><i
                                class="fa fa-shopping-cart"></i></a>
                    </div>
                    @endif
                </li>
                <li class="nav-item d-lg-flex gap-2 flex-wrap d-none position-relative">
                    @auth

                        <a href="#" class="nav-link text-white text-decoration-none mx-1" id="profileDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- <i class="fas fa-user-circle"></i> --}}
                            @if (Auth::user()->image != '')
                                <img src="{{ asset('images/profile_image/thumb/' . Auth::user()->image) }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width:25px;">
                            @else
                                <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width:25px;">
                            @endif

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                        </ul>
                    @else
                        <a href="{{ route('user.login') }}" class="nav-link text-white text-decoration-none mx-1">
                            <i class="fas fa-user"></i>
                        </a>
                    @endauth
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- header end -->
<script>
    function updateCartCount() {
        // Make an AJAX request to get the cart count
        fetch("{{ route('cart.count') }}")
            .then(response => response.json())
            .then(data => {

                const cartCountElement = document.getElementById('cart-count');
                const cartCountElementMobile = document.getElementById('cart-count-mobile');
                // Update the cart count element based on the total items
                if (data.totalItems > 0) {
                    cartCountElement.innerText = data.totalItems;
                    cartCountElementMobile.textContent = data.totalItems;
                    cartCountElement.style.display = 'block'; // Show the count
                } else {
                    cartCountElement.innerText = 0;
                    cartCountElement.style.display = 'none'; // Hide the count if cart is empty
                }
            })
            .catch(error => console.error('Error fetching cart count:', error));
    }

    // Call this function on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });
</script>
