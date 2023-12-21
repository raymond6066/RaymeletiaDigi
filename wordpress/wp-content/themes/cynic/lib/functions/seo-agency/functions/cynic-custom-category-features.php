<?php

class CT_TAX_META
{

    public function __construct()
    {
        //
    }

    /*
    * Initialize the class and start calling our hooks and filters
    * @since 1.0.0
    */

    public function init()
    {
        add_action('portfolio-cat_add_form_fields', array($this, 'cynic_add_category_icon'), 10, 2);
        add_action('created_portfolio-cat', array($this, 'cynic_save_category_icon'), 10, 2);
        add_action('portfolio-cat_edit_form_fields', array($this, 'cynic_update_category_icon'), 10, 2);
        add_action('edited_portfolio-cat', array($this, 'cynic_updated_category_icon'), 10, 2);
        add_action('admin_footer', array($this, 'cynic_add_script'));
    }

    /*
    * Add a form field in the new category page
    * @since 1.0.0
    */

    private function getIconUPloaderSetting()
    {
        return $settings = array('title' => 'Image Icons',
            'button_text' => 'Insert Icon',
            'library_type' => 'image',
            'multiple' => false,
            'parent_selector' => '.form-field',
            'show_media' => true,
            'show_selector' => '.show_image_icon',
            'show_attr' => 'src',
            'param_selector' => '.category_image_icon'
        );
    }

    public function cynic_add_category_icon($taxonomy)
    {
        ?>
        <div class="form-field term-group">
            <label for="category-order"><?php esc_html_e('Category Order', 'cynic'); ?></label>
            <input type="number" id="category-order" name="category_order" class="category-order" value="1">
        </div>

        <div class="form-field term-group">
            <label for="category-icon-type"><?php esc_html_e('Icon Type', 'cynic'); ?></label>
            <select name="category_icon_type"  class="cynic-our-work-category-icons-type-select">
                <option value="font_icon">Font Icon</option>
                <option value="image_icon">Image Icon</option>
            </select>
            <span class="span-icon"></span>
        </div>
        <div class="form-field term-group category_image_icon_wrapper">
            <label for="category-image-icon"><?php esc_html_e('Upload Image Icon', 'cynic'); ?></label>
            <img class="show_image_icon" src="" width="100px"><br>
            <button type="button" data-target="#category-image-icon"
                    data-show="" data-settings="<?php echo esc_attr(json_encode($this->getIconUPloaderSetting())); ?>"
                    class="button cynic_global_uploader_btn786">
                <span class="wp-media-buttons-icon"></span> <?php esc_html_e('Add Image Icon', 'cynic'); ?>
            </button>
            <span class="span-icon"></span>
            <input type="hidden" name="category_image_icon" class="category_image_icon" value="">
        </div>

        <div class="form-field term-group category_font_icon_wrapper">
            <label for="category-icon"><?php esc_html_e('Category Icon', 'cynic'); ?></label>
            <input type="text" id="category-icon" name="category_icon" class="category_icon cynicIconsPicker" value="">
            <span class="span-icon"></span>
        </div>
        <?php
    }

    public function cynic_save_category_icon($term_id, $tt_id)
    {
        if (isset($_POST['category_order']) && '' !== $_POST['category_order']) {
            $category_order = $_POST['category_order'];
            add_term_meta($term_id, 'category_order', $category_order, true);
        }

        if (isset($_POST['category_icon_type']) && '' !== $_POST['category_icon_type']) {
            $category_icon_type = $_POST['category_icon_type'];
            add_term_meta($term_id, 'category_icon_type', $category_icon_type, true);
        }


        if (isset($_POST['category_image_icon']) && '' !== $_POST['category_image_icon']) {
            $category_image_icon = $_POST['category_image_icon'];
            add_term_meta($term_id, 'category_image_icon', $category_image_icon, true);
        }


        if (isset($_POST['category_icon']) && '' !== $_POST['category_icon']) {
            $category_icon = $_POST['category_icon'];
            add_term_meta($term_id, 'category_icon', $category_icon, true);
        }

    }

    public function cynic_update_category_icon($term, $taxonomy)
    {
        $category_order = get_term_meta($term->term_id, 'category_order', true);
        $category_icon_type = get_term_meta($term->term_id, 'category_icon_type', true);
        $category_image_icon = get_term_meta($term->term_id, 'category_image_icon', true);
        $category_icon = get_term_meta($term->term_id, 'category_icon', true); ?>

        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="category-order"><?php esc_html_e('Category Order', 'cynic'); ?></label>
            </th>
            <td>
                <input type="number" id="category-order" name="category_order" class="category-order"
                       value="<?php echo esc_html($category_order); ?>">
            </td>
        </tr>


        <tr class="form-field term-group">
            <th scope="row">
                <label for="category-icon-type"><?php esc_html_e('Icon Type', 'cynic'); ?></label>
            </th>
            <td>
                <select name="category_icon_type" class="cynic-our-work-category-icons-type-select">
                    <option <?php echo esc_attr(($category_icon_type=='font_icon')?'selected': ''); ?> value="font_icon">Font Icon</option>
                    <option <?php echo esc_attr(($category_icon_type=='image_icon')?'selected': ''); ?> value="image_icon">Image Icon</option>
                </select>
                <span class="span-icon"></span>
            </td>
        </tr>

        <tr class="form-field term-group category_image_icon_wrapper">
            <th scope="row"  style="vertical-align:bottom">
                <label for="category-image-icon"><?php esc_html_e('Upload Image Icon', 'cynic'); ?></label>
            </th>
            <td>
                <img class="show_image_icon" src="<?php echo esc_url(wp_get_attachment_image_url($category_image_icon, 'full')) ?>" width="100px"><br>
                <button type="button" data-target="#category-image-icon"
                        data-show=""
                        data-settings="<?php echo esc_attr(json_encode($this->getIconUPloaderSetting())); ?>"
                        class="button cynic_global_uploader_btn786">
                    <span class="wp-media-buttons-icon"></span> <?php echo esc_attr((wp_get_attachment_image($category_image_icon))? "Change Icon":'Add Image Icon','cynic'); ?>
                </button>
                <span class="span-icon"></span>
                <input type="hidden" name="category_image_icon" class="category_image_icon" value="<?php echo esc_attr($category_image_icon); ?>">
            </td>
        </tr>


        <tr class="form-field term-group-wrap  category_font_icon_wrapper">
            <th scope="row">
                <label for="category-icon"><?php esc_html_e('Category Icon', 'cynic'); ?></label>
            </th>
            <td>
                <input type="text" id="category-icon" name="category_icon"  class="category-icon cynicIconsPicker"
                       value="<?php echo esc_attr($category_icon); ?>">

                    <span class="span-icon fa <?php echo esc_attr($category_icon) ?>"></span>

            </td>
        </tr>
        <?php
    }

    public function cynic_updated_category_icon($term_id, $tt_id)
    {
        if (isset($_POST['category_order']) && '' !== $_POST['category_order']) {
            $category_order = $_POST['category_order'];
            update_term_meta($term_id, 'category_order', $category_order);
        } else {
            update_term_meta($term_id, 'category_order', '');
        }

        if (isset($_POST['category_icon_type']) && '' !== $_POST['category_icon_type']) {
            $category_icon_type = $_POST['category_icon_type'];
            update_term_meta($term_id, 'category_icon_type', $category_icon_type);
        } else {
            update_term_meta($term_id, 'category_icon_type', '');
        }


        if (isset($_POST['category_image_icon']) && '' !== $_POST['category_image_icon']) {
            $category_image_icon = $_POST['category_image_icon'];
            update_term_meta($term_id, 'category_image_icon', $category_image_icon);
        } else {
            update_term_meta($term_id, 'category_image_icon', '');
        }


        if (isset($_POST['category_icon']) && '' !== $_POST['category_icon']) {
            $category_icon = $_POST['category_icon'];
            update_term_meta($term_id, 'category_icon', $category_icon);
        } else {
            update_term_meta($term_id, 'category_icon', '');
        }

    }

    /*
        * Add script
        * @since 1.0.0
        */



    public function cynic_add_script() {
        ?>

        <script>
        jQuery(document).ready(function ($) {
            // Our Work Category Icon Type chaning
            function showHideCynicOurWorkCategoryIconTypeFieds(selectedIconType)
            {
                if (selectedIconType == 'image_icon') {
                    $('.category_image_icon_wrapper').show();
                    $('.category_font_icon_wrapper').hide();
                } else {
                    $('.category_image_icon_wrapper').hide();
                    $('.category_font_icon_wrapper').show();
                }
            }

            showHideCynicOurWorkCategoryIconTypeFieds($('.cynic-our-work-category-icons-type-select').val());

            $(document).on('change', '.cynic-our-work-category-icons-type-select', function (e) {
                e.preventDefault();
                var selectedIconType = $(this).val();
                showHideCynicOurWorkCategoryIconTypeFieds(selectedIconType);

            });
              });
        </script>
        </script>

        <?php
    }





}

$CT_TAX_META = new CT_TAX_META();
$CT_TAX_META->init();