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
                    <h1 class="m-0">Yorum Güncelle</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Yorum İşlemleri</li>
                        <li class="breadcrumb-item">Yorum Güncelle</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
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
            <div class="row">
                <div class="card col-12">

                    <form action="<?= route('manage.comment.update', ['id' => $comment->id]) ?>" method="post">
                        <?= csrfToken() ?>
                        <?= method('put') ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="kategoriAdi">Yorum Adı : </label>
                                    <textarea name="message" class="form-control" id="kategoriAdi" placeholder="Kategori Adı" cols="30" rows="10"><?= $comment->message ?></textarea>
                                </div>

                                <div class="form-group col-md-1 mt-2">
                                    <label for="summit"> </label>
                                    <button type="submit" class="btn btn-primary" id="summit">Güncelle</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= includeView('manage.partials.footer') ?>