<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            @include('layouts.partials.lang-switcher')

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle img-fluid" src="{{ asset('img/no-user-image.jpg') }}" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle img-fluid" src="{{ asset('img/no-user-image.jpg') }}" alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                            <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a class="text-body ms-0" style="display: block;" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>{{ __('messages.logout_lbl') }}</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

@push('scripts')
    <script>
        let langLinks = document.querySelectorAll('.lang-link');

        langLinks.forEach(function (element) {
            element.addEventListener('click', function (event) {
                const selectedLang = document.getElementById('lang-flag')
                selectedLang.classList.remove(selectedLang.classList[1])
                selectedLang.classList.add('flag-icon-' + this.getAttribute('id'))
            })
        })
    </script>
@endpush
