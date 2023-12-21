<?php

/**
 * @class CynicSEOPostTypes
 * @abstract
 */
class CynicIllustrationPostTypes
{

    public function __construct()
    {
        add_action('init', array($this, 'cynicSEO_post_type_init'));
        add_filter('rwmb_meta_boxes', array($this, 'cynicSEO_register_meta_boxes'));
    }

    /**
     * Register all required post types
     *
     */
    public function cynicSEO_post_type_init()
    {
        /**
         * @abstract Portfolio post type
         */
        $labels = array(
            'name' => _x('Portfolio', 'post type general name', 'cynic'),
            'singular_name' => _x('Portfolio', 'post type singular name', 'cynic'),
            'menu_name' => _x('Portfolio', 'admin menu', 'cynic'),
            'name_admin_bar' => _x('Portfolio', 'add new on admin bar', 'cynic'),
            'add_new' => _x('Add New', 'portfolio', 'cynic'),
            'add_new_item' => __('Add New Portfolio', 'cynic'),
            'new_item' => __('New Portfolio', 'cynic'),
            'edit_item' => __('Edit Portfolio', 'cynic'),
            'view_item' => __('View Portfolio', 'cynic'),
            'all_items' => __('All Portfolio', 'cynic'),
            'search_items' => __('Search Portfolio', 'cynic'),
            'parent_item_colon' => __('Parent Portfolio:', 'cynic'),
            'not_found' => __('No portfolio found.', 'cynic'),
            'not_found_in_trash' => __('No portfolio found in Trash.', 'cynic')
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Description.', 'cynic'),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'pf'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
        );

        register_post_type('portfolio', $args);

        $labels = array(
            'name' => _x('Portfolio Categories', 'taxonomy general name', 'cynic'),
            'singular_name' => _x('Portfolio Category', 'taxonomy singular name', 'cynic'),
            'search_items' => __('Search Portfolio Categories', 'cynic'),
            'all_items' => __('All Portfolio Categories', 'cynic'),
            'parent_item' => __('Parent Portfolio Category', 'cynic'),
            'parent_item_colon' => __('Parent Portfolio Category:', 'cynic'),
            'edit_item' => __('Edit Portfolio Category', 'cynic'),
            'update_item' => __('Update Portfolio Category', 'cynic'),
            'add_new_item' => __('Add New Portfolio Category', 'cynic'),
            'new_item_name' => __('New Portfolio Category Name', 'cynic'),
            'menu_name' => __('Portfolio Category', 'cynic'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'portfolio-cat'),
        );

        register_taxonomy('portfolio-cat', array('portfolio'), $args);


        /**
         * @abstract case studies post type
         */
        $labels = array(
            'name' => _x('Case Studies', 'post type general name', 'cynic'),
            'singular_name' => _x('Case Study', 'post type singular name', 'cynic'),
            'menu_name' => _x('Case Studies', 'admin menu', 'cynic'),
            'name_admin_bar' => _x('Case Study', 'add new on admin bar', 'cynic'),
            'add_new' => _x('Add New', 'cv', 'cynic'),
            'add_new_item' => __('Add New Case Study', 'cynic'),
            'new_item' => __('New Case Study', 'cynic'),
            'edit_item' => __('Edit Case Study', 'cynic'),
            'view_item' => __('View Case Study', 'cynic'),
            'all_items' => __('All Case Studies', 'cynic'),
            'search_items' => __('Search Case Studies', 'cynic'),
            'parent_item_colon' => __('Parent Case Studies:', 'cynic'),
            'not_found' => __('No Case Studies found.', 'cynic'),
            'not_found_in_trash' => __('No Case Studies found in Trash.', 'cynic')
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Description.', 'cynic'),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'case-study'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
        );

        register_post_type('case_studies', $args);

        $labels = array(
            'name' => _x('Categories', 'taxonomy general name', 'cynic'),
            'singular_name' => _x('Category', 'taxonomy singular name', 'cynic'),
            'search_items' => __('Search Categories', 'cynic'),
            'all_items' => __('All Categories', 'cynic'),
            'parent_item' => __('Parent Category', 'cynic'),
            'parent_item_colon' => __('Parent Category:', 'cynic'),
            'edit_item' => __('Edit Category', 'cynic'),
            'update_item' => __('Update Category', 'cynic'),
            'add_new_item' => __('Add New Category', 'cynic'),
            'new_item_name' => __('New Project Category Name', 'cynic'),
            'menu_name' => __('Category', 'cynic'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'case-studies-cat'),
        );

        register_taxonomy('case_studies_cat', array('case_studies'), $args);


        /**
         * @abstract Customer Review post type
         */
        $labels = array(
            'name' => _x('Reviews', 'post type general name', 'cynic'),
            'singular_name' => _x('Reviews', 'post type singular name', 'cynic'),
            'menu_name' => _x('Customer Reviews', 'admin menu', 'cynic'),
            'name_admin_bar' => _x('Customer Reviews', 'add new on admin bar', 'cynic'),
            'add_new' => _x('Add New', 'reviews', 'cynic'),
            'add_new_item' => __('Add New Review', 'cynic'),
            'new_item' => __('New Review', 'cynic'),
            'edit_item' => __('Edit Review', 'cynic'),
            'view_item' => __('View Reviews', 'cynic'),
            'all_items' => __('All Reviews', 'cynic'),
            'search_items' => __('Search Review', 'cynic'),
            'parent_item_colon' => __('Parent Review:', 'cynic'),
            'not_found' => __('No Review found.', 'cynic'),
            'not_found_in_trash' => __('No Review found in Trash.', 'cynic')
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Description.', 'cynic'),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'reviews'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
        );

        register_post_type('reviews', $args);

        $labels = array(
            'name' => _x('Review Categories', 'taxonomy general name', 'cynic'),
            'singular_name' => _x('Review Category', 'taxonomy singular name', 'cynic'),
            'search_items' => __('Search Review Categories', 'cynic'),
            'all_items' => __('All Review Categories', 'cynic'),
            'parent_item' => __('Parent Review Category', 'cynic'),
            'parent_item_colon' => __('Parent Review Category:', 'cynic'),
            'edit_item' => __('Edit Review Category', 'cynic'),
            'update_item' => __('Update Review Category', 'cynic'),
            'add_new_item' => __('Add New Review Category', 'cynic'),
            'new_item_name' => __('New Review Category Name', 'cynic'),
            'menu_name' => __('Review Category', 'cynic'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'reviews-cat'),
        );

        register_taxonomy('reviews-cat', array('reviews'), $args);
    }

    public function cynicSEO_register_meta_boxes($meta_boxes = array())
    {

        $prefix = 'cynic_page_';
        $meta_boxes[] = array(
            'id' => 'cynic_pages',
            'title' => __('Page Meta', 'cynic'),
            'post_types' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'display_header',
                    'class' => $prefix . 'display_header',
                    'name' => __('Display Page Header', 'cynic'),
                    'type' => 'radio',
                    'std' => '1',
                    'options' => array(
                        '1' => __('Yes', 'cynic'),
                        '2' => __('No', 'cynic')
                    ),
                ),
                array(
                    'id' => $prefix . 'title',
                    'class' => $prefix . 'title',
                    'name' => __('Display Page Title', 'cynic'),
                    'type' => 'radio',
                    'std' => '2',
                    'options' => array(
                        '2' => __('Display Title', 'cynic'),
                        '0' => __('Empty Title', 'cynic'),
                    ),
                ),
                array(
                    'id' => $prefix . 'headingtext',
                    'class' => $prefix . 'headingtext',
                    'name' => __('Heading Text', 'cynic'),
                    'type' => 'wysiwyg',
                ),
            ));


        $prefix = 'portfolio_';

        $meta_boxes[] = array(
            'id' => 'cynic_portfolio_type',
            'title' => __('Portfolio Type', 'cynic'),
            'post_types' => array('portfolio'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'type',
                    'name' => __('Is Portfolio', 'cynic'),
                    'type' => 'radio',
                    'std' => '0',
                    'options' => array(
                        '0' => __('Image', 'cynic'),
                        '1' => __('Video', 'cynic'),
                    ),
                ),
            ));

        $meta_boxes[] = array(
            'id' => 'cynic_portfolio',
            'title' => __('Image Portfolio', 'cynic'),
            'post_types' => array('portfolio'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'featured',
                    'name' => __('Is Featured', 'cynic'),
                    'type' => 'radio',
                    'std' => '0',
                    'options' => array(
                        '1' => __('Yes', 'cynic'),
                        '0' => __('No', 'cynic'),
                    ),
                ),
                array(
                    'name' => __('Button Text', 'cynic'),
                    'desc' => __('Button Text', 'cynic'),
                    'id' => $prefix . 'button_text',
                    'type' => 'text',
                    'std' => 'LAUNCH WEBSITE',
                    'clone' => false,
                ),
                array(
                    'name' => __('Button Custom Link', 'cynic'),
                    'desc' => __('Button Custom Link', 'cynic'),
                    'id' => $prefix . 'custom_link',
                    'type' => 'text',
                    'std' => '#',
                    'clone' => false,
                ),
                array(
                    'id' => $prefix . 'link_target',
                    'name' => __('Button Link Target', 'cynic'),
                    'type' => 'select',
                    'std' => '',
                    'options' => array(
                        '' => __('Default', 'cynic'),
                        '_blank' => __('Blank', 'cynic'),
                    ),
                ),
                array(
                    'name' => __('Bullet Points Section Title', 'cynic'),
                    'desc' => __('Features Section Title', 'cynic'),
                    'id' => $prefix . 'feature_title',
                    'type' => 'text',
                    'std' => '',
                    'clone' => false,
                ),
                array(
                    'name' => __('Bullet Points', 'cynic'),
                    'desc' => __('Add Feature(Multiple supported)', 'cynic'),
                    'id' => $prefix . 'features',
                    'type' => 'text',
                    'std' => '',
                    'clone' => true,
                ),
            ));

        $meta_boxes[] = array(
            'id' => 'cynic_video_information',
            'title' => __('Video Portfolio', 'cynic'),
            'post_types' => array('portfolio'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Video Link', 'cynic'),
                    'desc' => __('Set Video url', 'cynic'),
                    'id' => $prefix . 'video_link',
                    'type' => 'textarea',
                    'std' => '',
                    'clone' => false,
                ),
            ));


        // Metabox for Case_studies

        $prefix = 'cynic_case_studies_';
        $meta_boxes[] = array(
            'id' => $prefix .'content',
            'title' => __('Case Studies', 'cynic'),
            'post_types' => array('case_studies'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'feature',
                    'class' => 'cynicIconsPickerBlockClone',
                    'name' => 'Case Studied Content',
                    'type' => 'group',
                    'clone' => true,
                    'sort_clone' => true,
                    'collapsible' => true,
                    'group_title' => array('field' => 'counter'), // ID of the subfield
                    'save_state' => true,
                    'fields' => array(
                        array(
                            'name' => 'Title',
                            'id' => $prefix . 'title',
                            'type' => 'text',
                        ),
                        array(
                            'name' => __('Description', 'cynic'),
                            'desc' => __('Insert description', 'cynic'),
                            'id' => $prefix . 'text',
                            'type' => 'textarea',
                        ),
                        array(
                            'id' => $prefix . 'image',
                            'name' => __('Images', 'cynic'),
                            'type' => 'file_advanced',
                            'max_file_uploads' => 1
                        ),
                        array(
                            'id' => $prefix . 'image_position',
                            'name' => __('Select Image Position', 'cynic'),
                            'type' => 'select',
                            'std' => '0',
                            'options' => array(
                                '0' => __('Left', 'cynic'),
                                '1' => __('Right', 'cynic'),
                            ),
                        )
                    ),
                )
            ));

        $prefix = 'cynic_post_';
        $meta_boxes[] = array(
            'id' => 'cynic_post_meta',
            'title' => __('Post Format Data', 'cynic'),
            'post_types' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'gallery',
                    'name' => __('Gallery', 'cynic'),
                    'type' => 'image_advanced',
                ),
                array(
                    'id' => $prefix . 'featured',
                    'name' => __('Is Featured', 'cynic'),
                    'type' => 'radio',
                    'std' => '0',
                    'options' => array(
                        '1' => __('Yes', 'cynic'),
                        '0' => __('No', 'cynic'),
                    ),
                ),
            ));

        //Meta for customer review
        $prefix = 'reviews_';
        $meta_boxes[] = array(
            'id' => 'cynic_reviews',
            'title' => __('Customer Review Information', 'cynic'),
            'post_types' => array('reviews'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Reviewer Organization', 'cynic'),
                    'desc' => __('Name of a reviewer organization', 'cynic'),
                    'id' => $prefix . 'reviewer_org',
                    'type' => 'textarea',
                    'std' => '',
                    'clone' => false,
                )
            ));
        return $meta_boxes;
    }

}
