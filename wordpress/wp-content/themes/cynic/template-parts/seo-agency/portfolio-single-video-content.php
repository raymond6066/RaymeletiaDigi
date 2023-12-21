<?php
$top_video_url = esc_url(cynic_get_meta('cynic_portfolio_type_video', true));
if (!empty($top_video_url)):
    ?>
    <div class="embed-responsive embed-responsive-16by9">
        <?php
        echo wp_oembed_get($top_video_url);
        ?>
    </div>
    <?php
endif;
?>