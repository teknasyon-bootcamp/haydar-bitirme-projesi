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
                    <h1 class="m-0">Haber Ekle</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Haber İşlemleri</li>
                        <li class="breadcrumb-item">Haber Ekle</li>
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

            <div class="card">
                <div class="card col-12">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= route('manage.news.store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrfToken() ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="newsInput">Haber Başlığı</label>
                                <input type="text" name="title" required class="form-control" id="newsInput" placeholder="Haber başlığı">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Kapak Fotoğrafı</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="cover_image" required class="custom-file-input" id="coverImageInput">
                                        <label class="custom-file-label" for="coverImageInput">Kapak Görseli Seç</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contentInput">Haber İçeriği</label>
                                <textarea name="content" class="form-control" required id="contentInput" id="" cols="30" placeholder="Haber İçeriği" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Kategori">Kategori : </label>
                                <select name="category_id" <?= user()->role_level < 3 ? 'disabled' : '' ?> class="form-control" id="Kategori">
                                    <?php if (isset($categories)) : ?>
                                        <?php foreach ($categories as $category) : ?>
                                            <option <?= user()->role_level < 3 ? 'selected' : '' ?> value="<?= $category->id ?>"><?= $category->name ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= includeView('manage.partials.footer') ?>