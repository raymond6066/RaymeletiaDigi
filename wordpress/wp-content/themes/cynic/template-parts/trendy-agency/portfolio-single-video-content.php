<?php
/* 
 * To display single video type portfolio.
 */
$video_url = get_post_meta(get_the_ID(), 'portfolio_video_link', TRUE);
parse_str(parse_url($video_url, PHP_URL_QUERY), $codes);
$terms = wp_get_post_terms(get_the_ID(), 'portfolio-cat');
$title = get_the_title(); ?>
<div class="col-md-12">
    <div class="portfolio-single-video-content">
            <p class="port-categories">
                <?php
                esc_html_e('Featured - ', 'cynic');
                $catshtml = '';
                foreach ($terms as $index => $term) {
                    if ($index > 0) {
                        $catshtml .= ', ';
                    }
                    $catshtml .= $term->name;
                }
                ?>
                <a href="<?php echo esc_url($catSlug) ?>">
                    <?php echo esc_html($catshtml); ?>
                </a>
            </p>
            <?php if ($title) { ?>
                <h2 class="b-clor"><?php echo esc_html($title) ?></h2>
            <?php } ?>
        <?php
        $content = apply_filters('the_content', $video_url);
        $video = false;
        // Only get video from the content if a playlist isn't present.
        if (false === strpos($content, 'wp-playlist-script')) {
            $video = get_media_embedded_in_content($content, array('video', 'object', 'embed', 'iframe'));
            if ($video) :
                foreach ($video as $video_html) {
                    ?>
                    <p class="portfolio-type-video"><?php echo esc_html_decode($video_html); ?></p>
                    <?php
                }
            endif;
        }
        ?>
    </div>
</div>


