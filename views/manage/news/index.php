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
                    <h1 class="m-0">Haber İşlemleri</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Haber İşlemleri</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
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
                            <th>Haber Başlığı</th>
                            <th>Yazar</th>
                            <th>Kayıt Tarihi</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($news)) : ?>
                            <?php foreach ($news as $newsItem) : ?>
                                <tr>
                                    <td><?= $newsItem->title ?></td>
                                    <td><?= $newsItem->user()->name ?></td>
                                    <td><?= $newsItem->getDate() ?></td>
                                    <td>
                                        <?php if($newsItem->isEditableByUser()) : ?>
                                        <a href="<?= route('manage.news.edit', ['id' => $newsItem->id]) ?>" class="btn btn-primary">Düzenle</a>
                                        <a onclick="document.getElementById('news-delete-form-<?= $newsItem->id ?>').submit();" class="btn btn-danger">Sil
                                        </a>

                                        <form action="<?= route('manage.news.destroy', ['id' => $newsItem->id]) ?>" id="news-delete-form-<?= $newsItem->id ?>" style="display:none;" method="post">
                                            <?= csrfToken() ?>
                                            <?= method('delete') ?>
                                        </form>

                                        <?php else : ?>
                                            <p>Düzenleme yapabilmeniz için yayınlanma tarihi üzerinden bir gün geçmesi gerekir.</p>
                                        <?php endif ?>
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