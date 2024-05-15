<div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="{{ route('eksternal.dashboard') }}">
      <span class="align-middle">Dashboard</span>
    </a>

    <ul class="sidebar-nav">

        <li class="sidebar-header">Dashboard</li>
        <li class="sidebar-item {{ setSidebarActive(['eksternal.dashboard']) }}">
            <a class="sidebar-link" href="{{ route('eksternal.dashboard') }}">
              <i class="align-middle" data-feather="monitor"></i>
              <span class="align-middle">Dashboard</span>
            </a>
          </li>

        <li class="sidebar-header">Daftar Usulan Saya</li>
            <li class="sidebar-item {{ setSidebarActive(['eksternal.usulan-pelatihan.*','eksternal.usulan-pelatihan.index']) }}">
                <a class="sidebar-link" href="{{ route('eksternal.usulan-pelatihan.index') }}">
                <i class="align-middle" data-feather="layout"></i>
                <span class="align-middle">Usulan Pelatihan</span>
                </a>
            </li>

            <li class="sidebar-item {{ setSidebarActive(['eksternal.usulan-ujikom.*','eksternal.usulan-ujikom.index']) }}">
                <a class="sidebar-link" href="{{ route('eksternal.usulan-ujikom.index') }}">
                <i class="align-middle" data-feather="layout"></i>
                <span class="align-middle">Usulan Ujikom</span>
                </a>
            </li>

    @if (auth()->guard('ekt')->user()->account_type === 'multirole' )
        <div class="sidebar-cta">
                <div class="sidebar-cta-content d-grid">
                    <a href="{{ route('eksternal.admin.dashboard') }}" class="btn btn-primary">Switch to Admin</a>
                </div>
        </div>
    @endif

    </ul>



</div>
