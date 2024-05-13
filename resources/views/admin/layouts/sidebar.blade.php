<div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
      <span class="align-middle">Admin Dashboard</span>
    </a>

    <ul class="sidebar-nav">

        <li class="sidebar-header">Dashboard</li>
        <li class="sidebar-item {{ setSidebarActive(['admin.dashboard']) }}">
            <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
              <i class="align-middle" data-feather="monitor"></i>
              <span class="align-middle">Dashboard</span>
            </a>
          </li>

    @if (canAccess(['jenis pelatihan view','pelatihan view','jenis ujikom view','ujikom view']))
        <li class="sidebar-header">Master</li>
    @endif

    @if (canAccess(['jenis pelatihan view','jenis pelatihan create','jenis pelatihan update','jenis pelatihan delete']))
        <li class="sidebar-item {{ setSidebarActive(['admin.jenis-pelatihan.*','admin.jenis-pelatihan.index']) }}">
            <a class="sidebar-link" href="{{ route('admin.jenis-pelatihan.index') }}">
                <i class="align-middle" data-feather="briefcase"></i>
                <span class="align-middle">Jenis Pelatihan</span>
            </a>
        </li>
    @endif

    @if (canAccess(['pelatihan view','pelatihan create','pelatihan update','pelatihan delete']))
        <li class="sidebar-item {{ setSidebarActive(['admin.pelatihan.*','admin.pelatihan.index']) }}">
            <a class="sidebar-link" href="{{ route('admin.pelatihan.index') }}">
                <i class="align-middle" data-feather="user"></i>
                <span class="align-middle">Pelatihan</span>
            </a>
        </li>
    @endif

    @if (canAccess(['jenis ujikom view','jenis ujikom create','jenis ujikom update','jenis ujikom delete']))
        <li class="sidebar-item {{ setSidebarActive(['admin.jenis-ujikom.*','admin.jenis-ujikom.index']) }}">
            <a class="sidebar-link" href="{{ route('admin.jenis-ujikom.index') }}">
                <i class="align-middle" data-feather="cpu"></i>
                <span class="align-middle">Jenis Uji Kompetensi</span>
            </a>
        </li>
    @endif

    @if (canAccess(['ujikom view','ujikom create','ujikom update','ujikom delete']))
        <li class="sidebar-item {{ setSidebarActive(['admin.ujikom.*','admin.ujikom.index']) }}">
            <a class="sidebar-link" href="{{ route('admin.ujikom.index') }}">
                <i class="align-middle" data-feather="user"></i>
                <span class="align-middle">Uji Kompetensi</span>
            </a>
        </li>
    @endif

    @if (canAccess(['usulan pelatihan view','usulan ujikom view']))
        <li class="sidebar-header">Usulan</li>
    @endif

    @if (canAccess(['usulan pelatihan view','usulan pelatihan create','usulan pelatihan update','usulan pelatihan delete']))
        <li class="sidebar-item {{ setSidebarActive(['admin.usulan-pelatihan.*','admin.usulan-pelatihan.index']) }}">
            <a class="sidebar-link" href="{{ route('admin.usulan-pelatihan.index') }}">
            <i class="align-middle" data-feather="layout"></i>
            <span class="align-middle">Usulan Pelatihan</span>
            </a>
        </li>
    @endif

    @if (canAccess(['usulan ujikom view','usulan ujikom create','usulan ujikom update','usulan ujikom delete']))
        <li class="sidebar-item {{ setSidebarActive(['admin.usulan-ujikom.*','admin.usulan-ujikom.index']) }}">
            <a class="sidebar-link" href="{{ route('admin.usulan-ujikom.index') }}">
            <i class="align-middle" data-feather="layout"></i>
            <span class="align-middle">Usulan Ujikom</span>
            </a>
        </li>
    @endif

    @if (canAccess(['manajemen akses']))
        <li class="sidebar-header">Manajemen Akses</li>

        <li class="sidebar-item {{ setSidebarActive(['admin.role.*','admin.role.index']) }}">
            <a class="sidebar-link" href="{{ route('admin.role.index') }}">
            <i class="align-middle" data-feather="sliders"></i>
            <span class="align-middle">Roles</span>
          </a>
        </li>

        <li class="sidebar-item {{ setSidebarActive(['admin.role-user.*','admin.role-user.index']) }}">
            <a class="sidebar-link" href="{{ route('admin.role-user.index') }}">
            <i class="align-middle" data-feather="user"></i>
            <span class="align-middle">Role User</span>
          </a>
        </li>

        <li class="sidebar-item {{ setSidebarActive(['admin.pengaturan.*','admin.pengaturan.index']) }}">
            <a class="sidebar-link" href="{{ route('admin.pengaturan.index') }}">
            <i class="align-middle" data-feather="user"></i>
            <span class="align-middle">Pengaturan</span>
          </a>
        </li>
    @endif

    </ul>

</div>
