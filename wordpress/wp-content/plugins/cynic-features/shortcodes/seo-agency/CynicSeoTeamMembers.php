<?php

class CynicSeoTeamMembers
{

    protected $detailsText;
    protected $html1;
    protected $html2;

    public function __construct()
    {
        add_shortcode('cynic_seo_team_members', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_team_member', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'name' => __('Team Members', 'cynic'),
                'base' => 'cynic_seo_team_members',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_team_member'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
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
                        "holder" => "div",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'details_button_text',
                        'type' => 'textfield',
                        'heading' => __('Details Button Text', 'cynic'),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_team_member',
                'name' => __('Team Profile', 'cynic'),
                "as_child" => array('only' => 'cynic_seo_team_members'),
                "content_element" => true,
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
                        'heading' => 'Avator',
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    ),

                    array(
                        "holder" => "p",
                        "class" => "",
                        'param_name' => 'fullname',
                        'type' => 'textfield',
                        'heading' => __('Full Name', 'cynic'),
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'designation',
                        'type' => 'textfield',
                        'heading' => __('Designation', 'cynic'),
                        'admin_label' => true,
                    ),


                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Bio',
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
                                'value'=>'#'
                            ),

                            array(
                                'type' => 'dropdown',
                                'heading' => __('Icon library for Social Icons', 'cynic'),
                                'value' => array(
                                    __('Font Awesome', 'cynic') => 'fontawesome',
                                    __('Linear Icons', 'cynic') => 'caviaricons',
                                ),
                                'param_name' => 'icon_type',
                                'description' => __('Select icon library.', 'cynic'),
                            ),
                            array(
                                'type' => 'iconpicker',
                                'heading' => __('Social Icon', 'cynic'),
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
                                'heading' => __('Social Icon', 'cynic'),
                                'param_name' => 'icon_fontawesome',
                                'value' => 'fa fa-facebook',
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
                'title' => '',
                'details_button_text' => 'View Details',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        $details_button_text = $attributes['details_button_text'];
        $this->detailsText = $details_button_text;
        $content = do_shortcode($content);
        ob_start(); ?>
        <div class="<?php echo esc_attr($extra_class); ?>">
            <?php
            if (!empty($title)) {
                ?>
                <div class="team-title">
                    <h3><?php echo esc_html_cynicSEO_string($title); ?></h3>
                </div>
            <?php } ?>
            <ul class="gridder clearfix">
                <?php echo esc_html_cynicSEO_string($this->html1); ?>
            </ul>
            <?php echo esc_html_cynicSEO_string($this->html2); ?>
        </div>
        <?php
        $this->html1 = '';
        $this->html2 = '';
        $this->per_row = '';
        $this->detailsText = '';
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
                'member_socials' => [],
            ), $atts);
        $content = do_shortcode($content);

        $extra_class = $attributes['extra_class'];
        $image = $attributes['image'];
        $imagehtml = wp_get_attachment_image($image, 'full', false, ['class' => 'img-fluid']);
        $fullname = $attributes['fullname'];
        $designation = $attributes['designation'];
        $member_socials = vc_param_group_parse_atts($attributes['member_socials']);
        $tabid = uniqid(rand(000000, 999999));
        ob_start();
        ?>
        <li class="gridder-list <?php echo esc_attr($extra_class); ?>"
            data-griddercontent="#gridder-content-<?php echo esc_html_cynicSEO_string($tabid); ?>">
            <div class="inner-content">
                <?php echo esc_html_cynicSEO_string($imagehtml); ?>
                <div class="overlay">
                    <a href="javascript:void(0)"
                       class="secondary-btn"><?php echo esc_html_cynicSEO_string($this->detailsText); ?></a>
                </div>
            </div>
        </li>
        <?php
        $this->html1 .= ob_get_clean();
        ?>
        <?php ob_start(); ?>
        <div id="gridder-content-<?php echo esc_html_cynicSEO_string($tabid); ?>" class="gridder-content">
            <h3><?php echo esc_html_cynicSEO_string($fullname); ?>
                <span><?php echo esc_html_cynicSEO_string($designation); ?></span>
            </h3>
            <p><?php echo $content; ?></p>

            <?php
            if (count($member_socials) > 0) {
                ?>
                <div class="nav-social-links d-flex justify-content-start">
                    <?php
                    foreach ($member_socials as $social) {
                        $social_icon = ($social['icon_type'] == 'fontawesome') ? $social['icon_fontawesome'] : $social['icon_caviaricons'];
                        $social_link = (isset($social['social_link']) && !empty($social['social_link']))? $social['social_link'] : '#';
                        $soical_link_hover = (isset($social['soical_link_hover']) && !empty($social['soical_link_hover']))? $social['soical_link_hover'] : '#3b5998';
                        ?>
                        <a class="social-bg" data-hover-bg="<?php echo esc_attr($soical_link_hover); ?>"
                           href="<?php echo esc_url($social_link) ?>" target="_blank">
                            <i class="<?php echo esc_attr($social_icon) ?>"></i>
                        </a>
                    <?php } ?>
                </div>
                <?php
            }
            ?>
            <!-- End of .nav-social-links -->
        </div>
        <?php $this->html2 .= ob_get_clean(); ?>
        <?php
    }
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_cynic_seo_team_members extends WPBakeryShortCodesContainer
    {
        public function contentAdmin( $atts, $content = null ) {
            $width = '';

            $atts = shortcode_atts( $this->predefined_atts, $atts );
            extract( $atts );
            $this->atts = $atts;
            $output = '';

            $output .= '<div ' . $this->mainHtmlBlockParams( $width, 1 ) . '>';
            if ( $this->backened_editor_prepend_controls ) {
                $output .= $this->getColumnControls( $this->settings( 'controls' ) );
            }
            $output .= '<div class="wpb_element_wrapper">';

            if ( isset( $this->settings['custom_markup'] ) && '' !== $this->settings['custom_markup'] ) {
                $markup = $this->settings['custom_markup'];
                $output .= $this->customMarkup( $markup );
            } else {
                $output .= $this->outputTitle( $this->settings['name'] );
                $output .= $this->paramsHtmlHolders( $atts );
                $output .= '<div ' . $this->containerHtmlBlockParams( $width, 1 ) . '>';
                $output .= do_shortcode( shortcode_unautop( $content ) );
                $output .= '</div>';
            }

            $output .= '</div>';
            if ( $this->backened_editor_prepend_controls ) {
                $output .= $this->getColumnControls( 'add', 'bottom-controls' );

            }
            $output .= '</div>';

            return $output;
        }
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_cynic_seo_team_member extends WPBakeryShortCode
    {

    }
}