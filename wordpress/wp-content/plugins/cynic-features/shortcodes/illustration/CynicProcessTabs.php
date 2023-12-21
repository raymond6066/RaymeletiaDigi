<?php

class CynicProcessTabs {

    public $tabnavs = '', $tabcount = 0;

    public function __construct() {
        add_shortcode('cynic_process_tabs', array($this, 'shortcodecb'));
        add_shortcode('cynic_process_tab', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_process_tabs',
                'name' => __('Process Tabs', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_process_tab'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => false,
                "is_container" => false,
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
                'base' => 'cynic_process_tab',
                'name' => __('Process Tab', 'cynic'),
                "category" => __("Illustration", "cynic"),
                "as_child" => array('only' => 'cynic_process_tabs'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Process Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Featured Image',
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Process Text Content',
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
        <div class="process-tab-container grid-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="nav nav-pills">
                            <?php echo $this->tabnavs ?>
                        </div>
                    </div>
                    <!-- End of .col -->

                    <div class="col-lg-7">
                        <div class="tab-content">
                            <?php echo $content; ?>
                        </div>
                    </div>
                    <!-- End of .col -->
                </div>
                <!-- End of .row -->
            </div>
        </div>
        <!-- End of .process-tab-container -->
        <?php
        $this->tabcount = 0;
        $this->tabnavs = '';
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'image' => '',
                'title' => '',
            ), $atts);
        extract($atts);
        $tabactivecls = '';
        if ($this->tabcount == 0) {
            $tabactivecls = 'active';
        }
        $tabid = 'process-tab-' . uniqid(rand(000000, 999999));
        ob_start();
        $numberFormat = $this->tabcount+1; ?>
        <a class="nav-link <?php echo esc_attr($tabactivecls); ?>" data-toggle="pill" href="#<?php echo $tabid ?>">
            <span><?php echo str_pad($numberFormat, 2, '0', STR_PAD_LEFT); ?></span>
            <?php echo esc_html($title) ?>
            <i class="fal fa-long-arrow-right"></i>
        </a>
        <?php
        $this->tabnavs .= ob_get_clean();
        ob_start(); ?>
        <div class="tab-pane fade show <?php echo $tabactivecls ?>" id="<?php echo $tabid ?>">
            <div class="img-card process-card">
                <?php
                if ($image) {
                    echo wp_get_attachment_image((int) $image, 'full', false, array('class' => 'img-fluid'));
                } ?>
                <div class="process-card-content">
                    <h3><?php echo esc_html($title); ?></h3>
                    <?php echo apply_filters('the_content', $content) ?>
                </div>
            </div>
            <!-- undefined -->
        </div>
        <?php
        $this->tabcount++;
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_Process_Tabs extends WPBakeryShortCodesContainer {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_Process_Tab extends WPBakeryShortCode {

    }

}