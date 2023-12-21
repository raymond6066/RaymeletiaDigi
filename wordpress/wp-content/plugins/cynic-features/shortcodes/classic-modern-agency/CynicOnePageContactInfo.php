<?php

class CynicOnePageContactInfo {

    public static $securityNonce, $noncePlain;

    public function __construct() {
        add_shortcode('cynic_onepage_contact_info', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_onepage_contact_info',
                'name' => __('One Page Contact Info', 'cynic'),
                "category" => __("Cynic Onepage", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Contact Title',
                        'type' => 'textfield',
                        'param_name' => 'contact_title',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Call Title',
                        'type' => 'textfield',
                        'param_name' => 'call_title',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Phone Number',
                        'type' => 'textfield',
                        'param_name' => 'phone_number',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Email Title',
                        'type' => 'textfield',
                        'param_name' => 'email_title',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Email Address',
                        'type' => 'textfield',
                        'param_name' => 'email_address',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Address Title',
                        'type' => 'textfield',
                        'param_name' => 'address_title',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Address',
                        'type' => 'textarea',
                        'param_name' => 'address',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Social Media Title',
                        'type' => 'textfield',
                        'param_name' => 'social_media_title',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Facebook',
                        'type' => 'textfield',
                        'param_name' => 'social_media_facebook',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Twitter',
                        'type' => 'textfield',
                        'param_name' => 'social_media_twitter',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Google Plus',
                        'type' => 'textfield',
                        'param_name' => 'social_media_google',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Instagram',
                        'type' => 'textfield',
                        'param_name' => 'social_media_instagram',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Pinterest',
                        'type' => 'textfield',
                        'param_name' => 'social_media_pinterest',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Linkedin',
                        'type' => 'textfield',
                        'param_name' => 'onepage_media_linkedin',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Youtube',
                        'type' => 'textfield',
                        'param_name' => 'onepage_media_youtube',
                    ),
            ));
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'contact_title' => '',
            'call_title' => '',
            'phone_number' => '',
            'email_title' => '',
            'email_address' => '',
            'address_title' => '',
            'address' => '',
            'social_media_title' => '',
            'social_media_facebook' => '#',
            'social_media_twitter' => '#',
            'social_media_google' => '#',
            'social_media_instagram' => '#',
            'social_media_pinterest' => '#',
            'onepage_media_linkedin' => '#',
            'onepage_media_youtube' => '#'
        ), $atts);
        extract($atts);
        ob_start();
        ?>
        <div class="contact-information">
            <h3><?php echo esc_html($contact_title); ?></h3>
            <div><?php echo esc_html($call_title); ?>
                <div><a href="tel:<?php echo esc_attr($phone_number); ?>"><?php echo esc_html($phone_number); ?></a></div>
            </div>
            <div><?php echo esc_html($email_title); ?><a href="mailto:<?php echo esc_attr($email_address); ?>"><?php echo esc_html($email_address); ?></a></div>
            <div><?php echo esc_html($address_title); ?><span><?php echo html_entity_decode(esc_html($address)); ?></span></div>
                <div><?php echo esc_html($social_media_title); ?>
                    <ul class="social-icons list-inline">
                        <?php if(!empty($social_media_facebook) && $social_media_facebook !="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_facebook) ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_twitter) && $social_media_twitter !="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_twitter) ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_google) && $social_media_google !="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_google) ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_instagram) && $social_media_instagram !="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_instagram) ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_pinterest) && $social_media_pinterest !="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_pinterest) ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                        <?php } ?>
                        <?php   
                        if(!isset($onepage_media_linkedin) || empty($onepage_media_linkedin)){ 
                            if(!empty($social_media_linkedin) && $social_media_linkedin !="#") { ?>
                                <li><a href="<?php echo esc_url($social_media_linkedin) ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <?php   
                            } 
                        } else { ?>
                        <?php if(!empty($onepage_media_linkedin) && $onepage_media_linkedin!="#") { ?>
                            <li><a href="<?php echo esc_url($onepage_media_linkedin) ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <?php } } ?>
                        <?php if(!empty($social_media_youtube) && $social_media_youtube !="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_youtube) ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        <?php } ?>
                    </ul>
                    <!-- End of .social-icons -->
                </div>
        </div>
        <?php
        return ob_get_clean();
    }

}
