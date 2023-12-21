<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $isFeatured = get_post_meta(get_the_ID(), 'cynic_post_featured', true);
        $class = (isset($isFeatured) && $isFeatured==1) ? "featured-item": ""; ?>
        <div class="<?php echo esc_attr($class); ?>">
            <div class="modal-title">
                <h2 class="section-title text-center"><?php the_title(); ?></h2>
            </div>
            <!-- End of .modal-title -->
            <ul class="blog-info">
                <li>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                        <img src="<?php echo CYNIC_THEME_URI; ?>/images/illustration/user.png" alt="user icon"><?php the_author(); ?></a>
                </li>
                <li>
                    <a href="<?php echo esc_url(get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'))) ?>">
                        <img src="<?php echo CYNIC_THEME_URI; ?>/images/illustration/watch.png" alt="user icon"><?php echo get_the_date('j F, Y'); ?>
                    </a>
                </li>
            </ul>
            <!-- End of .blog-info -->
            <?php
            if (get_post_format() != "video" && has_post_thumbnail()) {
                the_post_thumbnail('full', array('class'=>'img-fluid modal-feat-img'));
            }
            the_content();
            ?>
        </div>
        <?php
    }
}
?>