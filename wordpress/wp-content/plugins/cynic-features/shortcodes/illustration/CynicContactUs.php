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
                "category" => __("Illustration", "cynic"),
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
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Select Contact Form',
                        'type' => 'dropdown',
                        'param_name' => 'form_shortcode',
                        'value' => $forms,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'follow_us',
                        'type' => 'textfield',
                        'heading' => __('Follow Us Text', 'cynic'),
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

    public function shortcodecb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'form_shortcode' => '',
                'follow_us' => 'Follow Us:',
                'member_socials' => array(),
            ), $atts);

        ob_start();
        $form_shortcode = $attributes['form_shortcode'];
        $get_shortcode = "";
        if (isset($form_shortcode) && !empty($form_shortcode)) {
            $get_shortcode = get_contact_forms_shortcode($form_shortcode);
        }
        $features = vc_param_group_parse_atts($attributes['member_socials']);
        $featuresCount = count($features); ?>
        <div class="container">
            <div class="quote-form-wrapper text-center <?php echo esc_attr($attributes['extra_class']); ?>">
                <?php echo $get_shortcode; ?>
                <?php if($featuresCount > 0) { ?>
                    <div class="col-lg-12">
                        <div class="social-icons-wrapper d-flex justify-content-center">
                            <p><?php echo esc_html($attributes['follow_us']); ?></p>
                            <ul class="social-icons">
                                <?php
                                foreach($features as $feature) {
                                    $icon_type = (isset($miniline_icons) && !empty($miniline_icons)) ? $feature['icon_miniline'] : $feature['icon_fontawesome'];  ?>
                                    <li>
                                        <a href="<?php echo $feature['social_link']; ?>"
                                           <?php if($feature['social_link'] !="#" ) { ?>
                                                target="_blank"
                                           <?php } ?>
                                           rel="noopener">
                                            <i class="<?php echo esc_attr($icon_type); ?>"></i>
                                        </a>
                                    </li>
                                    <?php
                                } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

}
