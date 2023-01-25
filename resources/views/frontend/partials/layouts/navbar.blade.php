<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="{{ route('home.frontend') }}" class="logo d-flex align-items-center">
      <h1 class="d-flex align-items-center">News Example</h1>
    </a>

    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a href="{{ route('home.frontend') }}" class="@if (Request::segment(1) == '') active @endif">Home</a></li>
        <!-- <li><a href="about.html">About</a></li> -->
        <li><a href="{{ route('reads.index') }}" class="@if (Request::segment(1) == 'reads') active @endif">News</a></li>
        @if(isset(Auth::user()->role))
        <li class="dropdown"><a href="#" class=""><span>{{ auth()->user()->name }}</span> <i class="bi dropdown-indicator bi-chevron-up"></i></a>
          <ul class="dropdown-active">
            <li><a class="dropdown-item" href="{{ route('news.create') }}">Create a News</a></li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="ti-power-off text-primary"></i>
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
        @endif
        @guest
        <li><a href="{{ route('login') }}" class="btn-get-started">Login</a></li>
        @endguest
        <!-- <li><a href="contact.html">Contact</a></li> -->
      </ul>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->