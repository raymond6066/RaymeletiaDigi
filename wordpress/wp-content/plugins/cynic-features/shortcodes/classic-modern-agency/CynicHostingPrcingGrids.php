<?php

class CynicHostingPricingGrids {

    public function __construct() {
        add_shortcode('cynic_hosting_pricing', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'), 1000);
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            /* Get All Pages*/
            
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->ID;
                }
            }
            
            $args = array(
                'base' => 'cynic_hosting_pricing',
                'name' => __('Hosting Pricing', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        'heading' => 'Pricing Plan',
                        'type' => 'textfield',
                        'param_name' => 'pricing_plan',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Is Featured',
                        'type' => 'dropdown',
                        'param_name' => 'is_featured',
                        'std' => 'No',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Pricing Slot Title',
                        'type' => 'textfield',
                        'param_name' => 'slot_title',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Pricing Slot',
                        'type' => 'textarea',
                        'param_name' => 'pricing_slot',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Buttlet Points',
                        'type' => 'textarea',
                        'param_name' => 'bullet_points',
                        'value' => '',
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
                        'param_name' => 'link_open_type',
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
                        ),
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'pricing_plan' => '',
            'is_featured' => '',
            'slot_title' => '',
            'pricing_slot' => '',
            'bullet_points' => '',
            'button_text' => 'SIGN UP NOW',
            'button_link' => '1',
            'internal_link' => '',
            'external_link' => '#',
            'link_open_type' => '0',
                ), $atts);
        extract($atts);
        ob_start();
        $newBulletPoints = array();
        if (isset($bullet_points) && !empty($bullet_points)) {
            $bullet_points = nl2br($bullet_points);
            $bullet_points = preg_replace("<br>", "***", $bullet_points);
            $newBulletPoints = explode('<*** />', $bullet_points);
        } ?>
        <div class="content text-left">
            <div class="plan-title<?php if(isset($is_featured) && $is_featured=="yes") { echo esc_attr(' essential'); } ?>"><?php echo html_entity_decode(esc_html($pricing_plan)); ?></div>
            <div class="pricing-inner equalheight">
                <div class="price">
                    <?php echo esc_html($slot_title); ?>
                    <span><?php echo html_entity_decode(esc_html($pricing_slot)); ?></span>
                </div>
                <?php 
                if(isset($newBulletPoints) && !empty($newBulletPoints)) { 
                    foreach($newBulletPoints as $point) {    ?>
                        <span><i class="icon-checkmark-circle"></i> <?php echo esc_html($point); ?></span>
                        <?php 
                    } 
                } ?>
            </div>
            <?php 
            if (isset($button_link) && !empty($button_link)) { 
                $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; ?>
                <a href="<?php echo esc_url($link) ?>" <?php if (isset($link_open_type) && $link_open_type == '1') { ?> target="_blank" <?php } ?> class="btn btn-fill full-width"><?php echo esc_html($button_text) ?></a>
                <?php 
            } ?> 
        </div>
        <!-- End of .content -->
        <?php
        return ob_get_clean();
    }

}
