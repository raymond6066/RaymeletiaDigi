<?php

class CynicContactUs
{

    public function __construct()
    {
        add_shortcode('cynic_contact_us', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $forms = get_contact_forms();
            $args = array(
                'base' => 'cynic_contact_us',
                'name' => __('Contact Us', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "content_element" => true,
                "show_settings_on_create" => true,
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
                        "holder" => "h3",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Ttile', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Select Contact Form',
                        'type' => 'dropdown',
                        'param_name' => 'form_shortcode',
                        'value' => $forms,
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Google Map Iframe',
                        'type' => 'textarea_raw_html',
                        'param_name' => 'google_map_iframe',
                        'value' => '',
                        'dependency' => array(
                            'element' => 'layouts',
                            'value' => '1',
                        ),
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Contact Information',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
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

    public function shortcodecb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'layouts' => '',
                'title' => '',
                'form_shortcode' => '',
                'google_map_iframe' => '',
                'member_socials' => array(),
            ), $atts);

        ob_start();
        $layouts = $attributes['layouts'];
        $form_shortcode = $attributes['form_shortcode'];
        $get_shortcode = "";
        if (isset($form_shortcode) && !empty($form_shortcode)) {
            $get_shortcode = get_contact_forms_shortcode($form_shortcode);
        }

        if ($layouts == 2) {
            $this->MultipageHtml($attributes, $content, $get_shortcode);
        } else {
            $this->onePagelayoutHtml($attributes, $content, $get_shortcode);
        }
        return ob_get_clean();
    }

    protected function onePagelayoutHtml($attributes = array(), $content = null, $get_shortcode = null)
    {

        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        $google_map_iframe = rawurldecode(base64_decode(strip_tags($attributes['google_map_iframe'])));
        $member_socials = vc_param_group_parse_atts($attributes['member_socials']);
        ob_start();
        $shape_colors = getCynicOptionsVal('shape-color');
        $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
        $get_colors = get_bubble_color($bubble_colors); ?>
        <div class="grey-bg <?php echo esc_attr($extra_class) ?>">
            <div class="trigger-contact"></div>
            <svg class="bg-shape shape-contact reveal-from-left" xmlns="http://www.w3.org/2000/svg"
                 width="779px"
                 height="759px">
                <defs>
                    <linearGradient id="PSgrad_07" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_07)"
                      d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"/>
            </svg>
            <svg class="bg-shape shape-contact-2 reveal-from-right" xmlns="http://www.w3.org/2000/svg"
                 width="779px"
                 height="759px">
                <defs>
                    <linearGradient id="PSgrad_08" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_08)"
                      d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"/>
            </svg>

            <div class="container">
                <div class="row align-items-end">
                    <div class="col-md-7">
                        <div class="contact-wrapper common-contact-wrapper">
                            <div class="form-wrapper">
                                <?php
                                if ($title):
                                    ?>
                                    <h3><?php echo esc_html($title); ?></h3>
                                <?php endif;
                                echo $get_shortcode; ?>
                                <!-- End of .contact-form -->
                            </div>
                            <!-- End of .form-wrapper -->

                            <div class="map-wrapper">
                                <?php echo do_shortcode($google_map_iframe); ?>
                            </div>
                            <!-- End of .map-wrapper -->
                            <a href="#" class="view-map-btn"><?php echo esc_html_e('VIEW MAP', 'cynic') ?>
                                <i class="ml-symone-2-arrow-left-right-up-down-increase-decrease"></i>
                            </a>
                        </div>
                        <!-- End of .contact-form -->
                    </div>
                    <!-- End of .col-md-6 -->
                    <div class="col-md-3 offset-md-1">
                        <div class="contact-info m-b-70">
                            <?php echo do_shortcode($content) ?>
                            <?php if (count($member_socials) > 0) {
                                ?>
                                <div class="social-icons-wrapper">
                                    <p><?php echo esc_html_e('Follow us on', 'cynic') ?></p>
                                    <ul class="social-icons">
                                        <?php
                                        $media_attribute = get_theme_mod('cynic_social-media-color');
                                        $social_icon_color = !empty($media_attribute) ? $media_attribute : "#a6d1ed";
                                        foreach ($member_socials as $social) {
                                            $social_icon = ($social['icon_type'] == 'miniline_icons') ? $social['icon_miniline'] : $social['icon_fontawesome'];
                                            $social_link = (isset($social['social_link']) && !empty($social['social_link'])) ? $social['social_link'] : '#';
                                            $soical_link_hover = (isset($social['soical_link_hover']) && !empty($social['soical_link_hover'])) ? $social['soical_link_hover'] : '#3b5998';
                                            ?>
                                            <li>
                                                <a onMouseOver="this.style.background='<?php echo esc_attr($soical_link_hover) ?>'"
                                                   onMouseOut="this.style.background='<?php echo esc_attr($social_icon_color); ?>'"
                                                   href="<?php echo esc_url($social_link) ?>" target="_blank"
                                                    style="background: <?php echo esc_attr($social_icon_color); ?>" rel="noopener"><i
                                                            class="<?php echo esc_attr($social_icon) ?>"></i></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <!-- End of .contact-info -->
                    </div>
                    <!-- End of .col-md-4 -->

                </div>
                <!-- End of .row -->
            </div>
            <!-- End of .container -->
        </div>
        <?php
        echo ob_get_clean();
    }

    protected function MultipageHtml($attributes = array(), $content = null, $get_shortcode = null)
    {
        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        $form_shortcode = rawurldecode(base64_decode(strip_tags($attributes['form_shortcode'])));
        $member_socials = vc_param_group_parse_atts($attributes['member_socials']);
        ob_start(); ?>
        <div class="container <?php echo esc_attr($extra_class); ?>">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="contact-wrapper contact-page-form-wrapper">
                        <div class="form-wrapper">
                            <?php
                            if ($title):
                                ?>
                                <h3><?php echo esc_html($title); ?></h3>
                            <?php endif;
                            echo $get_shortcode; ?>
                            <!-- End of .contact-form -->
                        </div>
                        <!-- End of .form-wrapper -->
                    </div>
                    <!-- End of .contact-form -->
                </div>
                <div class="col-lg-6">
                    <div class="contact-info floating-contact-info">
                        <?php echo do_shortcode($content) ?>
                        <?php if (count($member_socials) > 0) {
                            ?>
                            <div class="social-icons-wrapper">
                                <p><?php echo esc_html_e('Follow us on', 'cynic') ?></p>
                                <ul class="social-icons">
                                    <?php
                                    foreach ($member_socials as $social) {
                                        $social_icon = ($social['icon_type'] == 'miniline_icons') ? $social['icon_miniline'] : $social['icon_fontawesome'];
                                        $social_link = (isset($social['social_link']) && !empty($social['social_link'])) ? $social['social_link'] : '#';
                                        $soical_link_hover = (isset($social['soical_link_hover']) && !empty($social['soical_link_hover'])) ? $social['soical_link_hover'] : '#3b5998';
                                        ?>
                                        <li>
                                            <a onMouseOver="this.style.background='<?php echo esc_attr($soical_link_hover) ?>'"
                                               onMouseOut="this.style.background='#f1efff'"
                                               href="<?php echo esc_url($social_link) ?>" target="_blank"
                                               rel="noopener"><i
                                                        class="<?php echo esc_attr($social_icon) ?>"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- End of .contact-info -->
                </div>
                <!-- End of .col-lg-5 -->
            </div>
            <!-- End of .row -->
        </div>
        <?php
        echo ob_get_clean();
    }

}
