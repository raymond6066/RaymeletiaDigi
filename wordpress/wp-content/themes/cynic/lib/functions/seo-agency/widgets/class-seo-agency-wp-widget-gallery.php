<?php

class Cynic_Gallery_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'cynic_gallery_widget', // Base ID
            esc_html__('Cynic: Gallery', 'cynic'), // Name
            array('description' => esc_html__('A Gallery widget', 'cynic'),) // Args
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
        $image_ids = (isset($instance['image_ids']) && !empty($instance['image_ids'])) ? $instance['image_ids'] : '';
        ?>
        <div class="footer-mid-nav partners-list">
            <?php
            if (!empty($title)) {
                ?>
                <h6 class="nav-item"><?php echo esc_html($title); ?></h6>
                <?php
            }
            ?>
            <div id="gallery-<?php echo esc_attr($this->id) ?>"
                 class="gallery galleryid-<?php echo esc_attr($this->id) ?>">
                <?php
                if (!empty($image_ids)) {
                    $imageIDArr = explode(',', $image_ids);
                    if (count($imageIDArr) > 0) {
                        ?>
                        <?php
                        foreach ($imageIDArr as $imageID) {
                            ?>
                            <figure class="gallery-item">
                                <div class="gallery-icon">
                                    <?php
                                    echo wp_get_attachment_image($imageID, 'full');
                                    ?>
                                </div>
                            </figure>
                            <?php
                        }
                        ?>
                        <?php
                    }
                }
                ?>
            </div>
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
        $title = "";
        $image_ids = "";
        $galleryPrevHtml = "";

        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
        if (isset($instance['image_ids'])) {
            $imageIds = explode(',', $instance['image_ids']);
            if (count($imageIds) > 0) {
                $image_ids = $instance['image_ids'];
                foreach ($imageIds as $img_id) {
                    $image_srcArr = wp_get_attachment_image_src($img_id, 'full');
                    if (count($image_srcArr) > 1) {
                        $galleryPrevHtml .= '<dl class="gallery-item">';
                        $galleryPrevHtml .= '<dl class="gallery-icon">';
                        $galleryPrevHtml .= '<img src="' . $image_srcArr[0] . '"/>';
                        $galleryPrevHtml .= '</dl>';
                        $galleryPrevHtml .= '</dl>';
                    }
                }
            }

        }

        $widgetid = $this->id;
        $widgetname = 'cynic-gallery-widget-';
        ?>

        <div class="cynic-gallery-widget-<?php echo esc_attr($widgetid) ?> media-widget-control">
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'cynic'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                       value="<?php echo esc_html($title); ?>"/>
            </p>

            <div class="cynic-gallery-widget-container media-widget-preview media_gallery">
                <div class="media-widget-preview media_gallery">
                    <?php
                    if ($galleryPrevHtml) {
                        echo esc_html_decode($galleryPrevHtml);
                    }
                    ?>
                </div>
            </div>
            <input class="cynic-widget-gallery-image-ids-<?php echo esc_attr($widgetid) ?>" type="hidden"
                   name='<?php echo esc_attr($this->get_field_name("image_ids")); ?>'
                   value="<?php echo esc_attr($image_ids); ?>">
            <p>
            <div class="upload-file-container upload_btn-<?php echo esc_attr($widgetid . $widgetname); ?> ">
                <button type="button"
                        class="button cynic_widget_add_gallery_uploader <?php echo esc_attr((!empty($galleryPrevHtml)) ? 'hidden' : ''); ?>"
                        data-target="cynic-widget-gallery-image-ids-<?php echo esc_attr($widgetid) ?>"
                        data-parent="cynic-gallery-widget-<?php echo esc_attr($widgetid) ?>">Add Gallery
                </button>
                <button type="button"
                        class="button cynic_widget_edit_gallery_uploader <?php echo esc_attr((empty($galleryPrevHtml)) ? 'hidden' : ''); ?>"
                        data-target="cynic-widget-gallery-image-ids-<?php echo esc_attr($widgetid) ?>"
                        data-parent="cynic-gallery-widget-<?php echo esc_attr($widgetid) ?>">Edit Gallery
                </button>
            </div>
            </p>
        </div>
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
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? $new_instance['title'] : '';
        $instance['image_ids'] = (!empty($new_instance['image_ids'])) ? $new_instance['image_ids'] : '';
        return $instance;
    }

} // class Foo_Widget


// register Foo_Widget widget
function register_cynic_gallery_widget()
{
    register_widget('Cynic_Gallery_Widget');
}

add_action('widgets_init', 'register_cynic_gallery_widget');