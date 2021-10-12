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

                <div class="d-flex justify-content-center row">
                    <div class="d-flex flex-column col-md-8">
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
                        <div class="coment-bottom bg-white p-2 px-4">
                            <form action="<?= route('manage.news.comment.store', ['id' => $news->id]) ?>" method="post">
                                <?= csrfToken() ?>
                                <div class="d-flex flex-row add-comment-section mt-4 mb-4">

                                    <input type="text" name="comment" class="form-control mr-3" placeholder="Yorumunuzu yazın...">

                                    <?php if (!isGuest()) : ?>
                                        <div class="form-check pb-3">
                                            <input class="form-check-input" type="checkbox" name="anonim" id="anonymous">
                                            <label class="form-check-label text-muted font-italic small mr-3" for="anonymous">
                                                Anonim olarak gönder
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                    <button class="btn btn-primary" type="submit">Yorumla</button>

                                </div>
                            </form>

                            <?php foreach ($comments as $comment) : ?>

                                <div class="commented-section mt-2">
                                    <div class="d-flex flex-row align-items-center commented-user">
                                        <h5 class="mr-2"><?= $comment->userName() ?></h5><span class="dot mb-1"></span>
                                    </div>
                                    <div class="comment-text-sm">
                                        <?= $comment->message ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>
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