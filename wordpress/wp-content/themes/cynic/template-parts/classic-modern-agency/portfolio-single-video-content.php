<?php
/* 
 * To display single video type portfolio.
 */
$video_url = get_post_meta(get_the_ID(), 'portfolio_video_link', TRUE);
parse_str( parse_url( $video_url, PHP_URL_QUERY ), $codes ); 
$terms = wp_get_post_terms(get_the_ID(), 'portfolio-cat'); 
$title = get_the_title(); ?>
<div class="col-md-12">
    <div class="portfolio-single-video-content">
        <div class="port-modal-content">
            <p class="gray-text">
                <?php 
                    esc_html_e('Featured - ', 'cynic');
                    $catshtml = '';
                    foreach($terms as $index=>$term){
                            if($index > 0){
                                    $catshtml .= ', ';
                            }
                            $catshtml .= $term->name;
                    }
                    echo esc_html($catshtml);
                ?>
            </p>
            <?php if($title){ ?>
              <h2 class="b-clor"><?php echo esc_html($title)?></h2>
            <?php } ?>
        </div>
        <?php if(isset($codes['v']) && !empty($codes['v'])) { ?>
            <p class="portfolio-type-video" data-attr="<?php echo esc_attr($codes['v']) ?>"></p>
        <?php } ?>
    </div>
</div>

