<?php

class CynicAwardRecognitionGrids {
    public function __construct() {
        add_shortcode('cynic_award_recognition', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_award_recognition',
                'name' => __('Award Recognition', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Image',
                        'type' => 'attach_images',
                        'param_name' => 'image',
                        'value' => '',
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'image' => '',
            ), $atts);
        extract($atts);
        ob_start(); 
        $image_ids=explode(',',$atts['image']);
        foreach( $image_ids as $image_id ) { 
        $image_no = 1;
            $images = wp_get_attachment_image_src( $image_id, 'full' ); ?>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="img_container">
                    <img src="<?php echo esc_attr($images[0]); ?>" alt="<?php echo "award-recohnition-".$image_no; ?>" class="img-responsive">
                </div>
                <!-- End of .img_container -->
            </div>
            <?php
            $image++;
        }
        return ob_get_clean();
    }
}
