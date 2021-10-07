<?php include_once AppRootDirectory . '/views/partials/header.php' ?>
<!-- partial:partials/_navbar.html -->
<?php include_once AppRootDirectory . '/views/partials/navbar.php' ?>

<div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Giriş Yap

            </div>

            <div class="card-body bg-light">

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

                ?>
                <form class="col-md-4 mx-auto" action="<?php route('login') ?>" method="POST">
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">E-posta Adresi : </label>
                        <input type="email" name="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputPassword1" class="form-label">Parola : </label>
                        <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="row mb-3 justify-content-center mx-auto">
                        <button type="submit" class="btn btn-primary">Giriş</button>
                    </div>
                </form>
            </div>
        </div>

    </div>



</div>
</div>


<!-- main-panel ends -->
<!-- container-scroller ends -->
<?php include_once AppRootDirectory . '/views/partials/footer.php' ?>