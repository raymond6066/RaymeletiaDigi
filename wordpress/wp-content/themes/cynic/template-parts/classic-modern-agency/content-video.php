<?php if (!is_single()) { ?>
	<h2 class="blog-item-title font-alt"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
<?php } else { ?>
	<h2 class="blog-item-title font-alt"><?php the_title() ?></h2>
<?php } ?>
<div class="blog-item-data"> <a href="<?php the_permalink()?>"><i class="icon-calendar-full"></i> <?php echo get_the_date('j F, Y') ?></a> <span class="separator">&nbsp;</span> <?php if(has_category()){?><span class="author"><i class="icon-list4"></i> <?php echo get_the_category_list(esc_html__(', ', 'cynic'));?></span> <span class="separator">&nbsp;</span> <?php }?><a href="<?php the_author_meta('url')?>"><i class="icon-user"></i> <?php the_author();?></a> <span class="separator">&nbsp;</span> <a class="comments_link" href="<?php echo esc_url(get_comments_link(get_the_ID()))?>"><?php printf(_nx('%2$s Comment', '%2$s Comments', get_comments_number(), 'comments title', 'cynic'), number_format_i18n(get_comments_number()), '<i class="icon-bubbles"></i>');?></a></div>
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
	?>
</div>
<div class="blog-item-body">
	<?php
	
	if ( is_single() || empty( $video ) ) :

		the_content();
		wp_link_pages( array(
			'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'cynic' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );

	endif; ?>
</div>
<?php
if(!is_single()){
?>
<!-- Read More Link -->
<div class="blog-item-foot"> <a href="<?php the_permalink()?>" class="medium-btn3 btn btn-nofill green-text"><?php esc_html_e('Read More', 'cynic')?></a> </div>
<?php 
}
?>