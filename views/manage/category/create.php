<?= view('manage.partials.header') ?>
<?= view('manage.partials.navbar') ?>
<?= view('manage.partials.sidebar') ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kategori Ekle</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Kategori İşlemleri</li>
                        <li class="breadcrumb-item">Kategori Ekle</li>
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
                <form action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="kategoriAdi">Kategori Adı : </label>
                                <input type="text" name="name" class="form-control" id="kategoriAdi" placeholder="Kategori Adı">
                            </div>

                            <div class="form-group col-md-1 mt-2">
                            <label for="summit"> </label>
                                <button type="submit" class="btn btn-primary" id="summit">Kaydet</button>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->


                </form>

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= view('manage.partials.footer') ?>