<?= includeView('partials.header') ?>
<!-- partial:partials/_navbar.html -->
<?= includeView('partials.navbar') ?>

<div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Kayıt Ol

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
                <form class="col-md-8 mx-auto" action="<?= route('register')?>" method="POST">
                    <?= csrfToken() ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1" class="form-label">Ad Soyad : </label>
                            <input type="text" name="name" required class="form-control" id="exampleInputName" aria-describedby="nameHelp">
                            <div id="emailHelp" class="form-text">Size nasıl hitap etmemizi arzularsınız?</div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1" class="form-label">E-posta Adresi : </label>
                            <input type="email" name="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">E-postanız bizimle güvende.</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Parola : </label>
                            <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword2" class="form-label">Parola Tekrarı : </label>
                            <input type="password" name="passwordConfirm" required class="form-control" id="exampleInputPassword2">
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center mx-auto">
                        <button type="submit" class="btn btn-primary">Kayıt Ol</button>
                    </div>
                </form>
            </div>
        </div>

    </div>



</div>
</div>


<!-- main-panel ends -->
<!-- container-scroller ends -->
<?= includeView('partials.footer') ?>