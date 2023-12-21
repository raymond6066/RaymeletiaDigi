<?php

class CynicSeoLeftRightContentWithImage
{

    public function __construct()
    {
        add_shortcode('cynic_seo_left_right_content_image', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_seo_left_right_content_image',
                'name' => __('Left Right Content with Image', 'cynic'),
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
                        'type' => 'dropdown',
                        'heading' => __('Image Position', 'cynic'),
                        'value' => array(
                            __('Select Position', 'cynic') => '',
                            __('Left', 'cynic') => '1',
                            __('Right', 'cynic') => '2',
                        ),
                        'admin_label' => true,
                        'param_name' => 'image_position',
                        'description' => __('Select Image Position.', 'cynic'),
                    ),

                    array(
                        "holder" => "h2",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Title', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Title Tag', 'cynic'),
                        'value' => array(
                            __('Select Tag', 'cynic') => '',
                            __('h1', 'cynic') => 'h1',
                            __('h2', 'cynic') => 'h2',
                            __('h3', 'cynic') => 'h3',
                            __('h4', 'cynic') => 'h4',
                            __('h5', 'cynic') => 'h5',
                            __('h6', 'cynic') => 'h6',
                        ),
                        'admin_label' => true,
                        'param_name' => 'title_tag',
                        'description' => __('Select title wrapper tag.', 'cynic'),
                    ),

                    array(
                        "holder" => "p",
                        "class" => "",
                        'heading' => 'Short Description',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Icon library for list', 'cynic'),
                        'value' => array(
                            __('Default', 'cynic') => 'default',
                            __('Icons', 'cynic') => 'icons',
                        ),
                        'param_name' => 'icon_option',
                        'description' => __('Select icon library.', 'cynic'),
                    ),

                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('List Items', 'cynic'),
                        'param_name' => 'items_default',
                        'dependency' => array(
                            'element' => 'icon_option',
                            'value' => 'default',
                        ),
                        'params' => array(
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Short Description', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'short_content',
                                'description' => __('Content description.', 'cynic'),
                                'admin_label' => true,
                            ),
                        ),
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('List Items', 'cynic'),
                        'param_name' => 'items_icons',
                        'dependency' => array(
                            'element' => 'icon_option',
                            'value' => 'icons',
                        ),
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Icon library for list', 'cynic'),
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
                                'heading' => __('List Icon', 'cynic'),
                                'param_name' => 'icon_fontawesome',
                                'value' => 'fa fa-check',
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
                                'heading' => __('List Icon', 'cynic'),
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
                                'value' => 'icon-Add-Contacts',
                                'description' => __('Select service icon from library.', 'cynic'),
                            ),

                            array(
                                'type' => 'attach_image',
                                'heading' => __('List Icon', 'cynic'),
                                'param_name' => 'icon_image',
                                'dependency' => array(
                                    'element' => 'icon_type',
                                    'value' => 'image_icon',
                                ),
                                'value' => '',
                                'description' => __('Select service icon from Image Library.', 'cynic'),
                            ),

                            array(
                                "holder" => "p",
                                "class" => "",
                                'heading' => __('Short Description', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'short_content',
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

    public function shortcodecb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'image' => '',
                'image_position' => '2',
                'title' => '',
                'title_tag' => 'h3',
                'content' => '',
                'icon_option' => 'default',
                'items_default' => '',
                'items_icons' => '',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $image = $attributes['image'];
        $image_position = $attributes['image_position'];
        $title_tag = $attributes['title_tag'];
        $orderClass = '';
        if ($image_position == 1) {
            $orderClass = ' order-md-1';
        }
        $title = $attributes['title'];
        $short_description = do_shortcode($content);
        $icon_option = $attributes['icon_option'];
        $listUlClass = '';
        if ($icon_option == 'icons') {
            $listUlClass = 'list-group-with-icons';
        }

        $items_default = $attributes['items_default'];
        $items_icons = $attributes['items_icons'];
        if (!empty($items_default)) {
            $items = vc_param_group_parse_atts($items_default);
        } elseif (!empty($items_icons)) {
            $items = vc_param_group_parse_atts($items_icons);
        }
        if (!isset($items)) {
            return false;
        }
        ob_start();
        ?>

        <div class="details-block-content <?php echo esc_attr($extra_class); ?>">
            <div class="row align-items-center">
                <div class="col-md-6 <?php echo esc_attr($orderClass); ?>">
                    <div class="text-content">
                        <<?php echo esc_attr($title_tag) ?>
                        > <?php echo esc_html_cynicSEO_string($title); ?> </<?php echo esc_attr($title_tag) ?>>
                    <p><?php echo esc_html_cynicSEO_string($short_description); ?></p>
                    <?php
                    if (!empty(isset($items) && !empty($items))):
                        ?>
                        <ul class="case-study-list-group <?php echo esc_attr($listUlClass); ?>">
                            <?php
                            foreach ($items as $item):
                                $iconshtml = '';
                                if (count($item) == 0) {
                                    continue;
                                }
                                if ($icon_option == 'icons') {
                                    $icon_type = $item['icon_type'];
                                    $icon_image = (isset($item['icon_image'])) ? $item['icon_image'] : '';

                                    if ($icon_type == 'fontawesome') {
                                        $iconshtml = '<i class="' . $item['icon_fontawesome'] . '"></i> ';
                                    } elseif ($icon_type == 'caviaricons') {
                                        $iconshtml = '<i class="' . $item['icon_caviaricons'] . '"></i> ';
                                    } elseif ($icon_type == 'image_icon' && !empty($icon_image)) {
                                        $iconshtml = wp_get_attachment_image($icon_image, 'full', true);
                                    } else {
                                        $iconshtml = '<i class="' . $item['icon_caviaricons'] . '"></i> ';
                                    }
                                }
                                ?>
                                <li><?php echo esc_html_cynicSEO_string($iconshtml);
                                    echo esc_html_cynicSEO_string($item['short_content']); ?></li>
                                <?php
                            endforeach;
                            ?>
                        </ul>
                        <?php
                    endif;
                    ?>
                </div>
                <!-- End of .text-content -->
            </div>
            <!-- End of .col-md-6 -->

            <div class="col-md-6">
                <div class="img-container">
                    <?php echo wp_get_attachment_image($image, 'full', false, ['alt' => $title, 'class' => 'img-fluid']); ?>
                </div>
                <!-- End of .img-container -->
            </div>
            <!-- End of .col-md-6 -->
        </div>
        <!-- End of .row -->
        </div>
        <?php
        return ob_get_clean();
    }

}


