<?php
function get_page_inner_header($_pageTitleType, $_type, $pageDescription, $pageTitle = '', $buttonHtml = '', $bannerImage = '', $displayHeader = 1)
{
    if (isset($displayHeader) && $displayHeader == 1
        && isset($_pageTitleType) && $_pageTitleType == 2):
        if ($_type == 'svg') {
            return true;
        } else {

            $page_name = $pageTitle;
            if (empty($pageTitle)):
                $args = array(
                    'public' => true,
                    '_builtin' => false
                );
                $output = 'names'; // names or objects, note names is the default
                $operator = 'and'; // 'and' or 'or'
                $cpostTypeArr = get_post_types($args, $output, $operator);
                if (is_home() || is_singular('post')) {
                    $page_name = ((trim(getCynicOptionsVal('breadcrumb_blog_title'))) ? getCynicOptionsVal('breadcrumb_blog_title') : __("News", 'cynic'));
                } elseif (get_post_type() == 'portfolio' || get_post_type() == 'case_studies') {
                    $obj = get_post_type_object(get_post_type());
                    $page_name = $obj->labels->singular_name;
                } elseif (count($cpostTypeArr) > 0 && in_array(get_post_type(), $cpostTypeArr)) {
                    $obj = get_post_type_object(get_post_type());
                    $page_name = $obj->labels->singular_name;
                } elseif (is_post_type_archive()) {
                    $page_name = post_type_archive_title('', false);
                } elseif (get_post_type() == 'page') {
                    $page_name = get_the_title();
                } elseif (is_search()) {
                    $page_name = sprintf(esc_html__('Search Results For: %s', 'cynic'), get_search_query());
                } else {
                    $page_name = strip_tags(get_the_archive_title('Text', true));
                }
            endif;
            ?>
            <!-- banner starts -->
            <div class="banner d-flex align-items-center light-grey-bg">

                <!-- Breadcrumb starts -->
<!--                <nav class="breadcrumb-wrapper" aria-label="breadcrumb">-->
<!--                    <div class="container">-->
<!--                        <ol class="breadcrumb">-->
<!--                            <li class="breadcrumb-item"><a-->
<!--                                        href="--><?php //echo home_url(); ?><!--">--><?php //esc_html_e('Home', 'cynic'); ?><!--</a></li>-->
<!--                            <li class="breadcrumb-item active" aria-current="page">--><?php //echo $page_name; ?><!--</li>-->
<!--                        </ol>-->
<!--                    </div>-->
<!--                </nav>-->


                <div class="container">
                    <div class="row no-gutters align-items-center">
                        <div class="col-lg-6 text-center text-lg-left">
                            <?php
                            if ($page_name) { ?>
                                <h1><?php echo esc_html($page_name); ?></h1>
                                <?php
                            }
                            if (isset($pageDescription) && !empty($pageDescription)) {
                                echo '<div class="larger-txt">' . html_entity_decode(cynic_newline($pageDescription)) . '</div>';
                            }
                            if (!empty($buttonHtml)) {
                                echo html_entity_decode(esc_html($buttonHtml));
                            } ?>
                        </div>
                        <!-- End of .col-lg-5 -->

                        <?php

                        if (!empty($bannerImage)) {
                            $imagesrc = $bannerImage;
                        } else {
                            $page_id = get_queried_object_id();
                            if (has_post_thumbnail($page_id)) :
                                $image_array = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'full');
                                $imagesrc = $image_array[0];
                            else :
                                $imagesrc = "";
                            endif;
                        }
                        ?>
                        <div class="col-lg-6">
                            <?php
                            if (!empty($imagesrc)) { ?>
                                <div class="img-container text-center text-lg-right">
                                    <img src="<?php echo esc_url($imagesrc); ?>" alt="News banner image"
                                         class="img-fluid">
                                </div>
                                <!-- End of .img-container -->
                                <?php
                            } ?>
                        </div>
                        <!-- End of .col-lg-7 -->
                    </div>
                    <!-- End of .row -->
                </div>
                <!-- End of .container -->
            </div>
            <!-- End of .banner -->
        <?php }
    endif;
}