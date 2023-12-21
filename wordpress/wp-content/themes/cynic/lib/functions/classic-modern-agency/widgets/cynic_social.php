<?php

class Cynic_Social_Widget extends WP_Widget {

	public $default_fields;
	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
            $widget_ops = array(
                'classname' => 'cynic_social_widget',
                'description' => esc_html__('Social Media Widget', 'cynic'),
            );
			$this->default_fields = array(
				'title' => '',
				'fb' => '#',
				'tw' => '#',
				'gplus' => '#',
				'ins' => '#',
				'pin' => '#',
				'led' => '#',
				'youtube' => '#',
			);

            parent::__construct( 'cynic_social_widget', esc_html__('Social Media Widget', 'cynic'), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
            // outputs the content of the widget
            echo esc_html_decode($args['before_widget']);
            if ( ! empty( $instance['title'] ) ) {
                echo esc_html_decode($args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']);
            }
            ?>
			<div class="footer-icons">
				<ul class="social-links">
					<?php if($instance['fb']){?>
					<li>
						<a href="<?php echo esc_url($instance['fb'])?>">
							<i class="fa fa-facebook"></i>
						</a>
					</li>
					<?php }?>
					<?php if($instance['tw']){?>
					<li>
						<a href="<?php echo esc_url($instance['tw'])?>">
							<i class="fa fa-twitter"></i>
						</a>
					</li>
					<?php }?>
					<?php if($instance['gplus']){?>
					<li>
						<a href="<?php echo esc_url($instance['gplus'])?>">
							<i class="fa fa-google-plus"></i>
						</a>
					</li>
					<?php }?>
					<?php if($instance['ins']){?>
					<li>
						<a href="<?php echo esc_url($instance['ins'])?>">
							<i class="fa fa-instagram"></i>
						</a>
					</li>
					<?php }?>
					<?php if($instance['pin']){?>
					<li>
						<a href="<?php echo esc_url($instance['pin'])?>">
							<i class="fa fa-pinterest"></i>
						</a>
					</li>
					<?php }?>
					<?php if($instance['led']){?>
					<li>
						<a href="<?php echo esc_url($instance['led'])?>">
							<i class="fa fa-linkedin"></i>
						</a>
					</li>
					<?php }?>
					<?php if(isset($instance['youtube']) && $instance['youtube']){?>
					<li>
						<a href="<?php echo esc_url($instance['youtube'])?>">
							<i class="fa fa-youtube"></i>
						</a>
					</li>
					<?php }?>
				</ul>
			</div>
            <?php
            echo esc_html_decode($args['after_widget']);
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
            // outputs the options form on admin

			$instance = wp_parse_args( $instance, $this->default_fields );

            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'fb' ) ); ?>"><?php esc_attr_e( 'Facebook Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb' ) ); ?>" type="text" value="<?php print $instance['fb']; ?>">
            </p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'tw' ) ); ?>"><?php esc_attr_e( 'Twitter Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tw' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tw' ) ); ?>" type="text" value="<?php print $instance['tw']; ?>">
            </p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'gplus' ) ); ?>"><?php esc_attr_e( 'Google+ Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gplus' ) ); ?>" type="text" value="<?php print $instance['gplus']; ?>">
            </p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'ins' ) ); ?>"><?php esc_attr_e( 'Instagram Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ins' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ins' ) ); ?>" type="text" value="<?php print $instance['ins']; ?>">
            </p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'pin' ) ); ?>"><?php esc_attr_e( 'Pinterest Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pin' ) ); ?>" type="text" value="<?php print $instance['pin']; ?>">
            </p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'led' ) ); ?>"><?php esc_attr_e( 'Linkedin Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'led' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'led' ) ); ?>" type="text" value="<?php print $instance['led']; ?>">
			</p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_attr_e( 'Youtube Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php print $instance['youtube']; ?>">
            </p>
            <?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
            // processes widget options to be saved
            $instance = array();
			foreach($this->default_fields as $key => $def){
				$instance[$key] = $new_instance[$key];
			}

            return $instance;
	}
}


function register_cynic_Social_Widget(){

    register_widget('Cynic_Social_Widget');
}

add_action('widgets_init', 'register_cynic_Social_Widget');
