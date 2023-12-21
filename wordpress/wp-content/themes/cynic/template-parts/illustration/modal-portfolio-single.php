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
        $customlinktarget = cynic_get_meta('portfolio_link_target'); ?>
        <div class="row no-gutters <?php if (isset($isFeatured) && $isFeatured == '1') {
            echo esc_attr('featured-item');
        } ?>">
            <div class="col-lg-6">
                <div class="modal-img text-center">
                    <?php
                    if (has_post_thumbnail()) {
                        echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, array('class' => 'img-fluid', 'alt' => '' . get_the_title(get_the_ID()) . ''));
                    } ?>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="modal-body__inner-content">
                    <?php
                    $catshtml = '';
                    foreach ($terms as $index => $term) {
                        $catSlug = (get_category_link($term->term_id));
                        if ($index > 0) {
                            $catshtml .= ', ';
                        }
                        $catshtml .= $term->name;
                    } ?>
                    <h4>
                        <span><?php esc_html_e('Featured ', 'cynic');
                            echo esc_html($catshtml) ?></span>
                        <?php echo the_title() ?>
                    </h4>
                    <?php the_content(); ?>
                    <?php if ($customlink && !empty($buttontext)) { ?>
                        <a target="<?php echo esc_attr($customlinktarget) ?>" href="<?php echo esc_url($customlink) ?>"
                           class="hyperlink"><?php echo esc_html($buttontext); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
} ?>