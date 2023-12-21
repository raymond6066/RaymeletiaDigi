<?php

class CynicTrendyMap {

    public $tabnavs = '', $tabcount = 1;

    public function __construct() {
        add_shortcode('cynic_gmap_tabs', array($this, 'shortcodecb'));
        add_shortcode('cynic_gmap_tab', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_gmap_tabs',
                'name' => __('Google Map Tabs', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
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
                "category" => __("Cynic Global", "cynic"),
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
                        'type' => 'attach_image',
                        'heading' => __('Tab Image', 'cynic'),
                        'param_name' => 'map_tab_image',
                        'description' => __('Please upload map image (32x32)px.', 'cynic'),
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
                        'heading' => 'Map Content',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'extra_class' => '',
            ), $atts);
        extract($atts);
        ob_start();
        $content = do_shortcode($content);
        ?>
        <svg class="bg-shape shape-work-places reveal-from-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             width="779px" height="759px">
            <defs>
                <linearGradient id="PSgrad_045" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                </linearGradient>

            </defs>
            <path fill-rule="evenodd" fill="url(#PSgrad_045)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
            />
        </svg>
        <div class="container">
            <div class="location-process-tab <?php echo $extra_class ?>">
                <ul class="nav nav-tabs location-tab-nav" id="location-tab-nav" role="tablist">
                    <?php echo $this->tabnavs ?>
                </ul>
                <p class="map-loc-alt"></p>
                <!-- Tab panes -->
                <div class="tab-content location-tab-content" id="location-tab">
                    <?php echo $content ?>
                </div>
            </div>
            <!-- End Tabs Area -->
        </div>
        <?php
        $this->tabcount = 1;
        $this->tabnavs = '';
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'address' => '',
                'map_tab_image' => '',
                'address' => '',
                'title' => '',
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
            <a class="nav-link <?php echo $tabactivecls ?>"
               id="process-nav-<?php echo $this->tabcount ?>" data-toggle="tab"
               href="#process-tab-<?php echo $this->tabcount ?>" role="tab"
               aria-controls="process-tab-<?php echo $this->tabcount ?>" aria-selected="true">
                <?php echo wp_get_attachment_image($map_tab_image, 'full', true, array('class' => '')); ?>
                <span><?php echo esc_html($title) ?></span>

                <div class="map-loc"><?php echo html_entity_decode(cynic_nl2br($address)); ?></div>
            </a>
        </li>
        <?php
        $this->tabnavs .= ob_get_clean();
        ob_start(); ?>
        <div class="tab-pane fade show <?php echo $tabactivecls ?>" id="process-tab-<?php echo $this->tabcount; ?>"
             role="tabpanel" aria-labelledby="process-nav-<?php echo $this->tabcount; ?>">
            <div class="map-wrapper">
                <?php echo apply_filters('the_content', $content) ?>
            </div>
            <!-- End of .map-wrapper -->
        </div>
        <!-- End of .tab-pane -->
        <?php
        $this->tabcount++;
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_Gmap_Tabs extends WPBakeryShortCodesContainer {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_Gmap_Tab extends WPBakeryShortCode {

    }

}