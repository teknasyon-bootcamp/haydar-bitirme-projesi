    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img src="<?= publicPath('manage/dist/img/AdminLTELogo.png" alt="AdminLTE Logo') ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><?= user()->getRole() ?></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= publicPath('manage/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= user()->name ?></a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Arayan derviş..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?= route('manage.main') ?>" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Kontrol Paneli
                            </p>
                        </a>
                    </li>

                    <?php if (user()->role_level >= 3) : ?>
                        <li class="nav-item">
                            <a href="<?= route('manage.category.index') ?>" class="nav-link ">
                                <i class="nav-icon fas  fa-spell-check"></i>
                                <p>
                                    Kategoriler
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= route('manage.category.index') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kategori İşlemleri</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route('manage.category.create') ?>" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Yeni Kategori</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>

                    <?php if (user()->role_level >= 2) : ?>
                        <li class="nav-item">
                            <a href="" class="nav-link ">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    Haberler
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= route('manage.news.index') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Haber İşlemleri</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route('manage.news.create') ?>" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Yeni Haber</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>

                    <li class="nav-item">
                        <a href="<?= route('manage.comment.index') ?>" class="nav-link">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>
                                Yorumlar
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= route('manage.user.news.seen') ?>" class="nav-link">
                            <i class="nav-icon fas fa-book-reader"></i>
                            <p>
                                Okunan Haberler
                            </p>
                        </a>
                    </li>


                    <?php if (user()->role_level >= 3) : ?>
                        <li class="nav-item">
                            <a href="<?= route('manage.user.request.index') ?>" class="nav-link">
                                <i class="nav-icon fas fa-user-times"></i>
                                <p>
                                    Hesap Silme İstekleri
                                </p>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php if (user()->role_level >= 3) : ?>
                        <li class="nav-item">
                            <a href="<?= route('manage.user.index') ?>" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Kullanıcı Rolleri
                                </p>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php if (user()->role_level >= 3) : ?>
                        <li class="nav-item">
                            <a href="<?= route('manage.user.logs') ?>" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Kullanıcı Aktiviteleri
                                </p>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>