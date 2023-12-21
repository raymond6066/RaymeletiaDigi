<?php

class CynicServiceGrid {

    public function __construct() {
        add_shortcode('cynic_service', array($this, 'shortcodecb'));
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
                'base' => 'cynic_service',
                'name' => __('Service Box', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Heading', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Icon library', 'cynic'),
                        'value' => array(
                            __('Linear Icons', 'cynic') => 'linearicons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                        ),
                        'admin_label' => true,
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Service Icon', 'cynic'),
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
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Service Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-adjust',
                        // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => false,
                            // default true, display an "EMPTY" icon?
                            'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'fontawesome',
                        ),
                        'description' => __('Select icon from library.', 'cynic'),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Layout Style',
                        'type' => 'dropdown',
                        'param_name' => 'layout_style',
                        'value' => array(
                            'Layout 1' => '1',
                            'Layout 2' => '2',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Content',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Listing Page"),
                        "param_name" => "internal_link",
                        "admin_label" => true,
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '1',
                        ),
                        'value' => $pagearr,
                        "description" => __("Please choose the page to display in service.")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("External Link"),
                        "param_name" => "external_link",
                        "admin_label" => true,
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '2',
                        ),
                        'value' => '',
                        "description" => __("Please place the external link here.")
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
            'title' => '',
            'icon_type' => 'linearicons',
            'icon_linearicons' => '',
            'icon_fontawesome' => '',
            'layout_style' => '1',
            'button_link' => '#',
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
        } else {
            $iconclass = $icon_linearicons;
        }
        ob_start();
        $_target = "";
        if (isset($open_type) && $open_type == '1') { 
            $_target = 'target="_blank"';
        }
        $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; 
        if ($layout_style == 1) {
            $linkprefix = '<div class="service-title-section">';
            $linksuffix = '</div>';
            $linkprefix = '<a href="' . $link . '" '.$_target.'>';
            $linksuffix = '</a>'; ?>
            <div class="service-box">
                <div class="box-green-border service-height"> <?php echo $linkprefix ?><span class="<?php echo esc_attr($iconclass) ?>"></span>
                    <div class="service-title"><?php echo esc_html($title) ?></div><?php echo $linksuffix ?>
                    <?php echo apply_filters('the_content', $content); ?>
                </div>
            </div>
            <?php
        } else {
            $linkprefix = $linksuffix = '';
            ?>
            <a href="<?php echo esc_url($link)?>" <?php echo $_target; ?> class="about-box about-height">
                <div  class="round-icon-wrapper"><span class="<?php echo esc_attr($iconclass) ?>"></span></div>
                <h3><?php echo $linkprefix ?><?php echo esc_html($title) ?><?php echo $linksuffix ?></h3>
                <div class="regular-text"><?php echo apply_filters('the_content', $content); ?></div>
            </a>
            <?php
        }
        return ob_get_clean();
    }

}
