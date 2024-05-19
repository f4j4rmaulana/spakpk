<div class="navbar-collapse collapse" id="navbarContainer">
    <ul class="navbar-nav navbar-align">

        <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                <div class="position-relative ">
                    <i class="align-middle" data-feather="bell"></i>
                        <div class="notifIcon">
                            @if(auth()->guard('ekt')->user()->unreadNotifications->count())
                                <span class="indicator">{{ auth()->guard('ekt')->user()->unreadNotifications->count() }}</span>
                            @endif
                        </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                <div class="dropdown-menu-footer d-flex justify-content-between">
                    <div class="text-dark notifHeader">Notifikasi ({{ auth()->guard('ekt')->user()->unreadNotifications->count() }})</div>
                    <a href="javascript:void(0)" data-url="{{ route('eksternal.admin.usulan-pelatihan.ajaxReadAllNotify') }}" class="text-muted btnReadAll">Tandai semua dibaca</a>
                </div>
                <div class="list-group notifMessage">
                    @foreach(auth()->user()->unreadNotifications as $notification)
                        <a href="javascript:void(0)" data-url="{{ route('eksternal.admin.usulan-pelatihan.ajaxReadNotify', Crypt::encryptString($notification->id)); }}"  class="list-group-item btnRead">
                            <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <span class="material-symbols-outlined" style="color:#FB8C00;">notifications_active</span>
                                    </div>
                                <div class="col-10">
                                    {{-- <div class="text-dark">Lorem ipsum</div> --}}

                                    <div class="text-muted small mt-1">{{ $notification->data['message'] }}</div>
                                    <div class="text-muted small mt-1">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    @if(auth()->user()->unreadNotifications->isEmpty())
                        <div class="row g-0 align-items-center list-group-item">
                            <div class="col-12">
                                {{-- <div class="text-dark">Lorem ipsum</div> --}}
                                <div class="text-muted text-center small mt-1">Tidak ada notifikasi</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="dropdown-menu-footer">
                    <a href="{{ route('eksternal.admin.notifikasi.index') }}" class="text-muted">Tampilkan semua notifikasi</a>
                </div>
            </div>
        </li>

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
        <sup><span class="badge bg-dark text-superscript">Admin</span></sup>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="{{ route('eksternal.profile.index') }}" >
        <i class="align-middle me-1" data-feather="user"></i>Profile</a>
        @if (auth()->guard('ekt')->user()->account_type === 'multirole' )
            <a class="dropdown-item" href="{{ route('eksternal.dashboard') }}"><i class="align-middle me-1" data-feather="repeat"></i> Back to User Role</a>
        @endif
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

@push('custom-script')
    <script>
        $(document).on('click', '.btnRead', function (e) {
            e.preventDefault();
            var url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    // location.reload();
                    $('.notifIcon').load(location.href + ' .notifIcon');
                    $('.notifMessage').load(location.href + ' .notifMessage');
                    $('.notifHeader').load(location.href + ' .notifHeader');
                },
                error: function (xhr) {
                    alert('Gagal melakukan update notifikasi!');
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.btnReadAll', function (e) {
            e.preventDefault();
            var url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    // location.reload();
                    $('.notifIcon').load(location.href + ' .notifIcon');
                    $('.notifMessage').load(location.href + ' .notifMessage');
                    $('.notifHeader').load(location.href + ' .notifHeader');
                },
                error: function (xhr) {
                    alert('Gagal melakukan update notifikasi!');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            setInterval(function(){
                $('.notifIcon').load(location.href + ' .notifIcon');
                $('.notifMessage').load(location.href + ' .notifMessage');
                $('.notifHeader').load(location.href + ' .notifHeader');
            }, 60000);
            });
    </script>
@endpush
