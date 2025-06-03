  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/logo_univ.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Kristen Maranatha</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('img/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Admin</a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
              <li class="nav-item menu-open">
              <a href="{{ route('admin.roles.dashboard') }}" class="nav-link {{ request()->routeIs('admin.roles.dashboard') ? 'active' : '' }}">
                  <p>Data Role</p>
              </a>
              <a href="{{ route('admin.keuangans.dashboard') }}" class="nav-link {{ request()->routeIs('admin.keuangans.dashboard') ? 'active' : '' }}">
                  <p>Data Tim Keuangan</p>
              </a>
              <a href="{{ route('admin.panitias.dashboard') }}" class="nav-link {{ request()->routeIs('admin.panitias.dashboard') ? 'active' : '' }}">
                  <p>Data Panitia Event</p>
              </a>
          </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>