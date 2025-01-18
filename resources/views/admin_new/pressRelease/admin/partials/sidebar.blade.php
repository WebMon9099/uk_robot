<div class="app-menu navbar-menu">
    <div class="navbar-brand-box my-3">
        <a href="{{ route('home') }}" class="logo logo-dark">
            <img class="img-fluid w-50" src={{ asset('images/logo.png') }}>
        </a>
        <a href="{{ route('home') }}" class="logo logo-light">
            <img class="img-fluid w-50" src={{ asset('images/logo.png') }}>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div id="scrollbar" class="mt-4" style="max-height: 80vh;  overflow-y: auto; ">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Dashboard</span></li>
                <li class="nav-item mb-2">
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                        <i class="ph-gauge"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-apps">Menu</span></li>
                <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a href="{{ route('user.index') }}" class="nav-link menu-link">
                            <i class="ph-user"></i>
                            <span data-key="t-user">Users</span>
                        </a>
                    @endif
                </li>
                <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a href="{{ route('product.index') }}" class="nav-link menu-link">
                            <i class="ph-package"></i>
                            <span data-key="t-branches">Products</span>
                        </a>
                    @endif
                </li>
                <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a class="nav-link menu-link" href="{{ route('payment.index') }}">
                            <i class="ph ph-receipt"></i>
                            <span data-key="t-dashboards">Payment Settings</span>
                        </a>
                    @endif
                </li>
                <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a class="nav-link menu-link " href="{{ route('site.setting') }}"> <i class="ph-gear"></i> <span
                                data-key="t-dashboards">Site Setting</span>
                        </a>
                    @endif
                </li>
                <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a class="nav-link menu-link" href="{{ route('orders.index') }}">
                            <i class="ph ph-receipt"></i>
                            <span data-key="t-dashboards">Orders</span>
                        </a>
                    @endif
                </li>
                {{-- blog --}}
                {{-- blog --}}
                <li class="nav-item mb-2">
                    @if (auth()->check() && in_array(auth()->user()->user_type, [1, 4]))
                        <a href="{{ route('blogs.index') }}" class="nav-link menu-link">
                            <i class="fa-regular fa-envelope"></i>
                            <span data-key="t-branches">Blog</span>
                        </a>
                    @endif
                </li>

                {{-- --}}
                <li class="nav-item mb-2">
                    @if (auth()->check() && in_array(auth()->user()->user_type, [1, 3]))
                        <a href="{{ route('press.index') }}" class="nav-link menu-link">
                            <i class="fa-regular fa-envelope"></i>
                            <span data-key="t-branches">Press/Pr</span>
                        </a>
                    @endif
                </li>

                {{-- blog Category --}}
                <li class="nav-item mb-2">
                    <a href="{{ route('category.index') }}" class="nav-link menu-link">
                        <i class="fa-solid fa-newspaper"></i>
                        <span data-key="t-branches">Blog Category</span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a class="nav-link menu-link" href="{{ route('press.release') }}">
                            <i class="ph ph-receipt"></i>
                            <span data-key="t-dashboards">Press Release</span>
                        </a>
                    @endif
                </li>
                <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a class="nav-link menu-link" href="{{ route('press.files.page') }}">
                            <i class="ph ph-receipt"></i>
                            <span data-key="t-dashboards">Press Media</span>
                        </a>
                    @endif
                </li>
                <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a href="{{ route('news.letter.index') }}" class="nav-link menu-link">
                            <i class="ph-envelope"></i>
                            <span data-key="t-user">News Letter</span>
                        </a>
                    @endif
                </li>
                <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a href="{{ route('contact.index') }}" class="nav-link menu-link">
                            <i class="ph-chat-circle"></i>
                            <span data-key="t-role-permission">Contact Us</span>
                        </a>
                    @endif
                </li>
                <!-- <li class="nav-item mb-2">
                    @if (auth()->check() && auth()->user()->user_type == 1)
                        <a class="nav-link menu-link" href="{{ route('payment.index') }}">
                            <i class="ph ph-receipt"></i>
                            <span data-key="t-dashboards">Payment Settings</span>
                        </a>
                    @endif
                </li> -->

            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>