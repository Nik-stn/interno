<?php get_header() ?>
<section class="page error">
    <div class="container">
        <h2 class="error__title">404</h2>
        <p class="error__text">We are sorry, but the page you requested was not found</p>
        <a href="<?php echo home_url(); ?>" class="btn-primary error__btn">Back To Home</a>
    </div>
    <div class="error__bg">
        <div class="error__thumb">
            <img class="error__img" src="<?php echo INTERNO_IMG_DIR ?>/error.jpg" alt="">
        </div>
    </div>
</section>