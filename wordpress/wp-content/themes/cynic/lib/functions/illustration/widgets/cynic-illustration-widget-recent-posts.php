<?php

class Cynic_Recent_Post_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'cynic_recent_post_widget', // Base ID
            esc_html__('Illustration: Recent Post', 'cynic'), // Name
            array('description' => esc_html__('Recent Post widget', 'cynic'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $title = (!empty($instance['title'])) ? $instance['title'] : __('Recent Posts', 'cynic');

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
        if (!$number) {
            $number = 5;
        }
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;

        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         * @since 4.9.0 Added the `$instance` parameter.
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         * @param array $instance Array of settings for the current widget.
         */
        $r = new WP_Query(apply_filters('widget_posts_args', array(
            'posts_per_page' => $number,
            'no_found_rows' => true,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
        ), $instance));

        if (!$r->have_posts()) {
            return;
        }
        ?>
        <?php echo esc_html_decode($args['before_widget']); ?>
        <?php

        if ($title) {
            echo esc_html_decode($args['before_title'] . $title . $args['after_title']);
        }
        ?>
            <?php foreach ($r->posts as $recent_post) : ?>
                <?php $title = get_the_title($recent_post->ID); ?>
                <div class="media">
                    <a href="<?php the_permalink($recent_post->ID); ?>">
                        <?php if (has_post_thumbnail($recent_post->ID)) { ?>
                            <?php echo get_the_post_thumbnail($recent_post->ID, 'cynic-recentpost-thumb'); ?>
                        <?php } else {
                            $default_image = getCynicOptionsVal('default_img');
                            echo cynic_getDefaultImages($default_image, 'cynic-recentpost-thumb', '','50','50');
                            ?>

                        <?php } ?>
                    </a>
                    <div class="media-body">
                        <?php
                        if ($show_date) { ?>
                            <div class="post-metas">
                                <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>"><?php echo get_the_date('j F, Y', $recent_post->ID); ?></a>
                            </div>
                            <?php
                        } ?>
                        <?php
                        if (isset($title) && !empty($title)) { ?>
                            <h6 class="mt-0">
                                <a href="<?php the_permalink($recent_post->ID); ?>"><?php echo esc_html_decode($title); ?></a>
                            </h6>
                            <?php
                        } else { ?>
                            <h6 class="mt-0">
                                <a href="<?php the_permalink($recent_post->ID); ?>"><?php echo "(no title)"; ?></a>
                            </h6>
                            <?php
                        } ?>
                    </div>
                    <!-- End of .media-body -->
                </div>
            <?php endforeach; ?>
        <?php
        echo esc_html_decode($args['after_widget']);
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        $show_date = isset($instance['show_date']) ? (bool)$instance['show_date'] : false;
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'cynic'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>"/></p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of posts to show:', 'cynic'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" step="1" min="1"
                   value="<?php echo esc_html($number); ?>" size="3"/></p>

        <p><input class="checkbox" type="checkbox"<?php checked($show_date); ?>
                  id="<?php echo esc_attr($this->get_field_id('show_date')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('show_date')); ?>"/>
            <label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php _e('Display post date?', 'cynic'); ?></label>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = (int)$new_instance['number'];
        $instance['show_date'] = isset($new_instance['show_date']) ? (bool)$new_instance['show_date'] : false;
        return $instance;
    }

} // class Foo_Widget


// register Foo_Widget widget
function register_cynic_recent_post_widget()
{
    register_widget('Cynic_Recent_Post_Widget');
}

add_action('widgets_init', 'register_cynic_recent_post_widget');