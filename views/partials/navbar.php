<header id="header">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="navbar-top">
        <div class="d-flex justify-content-between align-items-center">
          <ul class="navbar-top-left-menu">
          </ul>
          <ul class="navbar-top-right-menu">
            <?php if (isGuest()) : ?>
              <li class="nav-item">
                <a href="<?= route('login') ?>" class="nav-link">Giriş</a>
              </li>
              <li class="nav-item">
                <a href="<?= route('register') ?>" class="nav-link">Kaydol</a>
              </li>
            <?php else : ?>
              <li class="nav-item">
                <a href="<?= route('manage.main') ?>" class="nav-link">Yönetim Paneli</a>
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

                <li class="nav-item">
                  <a class="nav-link" href="<?= route('welcome') ?>">Anasayfa</a>
                </li>

                <?php if ($categories != null) : ?>
                  <?php foreach ($categories as $category) : ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?= route('category', ['id' => $category->id]) ?>"><?= $category->name ?></a>
                    </li>
                  <?php endforeach ?>
                <?php endif ?>
              </ul>
            </div>
          </div>
          <ul class="social-media">

          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>