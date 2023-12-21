<?php
/**
 * Description of CynicStartProjectGrid
 *
 * @author Axilweb
 */
class CynicStartProjectGrid {

    public function __construct() {
        add_shortcode('cynic_start_project', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            /* Get all pages */
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->ID;
                }
            }

            $args = array(
                'base' => 'cynic_start_project',
                'name' => __('Start Project Grids', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Select Layout', 'cynic'),
                        'value' => array(
                            __('Start Project Grid', 'cynic') => 'startproject',
                            __('Hosting Price Grid', 'cynic') => 'hosting_pricing',
                        ),
                        'admin_label' => true,
                        'param_name' => 'layout_type',
                        'description' => __('Select layout.', 'cynic'),
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __('Upload Image', 'cynic'),
                        'param_name' => 'image',
                        'dependency' => array(
                            'element' => 'layout_type',
                            'value' => 'hosting_pricing',
                        )
                    ),
                    array(
                        
                        'type' => 'textfield',
                        'heading' => __('Starting text', 'cynic'),
                        'param_name' => 'start_text',
                        'dependency' => array(
                            'element' => 'layout_type',
                            'value' => 'hosting_pricing',
                        )
                    ),
                    array(
                        
                        'type' => 'textfield',
                        'heading' => __('Currency', 'cynic'),
                        'param_name' => 'currency',
                        'dependency' => array(
                            'element' => 'layout_type',
                            'value' => 'hosting_pricing',
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Amount', 'cynic'),
                        'param_name' => 'amount',
                        'dependency' => array(
                            'element' => 'layout_type',
                            'value' => 'hosting_pricing',
                        )
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Payment Type', 'cynic'),
                        'param_name' => 'paymenttype',
                        'value' => array(
                            'Monthly' => '/month',
                            'Yearly' => '/year',
                        ),
                        'dependency' => array(
                            'element' => 'layout_type',
                            'value' => 'hosting_pricing',
                        )
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'heading',
                        'type' => 'textfield',
                        'heading' => __('Heading', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'sub_heading',
                        'type' => 'textarea',
                        'heading' => __('Sub Heading', 'cynic'),
                        'value' => '',
                        'dependency' => array(
                            'element' => 'layout_type',
                            'value' => 'startproject',
                        )
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'button_text',
                        'type' => 'textfield',
                        'heading' => __('Button Text', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
                        )
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Internal Link',
                        'type' => 'dropdown',
                        'param_name' => 'internal_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '1',
                        ),
                        'value' => $pagearr,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'External Link',
                        'type' => 'textfield',
                        'param_name' => 'external_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '2',
                        ),
                        'value' => '#',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
                        ),
                    ),
                )
            );
            vc_map($args);
        }
    }
    
   public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'layout_type' => 'startproject',
            'image' => '',
            'start_text' => '',
            'currency' => '',
            'amount' => '',
            'paymenttype' => '/month',
            'heading' => '',
            'sub_heading' => '',
            'button_text' => 'Work With Us',
            'button_link' => '',
            'internal_link' => '',
            'external_link' => '#',
            'open_type' => '0',
                ), $atts);
        extract($atts);
        ob_start(); 
        if(isset($layout_type) && $layout_type=="hosting_pricing") { 
            $imgsrc = wp_get_attachment_image_src($image, 'full');
            $imgsrc = $imgsrc[0];?>
            <div class="content" data-bg-img="<?php echo esc_url($imgsrc); ?>">
                <h2><?php echo esc_html($heading) ?></h2>
                <div class="price-lebel"><?php echo esc_html($start_text); ?><sup><?php echo esc_html($currency); ?></sup><span class="price"><?php echo esc_html($amount); ?></span><sub><?php echo esc_html($paymenttype); ?></sub> </div>
                <?php $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; ?>
                <a href="<?php echo esc_attr($link); ?>" <?php if (isset($open_type) && $open_type == '1') { ?> target="_blank" <?php } ?> class="btn btn-fill"><?php esc_html_e($button_text, 'cynic') ?></a> 
            </div>
        <?php } else { ?> 
            <div class="content clearfix">
                <div class="pull-left text-content">
                    <h2><?php echo esc_html($heading) ?></h2>
                    <p><?php echo html_entity_decode(esc_html($sub_heading)) ?></p>
                </div>
                <?php $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; ?>
                <a href="<?php echo esc_attr($link); ?>" <?php if (isset($open_type) && $open_type == '1') { ?> target="_blank" <?php } ?> class="btn btn-fill pull-right"><?php esc_html_e($button_text, 'cynic') ?></a> 
            </div>
        <?php
        }
        return ob_get_clean();
    }

}
