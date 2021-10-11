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
                    <h1 class="m-0">Okunan Haberler</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Okunan Haberler</li>
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Haberler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($userSeenNews)) : ?>
                            <?php foreach ($userSeenNews as $item) : ?>
                                <tr>
                                    <td> <a href="<?= route('news', ['id' => $item->news()->id]) ?>"><?= $item->news()->title ?></a></td>
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