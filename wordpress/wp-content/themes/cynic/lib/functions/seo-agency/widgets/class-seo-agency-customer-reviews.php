<?php
/**
 * This is is used to create
 * image upload for custom post type category customers review
 * */
if (!class_exists('CT_REVIEWERS_META')) {

    class CT_REVIEWERS_META {

        public function __construct() {
            //
        }

        /*
         * Initialize the class and start calling our hooks and filters
         * @since 1.0.0
         */

        public function init() {
            add_action('reviews-cat_add_form_fields', array($this, 'cynic_add_category_image'), 10, 2);
            add_action('created_reviews-cat', array($this, 'cynic_save_category_image'), 10, 2);
            add_action('reviews-cat_edit_form_fields', array($this, 'cynic_update_category_image'), 10, 2);
            add_action('edited_reviews-cat', array($this, 'cynic_updated_category_image'), 10, 2);
            add_action('admin_enqueue_scripts', array($this, 'cynic_load_media'));
            add_action('admin_footer', array($this, 'cynic_add_script'));
        }

        public function cynic_load_media() {
            wp_enqueue_media();
        }

        /*
         * Add a form field in the new category page
         * @since 1.0.0
         */

        public function cynic_add_category_image($taxonomy) {
            ?>
            <div class="form-field term-group">
                <label for="category-image-id"><?php esc_html_e('Image', 'cynic'); ?></label>
                <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
                <div id="category-image-wrapper"></div>
                <p>
                    <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php esc_html_e('Add Image', 'cynic'); ?>" />
                    <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php esc_html_e('Remove Image', 'cynic'); ?>" />
                </p>
            </div>
            <?php
        }

        /*
         * Save the form field
         * @since 1.0.0
         */

        public function cynic_save_category_image($term_id, $tt_id) {
            if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
                $image = $_POST['category-image-id'];
                add_term_meta($term_id, 'category-image-id', $image, true);
            }
        }

        /*
         * Edit the form field
         * @since 1.0.0
         */

        public function cynic_update_category_image($term, $taxonomy) {
            ?>
            <tr class="form-field term-group-wrap">
                <th scope="row">
                    <label for="category-image-id"><?php esc_html_e('Image', 'cynic'); ?></label>
                </th>
                <td>
            <?php $image_id = get_term_meta($term->term_id, 'category-image-id', true); ?>
                    <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo esc_attr($image_id); ?>">
                    <div id="category-image-wrapper">
            <?php if ($image_id) { ?>
                <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
            <?php } ?>
                    </div>
                    <p>
                        <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php esc_html_e('Add Image', 'cynic'); ?>" />
                        <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php esc_html_e('Remove Image', 'cynic'); ?>" />
                    </p>
                </td>
            </tr>
            <?php
        }

        /*
         * Update the form field value
         * @since 1.0.0
         */

        public function cynic_updated_category_image($term_id, $tt_id) {
            if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
                $image = $_POST['category-image-id'];
                update_term_meta($term_id, 'category-image-id', $image);
            } else {
                update_term_meta($term_id, 'category-image-id', '');
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
                    function ct_media_upload(button_class) {
                        var _custom_media = true,
                                _orig_send_attachment = wp.media.editor.send.attachment;
                        $('body').on('click', button_class, function (e) {
                            var button_id = '#' + $(this).attr('id');
                            var send_attachment_bkp = wp.media.editor.send.attachment;
                            var button = $(button_id);
                            _custom_media = true;
                            wp.media.editor.send.attachment = function (props, attachment) {
                                if (_custom_media) {
                                    $('#category-image-id').val(attachment.id);
                                    $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                                    $('#category-image-wrapper .custom_media_image').attr('src', attachment.url).css('display', 'block');
                                } else {
                                    return _orig_send_attachment.apply(button_id, [props, attachment]);
                                }
                            }
                            wp.media.editor.open(button);
                            return false;
                        });
                    }
                    ct_media_upload('.ct_tax_media_button.button');
                    $('body').on('click', '.ct_tax_media_remove', function () {
                        $('#category-image-id').val('');
                        $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                    });

                    $(document).ajaxComplete(function (event, xhr, settings) {
                        var queryStringArr = settings.data.split('&');
                        if ($.inArray('action=add-tag', queryStringArr) !== -1) {
                            var xml = xhr.responseXML;
                            $response = $(xml).find('term_id').text();
                            if ($response != "") {
                                // Clear the thumb image
                                $('#category-image-wrapper').html('');
                            }
                        }
                    });
                });
            </script>
        <?php
        }

    }

    $CT_TAX_META = new CT_REVIEWERS_META();
    $CT_TAX_META->init();
}

/**
 * Use radio inputs instead of checkboxes for term checklists in Customer Reviews taxonomies.
 *
 * @param   array   $args
 * @return  array
 */
function wpse_139269_term_radio_checklist($args) {
    if (!empty($args['taxonomy']) && $args['taxonomy'] === 'reviews-cat' /* <== Change to your required taxonomy */) {
        if (empty($args['walker']) || is_a($args['walker'], 'Walker')) { // Don't override 3rd party walkers.
            if (!class_exists('WPSE_139269_Walker_Category_Radio_Checklist')) {

                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {

                    function walk($elements, $max_depth, $args = array()) {
                        $output = parent::walk($elements, $max_depth, $args);
                        $output = str_replace(
                                array('type="checkbox"', "type='checkbox'"), array('type="radio"', "type='radio'"), $output
                        );

                        return $output;
                    }

                }

            }

            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

add_filter('wp_terms_checklist_args', 'wpse_139269_term_radio_checklist');