<?= includeView('partials.header') ?>
<!-- partial:partials/_navbar.html -->
<?= includeView('partials.navbar') ?>

<!-- partial -->
<div class="content-wrapper">
  <div class="container">
    <div class="row" data-aos="fade-up">
      
      <?php if (isset($news[0])) : ?>
        <div class="col-xl-8 stretch-card grid-margin">
          <div class="position-relative">
            <img src="<?= publicPath('uploads/' . $news[0]->image) ?>" alt="banner" class="img-fluid" />
            <div class="banner-content">
              <div class="badge badge-danger fs-12 font-weight-bold mb-3">
                <?= $news[0]->category()->name ?>
              </div>
              <h1 class="mb-0"> <?= $news[0]->title ?></h1>
              <p class="mb-2"> açıklama
                <?= $news[0]->getSummary() ?>
              </p>
            </div>
          </div>
        </div>
      <?php endif ?>

      <?php if (isset($news)) : ?>
        <div class="col-xl-4 stretch-card grid-margin">
          <div class="card bg-dark text-white">
            <div class="card-body">
              <h2>Son Haberler</h2>

              <?php if (isset($news[1])) : ?>
                <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                  <div class="pr-3">
                    <h5><?= $news[1]->title ?></h5>
                  </div>
                  <div class="rotate-img">
                    <img src="<?= publicPath("uploads/" . $news[1]->image . "") ?>" alt="thumb" class="img-fluid img-lg" />
                  </div>
                </div>
              <?php endif  ?>

              <?php if (isset($news[2])) : ?>
                <div class="d-flex border-bottom-blue pb-4 pt-4 align-items-center justify-content-between">
                  <div class="pr-3">
                    <h5><?= $news[2]->title ?></h5>
                  </div>
                  <div class="rotate-img">
                    <img src="<?= publicPath("uploads/" . $news[2]->image . "") ?>" alt="thumb" class="img-fluid img-lg" />
                  </div>
                </div>
              <?php endif  ?>

              <?php if (isset($news[3])) : ?>
                <div class="d-flex pt-4 align-items-center justify-content-between">
                  <div class="pr-3">
                    <h5><?= $news[2]->title ?></h5>
                  </div>
                  <div class="rotate-img">
                    <img src="<?= publicPath("uploads/" . $news[3]->image . "") ?>" alt="thumb" class="img-fluid img-lg" />
                  </div>
                </div>
              <?php endif  ?>

            </div>
          </div>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>
<!-- main-panel ends -->
<!-- container-scroller ends -->
<?= includeView('partials.footer') ?>