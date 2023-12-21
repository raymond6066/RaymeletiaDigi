<?php
/**
 *
 * Author : axilweb
 * Website: http://www.axilweb.com
 */

if (!function_exists('cynic_classic_modern_get_default_page_template')) {
    function cynic_classic_modern_get_default_page_template()
    {
        $scroll_to = 0;
        $content_class = 'col-sm-12 col-xs-12';
        $cynic_options = cynic_options();
        if (isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == 1) {
            get_template_part('template-parts/classic-modern-agency/page', 'header');
            $page_scroll_offset = cynic_get_meta('cynic_page_scroll_offset');
            $scroll_to = (isset($page_scroll_offset) && !empty($page_scroll_offset)) ? $page_scroll_offset : 480;
        } ?>
        <div class="container">

            <div id="cynic-modern-page" class="row">
                <div class="<?php echo esc_attr($content_class) ?> page-scroll-to"
                     data-scroll-to="<?php echo (isset($scroll_to)) ? esc_attr($scroll_to) : ""; ?>">
                    <?php
                    while (have_posts()) :
                    the_post();
                    the_content();
                    ?>
                </div>
                <?php
                wp_link_pages();
                endwhile;
                edit_post_link(__('Edit', 'cynic'), '<div class="clearfix"></div><div class="entry-footer"><span class="edit-link">', '</span></div><!-- .entry-footer -->');
                ?>

            </div>

        </div>
        <?php
    }
}

if (!function_exists('cynic_get_custom_page_template')) {
    function cynic_get_custom_page_template()
    {
        $scroll_to = 0;
        $content_class = 'col-sm-12 col-xs-12';
        $cynic_options = cynic_options();
        if (isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == 1) {
            get_template_part('template-parts/classic-modern-agency/page', 'header');
            $page_scroll_offset = cynic_get_meta('cynic_page_scroll_offset');
            $scroll_to = (isset($page_scroll_offset) && !empty($page_scroll_offset)) ? $page_scroll_offset : 480;
        } ?>
        <div class="container">

            <div id="cynic-modern-page" class="row">
                <div class="<?php echo esc_attr($content_class) ?> page-scroll-to"
                     data-scroll-to="<?php echo (isset($scroll_to)) ? esc_attr($scroll_to) : ""; ?>">
                    <?php
                    while (have_posts()) :
                    the_post();
                    the_content();
                    ?>
                </div>
                <?php
                wp_link_pages();
                endwhile;
                edit_post_link(__('Edit', 'cynic'), '<div class="clearfix"></div><div class="entry-footer"><span class="edit-link">', '</span></div><!-- .entry-footer -->');
                ?>

            </div>

        </div>
        <?php
    }
}

if (!function_exists('cynic_get_404_page_template')) {
    function cynic_classic_modern_404_page_template()
    { ?>
        <div class="error-404">
            <div class="container">
                <div class="error_message text-center">
                    <span><?php esc_html_e('oops!', 'cynic'); ?></span> <?php esc_html_e('404 Error. We can\'t seem to find your lost treasure.', 'cynic'); ?>
                    <br> <?php esc_html_e('Maybe you would like to', 'cynic'); ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                       class="b-clor"> <?php esc_html_e('go back?', 'cynic'); ?> </a>
                    <img src="<?php echo CYNIC_THEME_URI ?>/images/car-falling.jpg"
                         alt="<?php esc_html_e('car falling image', 'cynic'); ?>" class="img-responsive">
                </div>
                <!-- End of .error_message -->
            </div>
            <!-- End of .container -->
        </div>
        <?php
    }
}


if (!function_exists('cynic_classic_modern_get_search_form')) {
    function cynic_classic_modern_get_search_form()
    { ?>

        <form class="form-inline form search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="search-wrap">
                <button class="search-button animate" type="submit"
                        title="<?php echo esc_attr_x('Start Search', 'placeholder', 'cynic'); ?>"><i
                            class="icon-magnifier"></i>
                </button>
                <input type="text" name="s" value="<?php echo get_search_query(); ?>" class="form-control search-field"
                       placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'cynic'); ?>">
            </div>
        </form>

        <?php

    }
}

if (!function_exists('cynic_classic_modern_get_search_results_page')) {
    function cynic_classic_modern_get_search_results_page($posts = null, $max_number_pages = null)
    {
        $cynic_options = cynic_options();
        $bg_search = get_template_directory_uri() . "/images/search-results-banner.jpg";
        if (isset($cynic_options['cynic_search_result_banner']['url']) && !empty($cynic_options['cynic_search_result_banner']['url'])) {
            $bg_search = $cynic_options['cynic_search_result_banner']['url'];
        } ?>
        <!-- ++++ banner ++++ -->
        <section class="banner  o-hidden banner-inner search-results-banner"
                 data-bg="<?php echo esc_attr($bg_search) ?>">
            <div class="container">
                <!--banner text-->
                <div class="banner-txt">
                    <h1><?php echo((isset($cynic_options['cynic_search_banner_text']) && !empty($cynic_options['cynic_search_banner_text'])) ? esc_html($cynic_options['cynic_search_banner_text']) : esc_html__('search results for:', 'cynic')) ?></h1>
                    <form action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="form-group">
                            <i class="icon-magnifier"></i>
                            <input type="text" name="s" value="<?php echo get_search_query(); ?>" class="form-control"
                                   placeholder="<?php echo esc_attr_x('Search here...', 'placeholder', 'cynic'); ?>">
                            <button type="submit"
                                    title="<?php echo esc_attr_x('Start Search', 'placeholder', 'cynic'); ?>">
                                <i class="icon-chevron-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <!--end banner text-->
            </div>
            <!-- End of .container -->
        </section>
        <?php if (have_posts()) {
        $count = count($posts); ?>
        <!-- ++++ Search-results ++++ -->
        <section class="search-results">
            <div class="container">
                <!--section title -->
                <h2 class="b-clor"> <?php echo esc_html($count, 'cynic'); ?><?php esc_html_e('search results found', 'cynic'); ?></h2>
                <hr class="dark-line"/>
                <!--end section title -->
                <div class="row">
                    <?php while (have_posts()) {
                        the_post(); ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="content equalheight">
                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                <p class="regular-text"><?php the_excerpt(); ?></p>
                            </div>
                            <!-- End of .content -->
                        </div>
                    <?php } ?>
                    <!-- End of .col-sm-4 -->
                </div>
                <div class="row">
                    <div class="pagination">
                        <?php
                        $big = 999999999; // need an unlikely integer
                        echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $max_number_pages,
                            'prev_text' => esc_html__('&lt;', 'cynic'),
                            'next_text' => esc_html__('&gt;', 'cynic'),
                        ));
                        ?>
                    </div><!-- .blog-pagination -->
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
                <h2 class="b-clor"><?php echo (isset($cynic_options['cynic_no_result_text']) && !empty($cynic_options['cynic_no_result_text'])) ? esc_html($cynic_options['cynic_no_result_text']) : esc_html__("No results found! Maybe we can help.", "cynic") ?></h2>
                <?php
                $permalink = FALSE;
                if (isset($cynic_options['cynic_search_burron_link']) && !empty($cynic_options['cynic_search_burron_link'])) {
                    $args = array(
                        'post_type' => 'page',
                        'showposts' => 1,
                        'page_id' => (int)$cynic_options['cynic_search_burron_link'],
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $permalink = get_permalink();
                        }
                    }
                    wp_reset_postdata();
                } ?>
                <a href="<?php echo (isset($permalink) && !empty($permalink)) ? $permalink : home_url() ?>"
                   class="btn btn-fill"><?php echo (isset($cynic_options['cynic_search_burron_text']) && !empty($cynic_options['cynic_search_burron_text'])) ? esc_html($cynic_options['cynic_search_burron_text']) : esc_html__("contact us now", "cynic") ?></a>
            </div>
            <!-- End of .container -->
        </section>
    <?php } ?>
        <!-- End of .search-results -->
        <?php
    }
}

if (!function_exists('cynic_classic_modern_get_sidebar')) {
    function cynic_classic_modern_get_sidebar()
    {
        if (is_active_sidebar('blog-sidebar')) { ?>
            <div class="col-sm-4 col-md-3 col-xs-12 col-md-offset-1 sidebar">
                <?php dynamic_sidebar('blog-sidebar') ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('cynic_classic_modern_category_archieve')) {
    function cynic_classic_modern_category_archieve()
    {
        get_template_part('template-parts/classic-modern-agency/page', 'header');
        ?>
        <div class="page-section bg-white o-hidden blog-content">
            <div class="page-overly"></div>
            <div class="container">
                <div class="row">
                    <!-- Start Right Blog Details -->
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <?php if (have_posts()) { ?>
                            <?php while (have_posts()) {
                                the_post(); ?>
                                <article <?php post_class('blog-item') ?>>
                                    <?php get_template_part('template-parts/classic-modern-agency/content', get_post_format()) ?>
                                </article>
                                <div class="clear"></div>

                            <?php } ?>
                            <div class="pagination">
                                <?php
                                $big = 999999999; // need an unlikely integer
                                global $wp_query;

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
                        <?php } ?>
                    </div><!-- .col-md-8 -->
                    <!-- blog sidebar -->
                    <?php get_sidebar() ?>
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .page-head.area-padding -->
        <?php
    }
}