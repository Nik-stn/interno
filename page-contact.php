<?php get_header() ?>
<div class="thumb">
        <img class="thumb__img" src="<?php echo INTERNO_IMG_DIR ?>//bg-contact.jpg" alt="">
        <div class="thumb__info">
            <h2 class="title thumb__title">Contact Us</h2>
            <ul class="breadcrumbs">
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li>Contact</li>
            </ul>
        </div>
    </div>
    <section class="page contact">
        <div class="container">
            <h2 class="title">We love meeting new people and helping them.</h2>
            <div class="contact__box">
                <div class="contact__info">
                    <ul class="contact-list">
                        <li class="contact-list__item contact-list__email">
                            <a class="contact-list__link" href="mailto:<?php the_field('email', 10); ?>"><?php the_field('email', 10); ?></a>
                        </li>
                        <li class="contact-list__item contact-list__tel">
                            <a class="contact-list__link" href="tel:<?php the_field('phone', 10); ?>"><?php the_field('phone', 10); ?></a>
                        </li>
                        <li class="contact-list__item contact-list__website">
                            <a class="contact-list__link" href="<?php the_field('site', 10); ?>"><?php the_field('site', 10); ?></a>
                        </li>
                    </ul>
                    <?php dynamic_sidebar('social-network'); ?>
                </div>
                <div class="contact__form">
                    <?php echo do_shortcode('[contact-form-7 id="59e6792" title="Контактная форма"]')?>
                </div>
            </div>
        </div>
    </section>
    <?php get_footer() ?>