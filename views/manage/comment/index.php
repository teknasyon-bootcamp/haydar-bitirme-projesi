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
                    <h1 class="m-0">Yorum İşlemleri</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Yorum İşlemleri</li>
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
                            <th>Yorum</th>
                            <th>Yazar</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($comments)) : ?>
                            <?php foreach ($comments as $comment) : ?>
                                <tr>
                                    <td><?= $comment->message ?></td>
                                    <td><?= $comment->userName() ?></td>
                                    <td>
                                        <a href="<?= route('manage.comment.edit', ['id' => $comment->id]) ?>" class="btn btn-primary">Düzenle</a>
                                        <a onclick="document.getElementById('delete-form-<?= $comment->id ?>').submit();" class="btn btn-danger">Sil
                                        </a>

                                        <form action="<?= route('manage.comment.destroy', ['id' => $comment->id]) ?>" id="delete-form-<?= $comment->id ?>" style="display:none;" method="post">
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