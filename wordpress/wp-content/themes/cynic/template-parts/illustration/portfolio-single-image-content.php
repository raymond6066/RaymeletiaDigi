<?php
/*
 * To display single image type portfolio.
 */
$isFeatured = cynic_get_meta('portfolio_featured');
$terms = wp_get_post_terms(get_the_ID(), 'portfolio-cat');
$subtitle = cynic_get_meta('portfolio_subtitle_text');
$title = get_the_title();
$features = cynic_get_meta('portfolio_features');
$featuretitle = cynic_get_meta('portfolio_feature_title');
$buttontext = cynic_get_meta('portfolio_button_text');
$customlink = cynic_get_meta('portfolio_custom_link');
$customlinktarget = cynic_get_meta('portfolio_link_target'); ?>
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
    if (has_post_thumbnail()) {
        echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, array('class' => 'img-fluid modal-feat-img', 'alt' => '' . get_the_title(get_the_ID()) . ''));
    } ?>
    <p><?php the_content(); ?></p>
    <?php if ($featuretitle) { ?>
        <h3><?php esc_html($featuretitle); ?></h3>
    <?php } ?>
    <?php if ($features) { ?>
        <ul class="common-list">
            <?php foreach ($features as $feature) { ?>
                <li><?php echo esc_html($feature); ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>