<?php

/**
 * Description of CynicGenericTextImageGrids
 *
 * @author Axilweb
 */
class CynicGenericTextImageGrids {

    public function __construct() {
        add_shortcode('cynic_gereric_text', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_gereric_text',
                'name' => __('Generic Text & Image Grids', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Image',
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Image Position',
                        'type' => 'dropdown',
                        'param_name' => 'image_position',
                        'std' => 'left',
                        'value' => array(
                            'Left' => 'left',
                            'Right' => 'right',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'heading',
                        'type' => 'textfield',
                        'heading' => __('Heading', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'description',
                        'type' => 'textarea',
                        'heading' => __('Description', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'bullet_point',
                        'type' => 'textarea',
                        'heading' => __('Bullet Points', 'cynic'),
                        'value' => '',
                    )
                )
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
        array(
            'image' => '',
            'image_position' => 'left',
            'heading' => '',
            'description' => '',
            'bullet_point' => '',
        ), $atts);
        extract($atts);
        $newBulletPoints = array();
        if (isset($bullet_point) && !empty($bullet_point)) {
            $bullet_point = nl2br($bullet_point);
            $bullet_point = preg_replace("<br>", "***", $bullet_point);
            $newBulletPoints = explode('<*** />', $bullet_point);
        }
        ob_start();
        $images = wp_get_attachment_image_src( $image, 'cynic-generic-image' );
        $flex_left = (isset($image_position) && $image_position == "right") ? 'flex-left' : ""; ?>
        <!-- End of .faqs-content -->
        <div class="row flex-wrapper">
            <div class="col-sm-6">
                <div class="img-container">
                    <img src="<?php echo esc_attr($images[0]); ?>" class="img-responsive" alt="generic-img">
                </div>
            </div>
            <div class="col-sm-6 flex-content <?php echo esc_attr($flex_left)?>">
                <div class="content text-left">
                    <h3><?php echo esc_html($heading); ?></h3>
                    <p><?php echo esc_attr($description); ?></p>
                    <ul>
                        <?php
                        if (isset($newBulletPoints) && !empty($newBulletPoints)) {
                            foreach ($newBulletPoints as $bullet) {
                                ?>
                                <li><i class="icon-checkmark-circle"></i> <?php echo html_entity_decode(esc_html($bullet)); ?></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!-- End of .content -->
            </div>
            <!-- End of .col-sm-6 -->
        </div>
        <!-- End of .row -->
        <?php
        return ob_get_clean();
    }

}
