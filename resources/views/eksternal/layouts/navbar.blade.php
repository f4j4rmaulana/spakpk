<div class="navbar-collapse collapse">
    <ul class="navbar-nav navbar-align">

    <li class="nav-item dropdown">
        <a
        class="nav-icon dropdown-toggle d-inline-block d-sm-none"
        href="#"
        data-bs-toggle="dropdown"
        >
        <i class="align-middle" data-feather="settings"></i>
        </a>

        <a
        class="nav-link dropdown-toggle d-none d-sm-inline-block"
        href="#"
        data-bs-toggle="dropdown"
        >
        <img
            src="{{ asset(auth()->guard('ekt')->user()->image) }}"
            class="avatar img-fluid rounded me-1"
            alt="{{ auth()->guard('ekt')->user()->name }}"
        />
        <span class="text-dark">{{ auth()->guard('ekt')->user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="#"
            ><i class="align-middle me-1" data-feather="user"></i>Profile</a>
            <div class="dropdown-divider"></div>
             <!-- Authentication -->
            <form method="POST" action="{{ auth()->guard('ekt')->check() ? route('eksternal.logout') : route('logout') }}">
            @csrf
                <a class="dropdown-item" href="{{ route('eksternal.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log out</a>
            </form>
        </div>

    </li>
    </ul>
</div>
