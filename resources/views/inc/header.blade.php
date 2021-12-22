<nav class="navbar navbar-light bg-light">
    <a href="#">Navbar</a>
    @if (Auth::guest())
    <div class="button-group" >
        <a class="nav-item nav-link" href="{{ route('login') }}">Login</a>
        <a class="nav-item nav-link" href="{{ route('register') }}">Register</a>
    </div>

    @else
        <h5 class="navbar-brand"> {{ Auth::user()->name }}</h5>
        <a class="navbar-brand" href="{{ route('logout') }}">Logout</a>
    @endif
</nav>
