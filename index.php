<?php get_header() ?>
<div class="hero">
    <img class="hero__img" src="<?php echo INTERNO_IMG_DIR ?>/bg.jpg" alt="Background">
    <div class="container">
        <h1 class="hero__title"><?php the_field('banner__title', 10); ?></h1>
        <p class="hero__text"><?php the_field('banner__text', 10); ?></p>
    </div>
</div>
<div class="container">
    <div class="about">
        <div class="about__text">
            <h2 class="title">We Create The&nbsp;Art Of&nbsp;Stylish Living Stylishly</h2>
            <p>It is a long established fact that a reader will be distracted by the of readable content of a page when
                lookings at its layouts the points of using that it has a more-or-less normal.</p>
            <div class="about-phone">
                <div class="about-phone__icon"></div>
                <div class="about-phone__text">
                    <p><a href="tel:<?php the_field('phone'); ?>"><?php the_field('phone', 10); ?></a></p>
                    <p>Call Us Anytime</p>
                </div>
            </div>
            <a href="#" class="btn-primary">Get Free Estimate</a>
        </div>
        <div class="about__thumb">
            <img class="about__img" src="<?php echo INTERNO_IMG_DIR ?>/about.jpg" alt="About">
        </div>
    </div>
    <div class="swiper swiper-feedback">
        <div class="swiper-wrapper">
            <?php foreach (getFeedBack() as $post): ?> 
            <div class="swiper-slide swiper-feedback__slide">
                <h2 class="title">What our Customers says...</h2>
                <p class="swiper-feedback__text"><?php echo $post->post_content ?></p>
                <span class="swiper-feedback__author">-<?php echo $post->post_title ?></span>
            </div>
            <?php endforeach; ?> 
        </div>
        <div class="swiper-button-next swiper-feedback__next"></div>
        <div class="swiper-button-prev swiper-feedback__prev"></div>
    </div>
</div>
<div class="page">
    <div class="container">
        <div class="brands">
            <img src="<?php echo INTERNO_IMG_DIR ?>/brands/01.svg" alt="Home">
            <img src="<?php echo INTERNO_IMG_DIR ?>/brands/02.svg" alt="Stylevintage">
            <img src="<?php echo INTERNO_IMG_DIR ?>/brands/03.svg" alt="Brand">
            <img src="<?php echo INTERNO_IMG_DIR ?>/brands/04.svg" alt="Nature Home">
            <img src="<?php echo INTERNO_IMG_DIR ?>/brands/05.svg" alt="Classic">
        </div>
    </div>
</div>
<div class="stat bg">
    <div class="container">
        <div class="stats">
            <div class="stats__item">
                <p><span><?php the_field('year__exp', 10); ?></span>Years Of Experiance</p>
            </div>
            <div class="stats__item">
                <p><span><?php the_field('success__project', 10); ?></span>Success Project</p>
            </div>
            <div class="stats__item">
                <p><span><?php the_field('active__project', 10); ?></span>Active Project</p>
            </div>
            <div class="stats__item">
                <p><span><?php the_field('happy__customers', 10); ?></span>Happy Customers</p>
            </div>
        </div>
    </div>
</div>
<section class="page article">
    <div class="container">
        <h2 class="title article__title">Articles & News</h2>
        <p class="article__text">It is a long established fact that a reader will be distracted by the of readable
            content of a page when lookings at its layouts the points of using.</p>
        <div class="articles">
            <?php
            $args = array(
                'numberposts' => 3,
                'post_type' => 'post',
                'suppress_filters' => true,
            );
            $posts = get_posts($args);
            foreach ($posts as $post) {
            ?>
            <article class="articles__item">
                <div class="articles__thumb">
                    <?php the_post_thumbnail( large ); ?>
                    <?php 
                        $posttags = get_the_tags();

                        if ( $posttags ) {
                            echo '<a href="'.get_tag_link($posttags[0]->term_id).'" class="articles__tag">' . $posttags[0]->name . '</a>';
                        }
                    ?>
                </div>
                <h3 class="articles__title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="articles__info">
                    <span class="articles__date"><?php echo get_the_date('j F, Y'); ?></span>
                    <a href="<?php the_permalink(); ?>" class="articles__link"></a>
                </div>
            </article>
            <?php } wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="subscribe">
            <h2 class="title">Personally Newsletter</h2>
            <p>A bi-weekly newsletter of design inspiration.</p>
            <form class="subscribe-box" method="POST" action="https://cp.unisender.com/ru/subscribe?hash=6rwh4nppoqogtnjrij64zibiynuriyyb8chrjhptkwpdwaq1qgshy" name="subscribtion_form">
                <input class="subscribe-box__input" type="text" name="email" placeholder="Email address">
                <button class="subscribe-box__btn" type="submit">Subscribe</button>
                <input type="hidden" name="charset" value="UTF-8">
                <input type="hidden" name="default_list_id" value="1">
                <input type="hidden" name="overwrite" value="2">
                <input type="hidden" name="is_v5" value="1">
            </form>
        </div>
    </div>
</section>
<section class="page contact">
    <div class="container">
        <h2 class="title">Creative project? Let's have a&nbsp;productive talk.</h2>
        <?php echo do_shortcode('[contact-form-7 id="227501e" title="Форма обратной связи"]')?>
    </div>
</section>
<?php get_footer() ?>