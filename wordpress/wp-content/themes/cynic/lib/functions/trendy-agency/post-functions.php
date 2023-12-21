<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */

if (!function_exists('cynic_trendy_agency_get_posts')) {
    function cynic_trendy_agency_get_posts()
    {
        ?>

        <!-- Blog-posts starts
        ============================================ -->
        <?php
        cynic_trendy_page_header();
        $margin_top = cynic_margin_top(); ?>
        <div class="blog-posts">
            <div class="container <?php echo esc_attr($margin_top); ?>">
                <div class="row">
                    <?php
                    $col_md_class = 'col-md-12';
                    $blog_sidebar = cynic_is_check_val('cynic_blog_sidebar', true);
                    if ($blog_sidebar) {
                        $col_md_class = 'col-md-8';
                    }
                    ?>
                    <div class="<?php echo esc_attr($col_md_class); ?>">
                        <div class="article-wrapper">
                            <!-- Start Right Blog Details -->
                            <?php
                            if (have_posts()) {
                                while (have_posts()) {
                                    the_post(); ?>
                                    <article <?php post_class('blog-item') ?>>
                                        <?php get_template_part('template-parts/trendy-agency/content', get_post_format()) ?>
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

if (!function_exists('cynic_trendy_agency_single_posts')) {
    function cynic_trendy_agency_single_posts()
    {
        get_page_inner_header(2, 'text', '', '', '', 1);
        $blog_single_sidebar = cynic_is_check_val('cynic_blog_single_sidebar', true);
        $bubble_colors = get_theme_mod('cynic_shape-color');
        $get_colors = cynic_get_bubble_color($bubble_colors);
        $catids = array();
        $postid = "";?>
        <!-- Blog-details starts -->
        <div class="blog-post-details">
            <div class="container">
                <svg class="bg-shape shape-blog-details reveal-from-right" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="779px" height="759px">
                    <defs>
                        <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                            <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_03)"
                          d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                    />
                </svg>
                <div class="row">
                    <div class="col-12 <?php echo esc_attr(($blog_single_sidebar) ? ' col-md-8' : '') ?> ">
                        <div class="article-wrapper">
                            <article class="blog-details cynic-post-format-<?php echo get_post_format() ?>">
                                <?php
                                if (have_posts()) {
                                    $post_categories = get_the_category();
                                    $postid = get_the_ID();
                                    if ($post_categories && !is_wp_error($post_categories)) {
                                        foreach ($post_categories as $postcat) {
                                            $catids[] = $postcat->term_id;
                                        }
                                    }
                                    while (have_posts()) : the_post(); ?>
                                        <?php get_template_part('template-parts/trendy-agency/content', get_post_format());
                                        ?>
                                        <?php
                                    endwhile;
                                }
                                ?>
                            </article>
                            <!-- End of .blog-details -->
                            <!-- Author info -->
                            <?php
                            $author_info = cynic_is_check_val('cynic_author_info', false);
                            if ($author_info) {
                                cynic_author();
                            }
                            ?>
                            <?php
                            $blog_comment = cynic_is_check_val('cynic_blog_comment_section', true);
                            if ($blog_comment) {
                                if (comments_open() || get_comments_number()) :
                                    comments_template();
                                endif;
                            }
                            $display_pagination = cynic_is_check_val('cynic_blog_prev_next_botton', true);
                            if($display_pagination) { ?>
                                <div class="blog-details-prev-next d-flex justify-content-between">
                                    <?php
                                    $get_PrevPostBtnText = get_theme_mod('cynic_blog_prev_button_text');
                                    $PrevPostBtnText = !empty($get_PrevPostBtnText) ? $get_PrevPostBtnText : __("Prev", "cynic");
                                    $get_nextPostBtnText = get_theme_mod('cynic_blog_next_button_text');
                                    $nextPostBtnText = !empty($get_nextPostBtnText) ? $get_nextPostBtnText : __("Next", "Cynic");
                                    echo get_previous_post_link($format = '%link', $link = $PrevPostBtnText, $in_same_term = true);
                                    echo get_next_post_link($format = '%link', $link = $nextPostBtnText, $in_same_term = true);
                                    ?>
                                </div>
                                <?php
                            } ?>
                            <!--  End of .blog-details-prev-next-->
                        </div>
                        <!-- End of .article-wrapper -->
                    </div>
                    <?php
                    if ($blog_single_sidebar) {
                            get_sidebar();
                    }
                    ?>
                    <!-- End of .col-md-12 -->
                </div>
                <!-- End of .row -->
            </div>
            <!-- End of .container -->
        </div>
        <!-- End of .blog-post-details -->

        <!-- related-post starts
        ======================================= -->
        <?php
        $related = new WP_Query(array(
            'posts_per_page' => 3,
            'category__in' => $catids,
            'post_type' => 'post',
            'post__not_in' => array($postid),
        ));
        if ($related->have_posts()) { ?>
            <section class="related-post blog-details-related-post section-padding">
                <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="779px" height="759px">
                    <defs>
                        <linearGradient id="PSgrad_033" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1" />
                            <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0" />
                        </linearGradient>

                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_033)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                    />
                </svg>
                <div class="container">
                    <div class="blog-by-category single-cat">
                        <h2 class="text-center"><?php echo __('Related Posts', 'cynic'); ?></h2>
                        <div class="blog-grid text-center">
                            <div class="row equalHeightWrapper">
                                <?php
                                while ($related->have_posts()) {
                                    $related->the_post(); ?>
                                    <div class="item col-md-6 col-lg-4">
                                        <a href="<?php the_permalink(); ?>" class="news-content-block content-block">
                                            <div class="img-container">
                                                <?php
                                                if(has_post_thumbnail()) {
                                                    the_post_thumbnail('cynic-trendy-related-blog-thumbnail',array('class' => 'img-fluid'));
                                                } ?>
                                            </div>
                                            <!-- End of .img-container -->
                                            <h5 class="equalHeight">
                                                <span class="content-block__sub-title"><?php the_date(); ?></span>
                                                <?php the_title(); ?>
                                            </h5>
                                        </a>
                                        <!-- End of .featured-content-block -->
                                    </div>
                                    <!-- End of .item -->
                                    <?php
                                } ?>
                            </div>
                            <!-- End of .row -->
                        </div>
                        <!-- End of .blog-grid -->
                    </div>
                    <!-- End of .blog-by-category -->
                </div>
                <!-- End of .container -->
            </section>
            <!-- End of .featured-projects -->
        <?php
        }
    }
}

add_filter( 'embed_oembed_html', 'cynic_trendy_embed_oembed_html', 99, 4 );

function cynic_trendy_embed_oembed_html( $cache, $url, $attr, $post_ID ) {
    $classes = array();
    // Add these classes to all embeds.
    $classes_all = array(
        'embed_oembed_iframe_wrapper',
    );

    $classes = array_merge( $classes, $classes_all );
    // return '<div class="' . esc_attr( implode( $classes, ' ' ) ) . '">' . $cache . '</div>';
    return '<div class="' . esc_attr( implode(' ', $classes)) . '">' . $cache . '</div>';
}

