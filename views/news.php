<?= includeView('partials.header') ?>
<!-- partial:partials/_navbar.html -->
<?= includeView('partials.navbar') ?>

<!-- partial -->
<div class="content-wrapper">
    <div class="container">
        <div class="col-sm-12">
            <div class="card aos-init aos-animate" data-aos="fade-up">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="font-weight-600 mb-4">
                                <?= $news->title ?>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <img src="<?= publicPath('uploads/' . $news->image) ?>" alt="<?= $news->title ?>" class="img-fluid mx-auto">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                        <?= $news->content ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main-panel ends -->
<!-- container-scroller ends -->
<?= includeView('partials.footer') ?>