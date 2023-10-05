<?php get_header() ?>
<div class="thumb">
    <img class="thumb__img" src="<?php echo INTERNO_IMG_DIR ?>/bg-blog.jpg" alt="">
    <div class="thumb__info">
        <h2 class="title thumb__title"><?php if( is_category() ) echo get_queried_object()->name; ?></h2>
        <ul class="breadcrumbs">
            <li><a href="<?php echo home_url(); ?>">Home</a></li>
            <li><?php if( is_category() ) echo get_queried_object()->name; ?></li>
        </ul>
    </div>
</div>
<div class="page">
    <div class="container">
        <section class="article">
            <?php
                $category_slug = get_query_var( 'category_name' ); 
                $category = get_category_by_slug($category_slug);
                $category_id = $category->term_id;
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'cat' => $category_id,
                    'posts_per_page' => '-1',
                );
                $query = new WP_Query( $args );
            ?>
            <?php if ($query->have_posts()) : ?>
                <div class="articles">
                    <?php while ($query->have_posts(  )) : $query->the_post(  ); ?>
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
                    <?php endwhile; ?>
                </div>  
            <?php else : ?>
                <p>Nothing found</p>
            <?php endif; ?>
        </section>
    </div>
</div>
<?php get_footer() ?>