<?php

class CynicTinySocialBox{
    
    public function __construct()
    {
        add_shortcode('cynic_social_box', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }
    public function addMap()
    {
        if(function_exists('vc_map')){
            $args = array(
                'base' => 'cynic_social_box',
                'name' => __('Tiny Social Info Box', 'cynic'),
                "category" => __( "Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'facebook',
                        'type'  => 'textfield',
                        'heading' => __( 'Facebook Url', 'cynic' ),
                        'value' => '',
                        'admin_label' => false,
                    ),
					array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'twitter',
                        'type'  => 'textfield',
                        'heading' => __( 'Twitter Url', 'cynic' ),
                        'value' => '',
                        'admin_label' => false,
                    ),
					array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'gplus',
                        'type'  => 'textfield',
                        'heading' => __( 'Google+ Url', 'cynic' ),
                        'value' => '',
                        'admin_label' => false,
                    ),
					array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'instagram',
                        'type'  => 'textfield',
                        'heading' => __( 'Instagram Url', 'cynic' ),
                        'value' => '',
                        'admin_label' => false,
                    ),array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'pinterest',
                        'type'  => 'textfield',
                        'heading' => __( 'Pinterest Url', 'cynic' ),
                        'value' => '',
                        'admin_label' => false,
                    ),array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'linkedin',
                        'type'  => 'textfield',
                        'heading' => __( 'Linkedin Url', 'cynic' ),
                        'value' => '',
                        'admin_label' => false,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'youtube',
                        'type'  => 'textfield',
                        'heading' => __( 'Youtube Url', 'cynic' ),
                        'value' => '',
                        'admin_label' => false,
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
                    'facebook' => '', 
                    'twitter' => '', 
                    'gplus' => '', 
                    'instagram' => '', 
                    'pinterest' => '', 
                    'linkedin' => '', 
                    'youtube' => ''
                ), $atts);
        extract($atts);
        ob_start();
		?>	
		<div class="contact-info-box">
			<ul class="social-links">
				<?php if($facebook){?>
				<li><a href="<?php echo esc_url($facebook)?>"><span class="fa fa-facebook"></span></a></li>
				<?php }?>
				<?php if($twitter){?>
				<li><a href="<?php echo esc_url($twitter)?>"><span class="fa fa-twitter"></span></a></li>
				<?php }?>
				<?php if($gplus){?>
				<li><a href="<?php echo esc_url($gplus)?>"><span class="fa fa-google-plus"></span></a></li>
				<?php }?>
				<?php if($instagram){?>
				<li><a href="<?php echo esc_url($instagram)?>"><span class="fa fa-instagram"></span></a></li>
				<?php }?>
				<?php if($pinterest){?>
				<li><a href="<?php echo esc_url($pinterest)?>"><span class="fa fa-pinterest"></span></a></li>
				<?php }?>
				<?php if($linkedin){?>
				<li><a href="<?php echo esc_url($linkedin)?>"><span class="fa fa-linkedin"></span></a></li>
                <?php }?>
                <?php if($youtube){?>
				<li><a href="<?php echo esc_url($youtube)?>"><span class="fa fa-youtube"></span></a></li>
				<?php }?>
			</ul>
		</div>
		<?php
        return ob_get_clean();
    }
}