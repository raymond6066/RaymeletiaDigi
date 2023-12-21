<?php

class CynicSeoLogoCarousel
{

    public function __construct()
    {
        add_shortcode('cynic_seo_logo_carousel', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_seo_logo_carousel',
                'name' => __('Logo Carousel', 'cynic'),
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
                        "holder" => "h2",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Title', 'cynic'),
                        'value' => '',
                        'admin_label' => false,
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Image', 'cynic'),
                        'type' => 'attach_images',
                        'param_name' => 'images',
                        'value' => '',
                        'description' => __('Select images from media library.', 'cynic'),
                        'admin_label' => true,
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => __('Slider Paginate Dot', 'cynic'),
                        'param_name' => 'paginatedot',
                        'description' => __('Enable Paginate dot mode.', 'cynic'),
                        'value' => array(__('Yes', 'cynic') => 'yes'),
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => __('Slider speed', 'cynic'),
                        'param_name' => 'speed',
                        'value' => '200',
                        'description' => __('Duration of animation between slides (in ms).', 'cynic'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Slides per view', 'cynic'),
                        'param_name' => 'slides_per_view',
                        'value' => '5',
                        'description' => __('Enter number of slides to display at the same time.', 'cynic'),
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => __('Scroll per view', 'cynic'),
                        'param_name' => 'scroll_per_view',
                        'value' => '1',
                        'description' => __('Enter number of slides to scroll at the same time.', 'cynic'),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __('Slider autoplay', 'cynic'),
                        'param_name' => 'autoplay',
                        'description' => __('Enable autoplay mode.', 'cynic'),
                        'value' => array(__('Yes', 'cynic') => 'yes'),
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => __('Autoplay Slider speed', 'cynic'),
                        'param_name' => 'autoplayspeed',
                        'value' => '2000',
                        'description' => __('Duration of animation between autoplay (in ms).', 'cynic'),
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
                'speed' => '200',
                'slides_per_view' => '5',
                'scroll_per_view' => '1',
                'autoplay' => '',
                'paginatedot' => '',
                'autoplayspeed' => '2000',
//                'slide_link' => ''
            ), $atts);

        $title = $attributes['title'];
        $images = explode(',', $attributes['images']);
        $slides_per_view = (int)$attributes['slides_per_view'];
        $scroll_per_view = (int)$attributes['scroll_per_view'];
        $countImages = count($images);
        $speed = (int)$attributes['speed'];
        $dots = $attributes['paginatedot'];
        $autoplay = $attributes['autoplay'];
        $autoplayspeed = (int)$attributes['autoplayspeed'];

        if ($countImages == 0) {
            return;
        } else {

            if ($countImages < $slides_per_view) {
                $slides_per_view = $countImages;
            }

            if ($countImages < $scroll_per_view) {
                $scroll_per_view = $slides_per_view;
            }
        }

        $extra_class = $attributes['extra_class'];
//        $settings = ["speed" => $speed, 'slidesToShow' => $slides_per_view, 'slidesToScroll' => $scroll_per_view, 'autoplay' => $autoplay, 'autoplaySpeed' => $autoplayspeed, 'dots' => $dots];
        $settings = wp_json_encode(array('dots' => ($dots == 'yes') ? true : false, "infinite" => true, "speed" => $speed, 'slidesToShow' => $slides_per_view, 'slidesToScroll' => $scroll_per_view, 'autoplay' => ($autoplay == 'yes') ? true : false, 'autoplaySpeed' => $autoplayspeed,
            "responsive" => array(
                array("breakpoint" => 1024, "settings" => array("slidesToShow" => $slides_per_view, "slidesToScroll" => $scroll_per_view, "dots" => ($dots == 'yes') ? true : false)),
                array("breakpoint" => 600, "settings" => array("slidesToShow" => $slides_per_view, "slidesToScroll" => $scroll_per_view)),
                array("breakpoint" => 480, "settings" => array("slidesToShow" => 1, "slidesToScroll" => 1))
            )));
        ob_start();
        ?>

        <div class="cynic-feature-logo-carousel <?php echo esc_attr($extra_class); ?>">
            <div class="section-heading text-center">
                <h2><?php echo esc_html_cynicSEO_string($title); ?></h2>
            </div>
            <?php if (count($images) > 0) { ?>
                <div class="carousel-container cynic-section-visibility">
                    <div class="cynicSEO-slick-slider carousel-inner align-items-center my-0"
                         data-slick='<?php echo esc_attr($settings) ?>'>
                        <?php
                        foreach ($images as $image) {
                            ?>
                            <div class="item">
                                <div class="content">
                                    <?php echo wp_get_attachment_image($image, 'full', false, ['alt' => 'service icon', 'class' => 'd-block m-auto']); ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php

        return ob_get_clean();
    }

}
