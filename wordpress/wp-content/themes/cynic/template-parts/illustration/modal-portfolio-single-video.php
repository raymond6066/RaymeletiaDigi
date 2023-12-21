<?php
/*
 * To display single image type portfolio.
 */
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $isFeatured = cynic_get_meta('portfolio_featured');
        $terms = wp_get_post_terms(get_the_ID(), 'portfolio-cat');
        $subtitle = cynic_get_meta('portfolio_subtitle_text');
        $title = get_the_title();
        $features = cynic_get_meta('portfolio_features');
        $featuretitle = cynic_get_meta('portfolio_feature_title');
        $buttontext = cynic_get_meta('portfolio_button_text');
        $customlink = cynic_get_meta('portfolio_custom_link');
        $customlinktarget = cynic_get_meta('portfolio_link_target');
        $video_url = cynic_get_meta('portfolio_video_link');
        parse_str(parse_url($video_url, PHP_URL_QUERY), $codes);?>
        <div class="<?php if (isset($isFeatured) && $isFeatured == '1') {
            echo esc_attr('featured-item');
        } ?>">
            <div class="modal-title text-center">
                <?php
                $catshtml = '';
                foreach ($terms as $index => $term) {
                    $catSlug = (get_category_link($term->term_id));
                    if ($index > 0) {
                        $catshtml .= ', ';
                    }
                    $catshtml .= $term->name;
                } ?>
                <h2 class="section-title">
            <span><?php esc_html_e('Featured ', 'cynic');
                echo esc_html($catshtml) ?></span>
                    <?php echo the_title() ?>
                </h2>
                <?php if ($customlink && !empty($buttontext)) { ?>
                    <a target="<?php echo esc_attr($customlinktarget) ?>" href="<?php echo esc_url($customlink) ?>"
                       class="custom-btn secondary-btn"><?php echo esc_html($buttontext); ?></a>
                <?php } ?>
            </div>

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
            } ?>
            <p><?php the_content(); ?></p>
            <?php if (!empty($featuretitle)) { ?>
                <h3><?php echo esc_html($featuretitle); ?></h3>
            <?php } ?>
            <?php if ($features) { ?>
                <ul class="common-list">
                    <?php foreach ($features as $feature) { ?>
                        <li><?php echo esc_html($feature); ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
        <?php
    }
}
?>