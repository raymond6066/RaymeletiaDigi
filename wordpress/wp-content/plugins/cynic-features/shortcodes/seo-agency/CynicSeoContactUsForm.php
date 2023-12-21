<?php

class CynicSeoContactUsForm
{

    protected $taxonomy;
    protected $post_type;
    protected $modalhtml;

    public function __construct()
    {
        add_shortcode('cynic_seo_contact_us_form', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        add_action('wp_footer', array($this, 'append_modal_html'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $pagearr = cynicSEO_get_all_pages();
            $args = array(
                'base' => 'cynic_seo_contact_us_form',
                'name' => __('Contact Us Form', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "is_container" => false,
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
                        "holder" => "h1",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Title', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Select Contact US Page',
                        'type' => 'dropdown',
                        'param_name' => 'page_id',
                        'value' => $pagearr,
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Open with Modal?', 'cynic'),
                        'param_name' => 'is_modal',
                        'description' => __('Enable/Disable open with modal.', 'cynic'),
                        'value' => array(
                            __('Yes', 'cynic') => 'yes',
                            __('No', 'cynic') => 'no',
                        ),
                    ),

                    array(
                        "holder" => "",
                        'param_name' => 'modal_buttonn_text',
                        'type' => 'textfield',
                        'heading' => __('Modal Button Text', 'cynic'),
                        'value' => '',
                        'dependency' => array(
                            'element' => 'is_modal',
                            'value' => 'yes',
                        ),
                    ),

                    array(
                        "holder" => "",
                        'param_name' => 'modal_header_title',
                        'type' => 'textfield',
                        'heading' => __('Modal Header Title', 'cynic'),
                        'value' => '',
                        'dependency' => array(
                            'element' => 'is_modal',
                            'value' => 'yes',
                        ),
                    ),

                    array(
                        "holder" => "",
                        'param_name' => 'modal_close_text',
                        'type' => 'textfield',
                        'heading' => __('Modal Close Text', 'cynic'),
                        'value' => '',
                        'dependency' => array(
                            'element' => 'is_modal',
                            'value' => 'yes',
                        ),
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Form Display Type', 'cynic'),
                        'param_name' => 'form_type',
                        'description' => __('Form Display on the page or rediect to another page.', 'cynic'),
                        'value' => array(
                            __('Inline Form', 'cynic') => 'inline',
                            __('Link', 'cynic') => 'link',
                        ),
                        'dependency' => array(
                            'element' => 'is_modal',
                            'value' => 'no',
                        ),
                    ),

                    array(
                        "holder" => "",
                        'param_name' => 'link_buttonn_text',
                        'type' => 'textfield',
                        'heading' => __('link Button Text', 'cynic'),
                        'value' => '',
                        'dependency' => array(
                            'element' => 'form_type',
                            'value' => 'link',
                        ),
                    ),

                    array(
                        "holder" => "",
                        'param_name' => 'link_open_type',
                        'type' => 'dropdown',
                        'heading' => __('Link Open Type', 'cynic'),
                        'value' => array(
                            __('New Window', 'cynic') => '_blank',
                            __('Same Window', 'cynic') => '_self',
                        ),
                        'dependency' => array(
                            'element' => 'form_type',
                            'value' => 'link',
                        ),
                    ),


                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'title' => '',
                'page_id' => '',
                'modal_buttonn_text' => __('Contact Us', 'cynic'),
                'modal_header_title' => __('Tell Us About Your Project', 'cynic'),
                'modal_close_text' => __('Close', 'cynic'),
                'link_buttonn_text' => __('Contact Us', 'cynic'),
                'is_modal' => 'yes',
                'form_type' => 'inline',
                'link_open_type' => '_blank',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $title = trim($attributes['title']);
        $page_id = $attributes['page_id'];
        $modal_buttonn_text = trim($attributes['modal_buttonn_text']);
        $modal_header_title = trim($attributes['modal_header_title']);
        $modal_close_text = trim($attributes['modal_close_text']);

        $link_buttonn_text = trim($attributes['link_buttonn_text']);
        $is_modal = $attributes['is_modal'];
        $form_type = $attributes['form_type'];
        $link_open_type = $attributes['link_open_type'];

        $generalbtnText = '';

        $post = get_post($page_id);
        if ($post && !empty($page_id)) {
            $WrapperFormAttr = " ";
            ob_start();
            if ($is_modal == 'yes') {
                $form_id = "contact-form-" . uniqid(rand(000000, 999999));
                $WrapperFormAttr = 'data-toggle=modal data-target=' . $form_id;
            }

            if ($is_modal == 'yes' || $form_type == 'inline') {
                $content = apply_filters('the_content', $post->post_content);
                if ($is_modal == 'yes') {
                    $generalbtnText = $modal_buttonn_text;
                    $modalhtml = '<div class="footer-modal modal fade" id="' . esc_attr($form_id) . '" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">';
                    $modalhtml .= '<div class="contact-form-modal modal-dialog modal-dialog-centered">';
                    $modalhtml .= '<div class="form-content">';

                    $modalhtml .= '<div class="form-heading d-flex justify-content-between align-items-center">
                    <h3 id="contactModalLabel">' . $modal_header_title . '</h3>
                    <a href="javascript:void(0)" class="ff-close-btn" data-dismiss="modal">' . $modal_close_text . '</a></div>';
                    $modalhtml .= $content;

                    $modalhtml .= '</div>';
                    $modalhtml .= '</div>';
                    $modalhtml .= '</div>';

                    $this->modalhtml = $modalhtml;
                } else {
                    echo apply_filters('the_content', $content);
                }
                ?>
                <?php
            } else {
                $generalbtnText = $link_buttonn_text;
                $WrapperFormAttr = 'href=' . get_permalink($page_id) . ' target=' . $link_open_type;
            }

            if ($is_modal == 'yes' || $form_type == 'link') {
                ?>
                <div class="container">
                    <div class="form-heading d-flex justify-content-between align-items-center <?php echo esc_attr($extra_class); ?>">
                        <?php if (!empty($title)) { ?>
                            <h3 class="visible"><?php echo esc_html_cynicSEO_string($title); ?></h3>
                            <?php
                        }
                        if (!empty($generalbtnText)) {
                            ?>
                            <a class="primary-btn cynicSEO_contact_us_form" <?php echo esc_attr($WrapperFormAttr); ?>><?php echo esc_html($generalbtnText); ?></a>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
            return ob_get_clean();
        }

    }

    function append_modal_html()
    {
        echo $this->modalhtml;
    }
}
