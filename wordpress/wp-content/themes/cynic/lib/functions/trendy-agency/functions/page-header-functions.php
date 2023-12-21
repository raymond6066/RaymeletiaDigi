<?php
function get_page_inner_header($_pageTitleType, $_type, $pageDescription, $pageTitle = '', $buttonHtml = '', $displayHeader=1)
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
                    $page_name = ((trim(getCynicOptionsVal('breadcrumb_blog_title'))) ? getCynicOptionsVal('breadcrumb_blog_title') : __("Blog", 'cynic'));
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
            <div class="inner-page-banner <?php echo esc_attr((!empty($buttonHtml)) ? 'inner-banner-with-btn' : '') ?>">
                <div class="container text-center">
                    <?php
                    if ($page_name) {
                        ?>
                        <h1><?php echo esc_html($page_name); ?></h1>
                        <?php
                    }
                    ?>
                    <?php
                    if (isset($pageDescription) && !empty($pageDescription)) {
                        echo '<p>' . html_entity_decode(esc_html($pageDescription)) . '</p>';
                    }
                    if (!empty($buttonHtml)) {
                        echo html_entity_decode(esc_html($buttonHtml));
                    }
                    ?>
                </div>
            </div>
        <?php }
    endif;
}