<?php

class CynicOnePageCaseStudiesSlider {

    private $paginations = '', $counter = 0, $sliderhtmlid = '';
    private static $overallcounter = 0;

    public function __construct() {
        add_shortcode('cynic_onepage_ccs_slider', array($this, 'shortcodecb'));
        add_shortcode('cynic_onepage_ccs_slide', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_onepage_ccs_slider',
                'name' => __('Modern Case Studies Slider', 'cynic'),
                "category" => __("Cynic Modern", "cynic"),
                "as_parent" => array('only' => 'cynic_onepage_ccs_slide'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "show_settings_on_create" => false,
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
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_onepage_ccs_slide',
                'name' => __('Modern Case Study Slide', 'cynic'),
                "category" => __("Cynic", "cynic"),
                "as_child" => array('only' => 'cynic_ccs_slider'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Background Image',
                        'type' => 'attach_image',
                        'param_name' => 'bg_image',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Right Side Image',
                        'type' => 'attach_image',
                        'param_name' => 'right_image',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Slide Title', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'regular_text',
                        'type' => 'textfield',
                        'heading' => __('Slide Regular Text', 'cynic'),
                        'value' => '',
                        'admin_label' => false,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Slider Pagination Avatar Image',
                        'type' => 'attach_image',
                        'param_name' => 'pagi_avatar',
                        'value' => '',
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Link Icon', 'cynic'),
                        'param_name' => 'link_icon',
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'linearicons',
                            'iconsPerPage' => 200, // default 100, how many icons per/page to display
                        ),
                        'value' => 'icon-play-circle',
                        'description' => __('Select an icon from library.', 'cynic'),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'custom_link_text',
                        'type' => 'textfield',
                        'heading' => __('Custom Link Text', 'cynic'),
                        'value' => '',
                        'admin_label' => false,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'custom_link',
                        'type' => 'textfield',
                        'heading' => __('Custom Link', 'cynic'),
                        'value' => '',
                        'admin_label' => false,
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'extra_class' => '',
                ), $atts);
        $this->sliderhtmlid = 'case-studies-Carousel-' . rand(000000, 999999);
        extract($atts);
        ob_start();
        $content = do_shortcode($content); ?>

        <!--case studies section-->
        <section class="case-studies-section<?php echo $extra_class ? ' ' . $extra_class : ''; ?>">
            <div id="<?php echo esc_attr($this->sliderhtmlid) ?>" class="case-studies-carousel carousel slide" data-ride="carousel"> 
                <!--Indicators-->
                <?php if ($this->paginations) { ?>
                    <ol class="carousel-indicators">
                        <?php echo $this->paginations; ?>
                    </ol>
                <?php } ?>
                <div class="carousel-inner" role="listbox"> 
                    <?php echo $content; ?>
                </div>
            </div>
        </section>
        <!--end case studies section--> 
        <?php
        $this->paginations = '';
        $this->counter = 0;
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'bg_image' => '',
            'right_image' => '',
            'title' => '',
            'regular_text' => '',
            'pagi_avatar' => '',
            'link_icon' => 'icon-play-circle',
            'custom_link_text' => '',
            'custom_link' => '#',
                ), $atts);
        extract($atts);

        if ($bg_image) {
            $big_image = wp_get_attachment_url((int) $bg_image);
            $paginate_avatar = wp_get_attachment_image_src((int) $pagi_avatar, array(84, 84));
            if (isset($paginate_avatar[0]) && $paginate_avatar[0]) {
                $paginate_avatar = $paginate_avatar[0];
            }
        }
        if ($right_image) {
            $right_image = wp_get_attachment_url((int) $right_image);
        }
        $pagiactiveclass = '';
        if ($this->counter < 1) {
            $pagiactiveclass = 'active';
        }
        ob_start();
        ?>
        <li data-target="#<?php echo esc_attr($this->sliderhtmlid) ?>" data-slide-to="<?php echo self::$overallcounter ?>" data-bg-img="<?php echo isset($paginate_avatar) && $paginate_avatar ? $paginate_avatar : null; ?>" class="<?php echo $pagiactiveclass ?>" >
            </li>
        <?php
        $this->paginations .= ob_get_clean();
        ob_start();
        ?>
        <!--slider item-->
        <div class="item <?php echo $pagiactiveclass ?>" data-bg-img="<?php echo isset($big_image) && $big_image ? $big_image : null; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-12 pull-left">
                        <div class="carousel-caption">
                            <?php if ($title) { ?>
                                <h2><?php echo $title ?></h2>
                                    <?php 
                            }?>
                            <p class="regular-text"><?php echo $regular_text ?></p>
                            <?php if(isset($custom_link_text) && !empty($custom_link_text)) {  ?>
                                <a href="<?php echo $custom_link ?>" class="small-text semi-bold video-popup" ><span class="<?php echo $link_icon ?>"></span><span><?php echo $custom_link_text ?></span></a>
                            <?php } ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php if(isset($right_image) && !empty($right_image)) { ?>
                        <div class="col-md-5 col-xs-12 pull-right floating-img">
                            <img src="<?php echo esc_attr($right_image) ?>" alt="<?php echo esc_attr($title) ?>" class="img-responsive pull-right">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--end slider item--> 
        <?php
        $this->counter++;
        self::$overallcounter++;
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_Cynic_OnePage_Ccs_Slider extends WPBakeryShortCodesContainer {
        
    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Cynic_OnePage_Ccs_Slide extends WPBakeryShortCode {
        
    }

}