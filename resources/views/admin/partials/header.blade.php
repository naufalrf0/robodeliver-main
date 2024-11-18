<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/admin_layout/img/logo.svg') }}" alt="Logo" width="167" height="36">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="fa fa-fw fa-sign-out"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
