<h2>
    <?php if (is_single()) {
        ?>
        <span>
        <?php if (has_category()) { ?><?php echo get_the_category_list(esc_html__('&#44; ', 'cynic')); ?><?php } ?>
    </span>
        <?php the_title() ?>
    <?php } else { ?>
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
    <?php } ?>
</h2>
<div class="row">
    <div class="<?php echo esc_attr((is_single()) ? 'col-md-7' : 'col-md-12'); ?>">
        <div class="post-info">
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                <i class="ml-fac-21-man-male-avatar-fac-e"></i></i>
                <?php the_author(); ?>
            </a>
            <a href="<?php echo esc_url(get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'))) ?>"> <i
                        class="ml-tim-35-calander-date-schedule-clock-time-alarm-watch"></i> <?php echo get_the_date('j F, Y') ?>
            </a>
            <a class="comments_link" href="<?php echo esc_url(get_comments_link(get_the_ID())) ?>">
                <i class="ml-mestwo-4-speech-bubble-chat-dialogue-message"></i>
                <?php printf(_nx('%2s Comment', '%2s Comments', get_comments_number(), 'comments title', 'cynic'), number_format_i18n(get_comments_number())) ?>
            </a>
            <?php if (!is_single() && has_category()) { ?>
                <span class="category-icon"><i class="ml-filmthree-63-document-file-Layout-mini-line"></i>
                    <?php echo get_the_category_list(esc_html__('&#44; ', 'cynic')); ?>
                    </span>
            <?php } ?>
        </div>
    </div>
    <!-- End of .col-md-8 -->
    <?php if (is_single()) { ?>
        <div class="col-md-5">
            <?php echo cynic_trendy_agency_sharing_icon_links(); ?>
            <!-- End of .social-icons -->
        </div>
        <!-- End of .col-md-5 -->
    <?php } ?>
</div>
<!-- End of .row -->
<?php
$isFeatured = get_post_meta(get_the_ID(), 'cynic_post_featured', true);
$class = (isset($isFeatured) && $isFeatured == 1) ? "featured-item" : "";
$isButton = "";
if (get_post_format() == "video") {
    $isButton = "blog-video-popup";
} ?>
<div class="<?php echo esc_attr($class); echo " ". $isButton; ?>">
    <?php if (!is_single()) { ?>
        <a href="<?php the_permalink() ?>"
           class="img-container d-block blog-media post-format-<?php echo get_post_format() ?>">
            <?php the_post_thumbnail(cynicGetblogThumbnilSize('blog'), array('class' => 'img-fluid blog-details-img')) ?>
        </a>
    <?php } ?>
</div>
<?php
if (is_single()) {
    the_content();
} else {
    ?>
    <p><?php the_excerpt(); ?></p>
    <!-- Read More Link -->
    <a href="<?php the_permalink() ?>"
       class="custom-btn btn-big grad-style-ef">
        <?php echo __('Read More', 'cynic'); ?></a>
    <?php
}
?>
