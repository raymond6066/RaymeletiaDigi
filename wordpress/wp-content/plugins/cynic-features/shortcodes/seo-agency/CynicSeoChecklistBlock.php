<?php

class CynicSeoChecklistBlock
{

    protected $per_row;

    public function __construct()
    {
        add_shortcode('cynic_seo_checklists', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_checklist', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'name' => __('Checklist Block', 'cynic'),
                'base' => 'cynic_seo_checklists',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_checklist'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                        'heading' => __('Show per row', 'cynic'),
                        'admin_label' => true,
                        'param_name' => 'per_row',
                        'description' => __('Select grid per row.', 'cynic'),
                        'value' => array(1, 2, 3, 4),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_checklist',
                'name' => __('SEO Checklist Bullet Points', 'cynic'),
                "category" => __("Cynic SEO Checklist", "cynic"),
                "as_child" => array('only' => 'cynic_seo_checklists'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(

                    array(
                        'holder' => 'h2',
                        'type' => 'textfield',
                        'heading' => __('Checklist Title', 'cynic'),
                        'param_name' => 'checklist_title',
                        'description' => __('Display checklist title.', 'cynic'),
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Icon library for list', 'cynic'),
                        'value' => array(
                            __('Default', 'cynic') => 'default',
                            __('Linear Icons', 'cynic') => 'caviaricons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                        ),
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
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
                        'value' => 'icon-Tick',
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-bullhorn',
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
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Checklist Bullet Points', 'cynic'),
                        'param_name' => 'bullet_points',
                        'params' => array(
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('List Item', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'list_item',
                                'description' => __('Tab inner content description.', 'cynic'),
                                'admin_label' => true,
                            ),
                        )
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
                'per_row' => '2',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $per_row = $attributes['per_row'];

        $rows = 'col-md-6';
        if ($per_row == 1) {
            $rows = 'col-md-12';
        } elseif ($per_row == 2) {
            $rows = 'col-md-6';
        } elseif ($per_row == 3) {
            $rows = 'col-md-4';
        } elseif ($per_row == 4) {
            $rows = 'col-md-3';
        }
        $this->per_row = $rows;
        $content = do_shortcode($content);

        ob_start(); ?>
        <div class="container <?php echo esc_attr($extra_class); ?>">
            <div class="row">
                <?php echo $content; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'checklist_title' => '',
                'icon_type' => 'default',
                'icon_caviaricons' => 'icon-Tick',
                'icon_fontawesome' => 'fa fa-bullhorn',
                'bullet_points' => []
            ), $atts);
        $checklist_title = $attributes['checklist_title'];
        $icon_type = $attributes['icon_type'];
        $icon_caviaricons = $attributes['icon_caviaricons'];
        $icon_fontawesome = $attributes['icon_fontawesome'];
        $bullet_points = vc_param_group_parse_atts($attributes['bullet_points']);

        $iconshtml = '';
        $ulClassIcons = 'cynic-modern-icons';
        if ($icon_type == 'fontawesome') {
            $iconshtml = '<i class="' . $icon_fontawesome . '"></i> ';
        } elseif ($icon_type == 'caviaricons') {
            $iconshtml = '<i class="' . $icon_caviaricons . '"></i> ';
        } else {
            $ulClassIcons = 'checklist-list-group';
        }
        ob_start();
        if (count($bullet_points) > 0):
            ?>
            <div class="<?php echo esc_attr($this->per_row); ?>">
                <div class="content">
                    <h3><?php echo esc_html($checklist_title); ?></h3>
                    <ul class="<?php echo esc_attr($ulClassIcons); ?>">
                        <?php
                        foreach ($bullet_points as $point) {
                            echo '<li>' . $iconshtml . html_entity_decode(esc_html($point['list_item'])) . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        endif;
        return ob_get_clean();
    }
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_cynic_seo_checklists extends WPBakeryShortCodesContainer
    {

    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_cynic_seo_checklist extends WPBakeryShortCode
    {

    }
}