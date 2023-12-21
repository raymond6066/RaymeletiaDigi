
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
        } ?>
        <svg class="modal-bg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="379px" height="369px">
            <defs>
                <linearGradient id="PSgrad_09" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                </linearGradient>

            </defs>
            <path fill-rule="evenodd" fill="url(#PSgrad_09)" d="M54.086,281.380 L105.962,327.505 C173.075,387.178 276.496,381.853 336.956,315.610 C397.418,249.367 392.025,147.292 324.911,87.619 L273.035,41.495 C205.921,-18.178 102.501,-12.853 42.040,53.390 C-18.422,119.633 -13.028,221.708 54.086,281.380 Z"
            />
        </svg>
        <!-- End of .modal-bg -->

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="ml-symtwo-24-multiply-cross-math"></i>
        </button>
        <!-- End of .close -->

        <div class="modal-heading text-center">
            <h2><?php the_title() ?></h2>
            <?php the_content()?>
            <?php echo html_entity_decode(esc_html($launchSiteAnchor)); ?>
        </div>
        <!-- End of .modal-heading -->
        <div class="modal-body">
            <?php
            $taxonomy = 'case_studies_cat';
            $postid = get_the_ID();
            $categories = wp_get_post_terms($postid, $taxonomy);
            $images = cynic_get_meta('cynic_case_studies_challenges_image', false);
            $challenge_image_position = cynic_get_meta('cynic_case_studies_challenges_image_position');

            $challengeTitle = cynic_get_meta('cynic_case_studies_challenges_title');
            $SolutionTitle = cynic_get_meta('cynic_case_studies_solution_title');
            if (!empty($SolutionTitle) || !empty($challengeTitle)) {
                if (isset($challenge_image_position) && $challenge_image_position == "1") {
                    $left_text_class = "col-lg-5";
                    $right_text_class = "col-lg-6 offset-lg-1";
                } else {
                    $left_text_class = "col-lg-5 offset-lg-1 order-lg-2";
                    $right_text_class = "col-lg-6";
                }
                if (!empty($challengeTitle)) {
                    ?>
                    <div class="row no-gutters align-items-center case-study-content">
                        <svg class="case-study-challenge-bg" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" width="379px"
                             height="369px">
                            <defs>
                                <linearGradient id="PSgrad_010" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1"/>
                                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0"/>
                                </linearGradient>

                            </defs>
                            <path fill-rule="evenodd" fill="url(#PSgrad_010)"
                                  d="M54.086,281.380 L105.962,327.505 C173.075,387.178 276.496,381.853 336.956,315.610 C397.418,249.367 392.025,147.292 324.911,87.619 L273.035,41.495 C205.921,-18.178 102.501,-12.853 42.040,53.390 C-18.422,119.633 -13.028,221.708 54.086,281.380 Z"
                            />
                        </svg>
                        <div class="<?php echo esc_attr($left_text_class); ?>">
                            <h3><?php echo esc_html($challengeTitle); ?></h3>
                            <p><?php echo html_entity_decode(cynic_newline(cynic_get_meta('cynic_case_studies_challenges_text'))); ?></p>

                            <?php
                            $featuretitle = cynic_get_meta('cynic_case_studies_challenges_feature_title');
                            $featureIconType = cynic_get_meta('cynic_case_studies_challenges_icon_type');
                            $features = cynic_get_meta('cynic_case_studies_challenges_feature'); ?>
                        </div>
                        <div class="<?php echo esc_attr($right_text_class); ?>">
                            <?php echo (isset($images[0]) && !empty($images[0])) ? wp_get_attachment_image((int)$images[0], 'full', false, array('class' => 'img-fluid')) : ""; ?>
                        </div>
                    </div>
                    <!-- End of .row -->
                    <?php
                }
                if (!empty($SolutionTitle)) {
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
                    <div class="row no-gutters align-items-center case-study-content">
                        <svg class="case-study-solutions-bg" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" width="379px"
                             height="369px">
                            <defs>
                                <linearGradient id="PSgrad_011" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1"/>
                                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0"/>
                                </linearGradient>

                            </defs>
                            <path fill-rule="evenodd" fill="url(#PSgrad_011)"
                                  d="M54.086,281.380 L105.962,327.505 C173.075,387.178 276.496,381.853 336.956,315.610 C397.418,249.367 392.025,147.292 324.911,87.619 L273.035,41.495 C205.921,-18.178 102.501,-12.853 42.040,53.390 C-18.422,119.633 -13.028,221.708 54.086,281.380 Z"
                            />
                        </svg>
                        <div class="<?php echo esc_attr($left_text_class); ?>">
                            <h3><?php echo esc_html($SolutionTitle); ?></h3>
                            <p><?php echo html_entity_decode(esc_html(cynic_get_meta('cynic_case_studies_solution_text'))); ?></p>
                        </div>
                        <div class="<?php echo esc_attr($right_text_class) ?>">
                            <?php echo (isset($solution_images[0]) && !empty($images[0])) ? wp_get_attachment_image((int)$solution_images[0], 'full', false, array('class' => 'img-fluid')) : ""; ?>
                        </div>
                    </div>
                    <!-- End of .row -->
                    <?php
                }
            }
                $scores = cynic_get_meta('cynic_case_studies_scoreboard_scores');
                if (is_array($scores) && count($scores) > 0) { ?>
                    <div class="row no-gutters case-study-content scoreboard">
                        <div class="col-md-12">
                            <h3 class="text-md-center"><?php echo esc_html(cynic_get_meta('cynic_case_studies_scoreboard_title')) ?></h3>
                        </div>
                        <div class="col-md-6">
                            <?php
                            $i = 0;
                            $scrollefthtml = '';
                            $scrolrighthtml = '';
                            foreach ($scores as $score) {
                                if (!empty($score)) {
                                    if ($i % 2 == 0) {
                                        $scrollefthtml .= '<div class="score"><i class="ml-symtwo-23-check-mark"></i>' . esc_html($score) . '</div>';
                                    } else {
                                        $scrolrighthtml .= '<div class="score"><i class="ml-symtwo-23-check-mark"></i>' . esc_html($score) . '</div>';
                                    }
                                }
                                $i++;
                            } ?>
                            <div class="scores">
                                <?php echo $scrollefthtml ?>
                            </div>
                            <!-- End of .scores -->
                        </div>
                        <div class="col-md-6">
                            <div class="scores">
                                <?php echo $scrolrighthtml ?>
                            </div>
                            <!-- End of .scores -->
                        </div>
                    </div>
                    <!-- End of .row -->
                    <?php
                } ?>
                <!-- End of .modal-body -->
                <?php
        echo "</div>";
    }
}
?>
