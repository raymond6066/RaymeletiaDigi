<?php

class ajax_requests
{

    protected $ajax_onoce;

    public function __construct()
    {
        $this->ajax_onoce = 'cynicSEO-feature-plugin';
        add_action('wp_enqueue_scripts', array($this, 'cynicSEO_ajax_enqueue'));

        /* Reviews by category read more */
        add_action('wp_ajax_nopriv_cynicSEO_feature_client_review_read_more', array($this, 'cynicSEO_feature_client_review_read_more'));
        add_action('wp_ajax_cynicSEO_feature_client_review_read_more', array($this, 'cynicSEO_feature_client_review_read_more'));

    }

    function cynicSEO_ajax_enqueue()
    {
        $params = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce($this->ajax_onoce),
        );
        wp_localize_script('jquery', 'cynicSEO_feature_ajax', $params);
    }

function cynicSEO_feature_client_review_read_more()
    {
        check_ajax_referer($this->ajax_onoce, 'security');
        if ($_POST) {
            $args = $_POST['query'];
            $paged = (int)$_POST['paged'];

            $args['paged'] = $paged + 1;

            $query = new WP_Query($args);

            $settinggs = $_POST['settings'];

            $show_per_row = $settinggs['show_per_row'];
            $bgimageUrl = $settinggs['bgimageUrl'];
            $cat_term_id = $settinggs['cat_term_id'];
            $post_count = (int)$_POST['post_count'];


            $grid_row = 0;
            if ($show_per_row == 2) {
                $grid_row = 6;
            } elseif ($show_per_row == 3) {
                $grid_row = 4;
            } else {
                $grid_row = 12;
            }

            $return = array();

            $return['posts_count'] = $post_count + $query->post_count;
            if ($query->have_posts()) {
                ob_start();
                while ($query->have_posts()) {
                    $query->the_post();
                    $category_image = '';
                    $image_id = get_term_meta($cat_term_id, 'category-image-id', true);
                    if ($image_id) {
                        $category_image = wp_get_attachment_url($image_id);
                    }
                    ?>
                    <div class="col-md-<?php echo $grid_row; ?>">
                        <div class="review-content equalHeight" data-bg="<?php echo $bgimageUrl ?>">
                            <img class="review-source" src="<?php echo $category_image; ?>"
                                 alt="review source image">
                            <div class="media">

                                <?php
                                if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                                    the_post_thumbnail('thumbnail');
                                } else {
                                    ?>
                                    <img height="80" width="80" class="d-flex mr-3"
                                         src="<?php echo AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/css/user-icon-default.png' ?>"
                                         alt="media placeholder image">
                                    <?php
                                }
                                $review_values = get_post_meta(get_the_ID(), 'reviews_review_values');
                                $review = 'stars-0';
                                if (isset($review_values['0'])) {
                                    $review = $review_values['0'];
                                }
                                ?>
                                <div class="media-body">
                                    <div class="fixture">
                                        <span class="stars-container <?php echo esc_attr($review); ?>">★★★★★</span>
                                    </div>
                                    <h4 class="mt-0"><?php the_title() ?></h4>
                                    <?php $reviewerDesignation = get_post_meta(get_the_ID(), 'reviews_designation');
                                    if (isset($reviewerDesignation['0'])) {
                                        echo $reviewerDesignation['0'];
                                    }
                                    ?>
                                </div>
                                <!-- End of .media-body -->
                            </div>
                            <!-- End of .media -->
                            <p><?php the_content() ?></p>
                        </div>
                        <!-- End of .content -->
                    </div>
                    <?php
                    $return['outputs'] .= ob_get_clean();
                }
            }
            echo json_encode($return);
            die(); //end of cycle
        }
    }

}

new ajax_requests();
