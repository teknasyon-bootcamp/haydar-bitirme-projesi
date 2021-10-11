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
                    <h1 class="m-0">Kullanıcı Rolleri</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item">Kullanıcı Rolleri</li>
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
                            <th>Kullanıcı Adı</th>
                            <th>E-posta</th>
                            <th>Yetki</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($users)) : ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->email ?></td>
                                    <td>
                                        <form action="<?= route('manage.user.role.update', ['id' => $user->id]) ?>" method="post">

                                            <?= csrfToken() ?>
                                            <?= method('put') ?>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <select name="role_level" class="form-control" id="role">
                                                        <option <?= $user->role_level == 1 ? 'selected' : '' ?> value="1">Kullanıcı</option>
                                                        <option <?= $user->role_level == 2 ? 'selected' : '' ?> value="2">Editör</option>
                                                        <option <?= $user->role_level == 3 ? 'selected' : '' ?> value="3">Moderatör</option>
                                                        <option <?= $user->role_level == 4 ? 'selected' : '' ?> value="4">Yönetici</option>
                                                    </select>
                                                </div>


                                                <button class="btn btn-primary" type="submit">Değiştir</button>

                                            </div>
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