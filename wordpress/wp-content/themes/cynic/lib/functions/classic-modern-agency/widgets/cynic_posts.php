<?php

class Cynic_Posts_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
            $widget_ops = array( 
                'classname' => 'cynic_posts_widget',
                'description' => esc_html__('Posts List Widget', 'cynic'),
            );
            parent::__construct( 'cynic_posts_widget', esc_html__('Posts List Widget', 'cynic'), $widget_ops );
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
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $instance['numposts'],
                'orderby' => $instance['orderby'],
                'order' => $instance['order'],
            );
            $query = new WP_Query($args);
            if($query->have_posts()){
            ?>
            <div class="widget-item">
                <?php while($query->have_posts()){ $query->the_post();?>
                <div class="widget-product">
                    <div class="widget-img">
                            <a href="<?php the_permalink()?>">
                                <?php the_post_thumbnail('hoper-post-thumbnail')?>
                            </a>
                    </div>
                    <div class="product-info">
                            <h5><a href="<?php the_permalink()?>"><?php the_title();?></a></h5>
                            <?php the_excerpt()?>
                    </div>
                </div>
                <?php }?>
            </div>
            <?php }
            wp_reset_postdata();
            echo esc_html_decode($args['after_widget']);
            
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
            // outputs the options form on admin
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'cynic' ); ?></label> 
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'numposts' ) ); ?>"><?php esc_attr_e( 'Showposts:', 'cynic' ); ?></label> 
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'numposts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'numposts' ) ); ?>" type="text" value="<?php echo esc_attr( ($instance['numposts'] ? $instance['numposts'] : 3) ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_attr_e( 'Orderby:', 'cynic' ); ?></label> 
                <?php
                $orderbyarr = array(
                    'ID' => esc_html__('Post ID', 'cynic'),
                    'title' => esc_html__('Post Title', 'cynic'),
                    'name' => esc_html__('Post Url', 'cynic'),
                    'date' => esc_html__('Post Published', 'cynic'),
                    'comment_count' => esc_html__('Comments', 'cynic'),
                    'rand' => esc_html__('Random', 'cynic'),
                );
                $orderarr = array(
                    'DESC' => esc_html__('Decending', 'cynic'),
                    'ASC' => esc_html__('Ascending', 'cynic'),
                );
                
                ?>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
                    <?php foreach($orderbyarr as $key=>$val){
                    $selected = '';
                    if($instance['orderby'] == $key){
                        $selected = ' selected="selected"';
                    }
                    ?>
                    <option<?php print $selected?> value="<?php echo esc_attr($key)?>"><?php echo esc_html($val)?></option>
                    <?php }?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_attr_e( 'Order:', 'cynic' ); ?></label> 
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
                    <?php foreach($orderarr as $key=>$val){
                    $selected = '';
                    if($instance['order'] == $key){
                        $selected = ' selected="selected"';
                    }
                    ?>
                    <option<?php print $selected?> value="<?php echo esc_attr($key)?>"><?php echo esc_html($val)?></option>
                    <?php }?>
                </select>
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
            $instance['title'] = $new_instance['title'];
            $instance['numposts'] = $new_instance['numposts'];
            $instance['orderby'] = $new_instance['orderby'];
            $instance['order'] = $new_instance['order'];

            return $instance;
	}
}

