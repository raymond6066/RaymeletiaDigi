<?php
if (!function_exists('cynic_illustration_get_default_page_template')) {
    function cynic_illustration_get_default_page_template()
    {
        cynic_illustration_page_header(); ?>
        <div class="container">
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

if (!function_exists('cynic_illustration_get_mpdern_page_template')) {
    function cynic_illustration_get_mpdern_page_template()
    {
        cynic_illustration_page_header();
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
    }
}
if (!function_exists('cynic_illustration_get_sidebar')) {
    function cynic_illustration_get_sidebar()
    {
        if (is_active_sidebar('blog-sidebar')) { ?>
            <div class="col-md-4">
                <aside class="post-sidebar">
                    <?php dynamic_sidebar('blog-sidebar') ?>
                </aside>
            </div>
            <?php
        }
    }
}

if (!function_exists('cynic_illustration_get_search_form')) {
    function cynic_illustration_get_search_form()
    { ?>

        <div class="widget search-widget">
            <form class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" name="s" value="<?php echo get_search_query(); ?>"
                       placeholder="<?php echo esc_attr_e('Search', 'cynic'); ?>">
                <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
            </form>
        </div>

        <?php

    }
}

if (!function_exists('cynic_illustration_404_page_template')) {
    function cynic_illustration_404_page_template()
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
                               class="custom-btn secondary-btn"><?php echo get_theme_mod('cynic_404_button_text'); ?></a>
                        <?php } ?>
                    </div>
                    <!-- End of .col-md-6 -->
                    <?php if(get_theme_mod('cynic_404_banner_image')) { ?>
                        <div class="col-md-6 text-md-right text-center">
                            <img src="<?php echo esc_url(get_theme_mod('cynic_404_banner_image')) ?>" alt="banner 404 image" class="img-fluid">
                        </div>
                    <?php } else { ?>
                        <div class="col-md-6 text-md-right text-center">
                            <img src="<?php echo CYNIC_THEME_URI . '/images/illustration/banner-404.png'; ?>" alt="banner 404 image" class="img-fluid">
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