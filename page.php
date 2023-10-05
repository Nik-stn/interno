<?php get_header() ?>
<div class="thumb">
    <img class="thumb__img" src="<?php echo INTERNO_IMG_DIR ?>/bg-blog.jpg" alt="">
    <div class="thumb__info">
        <h2 class="title thumb__title">Articles & News</h2>
        <ul class="breadcrumbs">
            <li><a href="<?php echo home_url(); ?>">Home</a></li>
            <li>Blog</li>
        </ul>
    </div>
</div>
<div class="page">
    <div class="container">
        <section class="article-main">
            <h2 class="title">Latest Post</h2>
            <?php
            $args = array(
                'numberposts' => 1,
            );

            $result = wp_get_recent_posts($args);

            foreach ($result as $p) {
                $thumbnail = get_the_post_thumbnail( $p['ID'], 'full' );
                ?>
                <article class="article-main__item">
                    <div class="article-main__thumb">
                        <?php echo $thumbnail;?>
                    </div>
                    <div class="article-main__content">
                        <h3 class="article-main__title">
                            <a href="<?php echo get_permalink($p['ID']) ?>"><?php echo $p['post_title'] ?> </a>
                        </h3>
                        <?php echo substr($p['post_content'], 0, 200 )?>
                        <div class="article-main__info">
                            <span class="article-main__date">
                                <?php $date = date_i18n('j F, Y', strtotime($p['post_date'])); echo $date; ?>
                            </span>
                            <a href="<?php echo get_permalink($p['ID']) ?>" class="article-main__link"></a>
                        </div>
                    </div>
                </article>
                <?php
            }
            ?>
            
        </section>
        <section class="article">
            <h2 class="title">Articles & News</h2>
            <div class="articles">
                <?php
                $query_args = array(
                    'posts_per_page' => '6',
                    'paged' => get_query_var('paged') ?: 1
                ); 
                ?>
            <?php wp_reset_query(  ); $query = new WP_Query($query_args); ?>
                <?php if ($query->have_posts(  )) {
                    while ($query->have_posts(  )) {
                        $query->the_post(  );
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
                <?php }?>
            </div>
            <?php 
                $wp_query = $query;
                the_posts_pagination(  
                    $args = array(
                        'show_all'     => true, // показаны все страницы участвующие в пагинации
                        'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
                        'prev_text'    => __(''),
                        'next_text'    => __(''),
                        'type' => 'array',     // Текст который добавиться ко всем ссылкам.
                        'class'        => 'pagination', // CSS класс, добавлено в 5.5.0.
                    )
                );
            ?>
            <?php }?>
        </section>
    </div>
</div>
<?php get_footer() ?>