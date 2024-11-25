<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('assets/img/logo-white.png') }}" alt="Logo" height="36">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        @include('admin.partials.sidebar')
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <!-- Logout link triggers modal -->
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fa fa-fw fa-sign-out"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Select "Logout" below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
