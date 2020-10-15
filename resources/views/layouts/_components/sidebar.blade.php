<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Larastore</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Request::path() == 'home' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route("home") }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item {{ Request::path() == 'users' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route("users.index") }}">
          <i class="fas fa-fw fa-users"></i>
          <span>Manage Users</span></a>
      </li>

      <li class="nav-item {{ Request::path() == 'categories' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route("categories.index") }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Manage Categories</span>
            </a>
      </li>

            <li class="nav-item {{ Request::path() == 'books' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route("books.index") }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Manage Books</span>
            </a>
      </li>

                  <li class="nav-item {{ Request::path() == 'orders' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route("orders.index") }}">
            <i class="fas fa-fw fa-cart-plus"></i>
            <span>Manage Orders</span>
            </a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
