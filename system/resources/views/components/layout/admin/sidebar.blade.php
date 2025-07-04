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
            <a class="sidebar-link" href='{{ url('admin') }}' aria-expanded="false">
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
            <a class="sidebar-link {{ request()->is('admin/tahun-ajaran*') ? 'active' : '' }}" href='{{ url('admin/tahun-ajaran') }}' aria-expanded="false">
              <span>
                <i class="ti ti-calendar-event"></i>
              </span>
              <span class="hide-menu">Tahun Ajaran</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->is('admin/guru*') ? 'active' : '' }}" href='{{ url('admin/guru') }}' aria-expanded="false">
              <span>
                <i class="ti ti-user-check"></i>
              </span>
              <span class="hide-menu">Data Guru</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->is('admin/siswa*') ? 'active' : '' }}" href='{{ url('admin/siswa') }}' aria-expanded="false">
              <span>
                <i class="ti ti-user"></i>
              </span>
              <span class="hide-menu">Data Siswa</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->is('admin/kelas*') ? 'active' : '' }}" href='{{ url('admin/kelas') }}' aria-expanded="false">
              <span>
                <i class="ti ti-chalkboard"></i>
              </span>
              <span class="hide-menu">Kelas</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->is('admin/mapel*') ? 'active' : '' }}" href='{{ url('admin/mapel') }}' aria-expanded="false">
              <span>
                <i class="ti ti-book"></i>
              </span>
              <span class="hide-menu">Mapel</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>