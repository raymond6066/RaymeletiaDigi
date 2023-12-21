<?php

class CynicContentBlock
{

    public function __construct()
    {
        add_shortcode('cynic_content', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $pagearr = cynic_get_pages();
            $args = array(
                'base' => 'cynic_content',
                'name' => __('Content Block', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textarea',
                        'heading' => __('Lead Title', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Content Description',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'heading' => __('Block Banner Image', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'heading' => 'Image Position',
                        'type' => 'dropdown',
                        'param_name' => 'position',
                        'value' => array(
                            'Left' => '1',
                            'RIght' => '2',
                        ),
                    ),
                    array(
                        'heading' => 'Background Video',
                        'type' => 'dropdown',
                        'param_name' => 'bg_video',
                        'value' => array(
                            'Yes' => '1',
                            'No' => '2',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Video Link',
                        'type' => 'textarea',
                        'param_name' => 'video_link',
                        'dependency' => array(
                            'element' => 'bg_video',
                            'value' => '1',
                        ),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Link/Button Text',
                        'type' => 'textfield',
                        'param_name' => 'link_text'
                    ),
                    array(
                        "holder" => "",
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Select One' => '',
                            'Internal Link' => '1',
                            'External Link' => '2',
                            'Bookmark' => '3'
                        ),
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
                        "holder" => "",
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
                        "holder" => "",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
                        ),
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => array('1', '2'),
                        ),
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Bullet Points', 'cynic'),
                        'param_name' => 'features',
                        'params' => array(
                            array(
                                'type' => 'iconpicker',
                                'heading' => __('Social Icon', 'cynic'),
                                'param_name' => 'icon_fontawesome',
                                'value' => 'fab fa-twitter',
                                'settings' => array(
                                    'emptyIcon' => false,
                                    'type' => 'fontawesomeicons',
                                    'iconsPerPage' => 400,
                                ),
                                'description' => __('Select icon from library.', 'cynic'),
                            ),
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Bullet Text', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'bullet_text',
                                'description' => __('Bulllet text here.', 'cynic'),
                                'admin_label' => true,
                            ),
                        )
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'title' => '',
                'image' => '',
                'position' => '1',
                'bg_video' => '1',
                'video_link' => '',
                'link_text' => 'Learn More',
                'button_link' => '',
                'internal_link' => '#',
                'external_link' => '#',
                'bookmark_link' => '#',
                'open_type' => '',
                'features' => ''
            ), $atts);
        extract($atts);
        ob_start();
        $get_image_url = wp_get_attachment_url($image);
        $class1 = "";
        $class2 = "";
        if (isset($position) && $position == 2) {
            $class1 = "order-lg-2 offset-lg-1 text-lg-right";
            $class2 = "";
        } else {
            $class1 = "text-lg-left";
            $class2 = "offset-lg-1";
        }
        $features = vc_param_group_parse_atts($features);


        $bullets = ($features && count($features)) ? count($features) : '';


        ?>
        <div class="container">
            <div class="features-grid">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center <?php echo esc_attr($class1) ?>">
                        <div class="img-container">
                            <img src="<?php echo esc_url($get_image_url); ?>" alt="<?php echo esc_html($title); ?>"
                                 class="img-fluid">
                            <?php if (isset($bg_video) && $bg_video == 1 && !empty($video_link)) { ?>
                                <a href="<?php echo esc_url($video_link) ?>"
                                   class="video-popup feature-video-popup"></a>
                            <?php } ?>
                        </div>
                        <!-- End of .img-container -->
                    </div>
                    <!-- End of .col-lg-6 -->
                    <div class="col-lg-5 <?php echo esc_attr($class2) ?>">
                        <div class="features-content text-center text-lg-left">
                            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
                            <p><?php echo html_entity_decode(cynic_nl2br($content)); ?></p>
                            <?php
                            if (!empty($button_link)) {
                                $link = cynic_get_links($button_link, $internal_link, $external_link);
                                $page_scroll = ($button_link == 3) ? "page-scroll" : "";
                                if ($button_link == 3) {
                                    $link = $bookmark_link;
                                }
                                if (!empty($link)) { ?>
                                    <a href="<?php echo esc_url($link); ?>"
                                       class="hyperlink <?php echo esc_attr($page_scroll) ?>"><?php echo esc_attr($link_text); ?></a>
                                    <?php
                                }
                            }
                            if(isset($features[0]) && !empty($features[0])) { ?>
                                <ul class="feature-list">
                                    <?php
                                    foreach($features as $feature) {
                                        if(!empty($feature['bullet_text'])) { ?>
                                            <li>
                                                <i class="<?php echo esc_attr($feature['icon_fontawesome']); ?>"></i><?php echo $feature['bullet_text']; ?>
                                            </li>
                                            <?php
                                        }
                                    } ?>
                                </ul>
                                <!-- End of .feature-list -->
                                <?php
                            } ?>
                        </div>
                        <!-- End of .features-content -->
                    </div>
                    <!-- End of .col-lg-6 -->
                </div>
                <!-- End of .row -->
            </div>
            <!-- End of .features-grid -->
        </div>

        <?php
        return ob_get_clean();
    }

}
