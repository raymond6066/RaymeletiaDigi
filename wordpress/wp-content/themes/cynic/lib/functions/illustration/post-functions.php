<?php
if (!function_exists('cynic_illustration_single_post')) {
    function cynic_illustration_single_post()
    {
        ?>
        <!-- Blog-posts starts
        ============================================ -->
        <?php

        $title = (!empty(get_theme_mod('cynic_single_blog_page_title'))) ? get_theme_mod('cynic_single_blog_page_title') : 'News Details Page';
        $description = (!empty(get_theme_mod('cynic_single_blog_page_description'))) ? get_theme_mod('cynic_single_blog_page_description') : '';
        $banner_image = (!empty(get_theme_mod('cynic_single_blog_page_banner_image'))) ? get_theme_mod('cynic_single_blog_page_banner_image') : '';

        // cynic_illustration_page_header();
        get_page_inner_header(2, 'text', $description, $title, '', $banner_image, get_theme_mod('cynic_single_blog_page_banner'));
        ?>
        <div class="post-details">
            <div class="container">
                <div class="row">
                    <?php
                    $col_md_class = 'col-md-12';
                    $blog_sidebar = cynic_is_check_val('cynic_blog_single_sidebar', true);
                    if ($blog_sidebar) {
                        $col_md_class = 'col-md-8';
                    }
                    ?>
                    <div class="<?php echo esc_attr($col_md_class); ?>">
                        <!-- Start Right Blog Details -->
                        <?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post(); ?>
                                <article id="single-post-content" <?php post_class('article-details') ?>>
                                    <?php get_template_part('template-parts/illustration/content', get_post_format()) ?>
                                </article>
                                <?php
                            }
                        } ?>
                        <?php
                        $blog_comment = cynic_is_check_val('cynic_blog_comment_section', true);
                        if ($blog_comment) {
                            ?>
                            <div class="comment-wrapper">
                                <?php
                                if (comments_open() || get_comments_number()) {
                                    comments_template();
                                } ?>
                            </div>
                            <?php
                        } ?>
                        <!-- End of .comment-wrapper -->
                        <?php
                        global $wp_query;
                        $total_pages = $wp_query->max_num_pages;
                        if ($total_pages > 1) { ?>
                            <div class="pagination">
                                <?php
                                $big = 999999999; // need an unlikely integer
                                echo paginate_links(array(
                                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                    'format' => '?paged=%#%',
                                    'current' => max(1, get_query_var('paged')),
                                    'total' => $wp_query->max_num_pages,
                                    'prev_text' => esc_html__('&lt;', 'cynic'),
                                    'next_text' => esc_html__('&gt;', 'cynic'),
                                ));
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                    if ($blog_sidebar) {
                        get_sidebar();
                    }
                    ?>
                    <!-- End of .col-md-4 -->
                </div>
                <!-- End of .row -->
            </div>
        </div>
        <!-- End of .blog-posts -->

        <!-- Section latest-news starts -->
        <?php

        $related_news_section = cynic_is_check_val('cynic_blog_related_news_section', true);
        global $post;
        $postid = $post->ID;
        $taxonomy = "category";
        $categories = get_terms($taxonomy);
        if ($categories && !is_wp_error($categories)) {
            $select_cat = array();
            foreach ($categories as $cat) {
                $select_cat[] = (int)$cat->term_id;
            }
            $posts_per_page = 3;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => (int)$posts_per_page,
                'ignore_sticky_posts' => true,
                'post__not_in' => array($postid),
                'post_status' => 'publish',
            );
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $select_cat,
                ),
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                ?>
                <section class="latest-news section-gap light-grey-bg" id="cynic-news" data-scroll-offset="75">
                    <div class="container">
                        <?php
                        $block_title = get_theme_mod('cynic_blog_block_title');
                        if (!empty($block_title)) { ?>
                            <h2 class="section-title text-center"><?php echo $block_title; ?></h2>
                            <?php
                        } ?>
                        <div class="grid-wrapper">
                            <div class="row justify-content-center">
                                <?php
                                while ($query->have_posts()) {
                                    $query->the_post(); ?>
                                    <div class="col-lg-4 col-md-6">
                                        <a href="<?php the_permalink(); ?>" class="img-card news-card">
                                            <?php
                                            $thumbsize = "cynic-illustration-blog-thumb-img";
                                            if (has_post_thumbnail()) {
                                                echo wp_get_attachment_image(get_post_thumbnail_id(), $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . get_the_title(get_the_ID()) . ''));
                                            } ?>
                                            <div class="content">
                                                <h4><?php the_date('j F, Y'); ?>
                                                    <span><?php the_title(); ?></span>
                                                </h4>
                                            </div>
                                        </a>
                                        <!-- End of .img-card -->
                                    </div>
                                    <!-- End of .col-lg-4 -->
                                    <?php
                                }
                                wp_reset_postdata();
                                $blog_button_text = get_theme_mod('cynic_blog_button_text');
                                $blog_permalink = get_theme_mod('cynic_blog_page_link'); ?>
                                <?php
                                if (!empty($blog_button_text)) { ?>
                                    <div class="col-12 text-center">
                                        <a href="<?php the_permalink($blog_permalink); ?>"
                                           class="custom-btn secondary-btn"><?php echo $blog_button_text; ?></a>
                                    </div>
                                    <!-- End of .row -->
                                    <?php
                                } ?>
                                <!-- End of .text-center -->
                            </div>
                            <!-- End of .row -->

                        </div>
                        <!-- End of .grid-wrapper -->
                    </div>
                    <!-- End of .container -->
                </section>
                <!-- End of .latest-news -->
                <?php
            }

        }
    }
}


if (!function_exists('cynic_illustration_get_posts')) {
    function cynic_illustration_get_posts()
    {
        ?>
        <!-- Blog-posts starts
        ============================================ -->
        <?php

        $title = (!empty(get_theme_mod('cynic_single_blog_page_title'))) ? get_theme_mod('cynic_single_blog_page_title') : 'News Details Page';
        $description = (!empty(get_theme_mod('cynic_single_blog_page_description'))) ? get_theme_mod('cynic_single_blog_page_description') : '';
        $banner_image = (!empty(get_theme_mod('cynic_single_blog_page_banner_image'))) ? get_theme_mod('cynic_single_blog_page_banner_image') : '';

        cynic_illustration_page_header();
        // get_page_inner_header(2, 'text', $description, $title, '', $banner_image, get_theme_mod('cynic_single_blog_page_banner'));
        ?>
        <div class="post-details">
            <div class="container">
                <div class="row">
                    <?php
                    $col_md_class = 'col-md-12';
                    $blog_sidebar = cynic_is_check_val('cynic_blog_single_sidebar', true);
                    if ($blog_sidebar) {
                        $col_md_class = 'col-md-8';
                    }
                    ?>
                    <div class="<?php echo esc_attr($col_md_class); ?>">
                        <!-- Start Right Blog Details -->
                        <?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post(); ?>
                                <article <?php post_class('article-details illustration-blog-item') ?>>
                                    <?php get_template_part('template-parts/illustration/content', get_post_format()) ?>
                                </article>
                                <?php
                            }
                        } ?>
                        <?php
                        global $wp_query;
                        $total_pages = $wp_query->max_num_pages;
                        if ($total_pages > 1) { ?>
                            <div class="pagination">
                                <?php
                                $big = 999999999; // need an unlikely integer
                                echo paginate_links(array(
                                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                    'format' => '?paged=%#%',
                                    'current' => max(1, get_query_var('paged')),
                                    'total' => $wp_query->max_num_pages,
                                    'prev_text' => esc_html__('&lt;', 'cynic'),
                                    'next_text' => esc_html__('&gt;', 'cynic'),
                                ));
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                    if ($blog_sidebar) {
                        get_sidebar();
                    }
                    ?>
                    <!-- End of .col-md-4 -->
                </div>
                <!-- End of .row -->
            </div>
        </div>
        <!-- End of .blog-posts -->

        <?php
    }
}


/*Single page for reviews*/
if (!function_exists('cynic_classic_modern_reviews')) {
    function cynic_classic_modern_reviews()
    {
        ?>
        <!-- banner starts
        ============================================ -->
        <div class="details-banner">
            <?php cynic_breadcrumb(); ?>
        </div>
        <!-- End of .banner -->

        <!-- details-case-study starts
        ============================================ -->
        <?php
        if (have_posts()) {
            $taxonomy = 'reviews-cat';
            while (have_posts()) {
                the_post();
                $id = get_the_ID();
                $categories = get_the_terms($id, $taxonomy);
                $categories = $categories[0];

                $category_image = '';
                $image_id = get_term_meta($categories->term_id, 'category-image-id', true);
                if ($image_id) {
                    $category_image = wp_get_attachment_url($image_id);
                }

                ?>
                <section class="section client-reviews">
                    <div class="container">
                        <div class="section-heading text-center">
                            <h2><?php echo __('Client Review from', 'cynic'); ?>
                                <span><?php echo esc_html($categories->name); ?></span>
                            </h2>
                        </div>
                        <!-- End of .section-heading -->

                        <div class="review-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="review-content">
                                        <?php
                                        if (!empty($category_image)){
                                        ?>
                                        <img class="review-source" src="<?php echo esc_url($category_image); ?>"
                                             alt="review source image">
                                        <div class="media">
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                                                the_post_thumbnail('thumbnail');
                                            } else {
                                                if (defined('AXILWEB_CYNIC_FEATURE_PLUGIN_URL')) {

                                                    ?>
                                                    <img height="80" width="80" class="d-flex mr-3"
                                                         src="<?php echo esc_url(AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/css/user-icon-default.png'); ?>"
                                                         alt="media placeholder image">
                                                    <?php
                                                }
                                            }
                                            $review_values = get_post_meta(get_the_ID(), 'reviews_review_values');
                                            $review = 'stars-0';
                                            if (isset($review_values['0'])) {
                                                $review = $review_values['0'];
                                            }
                                            ?>
                                            <div class="media-body">
                                                <div class="fixture">
                                                    <span class="stars-container <?php echo esc_attr($review); ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                                </div>
                                                <h4 class="mt-0"><?php the_title() ?></h4>
                                                <?php $reviewerDesignation = get_post_meta(get_the_ID(), 'reviews_designation');
                                                if (isset($reviewerDesignation['0'])) {
                                                    echo esc_html($reviewerDesignation['0']);
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
                                <!-- End of .col-sm-6 -->
                            </div>
                            <!-- End of .row -->
                        </div>
                        <!-- End of .review-content -->
                    </div>
                    <!-- End of .container -->
                </section>
                <?php
            }
        }
    }
}

if (!function_exists('cynic_illustration_reviews')) {
    function cynic_illustration_reviews()
    {
        ?>

        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_page_inner_header(2, 'text', get_the_excerpt());
                $reviewer_designation = get_post_meta(get_the_ID(), 'reviews_reviewer_org', TRUE); ?>
                <div class="container">
                    <div class="img-card review-card text-left">
                        <div class="media align-items-center">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full', array('class' => 'img-fluid'));
                            } ?>
                            <div class="media-body">
                                <h5><?php the_title(); ?></h5>
                                <p><?php echo html_entity_decode(esc_html($reviewer_designation)); ?></a>
                                </p>
                            </div>
                        </div>
                        <!-- End of .media -->
                        <p><?php the_content(); ?></p>
                    </div>
                </div>
                <?php
            }
        } ?>

        <?php
    }
}

if (!function_exists('cynic_post_meta')) {
    function cynic_post_meta()
    { ?>
        <ul class="post-metas">
            <?php
            $avatar = get_avatar(get_the_author_meta('ID'), 90);

            if ($avatar !== false) { ?>
                <li class="blogger-img"><a
                            href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta('ID'), 90); ?><?php the_author(); ?></a>
                </li>
                <?php
            } ?>
            <li><a href="<?php the_permalink(); ?>" class=""><i
                            class="far fa-calendar-alt"></i><?php echo get_the_date(); ?></a></li>
            <li>
                <a href="<?php echo esc_url(get_comments_link(get_the_ID())) ?>">
                    <?php printf(_nx('%2$s Comments (1)', '%2$s Comments', get_comments_number(), 'comments title', 'cynic'), number_format_i18n(get_comments_number()), '<i class="far fa-comment-alt-lines"></i>'); ?>
                </a>
            </li>
            <?php
            if (has_category()) {
                $post_id = get_the_ID();
                $post_categories = get_the_category($post_id);
                echo '<li>';
                foreach ($post_categories as $category) { ?>
                    <a href="<?php echo get_category_link($category->term_id); ?>">
                        <i class="far fa-bezier-curve"></i><?php echo esc_html($category->name); ?></a>
                    <?php
                }
                echo '</li>';
            } ?>
        </ul>
        <?php
    }
}