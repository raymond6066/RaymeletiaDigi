<?php

/*
** Cynic All Custom Post Type Single Template
*/
if (!function_exists('cynic_classic_modern_single_portfolio')) {
    function cynic_classic_modern_single_portfolio()
    {
        if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>
                <div class="container">
                    <div id="portfolio-detail-content" class="row potfolio-modal">
                        <?php
                        $portfolio_type = cynic_get_meta('portfolio_type');
                        if (isset($portfolio_type) && $portfolio_type == '1') {
                            get_template_part('template-parts/classic-modern-agency/portfolio', 'single-video-content');
                        } else {
                            get_template_part('template-parts/classic-modern-agency/portfolio', 'single-image-content');
                        }
                        ?>
                    </div>
                </div><!-- .container-->

                <?php
            }
        }

    }
}

if (!function_exists('cynic_classic_modern_single_positions')) {
    function cynic_classic_modern_single_positions()
    {
        if (have_posts()) {
            $taxonomy = 'positions_cat';
            $categories = get_terms($taxonomy);
            $thumbsize = 'cynic-positions-hveq';
            while (have_posts()) {
                the_post();
                $categories = wp_get_post_terms(get_the_ID(), $taxonomy);
                $imgsrc = false;
                $cat_name = '';
                $cats = array();
                if (!empty($categories) && !is_wp_error($categories)) {
                    $cats = array();
                    foreach ($categories as $c => $cat) {
                        $cats[] = $cat->name;
                    }
                    $cat_name = (isset($cats) && !empty($cats)) ? implode(',', $cats) : "";
                }
                $category_title = get_post_meta(get_the_ID(), 'positions_category_title', TRUE);
                $position_title = get_post_meta(get_the_ID(), 'positions_number_of_post_title', TRUE);
                $department = (isset($category_title) && !empty($category_title)) ? $category_title : "Department";
                $positions = (isset($position_title) && !empty($position_title)) ? $position_title : "Number of Positions"; ?>
                <div class="container">
                    <div id="positions-detail-content" class="row">
                        <div class="port-modal-content team-modal-content">
                            <h2 class="b-clor"><?php the_title(); ?></h2>
                            <p class="gray-text"><?php echo esc_html($department); ?>
                                : <?php echo esc_html($cat_name); ?> | <?php echo esc_html($positions); ?>
                                : <?php echo esc_html(get_post_meta(get_the_ID(), 'positions_number_of_post', TRUE)) ?></p>
                            <?php the_content(); ?>
                            <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'positions_subtitle_text', TRUE)); ?>
                                :</h3>
                            <?php $features = get_post_meta(get_the_ID(), 'positions_features', TRUE); ?>
                            <?php if (isset($features) && !empty($features)) { ?>
                                <ul class="list-with-arrow">
                                    <?php
                                    $count = count($features);
                                    for ($i = 0; $i < $count; $i++) {
                                        ?>
                                        <li><?php echo esc_html($features[$i]); ?></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                            <p class="regular-text">
                                <?php
                                $text = html_entity_decode(get_post_meta(get_the_ID(), 'positions_more_info', TRUE));
                                echo (isset($text) && !empty($text)) ? $text : "";
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}

if (!function_exists('cynic_seo_agency_single_portfolio')) {
    function cynic_seo_agency_single_portfolio()
    { ?>
        <!-- banner starts
    ============================================ -->
        <div class="details-banner">
            <?php cynic_breadcrumb(); ?>
        </div>
        <!-- End of .banner -->
        <!-- Work-details-carousel starts
        ============================================ -->
        <?php
        $catids = array();
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $portfolio_type = cynic_get_meta('portfolio_type', true);
                $portfolio_logo = cynic_get_meta('cynic_portfolio_service_image', true);
                $service_title = cynic_get_meta('cynic_portfolio_service_title', true);
                $service_button_text = cynic_get_meta('cynic_portfolio_button_text', true);
                $service_button_link = cynic_get_meta('cynic_portfolio_button_link', true);
                $service_button_open_type = cynic_get_meta('cynic_portfolio_button_open_type', true);
                $service_bullet_points = cynic_get_meta('cynic_portfolio_service_bullet_points', true);
                $post_categories = get_terms('portfolio-cat');
                $postid = get_the_ID();
                if ($post_categories && !is_wp_error($post_categories)) {
                    foreach ($post_categories as $postcat) {
                        $catids[] = $postcat->term_id;
                    }
                } ?>
                <div class="section work-details-carousel">
                    <div class="container">
                        <?php
                        if ($portfolio_type == 1) {
                            get_template_part('template-parts/seo-agency/portfolio', 'single-video-content');
                        } else {
                            get_template_part('template-parts/seo-agency/portfolio', 'single-image-content');
                        }
                        ?>
                        <div class="work-details-text">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="content-box">
                                        <?php
                                        if ($portfolio_logo) {
                                            echo wp_get_attachment_image($portfolio_logo, 'full', false, array('alt' => ''));
                                        } ?>
                                        <div class="content">
                                            <h4><?php echo html_entity_decode(esc_html($service_title)); ?>:</h4>
                                            <?php
                                            if (isset($service_bullet_points) && !empty($service_bullet_points)) { ?>
                                                <ul class="checklist-list-group">
                                                    <?php foreach ($service_bullet_points as $bullet_point) { ?>
                                                        <li><?php echo html_entity_decode(esc_html($bullet_point)); ?></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                            <!-- End of .checklist-list-group -->
                                            <?php
                                            if (isset($service_button_text) && !empty($service_button_text)) {
                                                $service_button_link = (isset($service_button_link) && !empty($service_button_link)) ? $service_button_link : "#";
                                                ?>
                                                <a href="<?php echo esc_url($service_button_link); ?>" <?php if (isset($service_button_open_type) && $service_button_open_type == 2) { ?> target="_blank" <?php } ?>
                                                   class="primary-btn"><?php echo esc_html($service_button_text); ?></a>
                                                <?php
                                            } ?>
                                        </div>
                                        <!-- End of .content -->
                                    </div>
                                    <!-- End of .content-box -->
                                </div>
                                <!-- End of .col-md-4 -->

                                <div class="col-md-8">
                                    <div class="text-content"><?php the_content(); ?></div>
                                    <!-- End of .text-content -->
                                </div>
                                <!-- End of .col-md-8 -->
                            </div>
                            <!-- End of .row -->
                        </div>
                        <!-- End of .work-details-text -->
                    </div>
                    <!-- End of .container -->
                </div>
                <!-- End of .work-details-carousel -->

                <?php
            }
        }
        if (getCynicOptionsVal('related_posts')):
            if (!empty($catids)) {
                $taxonomy = 'portfolio-cat';
                $posts_per_page = 3;
                $args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => (int)$posts_per_page,
                    'ignore_sticky_posts' => true,
                    'post__not_in' => array($postid),
                );
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'id',
                        'terms' => $catids,
                    ),
                );
                $related = new WP_Query($args);
                if ($related->have_posts()) { ?>
                    <!-- Featured-works starts
                    ============================================ -->
                    <section class="featured-works">
                        <div class="container">
                            <div class="section-heading text-center">
                                <h2><?php esc_html_e('Related Projects', 'cynic'); ?></h2>
                            </div>
                            <!-- End of .section-heading -->

                            <div class="featured-work-content">
                                <div class="row">
                                    <?php while ($related->have_posts()) {
                                        $related->the_post(); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="content box-with-img">
                                                <a href="<?php the_permalink(); ?>" class="img-container">
                                                    <?php
                                                    if (has_post_thumbnail()) {
                                                        the_post_thumbnail('cynic-portfolio-thumbnail', array('class' => 'img-fluid', 'alt' => ''));
                                                    }
                                                    ?>
                                                </a>
                                                <!-- End of .img-container -->

                                                <div class="text-content  text-left">
                                                    <h3>
                                                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                                    </h3>
                                                    <a href="<?php the_permalink() ?>" class="readmore-btn">
                                                        <div> <?php esc_html_e('View Details', 'cynic') ?>
                                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                        </div>
                                                    </a>
                                                    <!-- End of .readmore-btn -->
                                                </div>
                                                <!-- End of .text-content -->

                                                <a href="<?php the_permalink(); ?>" class="overlay"
                                                   data-bg="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>">
                                                    <div class="text-content  text-left">
                                                        <h3><?php the_title(); ?></h3>
                                                        <div class="readmore-btn">
                                                            <div> <?php esc_html_e('View Details', 'cynic') ?>
                                                                <i class="fa fa-long-arrow-right"></i>
                                                            </div>
                                                        </div>
                                                        <!-- End of .readmore-btn -->
                                                    </div>
                                                    <!-- End of .text-content -->
                                                </a>
                                                <!-- End of .overlay -->
                                            </div>
                                            <!-- End of .content -->
                                        </div>
                                    <?php } ?>
                                    <!-- End of .col-md-6 -->
                                </div>
                                <!-- End of .row -->
                            </div>
                            <!-- End of .featured-work-content -->
                        </div>
                        <!-- End of .container -->
                    </section>
                    <!-- End of .featured-works -->
                    <?php
                    wp_reset_postdata();
                }
            }
        endif;
        ?>
        <?php
    }
}

if (!function_exists('cynic_seo_agency_single_positions')) {
    function cynic_seo_agency_single_positions()
    { ?>

        <!-- banner starts
        ============================================ -->
        <div class="details-banner">
            <?php cynic_breadcrumb(); ?>
        </div>
        <!-- End of .banner -->
        <!-- Job-application starts -->
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
            $post_type = 'positions';
            $taxonomy = 'positions_cat';

            $job_feild_title = get_post_meta(get_the_ID(), 'positions_job_field_title', TRUE);
            $job_feild_title = (isset($job_feild_title) && !empty($job_feild_title)) ? $job_feild_title : 'Position';

            $job_feild_details = get_post_meta(get_the_ID(), 'positions_job_description_field_title', TRUE);
            $job_feild_details = (isset($job_feild_details) && !empty($job_feild_details)) ? $job_feild_details : "Job details";

            $position_feild_title = get_post_meta(get_the_ID(), 'positions_number_of_post_title', TRUE);
            $position_feild_title = (isset($position_feild_title) && !empty($position_feild_title)) ? $position_feild_title : "Number of Positions";
            $position_number = get_post_meta(get_the_ID(), 'positions_number_of_post', TRUE);
            $position_number = (isset($position_number) && !empty($position_number)) ? $position_number : "1";

            $department_field_title = get_post_meta(get_the_ID(), 'positions_category_title', TRUE);
            $department_field_title = (isset($department_field_title) && !empty($department_field_title)) ? $department_field_title : "";

            $id = get_the_ID();
            $Department = (Array)get_the_terms($id, $taxonomy);
            $DepartmentName = '';
            if (count($Department) > 0) {
                $DepartmentArr = array();
                foreach ($Department as $dept) {
                    $DepartmentArr[] = $dept->name;
                }
                $DepartmentName = implode(', ', $DepartmentArr);
            }

            $qualifications_field_title = get_post_meta(get_the_ID(), 'positions_subtitle_text', TRUE);
            $qualifications_field_title = (isset($qualifications_field_title) && !empty($qualifications_field_title)) ? $qualifications_field_title : "Key of qualifications";
            $qualificationsBullets = get_post_meta(get_the_ID(), 'positions_features', TRUE);

            $skill_feild_title = get_post_meta(get_the_ID(), 'positions_skill_sub_title_text', TRUE);
            $skill_feild_title = (isset($skill_feild_title) && !empty($skill_feild_title)) ? $skill_feild_title : "Technical skill";
            $skillsBullets = get_post_meta(get_the_ID(), 'positions_skills', TRUE);

            $location_field_title = get_post_meta(get_the_ID(), 'positions_job_location_sub_title_text', TRUE);
            $location_field_title = (isset($location_field_title) && !empty($location_field_title)) ? $location_field_title : "Location";
            $locations = get_post_meta(get_the_ID(), 'positions_job_location_text', TRUE);

            ?>
            <section class="section job-application">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="job-description">
                                <h2> <?php echo esc_html_e('Job Description', 'cynic') ?></h2>
                                <h4><?php echo esc_html($position_feild_title) ?>
                                    : <?php echo esc_html($position_number); ?></h4>

                                <div class="description-box">
                                    <h4><?php echo esc_html($job_feild_title); ?>:</h4>
                                    <p><?php the_title() ?></p>
                                </div>

                                <?php
                                if (!empty($department_field_title)) {
                                    ?>
                                    <div class="description-box">
                                        <h4><?php echo esc_html($department_field_title); ?>:</h4>
                                        <p><?php echo esc_html($DepartmentName); ?></p>
                                    </div>
                                <?php } ?>

                                <div class="description-box">
                                    <h4><?php echo esc_html($job_feild_details); ?>:</h4>
                                    <?php the_content() ?>
                                </div>
                                <?php
                                if (isset($qualificationsBullets) && !empty($qualificationsBullets) && count($qualificationsBullets) > 0):
                                    ?>
                                    <!-- End of .description-box -->
                                    <div class="description-box">
                                        <h4><?php echo esc_html($qualifications_field_title) ?>:</h4>
                                        <ul class="list-box">
                                            <?php
                                            foreach ($qualificationsBullets as $feature) {
                                                if (empty($feature)) {
                                                    continue;
                                                }
                                                ?>
                                                <li><?php echo html_entity_decode(esc_html($feature)); ?></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <!-- End of .list-box -->
                                    </div>
                                    <!-- End of .description-box -->
                                    <?php
                                endif;
                                ?>

                                <?php
                                if (isset($skillsBullets) && !empty($skillsBullets) && count($skillsBullets) > 0):
                                    ?>
                                    <!-- End of .description-box -->
                                    <div class="description-box">
                                        <h4><?php echo esc_html($skill_feild_title) ?>:</h4>
                                        <ul class="list-box">
                                            <?php
                                            foreach ($skillsBullets as $skill) {
                                                if (empty($skill)) {
                                                    continue;
                                                }
                                                ?>
                                                <li><?php echo html_entity_decode(esc_html($skill)); ?></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <!-- End of .list-box -->
                                    </div>
                                    <!-- End of .description-box -->
                                    <?php
                                endif;
                                ?>
                                <!-- End of .description-box -->
                                <?php
                                if (!empty($locations) && $locations):
                                    ?>
                                    <div class="description-box">
                                        <h4><?php echo esc_html($location_field_title); ?>:</h4>
                                        <p><?php echo esc_html($locations); ?></p>
                                    </div>
                                    <?php
                                endif;
                                ?>
                                <?php
                                $readmore = html_entity_decode(get_post_meta(get_the_ID(), 'positions_more_info', TRUE));
                                if (!empty($readmore)):
                                    ?>
                                    <p class="regular-text">
                                        <?php
                                        echo html_entity_decode(esc_html($readmore));
                                        ?>
                                    </p>
                                    <?php
                                endif;
                                ?>
                                <!-- End of .description-box -->
                            </div>
                            <!-- End of .job-description -->
                        </div>
                        <!-- End of .col-md-6 -->

                        <div class="col-md-5 ml-auto">
                            <?php if (is_active_sidebar('cynic-online-submit-form')) : ?>
                                <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                                    <?php dynamic_sidebar('cynic-online-submit-form'); ?>
                                </div><!-- #primary-sidebar -->
                            <?php endif; ?>
                            <!-- End of .form-content -->
                        </div>
                        <!-- End of .co.-md-5 -->
                    </div>
                    <!-- End of .row -->
                </div>
                <!-- End of .container -->
            </section>
            <!-- End of .Job-application -->
            <?php
        endwhile;
        else:
            ?>
            <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'cynic'); ?></p>
            <?php
        endif;
        ?>

        <?php

    }
}

if (!function_exists('cynic_classic_modern_case_studies_single')) {
    function cynic_classic_modern_case_studies_single()
    {
        get_template_part('template-parts/classic-modern-agency/page', 'header');
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $taxonomy = 'case_studies_cat';
                $postid = get_the_ID();
                $categories = wp_get_post_terms($postid, $taxonomy);
                $images = cynic_get_meta('cynic_case_studies_challenges_image', false);
                $challenge_image_position = cynic_get_meta('cynic_case_studies_challenges_image_position');
                $left_class = "";
                $right_class = "";
                if (isset($challenge_image_position) && $challenge_image_position == "1") {
                    $left_class = "pull-right";
                    $right_class = "pull-left";
                } ?>
                <!-- ++++ case studies description challenges++++ -->
                <section class="bg-white o-hidden case-study-overview">
                    <div class="container">
                        <!--section title -->
                        <h2 class="b-clor"><?php echo esc_html_e('Overview', 'cynic') ?></h2>
                        <hr class="dark-line"/>
                        <!--end section title -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="overview-text">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ++++ case studies description challenges++++ -->
                <section class="bg-white o-hidden case-studies-details-section">
                    <div class="container">
                        <!--section title -->
                        <h2 class="b-clor"><?php echo esc_html(cynic_get_meta('cynic_case_studies_challenges_title')) ?></h2>
                        <hr class="dark-line"/>
                        <!--end section title -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="dis-table">
                                    <div class="<?php echo esc_attr($left_class); ?>">
                                        <?php echo (isset($images[0]) && !empty($images[0])) ? wp_get_attachment_image((int)$images[0], 'full', false, array('class' => 'img-responsive')) : ""; ?>
                                    </div>
                                    <div class="text-box <?php echo esc_attr($right_class); ?>">
                                        <p><?php echo html_entity_decode(esc_html(cynic_get_meta('cynic_case_studies_challenges_text'))); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                $solution_images = cynic_get_meta('cynic_case_studies_solution_image', false);
                $solution_image_position = cynic_get_meta('cynic_case_studies_solution_image_position');
                if (isset($solution_image_position) && $solution_image_position == "1") {
                    $left_class = "pull-right";
                    $right_class = "pull-left";
                }
                ?>
                <section class="bg-white o-hidden  case-studies-details-section">
                    <div class="container">
                        <!--section title -->
                        <h2 class="b-clor"><?php echo esc_html(cynic_get_meta('cynic_case_studies_solution_title')) ?></h2>
                        <hr class="dark-line"/>
                        <!--end section title -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="dis-table">
                                    <div class="<?php echo esc_attr($left_class); ?>">
                                        <?php echo (isset($solution_images[0]) && !empty($images[0])) ? wp_get_attachment_image((int)$solution_images[0], 'full', false, array('class' => 'img-responsive')) : ""; ?>
                                    </div>
                                    <div class="text-box <?php echo esc_attr($right_class); ?>">
                                        <p><?php echo html_entity_decode(esc_html(cynic_get_meta('cynic_case_studies_solution_text'))); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                $scores = cynic_get_meta('cynic_case_studies_scoreboard_scores');
                if (isset($scores[0]) && !empty($scores[0])) { ?>
                    <section class="bg-white o-hidden scoreboard">
                        <div class="container">
                            <!--section title -->
                            <h2 class="b-clor text-align-center"><?php echo esc_html(cynic_get_meta('cynic_case_studies_scoreboard_title')) ?></h2>
                            <!--end section title -->
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="score-table">
                                        <ul>
                                            <?php foreach ($scores as $score) { ?>
                                                <li><?php echo esc_html($score); ?></li>
                                            <?php } ?>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php } ?>
                <!-- ++++ end case studies description ++++ -->
            <?php }
        } ?>
        <?php
        if ($categories && !is_wp_error($categories)) {
            $select_cat = array();
            foreach ($categories as $cat) {
                $select_cat[] = (int)$cat->term_id;
            }
            $posts_per_page = 2;
            $args = array(
                'post_type' => 'case_studies',
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
                <section class="bg-white o-hidden long-box-wrapper case-study-box  case-studies-details-section">
                    <div class="container">
                        <h2 class="b-clor"><?php esc_html_e('Related Case Studies', 'cynic') ?></h2>
                        <hr class="dark-line">
                        <div class="row">
                            <?php while ($query->have_posts()) {
                                $query->the_post(); ?>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="box-content-with-img"> <?php the_post_thumbnail('cynic-related-case', array('class' => 'img-responsive')); ?>
                                        <div class="box-content-text equalheight">
                                            <h3 class="semi-bold"><a
                                                        href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
                                            <p class="regular-text"><?php the_excerpt(); ?></p>
                                            <a href="<?php the_permalink(); ?>"
                                               class="medium-btn2 btn btn-fill"><?php esc_html_e('VIEW DETAILS', 'cynic') ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
                <?php
            }
            wp_reset_postdata();
        }
    }
}

if (!function_exists('cynic_seo_agency_case_studies_single')) {
    function cynic_seo_agency_case_studies_single()
    { ?>
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
            while (have_posts()) {
                the_post(); ?>
                <section class="section details-case-study">
                    <div class="container">
                        <div class="details-block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-content">
                                        <h2><?php echo esc_html(cynic_get_meta('cynic_case_studies_overview_title')); ?></h2>
                                        <?php the_content(); ?>
                                    </div>
                                    <!-- End of .text-content -->
                                </div>
                                <!-- End of .col-md-6 -->

                                <div class="col-md-6">
                                    <div class="counter-box">
                                        <div class="row">
                                            <?php
                                            $counters = rwmb_meta('cynic_case_studies_counter_counter');
                                            if (isset($counters) && !empty($counters)) {
                                                foreach ($counters as $counter) { ?>
                                                    <div class="col-md-6">
                                                        <div class="content text-center">
                                                            <?php
                                                            if ((isset($counter['icon_type']) && $counter['icon_type'] == 'image_icon') && (isset($counter['cynic_case_studies_counter_image_icon'][0]))) {
                                                                $imagehtml = wp_get_attachment_image($counter['cynic_case_studies_counter_image_icon'][0], 'full');
                                                                if (!empty($imagehtml)) {
                                                                    $counterHtml = $imagehtml;
                                                                }
                                                            } else {
                                                                $fontIcon = "grad-icon fa fa-bar-chart";
                                                                if (isset($counter['cynic_case_studies_counter_icon']) && !empty($counter['cynic_case_studies_counter_icon'])) {
                                                                    $fontIcon = "grad-icon " . esc_attr(($counter['cynic_case_studies_counter_icon']));
                                                                }
                                                                $counterHtml = "<i class=\"$fontIcon\"></i>";
                                                            }
                                                            echo esc_html_decode($counterHtml);
                                                            ?>
                                                            <p>
                                                        <span class="d-block">
                                                            <i class="counter"><?php echo esc_html($counter['cynic_case_studies_counter_value']); ?></i>%</span> <?php echo esc_html($counter['cynic_case_studies_counter_title']); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- End of .col-md-6 -->
                                                    <?php
                                                }
                                            } ?>
                                        </div>
                                        <!-- End of .row -->
                                    </div>
                                    <!-- End of .counter-box -->
                                </div>
                                <!-- End of .col-md-6 -->
                            </div>
                            <!-- End of .row -->
                        </div>
                        <!-- End of .details-block-content -->
                        <?php $info_blocks = rwmb_meta('cynic_case_studies_information');
                        $class1 = "";
                        $class2 = "";
                        $thumbnail = "cynic-case-studies-single-thumbnail";
                        if (isset($info_blocks) && !empty($info_blocks)) {
                            foreach ($info_blocks as $block) {
                                if ($block['cynic_case_studies_link_target'] == "right") {
                                    $class1 = "order-md-2";
                                    $class2 = "order-md-1";
                                } else {
                                    $class1 = "order-md-1";
                                    $class2 = "order-md-2";
                                }
                                $_image = "";
                                $_image_url = "";
                                if (isset($block['cynic_case_studies_image'][0]) && !empty($block['cynic_case_studies_image'][0])) {
                                    $_image = wp_get_attachment_image((int)$block['cynic_case_studies_image'][0], $thumbnail, false, array('class' => 'img-fluid'));
                                    $_image_url = wp_get_attachment_url($block['cynic_case_studies_image'][0]);
                                }
                                ?>
                                <div class="details-block-content">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 <?php echo esc_attr($class2); ?>">
                                            <div class="text-content">
                                                <h3><?php echo esc_html($block['cynic_case_studies_title']); ?></h3>
                                                <p><?php echo esc_html($block['cynic_case_studies_description']); ?></p>
                                                <?php
                                                $bullets = $block['cynic_case_studies_bullet_point_blocks'];
                                                if (isset($bullets) && !empty($bullets)) { ?>
                                                    <ul class="case-study-list-group">
                                                        <?php foreach ($bullets as $bullet) { ?>
                                                            <li><?php echo esc_html($bullet['cynic_case_studies_bullet_points']); ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                            </div>
                                            <!-- End of .text-content -->
                                        </div>
                                        <!-- End of .col-md-6 -->

                                        <div class="col-md-6 <?php echo esc_attr($class1); ?>">
                                            <?php if (isset($_image) && !empty($_image)) { ?>
                                                <div class="img-container">
                                                    <?php echo esc_html_decode($_image); ?>
                                                    <div class="overlay">
                                                        <a href="<?php echo esc_url($_image_url); ?>" class="magnify">
                                                            <i class="icon-Add"></i>
                                                        </a>
                                                    </div>
                                                    <!-- End of .overlay -->
                                                </div>
                                            <?php } ?>
                                            <!-- End of .img-container -->
                                        </div>
                                        <!-- End of .col-md-6 -->
                                    </div>
                                    <!-- End of .row -->
                                </div>
                                <!-- End of .details-block-content -->
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- End of .container -->
                </section>
                <!-- End of .case-studies -->
                <?php
            }
        }
    }
}

/**
 * Trendy Agency Portfolio single page method
 */
if (!function_exists('cynic_trendy_agency_single_portfolio')) {
    function cynic_trendy_agency_single_portfolio()
    { ?>
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_page_inner_header(2, 'text', get_the_excerpt());
                ?>
                <div class="single-portfolio-content" id="single-portfolio-content">
                    <div class="container">
                        <div class="row">
                            <?php
                            $portfolio_type = cynic_get_meta('portfolio_type');
                            if (isset($portfolio_type) && $portfolio_type == '1') {
                                get_template_part('template-parts/trendy-agency/portfolio', 'single-video-content');
                            } else {
                                get_template_part('template-parts/trendy-agency/portfolio', 'single-image-content');
                            }
                            ?>
                        </div>
                    </div><!-- .container-->
                </div>
                <?php
            }
        }
    }
}

/**
 * Trendy Agency Portfolio single page without page title method
 */
if (!function_exists('cynic_trendy_agency_single_portfolio_without_page_title')) {
    function cynic_trendy_agency_single_portfolio_without_page_title()
    { ?>
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                ?>
                <div class="single-portfolio-content m-0 p-0" id="single-portfolio-content">
                    <div class="container">
                        <div class="row">
                            <?php
                            $portfolio_type = cynic_get_meta('portfolio_type');
                            if (isset($portfolio_type) && $portfolio_type == '1') {
                                get_template_part('template-parts/trendy-agency/portfolio', 'single-video-content');
                            } else {
                                get_template_part('template-parts/trendy-agency/portfolio', 'single-image-content');
                            }
                            ?>
                        </div>
                    </div><!-- .container-->
                </div>
                <?php
            }
        }
    }
}


/**
 * Trendy Agency Case Studies single page method
 */
if (!function_exists('cynic_trendy_agency_case_studies_single')) {
    function cynic_trendy_agency_case_studies_single()
    { ?>
        <!-- banner starts
        ============================================ -->
        <?php
        ?>
        <!-- End of .banner -->

        <!-- details-case-study starts
        ============================================ -->
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();

                $buttontext = cynic_get_meta('cynic_case_studies_button_text');
                $customlink = cynic_get_meta('cynic_case_studies_button_custom_link');
                $customlinktarget = cynic_get_meta('cynic_case_studies_button_link_target');
                $postTitle = get_the_title();
                $launchSiteAnchor = '';
                if ($buttontext) {
                    $LHref = esc_url($customlink);
                    $relativeHrefTerget = esc_attr($customlinktarget);
                    $launchSiteAnchor = '<a href="' . $LHref . '" target="' . $relativeHrefTerget . '" class="custom-btn btn-big grad-style-ef">' . $buttontext . '</a>';
                }

                get_page_inner_header(2, 'text', get_the_excerpt(), $postTitle, $launchSiteAnchor, 1);

                $taxonomy = 'case_studies_cat';
                $postid = get_the_ID();
                $categories = wp_get_post_terms($postid, $taxonomy);
                $images = cynic_get_meta('cynic_case_studies_challenges_image', false);
                $challenge_image_position = cynic_get_meta('cynic_case_studies_challenges_image_position');

                $challengeTitle = cynic_get_meta('cynic_case_studies_challenges_title');
                $SolutionTitle = cynic_get_meta('cynic_case_studies_solution_title');
                if (!empty($SolutionTitle) || !empty($challengeTitle)):
                    if (isset($challenge_image_position) && $challenge_image_position == "1") {
                        $left_text_class = "col-lg-5";
                        $right_text_class = "col-lg-6 offset-lg-1";
                    } else {
                        $left_text_class = "col-lg-5 offset-lg-1 order-lg-2";
                        $right_text_class = "col-lg-6";
                    }
                    ?>
                    <section class="image-with-description">
                        <svg class="bg-shape image-with-description-shape-bg reveal-from-right"
                             xmlns="http://www.w3.org/2000/svg"
                             width="779px" height="759px">
                            <defs>
                                <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1"/>
                                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                            <path fill-rule="evenodd" fill="url(#PSgrad_03)"
                                  d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                            />
                        </svg>
                        <div class="container">
                            <?php
                            if (!empty($challengeTitle)):
                                ?>
                                <div class="row align-items-center image-with-description-block">
                                    <div class="<?php echo esc_attr($left_text_class); ?>">
                                        <h2><?php echo esc_html($challengeTitle); ?></h2>
                                        <p><?php echo html_entity_decode(cynic_newline(cynic_get_meta('cynic_case_studies_challenges_text'))); ?></p>

                                        <?php
                                        $featuretitle = cynic_get_meta('cynic_case_studies_challenges_feature_title');
                                        $featureIconType = cynic_get_meta('cynic_case_studies_challenges_icon_type');
                                        $features = cynic_get_meta('cynic_case_studies_challenges_feature');
                                        ?>
                                        <?php if ($featuretitle) { ?>
                                            <h4><?php echo esc_html($featuretitle) ?></h4>
                                        <?php } ?>
                                        <?php if ($features) {
                                            $ulclass = 'common-list-items';
                                            if ($featureIconType == 'default_icon') {
                                                $ulclass = '';
                                            }
                                            ?>
                                            <ul class="<?php echo esc_attr(($ulclass) ? $ulclass : 'default-list-items'); ?>">
                                                <?php foreach ($features as $feature) {
                                                    if (!empty($feature)) {
                                                        $icons = '';
                                                        $bulletText = '';
                                                        if (!empty($ulclass) && isset($feature['cynic_case_studies_challenges_bullet_icon']) && !empty($feature['cynic_case_studies_challenges_bullet_icon'])) {
                                                            $icons = '<i class="' . $feature['cynic_case_studies_challenges_bullet_icon'] . '"></i>';
                                                        }

                                                        if (isset($feature['cynic_case_studies_challenges_bullet_text']) && !empty($feature['cynic_case_studies_challenges_bullet_text'])) {
                                                            $bulletText = $feature['cynic_case_studies_challenges_bullet_text'];
                                                        }

                                                        if (empty(trim($bulletText))) {
                                                            continue;
                                                        }
                                                        ?>
                                                        <li><?php echo html_entity_decode(esc_html($icons));
                                                            echo esc_html($bulletText) ?></li>
                                                    <?php }
                                                } ?>
                                            </ul>
                                        <?php } ?>

                                        <!-- End of .common-list-items -->
                                    </div>
                                    <!-- End of .col-lg-5 -->

                                    <div class="<?php echo esc_attr($right_text_class); ?>">
                                        <?php echo (isset($images[0]) && !empty($images[0])) ? wp_get_attachment_image((int)$images[0], 'full', false, array('class' => 'img-fluid')) : ""; ?>
                                    </div>
                                    <!-- End of .col-lg-6 -->
                                </div>
                                <!-- End of .row -->
                            <?php endif;
                            if (!empty($SolutionTitle)):
                                $solution_images = cynic_get_meta('cynic_case_studies_solution_image', false);
                                $solution_image_position = cynic_get_meta('cynic_case_studies_solution_image_position');
                                if (isset($solution_image_position) && $solution_image_position == "1") {
                                    $left_text_class = "col-lg-5";
                                    $right_text_class = "col-lg-6 offset-lg-1";
                                } else {
                                    $left_text_class = "col-lg-5 offset-lg-1 order-lg-2";
                                    $right_text_class = "col-lg-6";
                                }
                                ?>
                                <div class="row align-items-center image-with-description-block">
                                    <div class="<?php echo esc_attr($left_text_class) ?>">
                                        <h2><?php echo esc_html($SolutionTitle); ?></h2>
                                        <p><?php echo html_entity_decode(esc_html(cynic_get_meta('cynic_case_studies_solution_text'))); ?></p>
                                        <?php
                                        $featuretitle = cynic_get_meta('cynic_case_studies_solution_feature_title');
                                        $featureIconType = cynic_get_meta('cynic_case_studies_solution_icon_type');
                                        $features = cynic_get_meta('cynic_case_studies_solution_feature');
                                        ?>
                                        <?php if ($featuretitle) { ?>
                                            <h4><?php echo esc_html($featuretitle) ?></h4>
                                        <?php } ?>
                                        <?php if ($features) {
                                            $ulclass = 'common-list-items';
                                            if ($featureIconType == 'default_icon') {
                                                $ulclass = '';
                                            }
                                            ?>
                                            <ul class="<?php echo esc_attr(($ulclass) ? $ulclass : 'default-list-items'); ?>">
                                                <?php foreach ($features as $feature) {
                                                    if (!empty($feature)) {
                                                        $icons = '';
                                                        $bulletText = '';
                                                        if (!empty($ulclass) && isset($feature['cynic_case_studies_solution_bullet_icon']) &&
                                                            !empty($feature['cynic_case_studies_solution_bullet_icon'])) {
                                                            $icons = '<i class="' . $feature['cynic_case_studies_solution_bullet_icon'] . '"></i>';
                                                        }

                                                        if (isset($feature['cynic_case_studies_solution_bullet_text']) && !empty($feature['cynic_case_studies_solution_bullet_text'])) {
                                                            $bulletText = $feature['cynic_case_studies_solution_bullet_text'];
                                                        }

                                                        if (empty(trim($bulletText))) {
                                                            continue;
                                                        }
                                                        ?>
                                                        <li><?php echo html_entity_decode(esc_html($icons));
                                                            echo esc_html($bulletText) ?></li>
                                                    <?php }
                                                } ?>
                                            </ul>
                                        <?php } ?>
                                        <!-- End of .common-list-items -->
                                    </div>
                                    <!-- End of .col-lg-6 -->

                                    <div class="<?php echo esc_attr($right_text_class) ?>">
                                        <?php echo (isset($solution_images[0]) && !empty($images[0])) ? wp_get_attachment_image((int)$solution_images[0], 'full', false, array('class' => 'img-fluid')) : ""; ?>
                                    </div>
                                    <!-- End of .col-lg-6 -->
                                </div>
                                <?php
                            endif;
                            ?>
                            <!-- End of .row -->
                        </div>
                        <!-- End of .container -->
                    </section>
                    <!-- End of .image-with-description -->
                <?php endif; ?>
                <!-- scroreboard
                ======================================= -->
                <?php
                $scores = cynic_get_meta('cynic_case_studies_scoreboard_scores');
                if (is_array($scores) && count($scores) > 0):
                    ?>
                    <section class="scroreboard section-padding">
                        <div class="container">
                            <h2 class="text-center"><?php echo esc_html(cynic_get_meta('cynic_case_studies_scoreboard_title')) ?></h2>
                            <div class="scroreboard-wrapper">
                                <div class="row">
                                    <?php
                                    $i = 1;
                                    $scrollefthtml = '';
                                    $scrolrighthtml = '';
                                    foreach ($scores as $score) {
                                        if (!empty($score)) {
                                            if ($i % 2 == 0) {
                                                $scrollefthtml .= '<div><i class="ml-symtwo-23-check-mark"></i>' . esc_html($score) . '</div>';
                                            } else {
                                                $scrolrighthtml .= '<div><i class="ml-symtwo-23-check-mark"></i>' . esc_html($score) . '</div>';
                                            }
                                        }
                                        $i++;
                                    } ?>
                                    <div class="col-md-6">
                                        <div class="scoreboard-content">
                                            <?php echo $scrollefthtml ?>
                                        </div>
                                        <!-- End of .scroreboadr-content -->
                                    </div>
                                    <!-- End of .col-md-6 -->

                                    <div class="col-md-6">
                                        <div class="scoreboard-content">
                                            <?php echo $scrolrighthtml ?>
                                        </div>
                                        <!-- End of .scroreboadr-content -->
                                    </div>
                                    <!-- End of .col-md-6 -->
                                </div>
                                <!-- End of .row -->
                            </div>
                            <!-- End of .scroreboard-wrapper -->
                        </div>
                        <!-- End of .container -->
                    </section>
                    <!-- End of .our-process -->
                    <?php
                endif;
                ?>

                <!-- featured-projects
            ======================================= -->
                <?php
                if ($categories && !is_wp_error($categories)):
                    $select_cat = array();
                    foreach ($categories as $cat) {
                        $select_cat[] = (int)$cat->term_id;
                    }
                    $posts_per_page = 2;
                    $args = array(
                        'post_type' => 'case_studies',
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
                    if ($query->have_posts()):
                        ?>
                        <section class="inner-page-case-studies section-padding">
                            <svg class="bg-shape shape-project reveal-from-right" xmlns="http://www.w3.org/2000/svg"
                                 width="779px" height="759px">
                                <defs>
                                    <linearGradient id="PSgrad_04" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                        <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1"/>
                                        <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0"/>
                                    </linearGradient>

                                </defs>
                                <path fill-rule="evenodd" fill="url(#PSgrad_04)"
                                      d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                                />
                            </svg>
                            <div class="container">
                                <h2 class="text-center"><?php echo esc_html_e('More Case Studies', 'cynic') ?></h2>
                                <div class="case-study-showcase text-center">
                                    <div class="row">
                                        <?php while ($query->have_posts()) {
                                            $query->the_post(); ?>
                                            <div class="col-md-6">
                                                <a href="<?php the_permalink(); ?>"
                                                   class="case-study-content-block content-block text-left">
                                                    <div class="img-container">
                                                        <?php the_post_thumbnail('cynic-trendy-related-case', array('class' => 'img-fluid')); ?>
                                                    </div>
                                                    <!-- End of .img-container -->
                                                    <div class="txt-content equalHeightCaseStudy">
                                                        <h5><?php the_title() ?></h5>
                                                        <p><?php the_excerpt(); ?></p>
                                                    </div>
                                                    <!-- End of .txt-content -->
                                                </a>
                                                <!-- End of .featured-content-block -->
                                            </div>
                                            <!-- End of .col-md-6 -->
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $internal_link = (get_theme_mod('cynic_cs_page_link')) ? get_theme_mod('cynic_cs_page_link') : "#";
                                    $relativeHref = get_permalink((int)$internal_link);;
                                    $relativeHrefTerget = '_self';
                                    $relativeButtonText = __('DISCOVER MORE CASE STUDIES', 'cynic'); ?>
                                    <!-- End of .grid -->
                                    <a href="<?php echo esc_url($relativeHref); ?>"
                                       target="<?php echo esc_attr($relativeHrefTerget); ?>"
                                       class="custom-btn btn-big grad-style-ef btn-full"><?php echo esc_html($relativeButtonText) ?></a>
                                </div>
                                <!-- End of .template-showcase -->
                            </div>
                            <!-- End of .container -->
                        </section>
                        <!-- End of .featured-projects -->
                        <!-- End of .case-studies -->
                        <?php
                    endif;
                endif;
            }
        }
    }
}

/**
 * Illustration Portfolio single page method
 */
if (!function_exists('cynic_illustration_single_portfolio')) {
    function cynic_illustration_single_portfolio()
    { ?>
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_page_inner_header(2, 'text', get_the_excerpt()); ?>
                <div class="single-portfolio-content" id="single-portfolio-content">
                    <div class="container">
                        <div class="row">
                            <?php
                            $portfolio_type = cynic_get_meta('portfolio_type');
                            if (isset($portfolio_type) && $portfolio_type == '1') {
                                get_template_part('template-parts/illustration/portfolio', 'single-video-content');
                            } else {
                                get_template_part('template-parts/illustration/portfolio', 'single-image-content');
                            }
                            ?>
                        </div>
                    </div><!-- .container-->
                </div>
                <?php
            }
        }
    }
}


/*
 * */

if (!function_exists('cynic_illustration_case_studies_single')) {
    function cynic_illustration_case_studies_single()
    {
        if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>

                <!-- banner starts -->
                <div class="banner d-flex align-items-center">

                    <!-- Breadcrumb starts -->
<!--                    <nav class="breadcrumb-wrapper" aria-label="breadcrumb">-->
<!--                        <div class="container">-->
<!--                            <ol class="breadcrumb">-->
<!--                                <li class="breadcrumb-item">-->
<!--                                    <a href="--><?php //echo home_url('/'); ?><!--">--><?php //echo __('Home', 'cynic') ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="breadcrumb-item active" aria-current="page">--><?php //the_title(); ?><!--</li>-->
<!--                            </ol>-->
<!--                        </div>-->
<!--                    </nav>-->


                    <div class="container">
                        <div class="row no-gutters align-items-center">
                            <div class="col-lg-6 text-center text-lg-left">
                                <h1><?php the_title(); ?></h1>
                                <p class="larger-txt"><?php the_excerpt(); ?></p>
                            </div>
                            <!-- End of .col-lg-5 -->
                            <?php
                            if (has_post_thumbnail()) { ?>
                                <div class="col-lg-6">
                                    <div class="img-container text-center text-lg-right">
                                        <?php
                                        echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, array('class' => 'img-fluid', 'alt' => '' . get_the_title(get_the_ID()) . ''));
                                        ?>
                                    </div>
                                    <!-- End of .img-container -->
                                </div>
                                <!-- End of .col-lg-7 -->
                                <?php
                            } ?>
                        </div>
                        <!-- End of .row -->
                    </div>
                    <!-- End of .container -->
                </div>
                <!-- End of .banner -->

                <!-- our features starts -->
                <?php
                $features = cynic_get_meta('cynic_case_studies_feature');
                if ($features) { ?>
                    <section class="features section-gap-top  light-grey-bg" id="cynic-about" data-scroll-offset="165">
                        <div class="container">
                            <?php
                            foreach ($features as $feature) {
                                $challenge_image_position = $feature['cynic_case_studies_image_position'];
                                $images = (isset($feature['cynic_case_studies_image'])) ? $feature['cynic_case_studies_image'] : "";
                                if (isset($challenge_image_position) && $challenge_image_position == "1") {
                                    $left_text_class = "col-lg-6 order-lg-2 offset-lg-1 text-center text-lg-right";
                                    $right_text_class = "col-lg-5";
                                } else {
                                    $left_text_class = "col-lg-6 text-center text-lg-left";
                                    $right_text_class = "col-lg-5 offset-lg-1";
                                }
                                $bullet_points = nl2br($feature['cynic_case_studies_text']);
                                $__bullet_points = preg_replace("<br>", "***", $bullet_points);
                                $newBulletPoints = explode('<*** />', $__bullet_points); ?>
                                <div class="features-grid">
                                    <div class="row align-items-center">
                                        <div class="<?php echo esc_attr($left_text_class); ?>">
                                            <?php
                                            if (isset($images[0]) && !empty($images[0])) { ?>
                                                <div class="img-container">
                                                    <?php echo wp_get_attachment_image((int)$images[0], 'full', false, array('class' => 'img-fluid')); ?>
                                                </div>
                                                <!-- End of .img-container -->
                                                <?php
                                            } ?>
                                        </div>
                                        <!-- End of .col-lg-6 -->

                                        <div class="<?php echo esc_attr($right_text_class); ?>">
                                            <div class="features-content">
                                                <h2 class="section-title"><?php echo esc_html($feature['cynic_case_studies_title']); ?></h2>
                                                <?php
                                                foreach ($newBulletPoints as $text) {
                                                    if (!empty($text)) {
                                                        echo '<p>' . $text . '</p>';
                                                    }
                                                } ?>
                                            </div>
                                            <!-- End of .features-content -->
                                        </div>
                                        <!-- End of .col-lg-6 -->
                                    </div>
                                    <!-- End of .row -->
                                </div>
                                <!-- End of .features-grid -->
                                <?php
                            } ?>
                            <!-- End of .features-grid -->
                        </div>
                        <!-- End of .container -->
                    </section>
                    <!-- End of .features -->

                    <?php
                }
            }
            global $post;
            $postid = $post->ID;
            $taxonomy = "case_studies_cat";
            $categories = get_terms($taxonomy);
            if ($categories && !is_wp_error($categories)) {
                $select_cat = array();
                foreach ($categories as $cat) {
                    $select_cat[] = (int)$cat->term_id;
                }
                $posts_per_page = 3;
                $args = array(
                    'post_type' => 'case_studies',
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
                if ($query->have_posts()) { ?>
                    <!-- Case study starts -->
                    <section class="case-study section-gap ">
                        <div class="container">
                            <?php
                            $block_title = get_theme_mod('cynic_case_studies_block_title');
                            if(!empty($block_title)) { ?>
                                <h2 class="section-title text-center"><?php echo $block_title; ?></h2>
                                <?php
                            }
                            $cs_button_text = get_theme_mod('cynic_case_studies_button_text');
                            $cs_permalink = get_theme_mod('cynic_cs_page_link'); ?>
                            <div class="item-showcase grid-wrapper__small-padding">

                                <div class="row">
                                    <?php
                                    while($query->have_posts()) {
                                        $query->the_post(); ?>
                                        <div class="col-lg-4 col-md-6">
                                            <a href="<?php the_permalink(); ?>" class="img-card case-study-card">
                                                <?php
                                                $thumbsize = "cynic-illustration-cs-thumb-img";
                                                if(has_post_thumbnail()) {
                                                    echo wp_get_attachment_image(get_post_thumbnail_id(), $thumbsize , false, array('class' => 'img-fluid', 'alt' => '' . get_the_title(get_the_ID()) . ''));
                                                } ?>
                                                <div class="content case-study-content">
                                                    <h4><span><?php the_title(); ?></span></h4>
                                                    <p><?php the_excerpt(); ?></p>
                                                </div>
                                            </a>
                                            <!-- End of .img-card -->
                                        </div>
                                        <!-- End of .col-lg-4 -->
                                        <?php
                                    } ?>
                                </div>
                                <?php
                                if(!empty($cs_button_text)) { ?>
                                    <div class="col-12 text-center">
                                        <a href="<?php the_permalink($cs_permalink); ?>" class="custom-btn secondary-btn"><?php echo $cs_button_text; ?></a>
                                    </div>
                                    <!-- End of .row -->
                                    <?php
                                } ?>
                            </div>
                            <!-- End of .project-showcase -->
                        </div>
                        <!-- End of .container -->
                    </section>
                    <!-- End of .case-study -->
                    <?php
                }
                wp_reset_postdata();
            }
        }
    }
}