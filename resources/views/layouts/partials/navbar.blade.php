<header class="p-3 bg-dark text-white">
  <div class="container">
     @auth
    <nav  class="navbar navbar-expand-lg navbar-light bg-dark p-0 text-white">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" width="100%" id="navbarNav">
            <ul class="navbar-nav" style="height: 4rem;">
                <li class="nav-item text-white">
                    <a class="nav-link p-3 text-white" href="{{ url('/') }}">Dashboard</a>
                </li>
                @if(auth()->user()->roles[0]->name != "customer")
                <li class="nav-item text-white">
                    <a class="nav-link p-3 text-white" href="{{ url('/users') }}">Users</a>
                </li>
                @endif
                <li class="nav-item text-white">
                    <a class="nav-link p-3 text-white" href="{{ url('/tasks') }}">Tasks</a>
                </li>
                
            </ul>
        </div>

        Log in as {{auth()->user()->name}} &nbsp;&nbsp;&nbsp;<br/>Role : {{ ucwords(auth()->user()->roles[0]->name) }}
        <a class="nav-item mr-3 nav-link p-3 btn btn-outline-light me-2" href="{{ route('logout.perform') }}" >Logout</a>

    </nav>
    @endauth
  </div>
</header>