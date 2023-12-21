<?php

class Cynic_News_letter_Form_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'cynic_news_letter_form_widget', // Base ID
            esc_html__('Seo Agency : News Letter Form', 'cynic'), // Name
            array('description' => esc_html__('A News Letter widget', 'cynic'),) // Args
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
        $title = $instance['title'];
        $contform7code = $instance['form_shortcode'];
        $formHtml = do_shortcode($contform7code);
        ?>
        <ul class="footer-mid-nav footer-newsletter">
            <li class="nav-item"><?php echo esc_html($title); ?></li>
            <li class="nav-item">
                <?php echo esc_html_decode($formHtml); ?>
            </li>
        </ul>
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
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'cynic'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_html($title); ?>"/>
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
    
} // class Foo_Widget


// register Foo_Widget widget
function register_cynic_news_letter_form_widget()
{
    register_widget('Cynic_News_letter_Form_Widget');
}

add_action('widgets_init', 'register_cynic_news_letter_form_widget');