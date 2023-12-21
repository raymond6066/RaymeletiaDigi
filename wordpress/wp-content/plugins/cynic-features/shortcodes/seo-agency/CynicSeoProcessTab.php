<?php

class CynicSeoProcessTab
{
    protected $tabnavs = '', $tabcount = 0, $designlayout = '1';

    public function __construct()
    {
        add_shortcode('cynic_seo_process_tabs', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_process_tab', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('Process Tab', 'cynic'),
                'base' => 'cynic_seo_process_tabs',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_process_tab'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
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
                        'type' => 'dropdown',
                        'heading' => __('Layout', 'cynic'),
                        'admin_label' => true,
                        'param_name' => 'design_layout',
                        'description' => __('Select Design Layout.', 'cynic'),
                        'value' => array(
                            __('Layout 1', 'cynic') => '1',
                            __('Layout 2', 'cynic') => '2',
                        ),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_process_tab',
                'name' => __('Tab Item', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_process_tabs'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => __('Tab Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'tab_label',
                        'value' => '',
                        'description' => __('Tab Label text.', 'cynic'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Icon library', 'cynic'),
                        'value' => array(
                            __('Caviar Icons', 'cynic') => 'caviaricons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                            __('Image Icon', 'cynic') => 'image_icon',
                        ),
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-adjust',
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
                        'param_name' => 'icon_caviaricons',
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'caviaricons',
                            'iconsPerPage' => 200, // default 100, how many icons per/page to display
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'caviaricons',
                        ),
                        'value' => 'icon-users2',
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),

                    array(
                        'type' => 'attach_image',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_image',
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'image_icon',
                        ),
                        'value' => '',
                        'description' => __('Select service icon from Image Library.', 'cynic'),
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => '',
                        'description' => __('Tab content title.', 'cynic'),
                        'admin_label' => true,
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Description', 'cynic'),
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'description' => __('Tab content description.', 'cynic'),
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Image', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __('Select Tab content image.', 'cynic'),
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
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = array())
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'design_layout' => '1',
            ), $atts);
        $extra_class = $attributes['extra_class'];
        $design_layout = $attributes['design_layout'];
        $this->designlayout = $design_layout;

        $content = do_shortcode($content);
        ob_start(); ?>
        <div class="tab-container type-<?php echo esc_attr($design_layout); ?> <?php echo esc_attr($extra_class); ?>">
            <?php if (isset($design_layout) && $design_layout == 2) { ?>
            <div class="container">
                <?php } ?>
                <ul class="nav nav-tabs row no-gutters" id="ppc-process-tab" role="tablist">
                    <?php echo esc_html_cynicSEO_string($this->tabnavs); ?>
                </ul>
                <div class="tab-content" id="process-tab-content">
                    <p><?php echo apply_filters('the_content', $content); ?></p>
                </div>
                <?php if (isset($design_layout) && $design_layout == 2) { ?>
            </div>
        <?php } ?>
        </div>
        <?php
        $this->tabcount = 0;
        $this->tabnavs = '';
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'tab_label' => '',
                'icon_type' => 'caviaricons',
                'icon_fontawesome' => '',
                'icon_caviaricons' => '',
                'icon_image' => '',
                'title' => '',
                'image' => '',
                'image_position' => '2',
            ), $atts);

        $tab_label = $attributes['tab_label'];
        $icon_type = $attributes['icon_type'];
        $icon_fontawesome = $attributes['icon_fontawesome'];
        $icon_caviaricons = $attributes['icon_caviaricons'];
        $icon_image = $attributes['icon_image'];
        $title = $attributes['title'];
        $image = $attributes['image'];
        $image_position = $attributes['image_position'];


        $text_positionClass = ($image_position == 1) ? ' order-md-2' : '';
        $img_positionClass = ($image_position == 1) ? ' order-md-1' : '';

        $tab_icon = (!empty($icon_caviaricons)) ? $icon_caviaricons : ((!empty($icon_fontawesome)) ? $icon_fontawesome : 'icon-Add-Contacts');

        if ($icon_type == 'caviaricons') {
            $iconsHtml = '<i class="grad-icon ' . $tab_icon . '"></i>';
        } elseif ($icon_type == 'image_icon' && !empty($icon_image)) {
            $iconsHtml = wp_get_attachment_image($icon_image, 'full', true);
        } else {
            $iconsHtml = '<i class="' . $tab_icon . '"></i>';
        }

        $tabactivecls = '';
        $tabNavActiveCls = '';
        if ($this->tabcount == 0) {
            $tabactivecls = 'show active current';
            $tabNavActiveCls = 'active';
        }
        $tabid = uniqid(rand(000000, 999999));
        ob_start();
        ?>

        <li class="nav-item col">
            <a class="nav-link <?php echo esc_attr($tabNavActiveCls); ?>"
               id="process-tab-<?php echo esc_attr($tabid); ?>" data-toggle="tab"
               href="#process-content-<?php echo esc_attr($tabid); ?>" role="tab"
               aria-controls="process-content-<?php echo esc_attr($tabid); ?>"
               aria-selected="true">
                <?php

                if ($this->designlayout == 2) {
                    ?>
                    <div class="img-container">
                        <?php echo esc_html_cynicSEO_string($iconsHtml); ?>
                    </div>
                    <?php
                } else {
                    ?>

                    <?php echo esc_html_cynicSEO_string($iconsHtml); ?>

                    <?php
                }
                ?>


                <span><?php echo esc_html($tab_label); ?></span>
            </a>
        </li>
        <?php
        $this->tabnavs .= ob_get_clean();
        ob_start(); ?>
        <div class="tab-pane fade <?php echo esc_attr($tabactivecls) ?>"
             id="process-content-<?php echo esc_attr($tabid) ?>" role="tabpanel"
             aria-labelledby="process-content-<?php echo esc_attr($tabid) ?>">
            <div class="row">
                <div class="col-md text-left <?php echo esc_attr($text_positionClass); ?>">
                    <div class="text-content">
                        <h3><?php echo esc_html_cynicSEO_string($title); ?></h3>
                        <?php echo apply_filters('the_content', $content); ?></div>
                </div><!-- End of .col-sm -->
                <div class="col-md <?php echo esc_attr($img_positionClass); ?>">
                    <div class="svg-container text-center">
                        <?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'img-fluid', 'alt' => '' . $title . '')); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $this->tabcount++;
        return ob_get_clean();

    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_process_tabs extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_seo_process_tab extends WPBakeryShortCode
    {

    }


}
