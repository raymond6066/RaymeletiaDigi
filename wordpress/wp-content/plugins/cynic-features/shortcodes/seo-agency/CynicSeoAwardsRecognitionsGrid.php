<?php

class CynicSeoAwardsRecognitionsGrid
{
    protected $per_row;

    public function __construct()
    {
        add_shortcode('cynic_seo_awards_recognitions_grids', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_awards_recognitions_grid', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('Awards & Recognitions', 'cynic'),
                'base' => 'cynic_seo_awards_recognitions_grids',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_awards_recognitions_grid'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
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
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Show per row', 'cynic'),
                        'param_name' => 'per_row',
                        'description' => __('Select grid per row.', 'cynic'),
                        'value' => array(2, 3, 4),
                        'admin_label' => true,
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_awards_recognitions_grid',
                'name' => __('Awards & Recognitions Items', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_awards_recognitions_grids'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Image', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __('Select images from media library.', 'cynic'),
                    ),

                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => __('Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => '',
                        'description' => __('Title text.', 'cynic'),
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Sub Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'sub_title',
                        'value' => '',
                        'description' => __('Sub Title text.', 'cynic'),
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Description',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Link',
                        'type' => 'vc_link',
                        'setting'=>'title',
                        'param_name' => 'button_link',
                        'value' => '',
                        'description' => __('Keep empty if you don\'t want to use.', 'cynic'),
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
                'per_row' => '3',
            ), $atts);
        $extra_class = $attributes['extra_class'];
        $per_row = $attributes['per_row'];
        $rows = 'col-lg-3';
        if ($per_row == 1) {
            $rows = 'col-lg-12';
        } elseif ($per_row == 2) {
            $rows = 'col-lg-6';
        } elseif ($per_row == 3) {
            $rows = 'col-lg-4';
        } elseif ($per_row == 4) {
            $rows = 'col-lg-3';
        }

        $this->per_row = $rows;


        $content = do_shortcode($content);
        ob_start(); ?>
        <div class="<?php echo esc_attr($extra_class); ?>">
            <div class="row">
                <?php
                echo esc_html_cynicSEO_string($content);
                ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'image' => '',
                'title' => '',
                'sub_title' => '',
                'button_link' => '',
            ), $atts);

        $per_rows = $this->per_row;
        $image = $attributes['image'];
        $title = $attributes['title'];
        $sub_title = $attributes['sub_title'];

        $linkArr = vc_build_link($attributes['button_link']);
        $linkUrl = ((isset($linkArr['url']) && (!empty($linkArr['url']))) ? $linkArr['url'] : '');
        $linkTitle = ((isset($linkArr['title']) && (!empty($linkArr['title']))) ? $linkArr['title'] : "View Details");
        $linkAttr = '';
        if (isset($linkArr['target']) && !empty($linkArr['target'])) {
            $linkAttr = ' target="' . $linkArr['target'] . '"';
        }

        if (isset($linkArr['rel']) && !empty($linkArr['rel'])) {
            $linkAttr .= ' rel="' . $linkArr['rel'] . '"';
        }
        $startLink = '';
        if (!empty($linkUrl)) {
            $startLink = '<a href="' . $linkUrl . '" ' . $linkAttr . '>';
        }
        ob_start();

        ?>

        <div class="col-sm-6 <?php echo esc_html_cynicSEO_string($per_rows); ?>">
            <?php echo esc_html_cynicSEO_string($startLink); ?>
            <div class="content text-center">
                <?php echo wp_get_attachment_image($image, 'full', false, ['alt' => $title]); ?>
                <h3><?php echo esc_html_cynicSEO_string($title) ?>
                    <span><?php echo esc_html_cynicSEO_string($sub_title); ?></span>
                </h3>
                <p><?php echo esc_html_cynicSEO_string($content); ?></p>
            </div>
            <?php
            if (!empty($startLink)) {
                echo esc_html_cynicSEO_string('</a>');
            }
            ?>
        </div>

        <?php
        return ob_get_clean();

    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_awards_recognitions_grids extends WPBakeryShortCodesContainer
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

    class WPBakeryShortCode_cynic_seo_awards_recognitions_grid extends WPBakeryShortCode
    {

    }


}
