<?php

class CynicImageBoxText{
    
    public function __construct()
    {
        add_shortcode('cynic_image_box', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        
    }
    public function addMap()
    {
        if(function_exists('vc_map')){
            $args = array(
                'base' => 'cynic_image_box',
                'name' => __('Image Box With Text', 'cynic'),
                "category" => __( "Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
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
                        'heading' => 'Text Content',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Image Alignment', 'cynic' ),
						'value' => array(
							__( 'Left', 'cynic' ) => '1',
							__( 'Right', 'cynic' ) => '2',
						),
						'admin_label' => true,
						'param_name' => 'alignment',
						'description' => __( 'Select text alignment.', 'cynic' ),
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
                    'image' => '', 
                    'alignment' => '1',
                ), $atts);
        extract($atts);
        ob_start();
		if($content){
			$imagemarkup = '<div>'.wp_get_attachment_image((int)$image, array(560, 410), false, array('class'=>'img-responsive')).'</div>';
			$textclass = $before = $after = '';
			switch($alignment){
				case '2':
					$textclass = ' less-padding';
					$after = $imagemarkup;
					break;
				default:
					$before = $imagemarkup;
					break;
			}
		?>
		<div class="dis-table">
			<?php echo $before;?>
			<div class="text-box<?php echo $textclass?>">
				<?php echo apply_filters('the_content', $content)?>
			</div>
			<?php echo $after;?>
		</div>
		<?php 
		}
        return ob_get_clean();
    }
}