<?= includeView('manage.partials.header') ?>
<?= includeView('manage.partials.navbar') ?>
<?= includeView('manage.partials.sidebar') ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kategori İşlemleri</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Kategori İşlemleri</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <p class="small text-muted font-italic">
                Uyarı: Kategori silindiği takdirde kategoriye ait tüm haberler silinir.
            </p>
            <div class="card">
                <?php

                if ($errors->any()) {
                    echo "<div class='alert alert-danger'>";
                    echo "<ul>";
                    foreach ($errors->getErrors() as $error) {
                        echo "<li> $error </li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                }

                if ($success) {
                    echo "<div class='alert alert-success'>";
                    echo "<ul>";
                    echo "<li> $success </li>";
                    echo "</ul>";
                    echo "</div>";
                }

                ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kategori Adı</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($categories)) : ?>
                            <?php foreach ($categories as $category) : ?>
                                <tr>
                                    <td><?= $category->name ?></td>
                                    <td>
                                        <a href="<?= route('manage.category.edit', ['id' => $category->id]) ?>" id="delete-form-<?= $category->id ?>" class="btn btn-primary">Düzenle</a>
                                        <a onclick="document.getElementById('delete-form-<?= $category->id ?>').submit();" class="btn btn-danger">Sil
                                        </a>

                                        <form action="<?= route('manage.category.destroy', ['id' => $category->id]) ?>" id="delete-form-<?= $category->id ?>" style="display:none;" method="post">
                                            <?= csrfToken() ?>
                                            <?= method('delete') ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= includeView('manage.partials.footer') ?>