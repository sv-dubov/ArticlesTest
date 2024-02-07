<nav class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <img class="img-fluid" src="{{ asset('img/favicon.png') }}" alt="logo">
                <div style="font-size: 12px;" class="fw-bold">Articles</div>
            </a>
        </div>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">{{ __('messages.main_page') }}</li>
            <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">{{ __('messages.dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item {{ request()->segment(2) === 'categories' ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="tag"></i>
                    <p class="link-title">{{ __('messages.categories') }}</p>
                </a>
            </li>
        </ul>
    </div>
</nav>
