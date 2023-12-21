<?php

class CynicSubscription
{
    public function __construct()
    {
        add_shortcode('cynic_subscription', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'), 1000);
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_subscription',
                'name' => __('Subscription Block', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "h3",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textarea',
                        'heading' => __('Ttile', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Shortcode for Contact Forms',
                        'type' => 'textarea_raw_html',
                        'param_name' => 'contact_form_html',
                        'value' => ''
                    ),

                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'follow_title',
                        'type' => 'textfield',
                        'heading' => __('Follow Us Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Social Links', 'cynic'),
                        'param_name' => 'member_socials',
                        'params' => array(
                            array(
                                "holder" => "div",
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

    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'title' => '',
                'contact_form_html' => '',
                'follow_title' => '',
                'member_socials' => ''
            ), $atts);
        extract($atts);
        ob_start();
        $features = vc_param_group_parse_atts($member_socials);
        $socialCount = count($features);
        $form_content = rawurldecode(base64_decode(strip_tags($contact_form_html))); ?>
        <div class="container">
            <h3 class="text-center"><?php echo html_entity_decode(cynic_nl2br($title)); ?></h3>

            <?php echo do_shortcode($form_content); ?>
            <!-- End of .newsletter-form -->
            <?php
            if($socialCount > 0) { ?>
                <div class="social-icons-wrapper d-flex justify-content-center">
                    <p><?php echo esc_html($follow_title); ?></p>
                    <ul class="social-icons">
                        <?php foreach($features as $feature) {
                            $icon_type = (isset($miniline_icons) && !empty($miniline_icons)) ? $feature['icon_miniline'] : $feature['icon_fontawesome']; ?>
                            <li>
                                <a href="<?php echo esc_url($feature['social_link']); ?>" target="_blank" rel="noopener">
                                    <i class="<?php echo esc_attr($icon_type); ?>"></i>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- End of .social-icons -->
                </div>
                <!-- End of .social-icons-wrapper -->
                <?php
            } ?>
        </div>
        <!-- End of .container -->
        <?php
        return ob_get_clean();
    }
}