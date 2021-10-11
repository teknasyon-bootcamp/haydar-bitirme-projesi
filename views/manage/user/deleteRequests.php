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
                    <h1 class="m-0">Hesap Silme İstekleri</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Hesap Silme İstekleri</li>
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
                Uyarı: Kullanıcı silindiği takdirde kullanıcıya ait tüm yorum haber ve aktiveteleri de silmiş olursunuz.
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
                            <th>Kullanıcı Adı</th>
                            <th>E-posta</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($deleteRequests)) : ?>
                            <?php foreach ($deleteRequests as $deleteRequest) : ?>
                                <tr>
                                    <td><?= $deleteRequest->name ?></td>
                                    <td><?= $deleteRequest->email ?></td>
                                    <td>
                                        <a onclick="document.getElementById('delete-form-<?= $deleteRequest->id ?>').submit();" class="btn btn-danger">Onayla
                                        </a>
                                        <form action="<?= route('manage.user.destroy', ['id' => $deleteRequest->id]) ?>" id="delete-form-<?= $deleteRequest->id ?>" style="display:none;" method="post">
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