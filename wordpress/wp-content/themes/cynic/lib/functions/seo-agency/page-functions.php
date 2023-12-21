<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */

if (!function_exists('cynic_seo_agency_get_default_page_template')) {
    function cynic_seo_agency_get_default_page_template()
    {
        $_pageTitle = cynic_get_meta("cynic_page_title");
        $cynic_options = cynic_options();
        if (isset($_pageTitle) && $_pageTitle == 2) :
            get_page_header($_pageTitle);
        endif; ?>

        <div class="container">
            <?php
            while (have_posts()) : the_post();
                if ($_pageTitle == 1 || $_pageTitle === FALSE || $_pageTitle == ''): ?>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header><!-- .entry-header -->
                    <?php
                endif;
                the_content();
                wp_link_pages();
            endwhile;
            ?>

            <?php if (getCynicOptionsVal('page_comment_section')) : ?>
                <?php
                if (comments_open() || get_comments_number()) : ?>
                    <section class="o-hidden blog-content author-sec">
                        <?php comments_template(); ?>
                    </section>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <!-- End .of container -->
        <?php
    }
}

if (!function_exists('cynic_seo_agency_get_search_results_page')) {
    function cynic_seo_agency_get_search_results_page()
    {
        $searchBannerStatus = getCynicOptionsVal('header_search_banner');
        $ipbannerbgattr = '';
        if ($searchBannerStatus) {

            $bg_search = '';
            $search_result_banner = getCynicOptionsVal('search_result_banner');
            if (isset($search_result_banner['url']) && !empty($search_result_banner['url'])) {
                $bg_search = $search_result_banner['url'];
            }
            $ipbannerbgattr = 'data-bg=' . $bg_search;
        }
        ?>
        <!-- ++++ banner ++++ -->
        <section class="ip-banner search-results-banner" <?php echo esc_attr($ipbannerbgattr); ?>>
            <div class="content d-flex align-items-center justify-content-center">
                <div class="container">
                    <!--banner text-->
                    <div class="banner-txt">
                        <h1><?php echo((getCynicOptionsVal('search_banner_text')) ? esc_html(getCynicOptionsVal('search_banner_text')) : esc_html__('search results for:', 'cynic')); ?></h1>
                        <form action="<?php echo esc_url(home_url('/')); ?>">
                            <div class="form-group">
                                <i class="icon-Loupe"></i>
                                <input type="text" name="s" value="<?php echo get_search_query(); ?>"
                                       class="form-control"
                                       placeholder="<?php echo esc_attr_x('Search here...', 'placeholder', 'cynic'); ?>">
                                <button type="submit"
                                        title="<?php echo esc_attr_x('Start Search', 'placeholder', 'cynic'); ?>">
                                    <i class="icon-Chevron---Right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--end banner text-->
                </div>
                <!-- End of .container -->
            </div>
        </section>
        <?php

        global $wp_query;
        if (have_posts()) {
            $count = $wp_query->found_posts;
            $search_result_show_per_row = getCynicOptionsVal('search_result_show_per_row');
            $showPerRow = ($search_result_show_per_row && !empty($search_result_show_per_row)) ? (int)$search_result_show_per_row : 4;
            $showPerClass = 'result-box col-md-4';
            if (!empty($showPerRow)) {
                $showPerClass = 'result-box col-md-' . $showPerRow;
            }

            ?>
            <!-- ++++ Search-results ++++ -->
            <section class="section-search-result">
                <div class="container">
                    <!--section title -->
                    <h2> <?php echo esc_html($count, 'cynic'); ?>
                        &nbsp;<?php esc_html_e('search results found', 'cynic'); ?></h2>
                    <!--end section title -->
                    <div class="row">

                        <?php while (have_posts()) {
                            the_post(); ?>
                            <div class="<?php echo esc_attr($showPerClass); ?>">
                                <div class="content">
                                    <a href="<?php the_permalink() ?>"><?php echo(($showPerClass == 'col-md-12') ? wp_strip_all_tags(get_the_title()) : get_the_title()) ?></a>
                                    <p class="regular-text"><?php the_excerpt(); ?></p>
                                </div>
                                <!-- End of .content -->
                            </div>
                        <?php } ?>
                        <div class="col-md-12">
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
                            </div><!-- .blog-pagination -->
                        </div>
                        <!-- End of .col-sm-4 -->
                    </div>

                    <!-- End of .row -->
                </div>
                <!-- End of .container -->
            </section>
        <?php } else { ?>
            <!-- End of .search-results -->
            <!-- ++++ contact-us-now ++++ -->
            <section class="bg-white cynic-no-results">
                <div class="container text-left">
                    <h2><?php echo ((getCynicOptionsVal('no_result_text'))) ? esc_html(getCynicOptionsVal('no_result_text')) : esc_html__("No results found! Maybe we can help.", "cynic") ?></h2>
                    <?php
                    $permalink = FALSE;
                    if (getCynicOptionsVal('search_button_link')) {
                        $searchresultpageId = (int)getCynicOptionsVal('search_button_link');
                        $permalink = get_permalink($searchresultpageId);
                        ?>
                        <a href="<?php echo (isset($permalink) && !empty($permalink)) ? $permalink : home_url() ?>"
                           class="btn primary-btn"><?php echo (getCynicOptionsVal('search_button_text')) ? esc_html(getCynicOptionsVal('search_button_text')) : esc_html__("Contact Us", "cynic") ?></a>
                    <?php } ?>
                </div>
                <!-- End of .container -->
            </section>
        <?php }
    }
}

if (!function_exists('cynic_seo_agency_get_search_form')) {
    function cynic_seo_agency_get_search_form()
    { ?>

        <div class="widget search-widget">
            <form class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" name="s" value="<?php echo get_search_query(); ?>" class="form-control search-field"
                       placeholder="<?php echo esc_attr_e('Search', 'cynic'); ?>">
            </form>
        </div>

        <?php

    }
}

if (!function_exists('cynic_seo_agency_get_sidebar')) {
    function cynic_seo_agency_get_sidebar()
    {
        if (is_active_sidebar('blog-sidebar')) { ?>
            <aside class="col-md-4">
                <?php dynamic_sidebar('blog-sidebar') ?>
            </aside>
            <?php
        }
    }
}

if (!function_exists('cynic_seo_agency_404_page_template')) {
    function cynic_seo_agency_404_page_template()
    { ?>
        <!-- banner starts
        ============================================ -->
        <?php
        $bgimage = getCynicOptionsVal('404_page_background_image');
        $bgattr = ' ';
        if (!empty($bgimage['url'])) {
            $bgattr = 'data-bg=' . $bgimage['url'];
        }
        ?>
        <div class="p-404-error main" <?php echo esc_attr($bgattr); ?>>
            <section class="fullscreen-banner banner-404">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>
                                <span><?php echo((getCynicOptionsVal('404_page_error_code_text')) ? getCynicOptionsVal('404_page_error_code_text') : __('404', 'cynic')); ?></span><?php echo((getCynicOptionsVal('404_page_title_text')) ? getCynicOptionsVal('404_page_title_text') : __('oops! Page not Found', 'cynic')); ?>
                            </h1>
                            <p><?php echo((getCynicOptionsVal('404_page_sub_title_text')) ? getCynicOptionsVal('404_page_sub_title_text') : __('It\'s gone but it\'s not the end of the world!', 'cynic')); ?></p>
                            <?php
                            $permalink = get_permalink(getCynicOptionsVal('404_button_link'));
                            ?>
                            <a href="<?php echo (isset($permalink) && !empty($permalink)) ? $permalink : home_url() ?>"
                               class="btn primary-btn"><?php echo (getCynicOptionsVal('404_page_button_text')) ? esc_html(getCynicOptionsVal('404_page_button_text')) : esc_html__("Go Back Home", "cynic") ?></a>
                        </div>
                        <!-- End of .col-12 -->
                        <div class="col-12 img-container">
                            <?php
                            $page_image2 = getCynicOptionsVal('404_page_image2');
                            if (!empty($page_image2['url'])) { ?>
                                <img src="<?php echo esc_url($page_image2['url']) ?>"
                                     class="img-fluid">
                                <?php
                            }
                            $page_image1 = getCynicOptionsVal('404_page_image1');
                            if (!empty($page_image1['url'])) {
                                ?>
                                <img src="<?php echo esc_url($page_image1['url']) ?>"
                                     class="img-fluid floating-ballon">
                                <?php
                            }
                            ?>
                        </div>
                        <!-- End of .col-12 -->
                    </div>
                    <!-- End of .row -->
                </div>
                <!-- End of .container -->
            </section>

        </div>
        <?php
    }
}

if (!function_exists('cynic_seo_agency_category_archieve')) {
    function cynic_seo_agency_category_archieve()
    { ?>
        <!-- banner starts
    ============================================ -->
        <div class="details-banner">
            <?php cynic_breadcrumb(); ?>
        </div>
        <!-- Blog-posts starts
        ============================================ -->
        <div class="section blog-posts">
            <div class="container">
                <div class="row">
                    <?php
                    $col_md_class = 'col-md-12';
                    $blog_sidebar = getCynicOptionsVal('blog_sidebar');
                    if($blog_sidebar){
                        $col_md_class = 'col-md-8';
                    }
                    ?>
                    <div class="<?php echo esc_attr($col_md_class); ?>">
                        <!-- Start Right Blog Details -->
                        <?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post(); ?>
                                <article <?php post_class('blog-item') ?>>
                                    <?php get_template_part('template-parts/seo-agency/content', get_post_format()) ?>
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
                    <?php get_sidebar(); ?>
                    <?php if (isset($is_active_sidebar) && $is_active_sidebar == 1) : get_sidebar(); endif; ?>
                    <!-- End of .col-md-4 -->
                </div>
                <!-- End of .row -->
            </div>
            <!-- End of .container -->
        </div>
        <!-- End of .blog-posts -->
        <?php
    }
}