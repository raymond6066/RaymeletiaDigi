<?php
/* 
 * To display single image type portfolio.
 */
$isFeatured = cynic_get_meta('portfolio_featured');
$images = cynic_get_meta('portfolio_gallery', false);
if (has_post_thumbnail()) {
    $featured = get_post_thumbnail_id();
    array_unshift($images, $featured);
}
if (!empty($images)) { ?>
    <div class="col-lg-6">
        <!-- main slider carousel -->
        <div class="<?php if (isset($isFeatured) && $isFeatured == '1') {
            echo esc_attr('featured-item');
        } ?>">
            <div id="carousel-bounding-box">
                <div id="featured-project-carousel" class="carousel slide featured-project-carousel"
                     data-ride="carousel">
                    <!-- main slider carousel items -->
                    <?php
                    $activeClass = 'active';
                    $i = 0;
                    if(isset($images) && !empty($images)) {
                        $imageCount = count($images);
                        if($imageCount > 1) { ?>
                            <ol class="carousel-indicators">
                                <?php
                                foreach ($images as $image) {
                                    $bigimg = wp_get_attachment_url((int)$image);
                                    if ($bigimg) {
                                        echo '<li data-target="#featured-project-carousel" data-slide-to="' . esc_attr($i) . '" class="' . esc_attr($activeClass) . '"></li>';
                                        $activeClass = '';
                                        $i++;
                                    }
                                } ?>
                            </ol>
                            <?php
                        } ?>
                        <div class="carousel-inner">
                            <?php
                            $activeClass = 'active';
                            $i = 0;
                            foreach ($images as $image) {
                                $bigimg = wp_get_attachment_url((int)$image);
                                if ($bigimg) { ?>
                                    <div class="carousel-item <?php echo esc_attr($activeClass); ?>">
                                        <img class="d-block w-100" src="<?php echo esc_url($bigimg) ?>">
                                    </div>
                                    <?php
                                    $activeClass = '';
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                        <?php
                        if($i>1): ?>
                            <a class="carousel-control-prev" href="#featured-project-carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only"><?php esc_html_e('Previous', 'cynic')?></span>
                            </a>
                            <a class="carousel-control-next" href="#featured-project-carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only"><?php esc_html_e('Next', 'cynic')?></span>
                            </a>
                            <?php
                        endif;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="col-lg-6">
    <?php
    $terms = wp_get_post_terms(get_the_ID(), 'portfolio-cat');
    $subtitle = cynic_get_meta('portfolio_subtitle_text');
    $title = get_the_title();
    $features = cynic_get_meta('portfolio_features');
    $featuretitle = cynic_get_meta('portfolio_feature_title');
    $buttontext = cynic_get_meta('portfolio_button_text');
    $customlink = cynic_get_meta('portfolio_custom_link');
    $customlinktarget = cynic_get_meta('portfolio_link_target');
    ?>

    <div class="text-content">
        <h3>
            <?php
            $catshtml = '';
            foreach ($terms as $index => $term) {
                $catSlug = (get_category_link($term->term_id));
                if ($index > 0) {
                    $catshtml .= ', ';
                }
                $catshtml .= $term->name;
            } ?>
            <span>
                <?php esc_html_e('Featured - ', 'cynic'); echo esc_html($catshtml) ?></span>
                <?php echo the_title() ?>
                </h3>
            <?php the_content();
            if ($customlink && !empty($buttontext)) { ?>
                <a target="<?php echo esc_attr($customlinktarget) ?>" href="<?php echo esc_url($customlink) ?>"
                   class="custom-btn btn-big grad-style-ef">
                    <?php echo $buttontext; ?></a>
                <?php
            } ?>
    </div>
    <!-- End of .text-content -->

</div>