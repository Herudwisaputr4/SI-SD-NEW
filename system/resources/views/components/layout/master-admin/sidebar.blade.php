<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="/index.html" class="d-flex align-items-center text-decoration-none">
          <img src="{{ url('public') }}/assets/images/logos/logosisd.png" width="100" alt="Logo SI-SD" />
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">HOME</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href='{{ url('master-admin') }}' aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">MENU</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href='{{ url('master-admin/data-sekolah') }}' aria-expanded="false">
              <span>
                <i class="ti ti-home"></i>
              </span>
              <span class="hide-menu">Data Sekolah</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href='{{ url('master-admin/data-admin') }}' aria-expanded="false">
              <span>
                <i class="ti ti-user"></i>
              </span>
              <span class="hide-menu">Data Admin</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>