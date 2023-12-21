<?php

class CynicPricingGrids {

    public function __construct() {
        add_shortcode('cynic_price_table', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            /* Get all pages */
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->ID;
                }
            }

            $args = array(
                'base' => 'cynic_price_table',
                'name' => __('Pricing Grid', 'cynic'),
                "category" => __("Cynic Modern", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Icon library', 'cynic'),
                        'value' => array(
                            __('Linear Icons', 'cynic') => 'linearicons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                            __('Flat Icons', 'cynic') => 'flaticon',
                        ),
                        'admin_label' => true,
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-adjust',
                        // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => false,
                            'iconsPerPage' => 400,
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'fontawesome',
                        ),
                        'description' => __('Select icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_linearicons',
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'linearicons',
                            'iconsPerPage' => 200, // default 100, how many icons per/page to display
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'linearicons',
                        ),
                        'value' => 'icon-users2',
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Select a Icon.', 'cynic'),
                        'param_name' => 'icon_flaticon',
                        'value' => 'flaticon-building-4',
                        'settings' => array(
                            'emptyIcon' => false,
                            'iconsPerPage' => 200,
                            'type' => 'flaticon',
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'flaticon',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'icon_title',
                        'type' => 'textfield',
                        'heading' => __('Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'price',
                        'type' => 'textfield',
                        'heading' => __('Price', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'price_list',
                        'type' => 'textarea',
                        'heading' => __('Price List', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'button_text',
                        'type' => 'textfield',
                        'heading' => __('Button Text', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
                        )
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Internal Link',
                        'type' => 'dropdown',
                        'param_name' => 'internal_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '1',
                        ),
                        'value' => $pagearr,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'External Link',
                        'type' => 'textfield',
                        'param_name' => 'external_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '2',
                        ),
                        'value' => '#',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
                        ),
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'icon_title' => '',
            'price' => '',
            'icon_type' => '',
            'icon_linearicons' => '',
            'icon_fontawesome' => '',
            'icon_flaticon' => '',
            'price_list' => '',
            'button_text' => '',
            'button_link' => '1',
            'internal_link' => '',
            'external_link' => '#',
            'open_type' => '0',
                ), $atts);
        extract($atts);
        if (function_exists('vc_icon_element_fonts_enqueue')) {
            vc_icon_element_fonts_enqueue($icon_type);
        }
        if ($icon_type == 'fontawesome') {
            $iconclass = 'fa ' . $icon_fontawesome;
        } else if ($icon_type == 'flaticon') {
            $iconclass = "flaticon-building-4";
            if (!empty($icon_flaticon)) {
                $iconclass = $icon_flaticon;
            }
        } else {
            $iconclass = $icon_linearicons;
        }
        $newPriceArray = array();
        if(isset($price_list) && !empty($price_list)){
            $price_list = nl2br($price_list);
            $price_list = preg_replace("<br>", "***", $price_list);
            $newPriceArray = explode('<*** />', $price_list);
        }
        ob_start();
        ?>
        <ul class="pricing pricing-height">
            <li class="price">
                <i class="<?php echo esc_attr($iconclass); ?>"></i>
                <?php echo esc_html($icon_title); ?> <span><?php echo html_entity_decode(esc_html($price)); ?></span>
            </li>
            <?php
            if (isset($newPriceArray) && !empty($newPriceArray)) {
                foreach ($newPriceArray as $price) {
                    ?>
                    <li><?php echo html_entity_decode(esc_html($price)); ?></li>
                    <?php
                }
            }
            ?>
        </ul>
        <!-- End of .pricing -->
        <?php
        $_target=""; 
        if (isset($open_type) && $open_type == '1') { 
            $_target = 'target="_blank"'; 
        } 
        if(isset($button_link) && $button_link=="#onepage-contact"){
            $link = $button_link;
        }else{
            $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; 
        }?>
        <a href="<?php echo $link; ?>" <?php echo $_target; ?> class="page-scroll-kickass btn btn-fill"><?php echo (isset($button_text) && !empty($button_text)) ? esc_html($button_text) : esc_html__("KICKSTART YOUR BUSINESS", "cynic"); ?></a>
        <?php
        return ob_get_clean();
    }

}
