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
                src="{{ asset(auth()->user()->image) }}"
                class="avatar img-fluid rounded me-1"
                alt="{{ auth()->user()->name }}"
            />
            <span class="text-dark">{{ auth()->user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log out</a>
                </form>
            </div>

        </li>
    </ul>
</div>
