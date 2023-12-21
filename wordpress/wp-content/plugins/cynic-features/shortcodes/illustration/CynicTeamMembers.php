<?php

class CynicTeamMembers
{

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
                "category" => __("Illustration", "cynic"),
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
                "category" => __("Illustration", "cynic"),
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
                        'heading' => 'Avatar',
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
                            )
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
                'title' => '',
                'show_per_row' => '',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        $show_per_row = $attributes['show_per_row'];

        $this->showPerRow = $show_per_row;

        ob_start(); ?>

        <div class="container <?php echo esc_attr($extra_class) ?>">
            <div class="grid-wrapper">
                <div class="row">
                    <?php echo do_shortcode($content); ?>
                </div>
            </div>
        </div>

        <?php
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
        if (!empty($attributes['member_socials'])) {
            $member_socials = vc_param_group_parse_atts($attributes['member_socials']);
        }

        if ($this->showPerRow == 3) {
            $extra_class .= " col-md-4";
        } elseif ($this->showPerRow == 4) {
            $extra_class .= " col-md-3";
        } elseif ($this->showPerRow == 6) {
            $extra_class .= " col-md-2";
        }
        ob_start(); ?>
        <div class="<?php echo esc_attr($extra_class) ?> cynic_team_vc_element">
            <a href="javascript:void(0)" class="img-card text-center cynic_team_modal"
               data-bio="<?php echo esc_html($bio_info); ?>" data-fullname="<?php echo esc_html($fullname); ?>"
               data-designation="<?php echo esc_html($designation); ?>">
                <?php echo wp_get_attachment_image($image, 'full', false, ['class' => 'img-fluid']); ?>
                <h4><span><?php echo cynic_nl2br($fullname); ?></span> <?php echo esc_html($designation); ?></h4>
                <div class="img-container d-none">
                    <?php
                    echo wp_get_attachment_image($image, 'full', false, ['class' => 'img-fluid']);
                    ?>
                </div>
            </a>
            <!-- End of .img-card -->
            <div class="socialmediacontainer d-none">
                <?php
                if (!empty($member_socials)) {
                    $media_attribute = getCynicOptionsVal('social-media-color');
                    $social_icon_color = !empty($media_attribute) ? $media_attribute : "#9cb9e2"; ?>
                    <ul class="social-icons">
                        <?php
                        foreach ($member_socials as $social) {
                            $social_link = !empty($social['social_link']) ? $social['social_link'] : "#";
                            $social_icon = ($social['icon_type'] == 'miniline_icons') ? $social['icon_miniline'] : $social['icon_fontawesome'];?>
                            <li>
                                <a href="<?php echo esc_url($social_link) ?>" target="_blank" rel="noopener"><i
                                            class="<?php echo esc_attr($social_icon) ?>"></i></a>
                            </li>
                            <?php
                        } ?>
                    </ul>
                    <?php
                } ?>
            </div>
        </div>
        <!-- End of .col-md-4 -->
        <?php
        return ob_get_clean();
    }

    function cynic_footer_modals()
    {
        ?>
        <div class="modal fade team-modal" id="team-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                        <!-- End of .close -->
                    </div>
                    <!-- End of .modal-header -->

                    <div class="modal-body text-center"></div>
                    <!-- End of .modal-body -->
                </div>
                <!-- End of .modal-content -->
            </div>
            <!-- End of .modal-dialog -->
        </div>
        <!-- End of .team-modal -->
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
