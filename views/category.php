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
                                <?= $category->name ?>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <?php foreach ($news as $newsItem) : ?>
                                    <div class="col-sm-4 grid-margin">
                                        <div class="rotate-img">
                                            <img src="<?= publicPath('uploads/' . $newsItem->image) ?>" alt="banner" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-sm-8 grid-margin">
                                        <h2 class="font-weight-600 mb-2">
                                        <a href="<?= route('news', ['id' => $newsItem->id]) ?>"><?= $newsItem->title ?></a> 
                                        </h2>
                                        <p class="fs-15">
                                            <?= $newsItem->getSummary() ?>
                                        </p>
                                    </div>
                                <?php endforeach ?>
                            </div>
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