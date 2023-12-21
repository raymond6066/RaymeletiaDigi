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
if(!empty($images)){ ?>
<div class="col-md-6">

        <!-- main slider carousel -->
        <div id="slider" class="<?php if(isset($isFeatured) && $isFeatured=='1') { echo esc_attr('is-featured'); }?>">
            <div id="carousel-bounding-box">
                <div id="myCarousel" class="carousel slide"> 

                    <!-- main slider carousel items -->
                    <div class="carousel-inner">
                        <?php 
                        $navoutput = '';
                        foreach($images as $key=> $image){
                                $thumbsize = 'cynic-portfolio-thumb';
                                $activeclass = '';
                                $navselected = '';
                                if($key < 1){
                                    $activeclass = 'active';
                                    $navselected = 'selected';
                                }
                                $thumbimage = wp_get_attachment_image((int)$image, $thumbsize, false, array('class' => 'img-responsive'));
                                $bigimg = wp_get_attachment_url((int)$image);
                                $navoutput .= '<li> <a id="carousel-selector-'.esc_attr($key).'" class="carousel-selector '.esc_attr($navselected).'"> '.wp_kses_post($thumbimage).' </a> </li>';
                                ?>
                        <div class="item <?php echo esc_attr($activeclass);?>" data-bg-img="<?php echo esc_url($bigimg)?>" data-slide-number="<?php echo esc_attr($key)?>"> </div>
                        <?php }?>
                        <div id="slider-thumbs"> 
                            <!-- thumb navigation carousel items -->
                            <ul class="list-inline thumb-list">
                                    <?php print $navoutput;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php }?>
<div class="col-md-6">
    <?php 
    $terms = wp_get_post_terms(get_the_ID(), 'portfolio-cat');
    $features = cynic_get_meta('portfolio_features');
    $subtitle = cynic_get_meta('portfolio_subtitle_text');
    $title = get_the_title();
    $featuretitle = cynic_get_meta('portfolio_feature_title');
    $buttontext = cynic_get_meta('portfolio_button_text');
    $customlink = cynic_get_meta('portfolio_custom_link');
    $customlinktarget = cynic_get_meta('portfolio_link_target');
    ?>
    <div class="port-modal-content">
            <?php if($terms && !is_wp_error($terms)){ ?>
                <p class="gray-text"><?php 
                    esc_html_e('Featured - ', 'cynic');
                    $catshtml = '';
                    foreach($terms as $index=>$term){
                            if($index > 0){
                                    $catshtml .= ', ';
                            }
                            $catshtml .= $term->name;
                    }
                    echo esc_html($catshtml);
                ?></p>
            <?php }?>
            <?php if($title){ ?>
              <h2 class="b-clor"><?php echo esc_html($title)?></h2>
            <?php } ?>
            <?php the_content()?>
    </div>
    <?php if($featuretitle){ ?>
        <h3><?php echo esc_html($featuretitle)?></h3>
    <?php } ?>
    <?php if($features){ ?>
    <ul class="list-with-arrow">
      <?php foreach($features as $feature){?>
        <li><?php echo esc_html($feature)?></li>
      <?php } ?>
    </ul>
    <?php }
    if($customlink && $buttontext){ ?>
        <a target="<?php echo esc_attr($customlinktarget)?>" href="<?php echo esc_url($customlink)?>" class="medium-btn2 btn btn-fill"><?php echo esc_html($buttontext)?></a>
    <?php } ?>

</div>