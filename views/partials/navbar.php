<header id="header">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="navbar-top">
        <div class="d-flex justify-content-between align-items-center">
          <ul class="navbar-top-left-menu">
            <li class="nav-item">
              <a href="pages/index-inner.html" class="nav-link">Advertise</a>
            </li>
            <li class="nav-item">
              <a href="pages/aboutus.html" class="nav-link">About</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Events</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Write for Us</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">In the Press</a>
            </li>
          </ul>
          <ul class="navbar-top-right-menu">
            <li class="nav-item">
              <a href="#" class="nav-link"><i class="mdi mdi-magnify"></i></a>
            </li>
            <?php if (isGuest()) : ?>
              <li class="nav-item">
                <a href="<?= route('login') ?>" class="nav-link">Giriş</a>
              </li>
              <li class="nav-item">
                <a href="<?= route('register') ?>" class="nav-link">Kaydol</a>
              </li>
            <?php else : ?>
              <li class="nav-item">
                <a href="/manage" class="nav-link">Yönetim Paneli</a>
              </li>
            <?php endif ?>
          </ul>
        </div>
      </div>
      <div class="navbar-bottom">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <a class="navbar-brand" href="#"><img src="<?= publicPath('images/logo.svg') ?>" alt="" /></a>
          </div>
          <div>
            <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
              <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                <li>
                  <button class="navbar-close">
                    <i class="mdi mdi-close"></i>
                  </button>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="<?= route('welcome') ?>">Anasayfa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/magazine.html">MAGAZINE</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/business.html">Business</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/sports.html">Sports</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/art.html">Art</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/politics.html">POLITICS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/travel.html">Travel</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/contactus.html">Contact</a>
                </li>
              </ul>
            </div>
          </div>
          <ul class="social-media">
            <li>
              <a href="#">
                <i class="mdi mdi-facebook"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="mdi mdi-youtube"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="mdi mdi-twitter"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>