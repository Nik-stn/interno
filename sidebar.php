<div class="sidebar">
    <?php dynamic_sidebar('blog-sidebar'); ?>
    <div class="author">
        <div class="author__head">
            <div class="author__thumb">
                <?php echo get_avatar( $author->ID, 70 );?>
            </div>
            <div class="author__content">
                <h4 class="author__name"><?php the_author_meta('display_name', 1); ?></h4>
                <span class="author__role">Author</span>
            </div>
        </div>
        <p class="author__text"><?php the_author_meta('user_description', 1); ?></p>
    </div>
</div>