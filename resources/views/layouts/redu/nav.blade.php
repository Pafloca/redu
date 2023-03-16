<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="/groups" class="navbar-brand"><img src="{{ asset("/img/logo.png") }}" width="50px" height="65px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/groups">Groups</a>
                </li>

            </ul>
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="/profile/{{ \Illuminate\Support\Facades\Auth::id() }}"><img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" width="60px" height="60px"></a>
            @endif
        </div>
    </div>
</nav>
