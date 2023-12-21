<?php

class CynicSeoCareerQuotesSlider
{

    public function __construct()
    {
        add_shortcode('cynic_seo_career_quotes_slider', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_seo_career_quotes_slider',
                'name' => __('Career Quotes', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "is_container" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Image', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __('Select images from media library.', 'cynic'),
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Slider Items', 'cynic'),
                        'param_name' => 'slider_item',
                        'params' => array(
                            array(
                                "holder" => "p",
                                "class" => "",
                                'heading' => 'Short Description',
                                'type' => 'textarea',
                                'param_name' => 'short_description',
                                'value' => '',
                                'admin_label' => true,
                            ),
                        ),
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
                'image' => '',
                'slider_item' => [],
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $image = $attributes['image'];
        $items_val = $attributes['slider_item'];
        $items = vc_param_group_parse_atts($items_val);
        ob_start();
        $slickOptions = wp_json_encode(array('dots' => true, "infinite" => true, "speed" => 1000, "slidesToShow" => 1, "slidesToScroll" => 1, "autoplay" => true, "autoplay" => true, "autoplaySpeed" => 3000));
        if (!empty(isset($items) && count($items) > 0)):
            ?>
            <div class="cynic-career-slider carousel-container <?php echo esc_attr($extra_class); ?>">
                <div class="cynicSEO-slick-slider d-flex carousel-inner cynic-section-visibility"
                     data-slick='<?php echo esc_attr($slickOptions); ?>'>
                    <?php
                    if (!empty(isset($items) && !empty($items))):
                        foreach ($items as $item):
                            ?>
                            <div class="item col-12 mx-auto">
                                <div class="content text-center">
                                    <p><?php echo esc_html_cynicSEO_string($item['short_description']); ?></p>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            <?php
        endif;
        echo wp_get_attachment_image($image, 'full', false, ['class' => 'img-fluid team-img']); ?>
        <?php
        return ob_get_clean();
    }

}


