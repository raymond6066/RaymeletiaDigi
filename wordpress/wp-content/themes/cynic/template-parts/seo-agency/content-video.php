<div class="blog-media post-format-<?php echo get_post_format() ?>"> 
	<?php 
	$content = apply_filters( 'the_content', get_the_content() );
	$video = false;

	// Only get video from the content if a playlist isn't present.
	if ( false === strpos( $content, 'wp-playlist-script' ) ) {
		$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
	}
	if ( ! is_single() ) :
		// If not a single post, highlight the video file.
		if ( ! empty( $video ) ) :
			foreach ( $video as $video_html ) {
				echo esc_html_decode($video_html);
			}
		endif;
    endif;
    
    if(is_single()):
        the_content();
        cynic_inner_page_pagination();
    endif; ?>
</div>
<?php if (is_single()) { ?>
    <?php if(has_tag()) { ?>
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
                <span class="category-icon">
                    <i class="icon-Tag"></i>
                    <?php if (has_category()) { ?><?php echo get_the_category_list(esc_html__('&#44; ', 'cynic')); ?><?php } ?>
                </span>
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