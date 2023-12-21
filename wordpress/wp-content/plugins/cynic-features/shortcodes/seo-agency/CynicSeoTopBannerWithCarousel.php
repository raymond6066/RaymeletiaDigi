<?php

class CynicSeoTopBannerWithCarousel
{
    public function __construct()
    {
        add_shortcode('cynic_seo_top_banner_with_carousel', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_seo_top_banner_with_carousel',
                'name' => __('Top Banner with Carousel', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "is_container" => false,
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
                        'type' => 'checkbox',
                        'heading' => __('Show Paginate Dot', 'cynic'),
                        'param_name' => 'carouseldots',
                        'description' => __('Enable Carousel dot mode.', 'cynic'),
                        'value' => array(__('Yes', 'cynic') => 'yes'),
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => __('Show Next & Previous Button', 'cynic'),
                        'param_name' => 'carouselnextprevbtn',
                        'description' => __('Enable Carousel dot mode.', 'cynic'),
                        'value' => array(__('Yes', 'cynic') => 'yes'),
                    ),

                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Carousel Items', 'cynic'),
                        'param_name' => 'carousel_items',
                        'params' => array(
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Background Image', 'cynic'),
                                'type' => 'attach_image',
                                'param_name' => 'bg_image',
                                'value' => '',
                                'description' => __('Select images from media library.', 'cynic'),
                            ),
                            array(
                                "holder" => "h2",
                                "class" => "",
                                'heading' => 'Title',
                                'type' => 'textfield',
                                'param_name' => 'title',
                                'value' => '',
                                'admin_label' => true,
                            ),
                            array(
                                "holder" => "p",
                                "class" => "",
                                'heading' => 'Short Description',
                                'type' => 'textarea',
                                'param_name' => 'short_description',
                                'value' => '',
                            ),

                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => 'Read More Link',
                                'type' => 'vc_link',
                                'param_name' => 'carousel_link',
                                'value' => '',
                                'description' => __('Keep URL empty URL if you don\'t want', 'cynic'),
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
                                'type' => 'dropdown',
                                'heading' => __('Image Position', 'cynic'),
                                'value' => array(
                                    __('Right', 'cynic') => '2',
                                    __('Left', 'cynic') => '1',
                                ),
                                'admin_label' => true,
                                'param_name' => 'image_position',
                                'description' => __('Select Image Position.', 'cynic'),
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
                'carouseldots' => '',
                'carouselnextprevbtn' => '',
                'carousel_items' => [],
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $carouseldots = $attributes['carouseldots'];
        $carouselnextprevbtn = $attributes['carouselnextprevbtn'];

        $items_val = $attributes['carousel_items'];
        $items = vc_param_group_parse_atts($items_val);
        ob_start();
        if (count($items) > 0) {
            $carouselid = uniqid(rand(000000, 994999));
            ?>
            <div id="<?php echo esc_attr($carouselid); ?>" class="carousel slide banner-carousel <?php echo esc_attr($extra_class); ?>" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    $i = 0;
                    $innercontentHtml = '';
                    foreach ($items as $item) {
                        $extraClass = (isset($item['extra_class'])) ? $item['extra_class'] : '';
                        $bg_image = (isset($item['bg_image'])) ? $item['bg_image'] : '';
                        $bg_imgsrc = wp_get_attachment_url($bg_image, 'full');
                        $bgattr = ' ';
                        if (!empty($bg_imgsrc)) {
                            $bgattr = 'data-bg=' . $bg_imgsrc;
                        }

                        $title = (isset($item['title'])) ? $item['title'] : '';
                        $short_description = (isset($item['short_description'])) ? $item['short_description'] : '';

                        $carousel_link = (isset($item['carousel_link'])) ? $item['carousel_link'] : [];
                        $linkArr = vc_build_link($carousel_link);

                        $image = (isset($item['image'])) ? $item['image'] : '';

                        $image_position = $item['image_position'];
                        $img_positionClass = ($image_position == 1) ? ' order-1' : '';

                        $activeclass = '';
                        if ($i == 0) {
                            $activeclass = 'active';
                        }
                        if ($carouseldots) {
                            ?>
                            <li data-target="#<?php echo esc_attr($carouselid); ?>"
                                data-slide-to="<?php echo esc_attr($i); ?>"
                                class="<?php echo esc_attr($activeclass); ?>"></li>
                            <?php
                        }
                        $innercontentHtml .= '<div class="carousel-item ' . $activeclass . '">
                            <div class="ip-banner fullscreen-banner " ' . $bgattr . '>
                                <div class="content d-flex align-items-center justify-content-center">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-md-6 text-md-left text-center ' . $img_positionClass . '">
                                                <h1>' . $title . '</h1>
                                                <p>' . $short_description . '</p>' . cynicSEO_anchor_link_html($linkArr, 'primary-btn btn-white') . '     
                                            </div>
                                            <div class="col-md text-center text-md-right">
                                            ' . wp_get_attachment_image($image, 'full', false, ['class' => 'img-fluid']) . '
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        ?>
                        <?php
                        $i++;
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php echo esc_html_cynicSEO_string($innercontentHtml); ?>
                </div>
                <?php
                if ($carouselnextprevbtn) {
                    ?>
                    <a class="carousel-control-prev" href="#<?php echo esc_attr($carouselid); ?>" role="button"
                       data-slide="prev">
                        <i class="icon-Chevon---Left"></i>
                    </a>
                    <a class="carousel-control-next" href="#<?php echo esc_attr($carouselid); ?>" role="button"
                       data-slide="next">
                        <i class="icon-Chevron---Right"></i>
                    </a>
                <?php } ?>
            </div>
            <?php
        }
        return ob_get_clean();
    }
}
