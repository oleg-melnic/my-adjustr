<section  id="myadjurst-menu">
    <div class="container">
        <nav class="navbar  navbar-expand-md navbar-light justify-content-between">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" height="45" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav text-xs-center text-sm-center">
                    <li class="nav-item">
                        <a class="nav-link{{ ($activePage == 'main') ? ' active' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ ($activePage == 'how-it-works') ? ' active' : '' }}" href="{{ route('how-it-works') }}">How it works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ ($activePage == 'register') ? ' active' : '' }}" href="{{ route('register') }}">Join as a Pro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ ($activePage == 'login') ? ' active' : '' }}" href="{{ route('login') }}">Log in</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</section>
