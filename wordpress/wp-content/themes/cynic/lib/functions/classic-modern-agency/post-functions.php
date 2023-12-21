<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */

// To Get All The Posts And Classic Modern View
if (!function_exists('cynic_get_posts')) {
    function cynic_classic_modern_get_posts()
    {
        get_template_part('template-parts/classic-modern-agency/page', 'header');
        $cynic_options = cynic_options();
        $is_active_sidebar = 1;
        $class = "col-md-8 col-sm-8 col-xs-12";
        if (is_active_sidebar('blog-sidebar')) {
            if (isset($cynic_options['cynic_sidebar']) && $cynic_options['cynic_sidebar'] == 1) {
                $is_active_sidebar = 0;
                $class = "col-md-12 col-sm-12 col-xs-12";
            }

        } else {
            $class = 'col-md-12 col-sm-12 col-xs-12';
        }
        ?>
        <div class="page-section bg-white o-hidden blog-content">

            <div class="container relative">
                <div class="row">
                    <!-- Start Right Blog Details -->
                    <div class="<?php echo esc_attr($class); ?>">
                        <?php if (have_posts()) {
                            while (have_posts()) {
                                the_post(); ?>
                                <article <?php post_class('blog-item') ?>>
                                    <?php get_template_part('template-parts/classic-modern-agency/content', get_post_format()) ?>
                                </article>
                            <?php } ?>
                            <div class="clear"></div>
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
                                </div><!-- .blog-pagination -->
                            <?php } ?>
                        <?php } ?>
                    </div><!-- .col-md-8 -->

                    <!-- blog sidebar -->
                    <?php if (isset($is_active_sidebar) && $is_active_sidebar == 1) : get_sidebar(); endif; ?>

                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .page-head.area-padding -->

        <?php

    }
}

//To Get Classic Modern Single Post

if (!function_exists('cynic_classic_modern_single_posts')) {
    function cynic_classic_modern_single_posts()
    {
        $cynic_options = cynic_options();
        $is_active_sidebar = 1;
        $class = "col-sm-8 col-xs-12";
        $related_class = " col-sm-6";
        if (is_active_sidebar('blog-sidebar')) {
            if (isset($cynic_options['cynic_sidebar']) && $cynic_options['cynic_sidebar'] == 1) {
                $is_active_sidebar = 0;
                $class = "col-md-12 col-xs-12";
                if (isset($cynic_options['cynic_related_posts']) && $cynic_options['cynic_related_posts'] == 1) {
                    $related_class = " col-sm-4";
                }
            }
        } else {
            $class = 'col-md-12 col-xs-12';
            $related_class = " col-sm-6";
        }
        get_template_part('template-parts/classic-modern-agency/page', 'header'); ?>
        <div class="page-section bg-white blog-content">
            <div class="container relative">
                <div class="row">
                    <!-- Start Right Blog Details -->
                    <div class="<?php echo esc_attr($class); ?>">
                        <?php if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                $post_categories = get_the_category();
                                $catids = array();
                                $postid = get_the_ID();
                                if ($post_categories && !is_wp_error($post_categories)) {
                                    foreach ($post_categories as $postcat) {
                                        $catids[] = $postcat->term_id;
                                    }
                                }
                                ?>
                                <article <?php post_class('blog-item') ?>>
                                    <?php get_template_part('template-parts/classic-modern-agency/content', get_post_format()) ?>
                                </article>
                            <?php } //endwhile ?>
                            <!-- comments list -->
                            <div class="clear"></div>
                            <?php if (has_tag()) { ?>
                                <div class="post-tags"><?php the_tags(); ?></div>
                            <?php } ?>
                            <section class="blog-content author-sec">
                                <!--blog content row one-->
                                <?php
                                $btn_holder = "";
                                $extra_class = (isset($cynic_options['cynic_comment_section']) && $cynic_options['cynic_comment_section'] != "1") ? " btn-holder-navigation" : "";
                                ?>
                                <?php if (isset($cynic_options['cynic_author_info']) && $cynic_options['cynic_author_info'] == '1') { ?>
                                    <!--section title -->
                                    <h2 class="b-clor"><?php esc_html_e('Author Details', 'cynic') ?></h2>
                                    <hr class="dark-line">
                                    <div class="row">
                                        <?php
                                        $avatar = get_avatar(get_the_author_meta('ID'), 90);

                                        if ($avatar !== false) { ?>
                                            <div class="blogger-img"> <?php echo get_avatar(get_the_author_meta('ID'), 90); ?></div>
                                        <?php } ?>
                                        <div class="blog-description <?php if ($avatar === false) {
                                            echo esc_attr('comment-full-width');
                                        } ?>">
                                            <p class="bloger-name"><?php the_author_meta('nickname') ?></p>
                                            <p class="regular-text"><?php the_author_meta('description') ?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php $btn_holder = "btn-holder";
                                } ?>
                                <?php
                                $prev = get_previous_posts_link();
                                $next = get_next_post();
                                if (!empty($prev) || !empty($next)) { ?>
                                    <div class="clearfix nav-margin <?php if (!empty($btn_holder)) {
                                        echo esc_attr($btn_holder);
                                    }
                                    echo esc_attr($extra_class) ?>">
                                        <?php
                                        the_post_navigation(array(
                                            'prev_text' => '<span class="btn btn-nofill green-text medium-btn2 pull-left">' . esc_html__('Prev Post', 'cynic') . '</span>',
                                            'next_text' => '<span class="btn btn-nofill green-text medium-btn2 pull-right">' . esc_html__('Next Post', 'cynic') . '</span>',
                                        ));
                                        ?>
                                    </div>
                                <?php } ?>
                            </section>


                            <?php if (!isset($cynic_options['cynic_comment_section']) || ((isset($cynic_options['cynic_comment_section']) && $cynic_options['cynic_comment_section'] == '1'))) : ?>
                                <section class="blog-content author-sec">
                                    <div class="clear"></div>
                                    <div class="container-fluid">
                                        <?php if (comments_open() || get_comments_number()) :
                                            comments_template();
                                        endif; ?>
                                    </div><!-- .single-post-comments -->
                                </section>
                            <?php endif; ?>

                            <?php
                            (isset($cynic_options['cynic_sidebar']) && $cynic_options['cynic_sidebar'] == 1) ? $posts_per_page = 3 : $posts_per_page = 2;
                            if ($catids && isset($cynic_options['cynic_related_posts']) && $cynic_options['cynic_related_posts']) {
                                $related = new WP_Query(array(
                                    'posts_per_page' => $posts_per_page,
                                    'category__in' => $catids,
                                    'post_type' => 'post',
                                    'post__not_in' => array($postid),
                                ));
                                if ($related->have_posts()) { ?>
                                    <section class="bg-white blog-design-category blog-rel-post">
                                        <!--blog content row one-->
                                        <!--section title -->
                                        <h2 class="b-clor"><?php esc_html_e('Related Posts', 'cynic') ?></h2>
                                        <hr class="dark-line">
                                        <!--end section title -->
                                        <div class="row">
                                            <?php while ($related->have_posts()) {
                                                $related->the_post(); ?>
                                                <!--blog content box-->
                                                <div class="col-xs-12<?php echo esc_attr($related_class); ?>">
                                                    <div class="box-content-with-img equalheight">
                                                        <?php the_post_thumbnail('cynic-portfolio-hveq') ?>
                                                        <div class="box-content-text">
                                                            <p class="gray-text"><span
                                                                        class="icon-calendar-full"></span><?php echo get_the_date() ?>
                                                            </p>
                                                            <h3 class="semi-bold"><a
                                                                        href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                                            </h3>
                                                            <p class="regular-text"><?php the_excerpt(); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <!--end blog content box-->
                                        </div>
                                    </section>
                                <?php }
                            } ?>
                        <?php } ?>
                    </div><!-- .<?php echo esc_attr($class); ?> -->
                    <!-- blog sidebar -->
                    <?php if (isset($is_active_sidebar) && $is_active_sidebar == 1) : get_sidebar(); endif; ?>
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .page-section -->
        <?php
    }
}