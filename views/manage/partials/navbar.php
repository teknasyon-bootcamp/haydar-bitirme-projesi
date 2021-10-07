<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>
    <div class="navbar-nav ml-auto">
        <a onclick="document.getElementById('logout-form').submit();">
            <span uk-icon="sign-out" class="uk-margin-small-right uk-icon"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="sign-out">
                    <polygon points="13.1 13.4 12.5 12.8 15.28 10 8 10 8 9 15.28 9 12.5 6.2 13.1 5.62 17 9.5"></polygon>
                    <polygon points="13 2 3 2 3 17 13 17 13 16 4 16 4 3 13 3"></polygon>
                </svg></span> Çıkış Yap
        </a>
        <form action="<?= route('logout') ?>" id="logout-form" style="display:none;" method="post">
        </form>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    </ul>

</nav>
<!-- /.navbar -->