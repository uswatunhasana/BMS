<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->route()->getName() == 'home' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (isset(Auth::user()->role) && Auth::user()->role < 2)
                <li class="nav-item {{ (request()->segment(1) == 'users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="ti-user menu-icon"></i>
                        <span class="menu-title">User's Data</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(1) == 'category' ) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('category.index') }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Category</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(1) == 'tags' ) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('tags.index') }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Tags</span>
                    </a>
                </li>
        @endif
        <li class="nav-item {{ (request()->segment(1) == 'news') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('news.index') }}">
                <i class="ti-write menu-icon"></i>
                <span class="menu-title">News</span>
            </a>
        </li>
        @if (isset(Auth::user()->role) && Auth::user()->role == 0)
                <li class="nav-item {{ (request()->segment(1) == 'trashdata') ? 'active' : '' }}">
                     <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="ti-trash menu-icon"></i>
                        <span class="menu-title">Trash Data</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse {{ (request()->segment(1) == 'trashdata') ? 'show' : '' }}" id="auth">
                        <ul class="nav sub-menu">
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(2) == 'user') ? 'active' : '' }}" href="{{ route('trash.user') }}"> User Trash </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(2) == 'category') ? 'active' : '' }}" href="{{ route('trash.category') }}"> Categories Trash </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(2) == 'news') ? 'active' : '' }}" href="{{ route('trash.news') }}"> News Trash </a>
                            </li>
                        </ul>
                    </div>
                </li>
        @endif
    </ul>
</nav>
