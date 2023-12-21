<?php

class CynicSeoTextContentGrid
{
    protected $per_row;

    public function __construct()
    {
        add_shortcode('cynic_seo_content_grids', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_content_grid', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));

    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'name' => __('Text Content', 'cynic'),
                'base' => 'cynic_seo_content_grids',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_content_grid'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => false,
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Show per row', 'cynic'),
                        'admin_label' => true,
                        'param_name' => 'per_row',
                        'description' => __('Select grid per row.', 'cynic'),
                        'value' => array(1, 2, 3, 4),
                        'class'=>'cynic_vc_parent_padding'
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_content_grid',
                'name' => __('Content Block', 'cynic'),
                "category" => __("Cynic Blocks", "cynic"),
                "as_child" => array('only' => 'cynic_seo_content_grids'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
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
                        "holder" => "h2",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Title', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Title Tag', 'cynic'),
                        'value' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
                        'param_name' => 'title_tag',
                        'description' => __('Select A title tag.', 'cynic'),
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Title Alignment', 'cynic'),
                        'value' => array(
                            __('Select Alignment', 'cynic') => '',
                            __('Left', 'cynic') => 'text-left',
                            __('Right', 'cynic') => 'text-right',
                            __('Center', 'cynic') => 'text-center',
                            __('Justify', 'cynic') => 'text-justify',
                        ),
                        'param_name' => 'title_alignment',
                        'description' => __('Select A title alignment.', 'cynic'),
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
                        'type' => 'dropdown',
                        'heading' => __('Description Alignment', 'cynic'),
                        'value' => array(
                            __('Select Alignment', 'cynic') => '',
                            __('Left', 'cynic') => 'text-left',
                            __('Right', 'cynic') => 'text-right',
                            __('Center', 'cynic') => 'text-center',
                            __('Justify', 'cynic') => 'text-justify',
                        ),
                        'admin_label' => true,
                        'param_name' => 'desc_alignment',
                        'description' => __('Select A description alignment.', 'cynic'),
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Button Link',
                        'type' => 'vc_link',
                        'param_name' => 'button_link',
                        'value' => '',
                        'description' => __('Keep empty if don\'t want to use', 'cynic'),
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
                'per_row' => '2',
            ), $atts);
        ob_start();
        $extra_class = $attributes['extra_class'];
        $per_row = $attributes['per_row'];
        $rows = 'col-md-6';
        $rowClass = 'row';
        if ($per_row == 1) {
            $rows = '';
            $rowClass='';
        } elseif ($per_row == 2) {
            $rows = 'col-md-6';
        } elseif ($per_row == 3) {
            $rows = 'col-md-4';
        } elseif ($per_row == 4) {
            $rows = 'col-md-3';
        }
        $this->per_row = $rows;
        $content = do_shortcode($content);
        ?>
        <div class="<?php echo esc_attr($extra_class.' '.$rowClass); ?>">
            <?php echo $content; ?>
        </div>
        <?php
        return ob_get_clean();
    }


    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'title' => '',
                'title_tag' => 'h2',
                'title_alignment' => 'text-left',
                'desc_alignment' => 'text-left',
                'button_link' => '',
            ), $atts);

        ob_start();
        $per_rows = $this->per_row;

        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        $title_tag = $attributes['title_tag'];
        $title_alignment = $attributes['title_alignment'];
        $desc_alignment = $attributes['desc_alignment'];
        $linkArr = vc_build_link($attributes['button_link']);
        $titleContent = '<' . $title_tag . ' class="' . $title_alignment . '">' . $title . '</' . $title_tag . '>';
        ?>

        <div class="<?php echo esc_attr($per_rows); ?> <?php echo esc_attr($extra_class); ?>">
            <div class="text-content <?php echo esc_attr($desc_alignment); ?>">
                <?php
                if (!empty($title)) {
                    echo esc_html_cynicSEO_string($titleContent);
                }
                if (!empty($content)) {
                    ?>
                    <p><?php echo esc_html_cynicSEO_string($content) ?></p>
                    <?php
                }
                echo cynicSEO_anchor_link_html($linkArr);
                ?>
            </div>
            <!-- End of .text-content -->
        </div>
        <!-- End of .col-md-6 -->
        <?php
        return ob_get_clean();
    }

}


if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_content_grids extends WPBakeryShortCodesContainer
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

    class WPBakeryShortCode_cynic_seo_content_grid extends WPBakeryShortCode
    {

    }


}