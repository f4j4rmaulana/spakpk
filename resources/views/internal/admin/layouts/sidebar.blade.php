<div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="{{ route('internal.admin.dashboard') }}">
      <span class="align-middle">Dashboard</span>
    </a>

    <ul class="sidebar-nav">

        <li class="sidebar-header">Dashboard</li>
        <li class="sidebar-item {{ setSidebarActive(['internal.admin.dashboard']) }}">
            <a class="sidebar-link" href="{{ route('internal.admin.dashboard') }}">
              <i class="align-middle" data-feather="monitor"></i>
              <span class="align-middle">Dashboard</span>
            </a>
        </li>

        <li class="sidebar-header">Daftar Usulan</li>
            <li class="sidebar-item {{ setSidebarActive(['internal.admin.usulan-pelatihan.*','internal.admin.usulan-pelatihan.index']) }}">
                <a class="sidebar-link" href="{{ route('internal.admin.usulan-pelatihan.index') }}">
                <i class="align-middle" data-feather="layout"></i>
                    <span class="align-middle">Usulan Pelatihan</span>
                </a>
        </li>

        <li class="sidebar-item {{ setSidebarActive(['internal.admin.usulan-ujikom.*','internal.admin.usulan-ujikom.index']) }}">
            <a class="sidebar-link" href="{{ route('internal.admin.usulan-ujikom.index') }}">
                <i class="align-middle" data-feather="layout"></i>
                    <span class="align-middle">Usulan Ujikom</span>
            </a>
        </li>

    </ul>



</div>
