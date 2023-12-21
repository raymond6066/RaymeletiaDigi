<?php

class CynicScoreboard{
    
    public function __construct()
    {
        add_shortcode('cynic_scoreboard', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        
    }
    public function addMap()
    {
        if(function_exists('vc_map')){
            $args = array(
                'base' => 'cynic_scoreboard',
                'name' => __('Scoreboard', 'cynic'),
                "category" => __( "Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'title',
                        'type'  => 'textfield',
                        'heading' => __( 'Heading', 'cynic' ),
                        'value' => '',
                        'admin_label' => true,
                    ),
					array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Score Text',
                        'type' => 'textarea',
                        'param_name' => 'content',
                        'value' => "+2.64% sessions\n+12.35% average session duration\n+25.47% pageviews\n-53.21% bounce rate\n+22.23% pages per session\n+22.23% growth in sales",
						"description" => __( "Enter each content in separate line", "cynic" )
                    ),
					array(
                        "holder" => "div",
                        "class" => "",
                        'param_name'  => 'bg_color',
                        'type'  => 'colorpicker',
                        'heading' => __( 'Background Color', 'cynic' ),
                        'value' => '#323a45',
                        'admin_label' => true,
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
                    'bg_color' => '#323a45',
                ), $atts);
        extract($atts);
        ob_start();
		if($content){
			$exploded = explode("\n", $content);
			if(!empty($exploded)){
				if($title){
				?>
				<h2 class="b-clor text-align-center"><?php echo $title?></h2>
				<?php 
				}
				?>
				<div class="score-table" data-bg-color="<?php echo $bg_color?>">
					<ul>
						<?php
						foreach($exploded as $text){
							echo "<li>{$text}</li>";
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<?php
			}
		}
        return ob_get_clean();
    }
}