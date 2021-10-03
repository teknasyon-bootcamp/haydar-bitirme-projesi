<?php include_once AppRootDirectory . '/views/partials/header.php' ?>
<!-- partial:partials/_navbar.html -->
<?php include_once AppRootDirectory . '/views/partials/navbar.php' ?>

<div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Kayıt Ol

            </div>

            <div class="card-body bg-light">
                <form class="col-md-8 mx-auto ">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1" class="form-label">Ad Soyad : </label>
                            <input type="text" name="email" required class="form-control" id="exampleInputName" aria-describedby="nameHelp">
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
                            <input type="password" required class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword2" class="form-label">Parola Tekrarı : </label>
                            <input type="passwordConfirm"  required class="form-control" id="exampleInputPassword2">
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
<?php include_once AppRootDirectory . '/views/partials/footer.php' ?>