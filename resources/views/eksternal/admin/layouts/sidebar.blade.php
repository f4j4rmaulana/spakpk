<div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="{{ route('eksternal.admin.dashboard') }}">
      <span class="align-middle">Dashboard</span>
    </a>

    <ul class="sidebar-nav">

        <li class="sidebar-header">Dashboard</li>
        <li class="sidebar-item {{ setSidebarActive(['eksternal.admin.dashboard']) }}">
            <a class="sidebar-link" href="{{ route('eksternal.admin.dashboard') }}">
              <i class="align-middle" data-feather="monitor"></i>
              <span class="align-middle">Dashboard</span>
            </a>
        </li>

        <li class="sidebar-header">Daftar Usulan</li>
            <li class="sidebar-item {{ setSidebarActive(['eksternal.admin.usulan-pelatihan.*','eksternal.admin.usulan-pelatihan.index']) }}">
                <a class="sidebar-link" href="{{ route('eksternal.admin.usulan-pelatihan.index') }}">
                <i class="align-middle" data-feather="layout"></i>
                <span class="align-middle">Usulan Pelatihan</span>
                </a>
        </li>

        {{-- <li class="sidebar-item {{ setSidebarActive(['eksternal.admin.usulan-ujikom.*','eksternal.admin.usulan-ujikom.index']) }}">
            <a class="sidebar-link" href="{{ route('eksternal.admin.usulan-ujikom.index') }}">
            <i class="align-middle" data-feather="layout"></i>
            <span class="align-middle">Usulan Ujikom</span>
            </a>
        </li> --}}

    @if (auth()->guard('ekt')->user()->account_type === 'multirole' )
        <div class="sidebar-cta">
                <div class="sidebar-cta-content d-grid">
                    <a href="{{ route('eksternal.dashboard') }}" class="btn btn-warning">Back to User</a>
                </div>
        </div>
    @endif

    </ul>



</div>
