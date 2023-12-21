<?php

class CynicTeamMembers
{

    protected $layouts;
    protected $showPerRow;
    protected $identity;

    public function __construct()
    {
        add_shortcode('cynic_team_members', array($this, 'shortcodecb'));
        add_shortcode('cynic_team_member', array($this, 'shortcodechildcb'));
        add_action('wp_footer', array($this, 'cynic_footer_modals'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'name' => __('Team Members', 'cynic'),
                'base' => 'cynic_team_members',
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_team_member'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => false,
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        "holder" => "h2",
                        'type' => 'dropdown',
                        "class" => "cynic_vc_parent_padding",
                        'heading' => __('Select Layout', 'cynic'),
                        'value' => array(
                            __('Select Layout', 'cynic') => '',
                            __('Onepage Layout', 'cynic') => '1',
                            __('Multipage Layout', 'cynic') => '2',
                        ),
                        'admin_label' => true,
                        'param_name' => 'layouts',
                        'description' => __('Select layouts for different agencies.', 'cynic'),
                    ),

                    array(
                        "holder" => "h2",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Title Text', 'cynic'),
                    ),


                    array(
                        'type' => 'dropdown',
                        "class" => "cynic_vc_parent_padding",
                        'heading' => __('Show Per Row', 'cynic'),
                        'value' => array(
                            __('Select', 'cynic') => '',
                            __('Three', 'cynic') => '3',
                            __('Four', 'cynic') => '4',
                            __('Six', 'cynic') => '6',
                        ),
                        'param_name' => 'show_per_row',
                        'admin_label' => true,
                        'dependency' => array(
                            'element' => 'layouts',
                            'value' => '2',
                        ),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_team_member',
                'name' => __('Team Profile', 'cynic'),
                "category" => __("Cynic Trendy", "cynic"),
                "as_child" => array('only' => 'cynic_team_members'),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
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
                        'heading' => 'Avator',
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    ),

                    array(
                        "holder" => "p",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'fullname',
                        'type' => 'textfield',
                        'heading' => __('Full Name', 'cynic'),
                    ),

                    array(
                        "holder" => "",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'designation',
                        'type' => 'textfield',
                        'heading' => __('Designation', 'cynic'),
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Bio',
                        'type' => 'textarea',
                        'param_name' => 'bio_info',
                        'value' => '',
                    ),

                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Social Links', 'cynic'),
                        'param_name' => 'member_socials',
                        'params' => array(
                            array(
                                "holder" => "h2",
                                "class" => "",
                                'param_name' => 'social_link',
                                'type' => 'textfield',
                                'heading' => __('Social URL', 'cynic'),
                                'admin_label' => true,
                                'value' => '#'
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Icon library for Social Icons', 'cynic'),
                                'value' => array(
                                    __('Font Awesome', 'cynic') => 'fontawesome_icons',
                                    __('Miniline Icons', 'cynic') => 'miniline_icons',
                                ),
                                'param_name' => 'icon_type',
                                'description' => __('Select icon library.', 'cynic'),
                            ),

                            array(
                                'type' => 'iconpicker',
                                'heading' => __('Social Icon', 'cynic'),
                                'param_name' => 'icon_miniline',
                                'settings' => array(
                                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                                    'type' => 'minilineicons',
                                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                                ),
                                'dependency' => array(
                                    'element' => 'icon_type',
                                    'value' => 'miniline_icons',
                                ),
                                'value' => 'ml-baftwo-45-umbrella-secure-protect-rain',
                                'description' => __('Select service icon from library.', 'cynic'),
                            ),

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
                                'dependency' => array(
                                    'element' => 'icon_type',
                                    'value' => 'fontawesome_icons',
                                ),
                                'description' => __('Select icon from library.', 'cynic'),
                            ),
                            array(
                                "holder" => "",
                                "class" => "",
                                'param_name' => 'soical_link_hover',
                                'type' => 'colorpicker',
                                "value" => '#3b5998',
                                'heading' => __('Icon Hover Background Color', 'cynic'),
                            ),

                        ),
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
                'layouts' => '',
                'title' => '',
                'show_per_row' => '',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $layouts = $attributes['layouts'];
        $title = $attributes['title'];
        $show_per_row = $attributes['show_per_row'];

        $this->layouts = $layouts;
        $this->showPerRow = $show_per_row;


        ob_start();
        $bubble_colors = getCynicOptionsVal('shape-color');
        $get_colors = get_bubble_color($bubble_colors);

        if ($layouts == 2) {
            ?>
            <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" width="779px"
                 height="759px">
                <defs>
                    <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_03)"
                      d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"/>
            </svg>
            <div class="container <?php echo esc_attr($extra_class) ?>">
                <?php
                if ($title):
                    ?>
                    <h2><?php echo cynic_nl2br($title); ?></h2>
                <?php endif ?>
                <div class="team-grid">
                    <div class="row">
                        <?php echo do_shortcode($content); ?>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="trigger-team"></div>
            <svg class="bg-shape shape-team reveal-from-left" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" width="779px"
                 height="759px">
                <defs>
                    <linearGradient id="PSgrad_05" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="1"/>
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="0"/>
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_05)"
                      d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>

            <svg class="bg-shape shape-team-2 shape-2 reveal-from-bottom" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_06" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="1"/>
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_06)"
                      d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"/>
            </svg>
            <?php
            if ($title):
                ?>
                <div class="container <?php echo esc_attr($extra_class) ?>">
                    <h2><?php echo cynic_nl2br($title); ?></h2>
                </div>
            <?php endif ?>
            <div class="team-slider common-slider">
                <div class="carousel-container">
                    <?php echo do_shortcode($content); ?>
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        $this->layouts = '';
        $this->showPerRow = '';
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'image' => '',
                'fullname' => '',
                'designation' => '',
                'bio_info' => '',
                'member_socials' => array(),
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $image = $attributes['image'];
        $fullname = $attributes['fullname'];
        $designation = $attributes['designation'];
        $bio_info = $attributes['bio_info'];
        if (count($attributes['member_socials']) > 0) {
            $member_socials = vc_param_group_parse_atts($attributes['member_socials']);
        }

        if ($this->layouts == 2) {
            if ($this->showPerRow == 3) {
                $extra_class .= " col-md-6 col-lg-4";
            } elseif ($this->showPerRow == 4) {
                $extra_class .= " col-md-6 col-lg-3";
            } elseif ($this->showPerRow == 6) {
                $extra_class .= " col-md-6 col-lg-2";
            }
        }
        ob_start();
        ?>
        <div class="item <?php echo esc_attr($extra_class); ?> cynic_team_vc_element">
            <a href="#" class="team-content-block content-block cynic_team_modal"
               data-bio="<?php echo esc_html($bio_info); ?>" data-fullname="<?php echo esc_html($fullname); ?>"
               data-designation="<?php echo esc_html($designation); ?>">
                <div class="img-container">
                    <?php
                    echo wp_get_attachment_image($image, 'full', false, ['class' => 'img-fluid']);
                    ?>
                </div>
            </a>
            <div class="socialmediacontainer d-none">
                <?php if (count($member_socials) > 0) {
                    $media_attribute = getCynicOptionsVal('social-media-color');
                    $social_icon_color = !empty($media_attribute) ? $media_attribute : "#a6d1ed"; ?>
                    <ul class="social-icons">
                        <?php
                        foreach ($member_socials as $social) {
                            $social_icon = ($social['icon_type'] == 'miniline_icons') ? $social['icon_miniline'] : $social['icon_fontawesome'];
                            $social_link = (isset($social['social_link']) && !empty($social['social_link'])) ? $social['social_link'] : '#';
                            $soical_link_hover = (isset($social['soical_link_hover']) && !empty($social['soical_link_hover'])) ? $social['soical_link_hover'] : '#3b5998';
                            ?>
                            <li><a onMouseOver="this.style.background='<?php echo esc_attr($soical_link_hover) ?>'"
                                   onMouseOut="this.style.background='<?php echo esc_attr($social_icon_color); ?>'"
                                   style="background: <?php echo esc_attr($social_icon_color); ?>"
                                   href="<?php echo esc_url($social_link) ?>" target="_blank" rel="noopener"><i
                                            class="<?php echo esc_attr($social_icon) ?>"></i></a></li>
                        <?php } ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
            <h5>
                <a href="#">
                    <?php echo esc_html($fullname); ?>
                    <span class="content-block__sub-title"><?php echo esc_html($designation); ?></span>
                </a>
            </h5>
        </div>
        <?php
        return ob_get_clean();
    }

    function cynic_footer_modals()
    {
        $shape_colors = getCynicOptionsVal('shape-color');
        $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
        $get_colors = get_bubble_color($bubble_colors); ?>
        <!-- Featured-designs modal -->
        <div class="modal fade team-modal cynic_feature_team_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <svg class="team-modal-bg" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" width="379px" height="369px">
                            <defs>
                                <linearGradient id="PSgrad_020" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                    <stop offset="0%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="1"/>
                                    <stop offset="100%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                            <path fill-rule="evenodd" fill="url(#PSgrad_020)"
                                  d="M54.086,281.380 L105.962,327.505 C173.075,387.178 276.496,381.853 336.956,315.610 C397.418,249.367 392.025,147.292 324.911,87.619 L273.035,41.495 C205.921,-18.178 102.501,-12.853 42.040,53.390 C-18.422,119.633 -13.028,221.708 54.086,281.380 Z"/>
                        </svg>
                        <!-- End of .modal-bg -->

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ml-symtwo-24-multiply-cross-math"></i>
                        </button>
                        <!-- End of .close -->
                    </div>
                    <!-- End of .modal-header -->

                    <div class="modal-body">
                    </div>
                    <!-- End of .modal-body -->
                </div>
                <!-- End of .modal-content -->
            </div>
            <!-- End of .modal-dialog -->
        </div>
        <!-- End of .modal -->
        <?php
    }
}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_team_members extends WPBakeryShortCodesContainer
    {

        public function contentAdmin($atts, $content = null)
        {
            $width = '';

            $atts = shortcode_atts($this->predefined_atts, $atts);
            extract($atts);
            $this->atts = $atts;
            $output = '';

            $output .= '<div ' . $this->mainHtmlBlockParams($width, 1) . '>';
            if ($this->backened_editor_prepend_controls) {
                $output .= $this->getColumnControls($this->settings('controls'));
            }
            $output .= '<div class="wpb_element_wrapper">';

            if (isset($this->settings['custom_markup']) && '' !== $this->settings['custom_markup']) {
                $markup = $this->settings['custom_markup'];
                $output .= $this->customMarkup($markup);
            } else {
                $output .= $this->outputTitle($this->settings['name']);
                $output .= $this->paramsHtmlHolders($atts);
                $output .= '<div ' . $this->containerHtmlBlockParams($width, 1) . '>';
                $output .= do_shortcode(shortcode_unautop($content));
                $output .= '</div>';
            }

            $output .= '</div>';
            if ($this->backened_editor_prepend_controls) {
                $output .= $this->getColumnControls('add', 'bottom-controls');

            }
            $output .= '</div>';

            return $output;
        }
    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_team_member extends WPBakeryShortCode
    {

    }


}
