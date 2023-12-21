<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */

if (!function_exists('cynic_trendy_agency_get_default_page_template')) {
    function cynic_trendy_agency_get_default_page_template()
    {
        $margin_top = cynic_margin_top();
        cynic_trendy_page_header(); ?>
        <div class="container cynic-common-class <?php echo esc_attr($margin_top); ?>">
            <?php
            while (have_posts()) : the_post();
                the_content();
                wp_link_pages();
            endwhile;
            if (get_theme_mod('cynic_page_comment_section')) :
                if (comments_open() || get_comments_number()) : ?>
                    <section class="o-hidden blog-content author-sec">
                        <?php comments_template(); ?>
                    </section>
                    <?php
                endif;
            endif;
            ?>
        </div>
        <?php
    }
}

if (!function_exists('cynic_trendy_agency_get_search_results_page')) {
    function cynic_trendy_agency_get_search_results_page()
    { ?>
        <!-- search-projects
       ======================================= -->
        <?php
        global $wp_query;
        if (have_posts()) {
            $bubble_colors = get_theme_mod('cynic_shape-color');
            $get_colors = cynic_get_bubble_color($bubble_colors);
            $count = $wp_query->found_posts;
            $posts_per_page = get_option( 'posts_per_page' );
            $max_number_pages = $wp_query->max_num_pages;
            $page = 1; ?>
            <!-- Header starts
            ======================================= -->
            <div class="inner-page-banner search-banner">
                <div class="container text-center">
                    <?php if(get_theme_mod('cynic_search_title')) { ?>
                        <h1><?php echo get_theme_mod('cynic_search_title'); ?></h1>
                    <?php } ?>
                    <form action="<?php echo esc_url(home_url('/')); ?>" class="search-form text-center">
                        <input type="text" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
                        <?php
                        $button_text_val = get_theme_mod('cynic_search_button_text');
                        $button_text = !empty($button_text_val) ? $button_text_val : __("Search Now", "Cynic");
                        $subtitle_val = get_theme_mod('cynic_subtitle');
                        $subtitle = !empty($subtitle_val) ? $subtitle_val : __("results found for : ", "cynic")?>
                        <button class="custom-btn btn-big grad-style-ef"
                                type="submit"><?php echo esc_html($button_text); ?></button>
                        <p><?php echo esc_html($count) ?> <?php echo esc_html($subtitle) . '"' . get_search_query() . '"' ; ?></p>
                    </form>
                    <!-- End of .search-form -->
                </div>
                <!-- End of .container -->
            </div>
            <!-- End of .banner -->
            <section class="blog">
                <div class="trigger-project"></div>
                <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg"
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
                <div class="container">
                    <div class="blog-by-category section-padding">
                        <div class="blog-grid text-center equalHeightWrapper">
                            <div class="row">
                                <?php
                                while (have_posts()) {
                                    the_post(); ?>
                                    <div class="item col-md-6 col-lg-4">
                                        <a href="<?php the_permalink(); ?>" class="news-content-block content-block">
                                            <div class="img-container">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    the_post_thumbnail('cynic-trendy-custom-blog', array('class' => 'img-fluid blog-details-img'));
                                                } else { ?>
                                                    <img src="<?php echo get_template_directory_uri()?>/images/trendy-agency/default-image.png" alt="Default image" class="img-fluid">
                                                <?php } ?>
                                            </div>
                                            <!-- End of .img-container -->
                                            <h5 class="equalHeight">
                                                <span class="content-block__sub-title"><?php echo get_the_date('j F, Y') ?></span>
                                                <?php the_title(); ?>
                                            </h5>
                                        </a>
                                        <!-- End of .featured-content-block -->
                                    </div>
                                    <!-- End of .item -->
                                    <?php
                                } ?>
                            </div>
                            <?php
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
                        <!-- End of .blog-grid -->
                    </div>
                    <!-- End of .blog-by-category -->
                </div>
                <!-- End of .container -->
            </section>
            <!-- End of search-projects -->
            <?php
        } else { ?>
            <div class="inner-page-banner search-banner">
                <div class="container text-center">
                    <h1><?php echo __('Search Results For', 'cynic') ?></h1>
                    <form action="<?php echo esc_url(home_url('/')); ?>" class="search-form text-center">
                        <input type="text" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
                        <button class="custom-btn btn-big grad-style-ef"
                                type="submit"><?php echo __('Search Now', 'cynic') ?></button>
                        <p><?php echo __('No results found for ', 'cynic') . " ". "<strong>". '"' . get_search_query() . '"' . "</strong>"; ?></p>
                    </form>
                    <!-- End of .search-form -->
                </div>
                <!-- End of .container -->
            </div>
            <!-- End of .banner -->
            <?php

        }
    }
}

if (!function_exists('cynic_trendy_agency_get_search_form')) {
    function cynic_trendy_agency_get_search_form()
    { ?>

        <div class="widget search-widget">
            <form class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" name="s" value="<?php echo get_search_query(); ?>"
                       placeholder="<?php echo esc_attr_e('Search', 'cynic'); ?>">
            </form>
        </div>

        <?php

    }
}

if (!function_exists('cynic_trendy_agency_get_sidebar')) {
    function cynic_trendy_agency_get_sidebar()
    {
        if (is_active_sidebar('blog-sidebar')) { ?>
            <aside class="col-md-4">
                <?php dynamic_sidebar('blog-sidebar') ?>
            </aside>
            <?php
        }
    }
}

if (!function_exists('cynic_trendy_agency_404_page_template')) {
    function cynic_trendy_agency_404_page_template()
    { ?>
        <div class="inner-page-banner error-404-banner">
            <div class="container text-center">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-left text-center">
                        <?php if(get_theme_mod('cynic_404_title')) { ?>
                            <h1><?php echo get_theme_mod('cynic_404_title'); ?></h1>
                        <?php } ?>
                        <?php if(get_theme_mod('cynic_404_subtitle')) {
                            $subtitle = stripslashes(get_theme_mod('cynic_404_subtitle')); ?>
                            <p><?php echo $subtitle; ?></p>
                        <?php } ?>
                        <?php if(get_theme_mod('cynic_404_button_text')) {
                            $link = (get_theme_mod('cynic_404_button_link')) ? get_theme_mod('cynic_404_button_link') : "";
                            $url = (!empty($link)) ? get_permalink( $link) : "#"; ?>
                            <a href="<?php echo esc_url($url); ?>"
                               class="custom-btn btn-big grad-style-ab"><?php echo get_theme_mod('cynic_404_button_text'); ?></a>
                        <?php } ?>
                    </div>
                    <!-- End of .col-md-6 -->
                    <?php if(get_theme_mod('cynic_404_banner_image')) { ?>
                        <div class="col-md-6 text-md-right text-center">
                            <img src="<?php echo esc_url(get_theme_mod('cynic_404_banner_image')) ?>" alt="banner 404 image" class="img-fluid">
                        </div>
                    <?php } else { ?>
                        <div class="col-md-6 text-md-right text-center">
                            <img src="<?php echo CYNIC_THEME_URI . '/images/trendy-agency/banner-404.png'; ?>" alt="banner 404 image" class="img-fluid">
                        </div>
                    <?php } ?>
                </div>
                <!-- End of .row -->
            </div>
            <!-- End of .container -->
        </div>
        <!-- End of .banner -->
        <?php
    }
}


if (!function_exists('cynic_trendy_agency_modern_page_template')) {
    function cynic_trendy_agency_modern_page_template()
    {
        cynic_trendy_page_header();
        $margin_top = cynic_margin_top(); ?>
        <div class="container-modern cynic-common-class <?php echo esc_attr($margin_top); ?>">
            <?php
            while (have_posts()) : the_post();
                the_content();
                wp_link_pages();
            endwhile;
            if (getCynicOptionsVal('page_comment_section')) :
                if (comments_open() || get_comments_number()) : ?>
                    <section class="o-hidden blog-content author-sec">
                        <?php comments_template(); ?>
                    </section>
                    <?php
                endif;
            endif; ?>
            <!-- End .of container -->
        </div>
        <?php
    }
}
