<?php

class CynicOnepageTeamGrids {

    public static $securityNonce, $noncePlain;

    public function __construct() {
        add_shortcode('cynic_onepage_team', array($this, 'shortcodecb'));
        add_shortcode('cynic_onepage_team_child', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_onepage_team',
                'name' => __('Modern Team Grids', 'cynic'),
                "category" => __("Cynic Modern", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Select Layout',
                        'type' => 'dropdown',
                        'param_name' => 'theme_layout',
                        'value' => array(
                            'Modern' => 'modern',
                            'Classic' => 'classic',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Title',
                        'type' => 'textfield',
                        'param_name' => 'title',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Designation',
                        'type' => 'textfield',
                        'param_name' => 'designation',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Bio',
                        'type' => 'textarea',
                        'param_name' => 'bio',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Avatar',
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Button Text',
                        'type' => 'textfield',
                        'param_name' => 'button_text',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Facebook',
                        'type' => 'textfield',
                        'param_name' => 'social_media_facebook',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Twitter',
                        'type' => 'textfield',
                        'param_name' => 'social_media_twitter',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Google Plus',
                        'type' => 'textfield',
                        'param_name' => 'social_media_google',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Instagram',
                        'type' => 'textfield',
                        'param_name' => 'social_media_instagram',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Pinterest',
                        'type' => 'textfield',
                        'param_name' => 'social_media_pinterest',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Linkedin',
                        'type' => 'textfield',
                        'param_name' => 'social_media_linkedin',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Youtube',
                        'type' => 'textfield',
                        'param_name' => 'social_media_youtube',
                    ),
            ));
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'theme_layout' => 'modern',
            'title' => '',
            'designation' => '',
            'bio' => '',
            'image' => '',
            'button_text' => __('View Details', 'çynic'),
            'social_media_facebook' => '#',
            'social_media_twitter' => '#',
            'social_media_google' => '#',
            'social_media_instagram' => '#',
            'social_media_pinterest' => '#',
            'social_media_linkedin' => '#',
            'social_media_youtube' => '#',
                ), $atts);
        extract($atts);
        ob_start();
        ?>
        <?php 
        $elemid = 'onepage-' . rand(000000, 999999);
        $thumbsize = 'cynic-team-hveq'; 
        $vlong = 'cynic-team-vlong'; 
        $layouts = (isset($theme_layout) && $theme_layout=="classic") ? "classic" : "modern"; ?>
        <div class="content">
            <div class="img_container">
                <?php echo wp_get_attachment_image((int) $image, $thumbsize, false, array('class' => 'img-responsive')); ?>
                <div class="por-overlay">
                    <div class="text-inner">
                        <a href="javascript:void(0)" data-id="<?php echo esc_attr($elemid) ?>" data-action="get_team_details" class="btn btn-nofill getTeamMember"><?php echo esc_html($button_text); ?></a>
                    </div>
                    <!-- End of .text-inner -->
                </div>
                <!-- End of .por-overlay -->
            </div>
            <!-- End of .img_container -->
            <div class="member_details <?php echo esc_attr($layouts); ?>">
                <h3><a  href="javascript:void(0)" data-id="<?php echo esc_attr($elemid) ?>" data-action="get_team_details" class="getTeamMember member_intro" ><?php echo esc_html($title); ?></a><?php echo esc_html($designation); ?></h3>
                <?php if(isset($theme_layout) && $theme_layout=="classic") { ?>
                    <ul class="list-inline social_icons text-center">
                        <?php if(!empty($social_media_facebook) && $social_media_facebook!="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_facebook); ?>" target="_blank" class="text-center"><i class="fa fa-facebook"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_twitter) && $social_media_twitter!="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_twitter); ?>" target="_blank" class="text-center"><i class="fa fa-twitter"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_google) && $social_media_google!="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_google); ?>" target="_blank" class="text-center"><i class="fa fa-google-plus"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_instagram) && $social_media_instagram!="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_instagram); ?>" target="_blank" class="text-center"><i class="fa fa-instagram"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_pinterest) && $social_media_pinterest!="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_pinterest); ?>" target="_blank" class="text-center"><i class="fa fa-pinterest"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_linkedin) && $social_media_linkedin!="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_linkedin); ?>" target="_blank" class="text-center"><i class="fa fa-linkedin"></i></a></li>
                        <?php } ?>
                        <?php if(!empty($social_media_youtube) && $social_media_youtube!="#") { ?>
                            <li><a href="<?php echo esc_url($social_media_youtube); ?>" target="_blank" class="text-center"><i class="fa fa-youtube"></i></a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                <div id="<?php echo esc_attr($elemid) ?>" class="hidden">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="img_container">
                                <?php echo wp_get_attachment_image((int) $image, $vlong, false, array('class' => 'img-responsive')); ?>
                            </div>
                            <!-- End of .img_container -->
                        </div>
                        <div class="col-md-6">
                            <div class="port-modal-content team-modal-content">
                                <h2 class="b-clor"><?php echo esc_html($title);?></h2>
                                <p class="gray-text"><?php echo esc_html($designation);?></p>
                                <?php echo nl2br(esc_html($bio)); ?>
                                <ul class="list-inline social_icons text-left">
                                    <?php if(!empty($social_media_facebook) && $social_media_facebook!="#") { ?>
                                        <li><a href="<?php echo esc_url($social_media_facebook); ?>" target="_blank" class="text-center"><i class="fa fa-facebook"></i></a></li>
                                    <?php } ?>
                                    <?php if(!empty($social_media_twitter) && $social_media_twitter!="#") { ?>
                                        <li><a href="<?php echo esc_url($social_media_twitter); ?>" target="_blank" class="text-center"><i class="fa fa-twitter"></i></a></li>
                                    <?php } ?>
                                    <?php if(!empty($social_media_google) && $social_media_google!="#") { ?>
                                        <li><a href="<?php echo esc_url($social_media_google); ?>" target="_blank" class="text-center"><i class="fa fa-google-plus"></i></a></li>
                                    <?php } ?>
                                    <?php if(!empty($social_media_instagram) && $social_media_instagram!="#") { ?>
                                        <li><a href="<?php echo esc_url($social_media_instagram); ?>" target="_blank" class="text-center"><i class="fa fa-instagram"></i></a></li>
                                    <?php } ?>
                                    <?php if(!empty($social_media_pinterest) && $social_media_pinterest!="#") { ?>
                                        <li><a href="<?php echo esc_url($social_media_pinterest); ?>" target="_blank" class="text-center"><i class="fa fa-pinterest"></i></a></li>
                                    <?php } ?>
                                    <?php if(!empty($social_media_linkedin) && $social_media_linkedin!="#") { ?>
                                        <li><a href="<?php echo esc_url($social_media_linkedin); ?>" target="_blank" class="text-center"><i class="fa fa-linkedin"></i></a></li>
                                    <?php } ?>
                                    <?php if(!empty($social_media_youtube) && $social_media_youtube!="#") { ?>
                                        <li><a href="<?php echo esc_url($social_media_youtube); ?>" target="_blank" class="text-center"><i class="fa fa-youtube"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of .member_details -->
        </div>
        <!-- End of .content -->
        <?php
        return ob_get_clean();
    }
}
