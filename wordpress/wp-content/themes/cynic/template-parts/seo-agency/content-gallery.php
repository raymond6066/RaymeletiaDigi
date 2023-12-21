
<?php if (is_single()) { ?>
    <div class="img-container">
        <?php the_post_thumbnail(cynicGetblogThumbnilSize('single'), array('class' => 'img-fluid')) ?>
    </div>
<?php } else { ?>
    <a href="<?php the_permalink() ?>"
       class="img-container d-block <?php echo esc_attr($class) ?> blog-media post-format-<?php echo get_post_format() ?>">
       <?php
            $galleries = cynic_get_meta('cynic_post_gallery', false);
            if($galleries){
                array_unshift($galleries, get_post_thumbnail_id(get_the_ID()));
            ?>
                <ul class="clearlist content-slider">
                <?php
                foreach($galleries as $imgid){?>
                <li> <?php echo wp_get_attachment_image((int)$imgid, 'full')?> </li>
                <?php }?>
                </ul>
            <?php }else{
                the_post_thumbnail(cynicGetblogThumbnilSize('blog'), array('class' => 'img-fluid'));
            }
        ?>
    </a>
<?php } ?>

<?php if (is_single()) { ?>
    <?php
        the_content();
        cynic_inner_page_pagination();
    ?>
    <?php if(has_tag()){ ?>
        <div class="post-tags"><?php the_tags('Tags: ', ''); ?></div>
    <?php }
    get_template_part('template-parts/seo-agency/contentFooter');
} else { ?>
    <!-- End of .img-container -->
    <div class="article-head row no-gutters">
        <div class="post-date col-auto">
                    <span>
                        <?php echo get_the_date('j') ?>
                    </span>
            <?php echo get_the_date('M') ?>
        </div>
        <!-- End of .post-date -->
        <div class="post-title col-md">
            <h2>
                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
            </h2>
            <div class="post-info">
                <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID'))); ?>">
                    <i class="icon-User"></i>
                    <?php the_author(); ?>
                </a>
                <a class="comments_link" href="<?php echo esc_url(get_comments_link(get_the_ID())) ?>">
                    <i class="icon-Comment"></i>
                    <?php printf(_nx('%2s Comment', '%2s Comments', get_comments_number(), 'comments title', 'cynic'), number_format_i18n(get_comments_number())) ?>
                </a>
                <a href="#">
                    <i class="icon-Tag"></i>
                    <?php if (has_category()) { ?><?php echo get_the_category_list(esc_html__(', ', 'cynic')); ?><?php } ?>
                </a>
            </div>
            <!-- End of .post-info -->
        </div>
        <!-- End of .post-title -->
    </div>
    <!-- End of .article-head -->
    <p><?php the_excerpt(); ?></p>
<?php } ?>

<?php
if (!is_single()) {
    ?>
    <!-- Read More Link -->
    <a href="<?php the_permalink() ?>" class="primary-btn"><?php echo esc_html(getCynicOptionsVal('blog_read_more_text')) ?></a>
    <?php
}
?>