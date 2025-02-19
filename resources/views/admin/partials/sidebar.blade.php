<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('images/logo.png') }}" alt="logo.png"
          style="object-fit: cover; border-radius: 8px; max-height: 60px; padding-bottom:5px;">
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>
      
    @if (auth()->check() && in_array(auth()->user()->user_type, [0, 1]))
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Pages</span>
    </li>
    @endif

    <!-- Account Settings -->
    <li class="menu-item {{ request()->routeIs('payment.index', 'site.setting') ? 'active' : '' }}">
      @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-dock-top"></i>
      <div data-i18n="Account Settings">Settings</div>
      </a>
    @endif
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('payment.index') ? 'active' : '' }}">
          @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
        <a href="{{ route('payment.index') }}" class="menu-link">
        <div data-i18n="Notifications">Payment Settings</div>
        </a>
      @endif
        </li>
        <li class="menu-item {{ request()->routeIs('site.setting') ? 'active' : '' }}">
          @if (auth()->check() && auth()->user()->user_type == 0)
        <a href="{{ route('site.setting') }}" class="menu-link">
        <div data-i18n="Connections">Site Setting</div>
        </a>
      @endif
        </li>
      </ul>
    </li>

    <!-- users -->
    <li class="menu-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
      @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-dock-top"></i>
      <div data-i18n="Account Settings">Users</div>
      </a>
    @endif
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
          @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
        <a href="{{ route('user.index') }}" class="menu-link">
        <div data-i18n="Account">Users</div>
        </a>
      @endif
        </li>
        <!-- Dummy Roles Select Box under Users -->
        <li class="menu-item {{ request()->routeIs('user.roles') ? 'active' : '' }}">
          @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
        <a href="{{ route('user.roles') }}" class="menu-link">
        <div data-i18n="Roles">Users Role</div>
        </a>
      @endif
      </ul>
    </li>

    <!-- Products/Orders -->
    <li class="menu-item {{ request()->routeIs('product.index', 'orders.index') ? 'active' : '' }}">
      @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-dock-top"></i>
      <div data-i18n="Products Orders">Products/Orders</div>
      </a>
    @endif
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('product.index') ? 'active' : '' }}">
          <a href="{{ route('product.index') }}" class="menu-link">
            <div data-i18n="Products">Products</div>
          </a>
        </li>
        <li class="menu-item {{ request()->routeIs('orders.index') ? 'active' : '' }}">
          @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
        <a href="{{ route('orders.index') }}" class="menu-link">
        <div data-i18n="Orders">Orders</div>
        </a>
      @endif
        </li>
      </ul>
    </li>



    <!-- Media -->
    @if (auth()->check() && in_array(auth()->user()->user_type, [0, 1, 3]))
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Media</span></li>

    <!-- Blogs -->
    <li class="menu-item {{ request()->routeIs('blogs.index', 'category.index') ? 'active' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-dock-top"></i>
      <div data-i18n="Blogs">Blogs</div>
      </a>
      <ul class="menu-sub">
      <li class="menu-item {{ request()->routeIs('blogs.index') ? 'active' : '' }}">
        @if (auth()->check() && in_array(auth()->user()->user_type, [0, 1, 4]))
      <a href="{{ route('blogs.index') }}" class="menu-link">
      <div data-i18n="Products">Blog</div>
      </a>
    @endif
      </li>
      <li class="menu-item {{ request()->routeIs('category.index') ? 'active' : '' }}">
        <a href="{{ route('category.index') }}" class="menu-link">
        <div data-i18n="Blog Category">Blog Categories</div>
        </a>
      </li>
      </ul>
    </li>

    <!-- Press/Pr -->
    <li class="menu-item {{ Request::routeIs('press.index') ? 'active' : '' }}">
      <a href="{{ route('press.index') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-collection"></i>
      <div data-i18n="Press Pr">Press/Pr</div>
      </a>
    </li>
  @endif

    <!-- Press Release -->
    <li class="menu-item {{ Request::routeIs('press.release') ? 'active' : '' }}">
      @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
      <a href="{{ route('press.release') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-collection"></i>
      <div data-i18n="Press Release">Press Release</div>
      </a>
    @endif
    </li>

    <!-- Press Media -->
    <li class="menu-item {{ Request::routeIs('press.files.page') ? 'active' : '' }}">
      @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
      <a href="{{ route('press.files.page') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-collection"></i>
      <div data-i18n="Press Media">Press Media</div>
      </a>
    @endif
    </li>

    <!-- Monthly News Letter -->
    <li class="menu-item {{ Request::routeIs('monthly.news.index') ? 'active' : '' }}">
      @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
      <a href="{{ route('monthly.news.index') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-collection"></i>
      <div data-i18n="News Letter">Monthly News </div>
      </a>
    @endif
    </li>


    <!-- Help -->
    @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Help</span></li>

    <!-- News Letter -->
    <li class="menu-item {{ Request::routeIs('news.letter.index') ? 'active' : '' }}">
      @if (auth()->check() && in_array(auth()->user()->user_type, [1, 0]))
      <a href="{{ route('news.letter.index') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-collection"></i>
      <div data-i18n="News Letter">News Letter</div>
      </a>
    @endif
    </li>

    <li class="menu-item {{ Request::routeIs('contact.index') ? 'active' : '' }}">
      <a href="{{ route('contact.index') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-support"></i>
      <div data-i18n="Support">Contact Us</div>
      </a>
    </li>
  @endif

    <!-- Sales Consultances-->
    @if (auth()->check() && in_array(auth()->user()->user_type, [7]))
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Sales Consultances</span>
    </li>
    <li class="menu-item ">
      @if (auth()->check() && in_array(auth()->user()->user_type, [7]))
        <a href="#" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="PowePoint Presentation">PowePoint Presentation</div>
        </a>
      @endif
    </li>
    <li class="menu-item">
      @if (auth()->check() && in_array(auth()->user()->user_type, [7]))
        <a href="#" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Our Comparison">Our Comparison</div>
        </a>
      @endif
    </li>
    <li class="menu-item">
      @if (auth()->check() && in_array(auth()->user()->user_type, [7]))
        <a href="#" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Facts About RobotoKombucha">Facts About RobotoKombucha</div>
        </a>
      @endif
    </li>
    <li class="menu-item">
      @if (auth()->check() && in_array(auth()->user()->user_type, [7]))
        <a href="#" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Tools">Tools</div>
        </a>
      @endif
    </li>
  @endif

  </ul>
</aside>