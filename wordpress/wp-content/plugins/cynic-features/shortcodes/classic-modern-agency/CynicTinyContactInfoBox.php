<?php

class CynicTinyContactInfoBox{
    
    public function __construct()
    {
        add_shortcode('cynic_tiny_info', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }
    public function addMap()
    {
        if(function_exists('vc_map')){
            $args = array(
                'base' => 'cynic_tiny_info',
                'name' => __('Tiny Contact Info Box With Icon', 'cynic'),
                "category" => __( "Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'title',
                        'type'  => 'textfield',
                        'heading' => __( 'Title', 'cynic' ),
                        'value' => '',
                        'admin_label' => true,
                    ),
					array(
						'type' => 'dropdown',
						'param_name' => 'contact_info_type',
						'heading' => __( 'Contact Info Type', 'cynic' ),
						'value' => array(
							__( 'Phone No', 'cynic' ) => 'phone_no',
							__( 'Email', 'cynic' ) => 'email',
							__( 'Others', 'cynic' ) => 'others',
						)
					),
					array(
						"holder" => "div",
						"class" => "",
						'heading' => 'Contact Info',
						'type' => 'textarea',
						'param_name' => 'content',
						'value' => '',
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Icon library', 'cynic' ),
						'value' => array(
							__( 'Linear Icons', 'cynic' ) => 'linearicons',
							__( 'Font Awesome', 'cynic' ) => 'fontawesome',
						),
						'admin_label' => true,
						'param_name' => 'icon_type',
						'description' => __( 'Select icon library.', 'cynic' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Info Icon', 'cynic' ),
						'param_name' => 'icon_linearicons',
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'linearicons',
							'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'linearicons',
						),
						'value' => 'icon-users2',
						'description' => __( 'Select service icon from library.', 'cynic' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Info Icon', 'cynic' ),
						'param_name' => 'icon_fontawesome',
						'value' => 'fa fa-adjust',
						// default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false,
							// default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000,
							// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'fontawesome',
						),
						'description' => __( 'Select icon from library.', 'cynic' ),
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
					'title' => '', 
					'contact_info_type' => 'phone_no',
                    'icon_type' => 'linearicons', 
                    'icon_linearicons' => 'icon-users2',
                    'icon_fontawesome' => '',
                ), $atts);
        extract($atts);
		if(function_exists('vc_icon_element_fonts_enqueue')){
			vc_icon_element_fonts_enqueue( $icon_type );
		}
		if($icon_type == 'fontawesome'){
			$iconclass = 'fa '.$icon_fontawesome;
		}else{
			$iconclass = $icon_linearicons;
		}
		
        ob_start();
		if($title){
		?>		
		  <div class="contact-info-box"> <span class="<?php echo esc_attr($iconclass)?>"></span>
			<div>
			  <h6><?php echo esc_html($title)?></h6>
			  	<p>
					<?php if(isset($contact_info_type) && $contact_info_type=='email')  { ?>
							<a href="mailto:<?php echo esc_attr($content)?>"><?php echo esc_html($content)?></a>
					<?php } elseif(isset($contact_info_type) && $contact_info_type=='phone_no')  { ?>
							<a href="tel:<?php echo esc_attr(str_replace(' ', '', $content))?>"><?php echo esc_html($content)?></a>
					<?php } else { ?>
							<?php echo esc_html($content)?>
					<?php } ?>
				</p>
			</div>
		  </div>
		<?php 
		}
        return ob_get_clean();
    }
}