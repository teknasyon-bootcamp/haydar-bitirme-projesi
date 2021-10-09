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
                    <h1 class="m-0">Kategori Güncelle</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Kategori İşlemleri</li>
                        <li class="breadcrumb-item">Kategori Güncelle</li>
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

                    <form action="<?= route('manage.category.update', ['id' => $category->id]) ?>" method="post">
                        <?= csrfToken() ?>
                        <?= method('put') ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="kategoriAdi">Kategori Adı : </label>
                                    <input type="text" name="name" class="form-control" id="kategoriAdi" value="<?= $category->name ?>" placeholder="Kategori Adı">
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
            <div class="card">
                <div class="row">
                    <div class="card-body col-12">
                        <form action="<?= route('manage.category.editor.add', ['id' => $category->id]) ?>" method="post">
                            <?= csrfToken() ?>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="kullaniciAdı">Yeni Editör Adı : </label>
                                    <select name="user_id" class="form-control" id="kullaniciAdı">
                                        <?php if (isset($editors)) : ?>
                                            <?php foreach ($editors as $editor) : ?>
                                                <option value="<?= $editor->id ?>"><?= $editor->name ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-1 mt-4">
                                    <label for="summit"> </label>
                                    <button type="submit" class="btn btn-primary" id="summit">Ekle</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>


        <div class="row">
                <div class="card col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kullanıcı Adı</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($categoryEditors) : ?>
                                <?php foreach ($categoryEditors as $editor) : ?>
                                    <tr>
                                        <td><?= $editor->name ?></td>
                                        <td>
                                            <a onclick="document.getElementById('delete-form-<?= $editor->id ?>').submit();" class="btn btn-danger">Sil
                                            </a>

                                            <form action="<?= route('manage.category.editor.destory', ['user_id' => $editor->id]) ?>" id="delete-form-<?= $editor->id ?>" style="display:none;" method="post">
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
            </div>


        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= includeView('manage.partials.footer') ?>