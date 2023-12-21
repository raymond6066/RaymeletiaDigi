<?php

class CynicGoogleMap
{

    public $tabnavs = '', $tabcount = 1;

    public function __construct()
    {
        add_shortcode('cynic_gmap_tabs', array($this, 'shortcodecb'));
        add_shortcode('cynic_gmap_tab', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_gmap_tabs',
                'name' => __('Google Map Tabs', 'cynic'),
                "category" => __("Illustration", "cynic"),
                "as_parent" => array('only' => 'cynic_gmap_tab'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => false,
                "is_container" => FALSE,
                'class' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_gmap_tab',
                'name' => __('Google Map Tab', 'cynic'),
                "category" => __("Illustration", "cynic"),
                "as_child" => array('only' => 'cynic_gmap_tabs'),
                "content_element" => true,
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Tab Title', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Map Content',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Custom Address',
                        'type' => 'textarea',
                        'param_name' => 'address',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Email',
                        'type' => 'textarea',
                        'param_name' => 'email',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Phone',
                        'type' => 'textarea',
                        'param_name' => 'phone',
                        'value' => '',
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
                'extra_class' => '',
            ), $atts);
        extract($atts);
        ob_start();
        $content = do_shortcode($content); ?>
        <div class="container">
            <ul class="nav nav-tabs location-tab justify-content-center" role="tablist">
                <?php echo $this->tabnavs ?>
            </ul>
            <div class="tab-content location-tab-content grid-wrapper <?php echo $extra_class ?>" id="myTabContent">
                <?php echo $content ?>
            </div>
        </div>
        <?php
        $this->tabcount = 1;
        $this->tabnavs = '';
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'title' => '',
                'address' => '',
                'email' => '',
                'phone' => '',
            ), $atts);
        extract($atts);

        $tabactivecls = '';
        if ($this->tabcount == 1) {
            $tabactivecls = 'active';
        }
        $tabid = 'maptab-' . uniqid(rand(000000, 999999));
        ob_start();
        ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $tabactivecls ?>" data-toggle="tab"
               href="#location-tab-<?php echo $this->tabcount ?>"><?php echo esc_html($title) ?></a>
        </li>
        <?php
        $this->tabnavs .= ob_get_clean();
        ob_start(); ?>
        <div class="tab-pane fade show <?php echo $tabactivecls ?>"
             id="location-tab-<?php echo $this->tabcount; ?>">
            <div class="location-tab-inner">
                <?php echo apply_filters('the_content', $content) ?>
            </div>
            <div class="contact-info">
                <div class="row justify-content-between">
                    <?php if(!empty($address)) { ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="info">
                                <h5><?php echo __('Address', 'cynic'); ?></h5>
                                <p><?php echo html_entity_decode(cynic_nl2br($address)); ?></p>
                            </div>
                            <!-- End of .info -->
                        </div>
                        <!-- End of .col-md-3 -->
                    <?php }
                    if(!empty($email)) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="info">
                                <h5><?php echo __('Email', 'cynic'); ?></h5>
                                <a href="mailto:<?php echo $email; ?>"><?php echo html_entity_decode(cynic_nl2br($email)); ?></a>
                            </div>
                            <!-- End of .info -->
                        </div>
                        <!-- End of .col-md-3 -->
                    <?php }
                    if(!empty($phone)) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="info">
                                <h5>Phone</h5>
                                <a href="tel:<?php echo $phone; ?>"><?php echo html_entity_decode(cynic_nl2br($phone)); ?></a>
                            </div>
                            <!-- End of .info -->
                        </div>
                        <!-- End of .col-md-3 -->
                    <?php } ?>
                    <?php
                    if (get_theme_mod('cynic_header_button_display')) { ?>
                        <div class="col-md-6 col-lg-2 text-lg-right info">
                            <?php
                            $get_button_text = get_theme_mod('cynic_header_button_text');
                            $button_text = (!empty($get_button_text)) ? $get_button_text : "Contact Us";
                            if (get_theme_mod('cynic_is_header_button_open_with_modal') == "bookmark") {
                                $bookmark_link = get_theme_mod('cynic_header_button_bookmark');
                                $bookmark = (!empty($bookmark_link)) ? $bookmark_link : "#contact";
                                return '<li class="nav-item"><a class="custom-btn btn-small page-scroll" href="' . esc_url($bookmark) . '" >' . esc_html($button_text) . '</a></li>';
                            } else if (get_theme_mod('cynic_is_header_button_open_with_modal') == "page") {
                                $pageID = get_theme_mod('cynic_header_button_page');
                                if ($pageID) {
                                    $pageLink = get_page_link($pageID);
                                    echo '<a href="' . esc_url($pageLink) . '" class="custom-btn secondary-btn">'.__('Contact Us', 'cynic').'</a>';
                                }
                            } else if (get_theme_mod('cynic_is_header_button_open_with_modal') == "modal") {
                                $pageID = get_theme_mod('cynic_header_button_page');
                                if ($pageID) {
                                    echo '<a href="javascript:void(0)" class="custom-btn secondary-btn" data-toggle="modal" data-target="#get-a-quote-modal">'.__('Contact Us', 'cynic').'</a>';
                                }
                            } else {
                                echo '<a href="javascript:void(0)" class="custom-btn secondary-btn">'.__('Contact Us', 'cynic').'</a>';
                            } ?>
                        </div>
                        <?php
                    } ?>
                </div>
                <!-- End of .contact-in -->
            </div>
            <!-- End of .contact-info -->
        </div>
        <!-- End of .tab-pane -->
        <?php
        $this->tabcount++;
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_Gmap_Tabs extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_Gmap_Tab extends WPBakeryShortCode
    {

    }

}