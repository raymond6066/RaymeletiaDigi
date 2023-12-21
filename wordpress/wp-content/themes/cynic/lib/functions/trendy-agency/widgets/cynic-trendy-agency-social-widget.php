<?php

class cynic_social_widget extends WP_Widget {

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
				'behance' => '#',
				'twitter' => '#',
				'googleplus' => '#',
				'dribbble' => '#',
				'youtube' => '#',
				'facebook'=>'#',
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
				<ul class="social-icons">
					<?php if($instance['behance']){?>
					<li>
						<a href="<?php echo esc_url($instance['behance'])?>">
							<i class="fab fa-behance"></i>
						</a>
					</li>
					<?php }?>
                    <?php if($instance['twitter']){?>
					<li>
						<a href="<?php echo esc_url($instance['twitter'])?>">
							<i class="fab fa-twitter"></i>
						</a>
					</li>
					<?php }?>
                    <?php if($instance['googleplus']){?>
					<li>
						<a href="<?php echo esc_url($instance['googleplus'])?>">
							<i class="fab fa-google-plus-g"></i>
						</a>
					</li>
					<?php }?>
                    <?php if($instance['dribbble']){?>
					<li>
						<a href="<?php echo esc_url($instance['dribbble'])?>">
							<i class="fab fa-dribbble"></i>
						</a>
					</li>
					<?php }?>
                    <?php if($instance['youtube']){?>
					<li>
						<a href="<?php echo esc_url($instance['youtube'])?>">
							<i class="fab fa-youtube"></i>
						</a>
					</li>
					<?php }?>
                    <?php if($instance['facebook']){?>
					<li>
						<a href="<?php echo esc_url($instance['facebook'])?>">
							<i class="fab fa-facebook"></i>
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
                <label for="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>"><?php esc_attr_e( 'Behance Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behance' ) ); ?>" type="text" value="<?php print $instance['behance']; ?>">
            </p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_attr_e( 'Twitter Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php print $instance['twitter']; ?>">
            </p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>"><?php esc_attr_e( 'Google+ Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'googleplus' ) ); ?>" type="text" value="<?php print $instance['googleplus']; ?>">
            </p>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>"><?php esc_attr_e( 'Dribbble Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" type="text" value="<?php print $instance['dribbble']; ?>">
            </p>

			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_attr_e( 'Youtube Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php print $instance['youtube']; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_attr_e( 'Facebook Link:', 'cynic' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php print $instance['facebook']; ?>">
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

    register_widget('cynic_social_widget');
}

add_action('widgets_init', 'register_cynic_Social_Widget');
