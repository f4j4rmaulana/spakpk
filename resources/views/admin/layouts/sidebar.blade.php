<div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
      <span class="align-middle">AdminKit</span>
    </a>

    <ul class="sidebar-nav">
        <li class="sidebar-header">Dashboard</li>

        <li class="sidebar-item {{ setSidebarActive(['admin.dashboard']) }}">
            <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
              <i class="align-middle" data-feather="monitor"></i>
              <span class="align-middle">Dashboard</span>
            </a>
          </li>

      <li class="sidebar-header">Master</li>

      <li class="sidebar-item {{ setSidebarActive(['admin.jenis-pelatihan.*','admin.jenis-pelatihan.index']) }}">
        <a class="sidebar-link" href="{{ route('admin.jenis-pelatihan.index') }}">
          <i class="align-middle" data-feather="briefcase"></i>
          <span class="align-middle">Jenis Pelatihan</span>
        </a>
      </li>

      <li class="sidebar-item {{ setSidebarActive(['admin.pelatihan.*','admin.pelatihan.index']) }}">
        <a class="sidebar-link" href="{{ route('admin.pelatihan.index') }}">
          <i class="align-middle" data-feather="user"></i>
          <span class="align-middle">Pelatihan</span>
        </a>
      </li>


      <li class="sidebar-item {{ setSidebarActive(['admin.jenis-ujikom.*','admin.jenis-ujikom.index']) }}">
        <a class="sidebar-link" href="{{ route('admin.jenis-ujikom.index') }}">
          <i class="align-middle" data-feather="cpu"></i>
          <span class="align-middle">Jenis Uji Kompetensi</span>
        </a>
      </li>

      <li class="sidebar-item {{ setSidebarActive(['admin.ujikom.*','admin.ujikom.index']) }}">
        <a class="sidebar-link" href="{{ route('admin.ujikom.index') }}">
          <i class="align-middle" data-feather="user"></i>
          <span class="align-middle">Uji Kompetensi</span>
        </a>
      </li>

      <li class="sidebar-header">Usulan</li>

      <li class="sidebar-item {{ setSidebarActive(['admin.usulan-pelatihan.*','admin.usulan-pelatihan.index']) }}">
        <a class="sidebar-link" href="{{ route('admin.usulan-pelatihan.index') }}">
          <i class="align-middle" data-feather="layout"></i>
          <span class="align-middle">Usulan Bangkom</span>
        </a>
      </li>

      <li class="sidebar-item {{ setSidebarActive(['admin.usulan-ujikom.*','admin.usulan-ujikom.index']) }}">
        <a class="sidebar-link" href="{{ route('admin.usulan-ujikom.index') }}">
          <i class="align-middle" data-feather="layout"></i>
          <span class="align-middle">Usulan Ujikom</span>
        </a>
      </li>

        <li class="sidebar-header">Pengaturan</li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="index.html">
            <i class="align-middle" data-feather="sliders"></i>
            <span class="align-middle">Roles</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="pages-profile.html">
            <i class="align-middle" data-feather="user"></i>
            <span class="align-middle">Role Permission</span>
          </a>
        </li>

    </ul>

</div>
