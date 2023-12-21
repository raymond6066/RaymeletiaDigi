<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */
if (!function_exists('cynic_seo_agency_get_posts')) {
    function cynic_seo_agency_get_posts()
    {
        /*banner starts
        ============================================*/
        $blogBannerImageAttr = '';
        $blogBannerClass = '';
        $blogBannerImage = getCynicOptionsVal('blog_page_background_image');
        if (isset($blogBannerImage['url']) && !empty($blogBannerImage['url'])) {
            $blogBannerImageAttr = $blogBannerImage['url'];
            $blogBannerClass = 'ip-banner';
        }
        ?>
        <div class="details-banner <?php echo esc_attr($blogBannerClass) ?>" <?php echo ($blogBannerImageAttr) ? 'data-bg=' . esc_url($blogBannerImageAttr) : ''; ?>>
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
                    <?php
                    if (getCynicOptionsVal('blog_sidebar')) {
                        get_sidebar();
                    }
                    ?>
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

if (!function_exists('cynic_seo_agency_single_posts')) {
    function cynic_seo_agency_single_posts()
    {
        $cynic_options = cynic_options();
        ?>
        <!-- banner starts
           ============================================ -->
        <div class="details-banner">
            <?php cynic_breadcrumb(); ?>
        </div>
        <!-- End of .banner -->

        <!-- Blog-details starts -->
        <div class="section blog-details">
            <div class="container">
                <div class="row">
                    <div class="col-12 <?php echo esc_attr((getCynicOptionsVal('blog_single_sidebar')) ? ' col-md-8' : '') ?> ">
                        <div class="post-details">
                            <?php
                            if (have_posts()) {
                                while (have_posts()) : the_post(); ?>
                                    <?php get_template_part('template-parts/seo-agency/content', get_post_format()) ?>
                                    <?php
                                endwhile;
                            } ?>
                        </div>
                        <!-- End of .post-details -->
                        <!-- start Tag -->
                        <?php

                        if (isset($cynic_options['cynic_author_info']) && !empty($cynic_options['cynic_author_info'])) {
                            cynic_author();
                        }
                        ?>
                        <!-- End of .about-author -->
                        <?php
                        if (isset($cynic_options['cynic_blog_comment_section']) && !empty($cynic_options['cynic_blog_comment_section'])) {
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif;
                        }
                        ?>

                        <!-- End of .comment-form -->
                    </div>
                    <!-- End of .col-md-auto -->

                    <?php
                    if (getCynicOptionsVal('blog_single_sidebar')) {
                        get_sidebar();
                    }

                    ?>

                    <!-- End of .col-md-4 -->
                </div>
                <!-- End of .row -->
            </div>
            <!-- End of .container -->
        </div>
        <!-- End of .blog-posts -->
    <?php }
}