<?php

class CynicClientLogos
{

    public function __construct()
    {
        add_shortcode('cynic_client_logos', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_client_logos',
                'name' => __('Client Logo', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "show_settings_on_create" => true,
                "is_container" => false,
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "h3",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Ttile', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Image', 'cynic'),
                        'type' => 'attach_images',
                        'param_name' => 'images',
                        'value' => '',
                    ),

                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'title' => '',
                'images' => '',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        $images = $attributes['images'];
        $imagesArr = explode(',', $images);
        if (empty($imagesArr) || count($imagesArr) < 1) {
            return false;
        }

        ob_start(); ?>
        <div class="clients <?php echo esc_attr($extra_class); ?>">
            <div class="container">
                <?php
                if ($title) {
                    ?>
                    <h3><?php echo cynic_nl2br($title); ?></h3>
                    <?php
                }
                ?>
                <div class="row justify-content-center clients-wrapper">
                    <?php
                    foreach ($imagesArr as $image) {
                        $imageHtml = wp_get_attachment_image($image, 'full');
                        if ($imageHtml) {
                            ?>
                            <div class="client">
                                <?php echo html_entity_decode(esc_html($imageHtml)) ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

}
