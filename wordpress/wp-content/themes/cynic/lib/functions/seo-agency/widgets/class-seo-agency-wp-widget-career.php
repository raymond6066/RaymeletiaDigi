<?php

class Cynic_Career_Online_Submit_Form_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'cynic_online_submit_form_widget', // Base ID
            esc_html__('SEO Agency:Online Submit Form', 'cynic'), // Name
            array('description' => esc_html__('An online submit form widget', 'cynic'),) // Args
        );
        add_filter('wpcf7_form_tag', array($this, 'ses_add_plugin_list_to_contact_form'), 10, 2);
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
        $title = $instance['title'];
        $contform7code = $instance['form_shortcode'];
        $formHtml = do_shortcode($contform7code);
        ?>
        <div class="form-content">
            <div class="form-container">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if (!empty($title)) {
                            ?>
                            <h3><?php echo esc_html($title); ?></h3>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                echo esc_html_decode($formHtml);
                ?>
                <!-- End of form -->
            </div>
            <!-- End of .form-container -->
        </div>
        <?php
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
        $form_shortcode = isset($instance['form_shortcode']) ? esc_attr($instance['form_shortcode']) : '';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'cynic'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('form_shortcode')); ?>"><?php esc_html_e('Contact Form Short Code:', 'cynic'); ?></label>
            <textarea class="widefat" name="<?php echo esc_attr($this->get_field_name('form_shortcode')); ?>"
                      id="<?php echo esc_attr($this->get_field_id('form_shortcode')); ?>"><?php echo esc_html($form_shortcode); ?></textarea>
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
        $instance['form_shortcode'] = sanitize_text_field($new_instance['form_shortcode']);
        return $instance;
    }

    function ses_add_plugin_list_to_contact_form($tag, $unused)
    {
        if ($tag['name'] != 'cynic_career_job_lists')
            return $tag;

        $args = array(
            'order' => 'DESC',
            'post_type' => 'positions',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC');
        $plugins = get_posts($args);

        if (!$plugins)
            return $tag;

        $i = 0;
        foreach ($plugins as $plugin) {
            $tag['raw_values'][] = $plugin->post_title;
            $tag['values'][] = $plugin->post_title;
            $tag['labels'][] = $plugin->post_title;
        }

        return $tag;
    }

} // class Foo_Widget


// register Foo_Widget widget
function register_cynic_career_online_submit_form_widget()
{
    register_widget('Cynic_Career_Online_Submit_Form_Widget');
}

add_action('widgets_init', 'register_cynic_career_online_submit_form_widget');