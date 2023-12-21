<?php

/**
 * @class CynicPostTypes
 * @abstract 
 */
class CynicPostTypes {

    public function __construct() {
        add_action('init', array($this, 'cynic_post_type_init'));
        add_filter('rwmb_meta_boxes', array($this, 'cynic_register_meta_boxes'));
    }

    /**
     * Register all required post types
     *
     */
    public function cynic_post_type_init() {
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
         * @abstract Positions post type
         */
        $labels = array(
            'name' => _x('Positions', 'post type general name', 'cynic'),
            'singular_name' => _x('Position', 'post type singular name', 'cynic'),
            'menu_name' => _x('Positions', 'admin menu', 'cynic'),
            'name_admin_bar' => _x('Positions', 'add new on admin bar', 'cynic'),
            'add_new' => _x('Add New', 'cv', 'cynic'),
            'add_new_item' => __('Add New Position', 'cynic'),
            'new_item' => __('New Position', 'cynic'),
            'edit_item' => __('Edit Position', 'cynic'),
            'view_item' => __('View Positions', 'cynic'),
            'all_items' => __('All Positions', 'cynic'),
            'search_items' => __('Search Career', 'cynic'),
            'parent_item_colon' => __('Parent:', 'cynic'),
            'not_found' => __('No Position found.', 'cynic'),
            'not_found_in_trash' => __('No Position found in Trash.', 'cynic')
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Description.', 'cynic'),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'positions'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
        );

        register_post_type('positions', $args);

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
            'rewrite' => array('slug' => 'positions-cat'),
        );

        register_taxonomy('positions_cat', array('positions'), $args);

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

         /**
         * @abstract FAQ post type
         */
        $labels = array(
            'name' => _x('Faq', 'post type general name', 'cynic'),
            'singular_name' => _x('Faq', 'post type singular name', 'cynic'),
            'menu_name' => _x('Faq', 'admin menu', 'cynic'),
            'name_admin_bar' => _x('Faq', 'add new on admin bar', 'cynic'),
            'add_new' => _x('Add New', 'reviews', 'cynic'),
            'add_new_item' => __('Add New Faq', 'cynic'),
            'new_item' => __('New Faq', 'cynic'),
            'edit_item' => __('Edit Faq', 'cynic'),
            'view_item' => __('View Faqs', 'cynic'),
            'all_items' => __('All Faqs', 'cynic'),
            'search_items' => __('Search Faq', 'cynic'),
            'parent_item_colon' => __('Parent Faq:', 'cynic'),
            'not_found' => __('No Faq found.', 'cynic'),
            'not_found_in_trash' => __('No Faq found in Trash.', 'cynic')
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Description.', 'cynic'),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'faq'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
        );

        register_post_type('faq', $args);

        $labels = array(
            'name' => _x('Faq Categories', 'taxonomy general name', 'cynic'),
            'singular_name' => _x('Faq Category', 'taxonomy singular name', 'cynic'),
            'search_items' => __('Search Faq Categories', 'cynic'),
            'all_items' => __('All Faq Categories', 'cynic'),
            'parent_item' => __('Parent Faq Category', 'cynic'),
            'parent_item_colon' => __('Parent Faq Category:', 'cynic'),
            'edit_item' => __('Edit Faq Category', 'cynic'),
            'update_item' => __('Update Faq Category', 'cynic'),
            'add_new_item' => __('Add New Faq Category', 'cynic'),
            'new_item_name' => __('New Faq Category Name', 'cynic'),
            'menu_name' => __('Faq Category', 'cynic'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'faq-cat'),
        );

        register_taxonomy('faq-cat', array('faq'), $args);
    }

    public function cynic_register_meta_boxes($meta_boxes = array()) {
        $prefix = 'cynic_team_';
        $meta_boxes[] = array(
            'id' => 'personal',
            'title' => __('Personal Information', 'cynic'),
            'post_types' => array('team_members'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Designation', 'cynic'),
                    'desc' => 'Set designation',
                    'id' => $prefix . 'designation',
                    'type' => 'text',
                    'std' => '',
                    'clone' => false,
                ),
                array(
                    'name' => __('Facebook', 'cynic'),
                    'desc' => 'Set facebook link',
                    'id' => $prefix . 'facebook',
                    'type' => 'text',
                    'std' => '#',
                    'clone' => false,
                ),
                array(
                    'name' => __('Twitter', 'cynic'),
                    'desc' => 'Set twitter',
                    'id' => $prefix . 'twitter',
                    'type' => 'text',
                    'std' => '#',
                    'clone' => false,
                ),
                array(
                    'name' => __('Pinterest', 'cynic'),
                    'desc' => 'Set pinterest',
                    'id' => $prefix . 'pinterest',
                    'type' => 'text',
                    'std' => '#',
                    'clone' => false,
                ),
                array(
                    'name' => __('Instagram', 'cynic'),
                    'desc' => 'Set instagram',
                    'id' => $prefix . 'instagram',
                    'type' => 'text',
                    'std' => '#',
                    'clone' => false,
                ),
                array(
                    'name' => __('Linkedin', 'cynic'),
                    'desc' => 'Set linkedin',
                    'id' => $prefix . 'linkedin',
                    'type' => 'text',
                    'std' => '#',
                    'clone' => false,
                ),
            )
        );
        $prefix = 'cynic_page_';
        $meta_boxes[] = array(
            'id' => 'cynic_pages',
            'title' => __('Page Meta', 'cynic'),
            'post_types' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'title',
                    'name' => __('Display Page Title', 'cynic'),
                    'type' => 'radio',
                    'std' => '1',
                    'options' => array(
                        '1' => __('Yes', 'cynic'),
                        '0' => __('No', 'cynic'),
                    ),
                ),
                array(
                    'id' => $prefix . 'specialheading',
                    'name' => __('Display Big Heading Section For The Page', 'cynic'),
                    'type' => 'radio',
                    'std' => '0',
                    'options' => array(
                        '1' => __('Yes', 'cynic'),
                        '0' => __('No', 'cynic'),
                    ),
                ),
                array(
                    'id' => $prefix . 'sidebar',
                    'name' => __('Display Sidebar', 'cynic'),
                    'type' => 'radio',
                    'std' => '0',
                    'options' => array(
                        '1' => __('Yes', 'cynic'),
                        '0' => __('No', 'cynic'),
                    ),
                ),
                array(
                    'id' => $prefix . 'scroll_offset',
                    'name' => __('Set Page Scroll', 'cynic'),
                    'desc' => __('Cynic offset value should be: 480', 'cynic'),
                    'type' => 'text'
                ),
                array(
                    'id' => $prefix . 'headingtext',
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
                    'id' => $prefix . 'button_hover_text',
                    'name' => __('Button Hover Text', 'cynic'),
                    'type' => 'text',
                ),
                array(
                    'id' => $prefix . 'gallery',
                    'name' => __('Gallery', 'cynic'),
                    'type' => 'image_advanced',
                ),
                array(
                    'id' => $prefix . 'before_image',
                    'name' => __('Before Image', 'cynic'),
                    'type' => 'file_advanced',
                    'max_file_uploads' => 1
                ),
                array(
                    'id' => $prefix . 'after_image',
                    'name' => __('After Image', 'cynic'),
                    'type' => 'file_advanced',
                    'max_file_uploads' => 1
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
                array(
                    'name' => __('Button Text', 'cynic'),
                    'desc' => __('Button Text', 'cynic'),
                    'id' => $prefix . 'button_text',
                    'type' => 'text',
                    'std' => 'Launch Website',
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

        $prefix = 'positions_';
        $meta_boxes[] = array(
            'id' => 'cynic_positions',
            'title' => __('Career Information', 'cynic'),
            'post_types' => array('positions'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Number Of Post Title', 'cynic'),
                    'desc' => __('Set number of post title', 'cynic'),
                    'id' => $prefix . 'number_of_post_title',
                    'type' => 'text',
                    'std' => 'Number Of Positions',
                    'clone' => false,
                ),
                array(
                    'name' => __('Category Title', 'cynic'),
                    'desc' => __('Set category title', 'cynic'),
                    'id' => $prefix . 'category_title',
                    'type' => 'text',
                    'std' => 'Department',
                    'clone' => false,
                ),
                array(
                    'name' => __('Number Of Post', 'cynic'),
                    'desc' => __('Set number of post', 'cynic'),
                    'id' => $prefix . 'number_of_post',
                    'type' => 'text',
                    'std' => '',
                    'clone' => false,
                ),
                array(
                    'name' => __('Responsibility Title', 'cynic'),
                    'desc' => __('Set Responsibility title', 'cynic'),
                    'id' => $prefix . 'subtitle_text',
                    'type' => 'text',
                    'std' => '',
                    'clone' => false,
                ),
                array(
                    'name' => __('Add Responsibilities', 'cynic'),
                    'desc' => __('Add Responsibilities(Multiple supported)', 'cynic'),
                    'id' => $prefix . 'features',
                    'type' => 'textarea',
                    'std' => '',
                    'clone' => true,
                ),
                array(
                    'name' => __('More information', 'cynic'),
                    'desc' => __('Set more information', 'cynic'),
                    'id' => $prefix . 'more_info',
                    'type' => 'textarea',
                    'std' => '',
                    'clone' => false,
                ),
        ));

        $prefix = 'cynic_case_studies_challenges_';
        $meta_boxes[] = array(
            'id' => 'cynic_case_studies_challenges',
            'title' => __('Case Study Challenges', 'cynic'),
            'post_types' => array('case_studies'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Title', 'cynic'),
                    'desc' => __('Insert text for challenges', 'cynic'),
                    'id' => $prefix . 'title',
                    'type' => 'textfield',
                ),
                array(
                    'id' => $prefix . 'image',
                    'name' => __('Images', 'cynic'),
                    'type' => 'file_advanced',
                    'max_file_uploads' => 1
                ),
                array(
                    'name' => __('Description', 'cynic'),
                    'desc' => __('Insert description for challenges', 'cynic'),
                    'id' => $prefix . 'text',
                    'type' => 'textarea',
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
                ),
        ));
        $prefix = 'cynic_case_studies_solution_';
        $meta_boxes[] = array(
            'id' => 'cynic_case_studies_solution',
            'title' => __('Case Study Solution', 'cynic'),
            'post_types' => array('case_studies'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Title', 'cynic'),
                    'desc' => __('Insert title for solution', 'cynic'),
                    'id' => $prefix . 'title',
                    'type' => 'textfield',
                ),
                array(
                    'id' => $prefix . 'image',
                    'name' => __('Images', 'cynic'),
                    'type' => 'file_advanced',
                    'max_file_uploads' => 1
                ),
                array(
                    'name' => __('Description', 'cynic'),
                    'desc' => __('Insert description for challenges', 'cynic'),
                    'id' => $prefix . 'text',
                    'type' => 'textarea',
                ),
                array(
                    'id' => $prefix . 'image_position',
                    'name' => __('Select Image Position', 'cynic'),
                    'type' => 'select',
                    'std' => '1',
                    'options' => array(
                        '1' => __('Right', 'cynic'),
                        '0' => __('Left', 'cynic'),
                    ),
                ),
        ));
        
        $prefix = 'cynic_case_studies_scoreboard_';
        $meta_boxes[] = array(
            'id' => 'cynic_case_studies_scoreboard',
            'title' => __('Case Study Scores', 'cynic'),
            'post_types' => array('case_studies'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Title', 'cynic'),
                    'desc' => __('Insert title for solutions', 'cynic'),
                    'id' => $prefix . 'title',
                    'type' => 'textfield',
                ),
                array(
                    'name' => __('Scores', 'cynic'),
                    'desc' => __('Add Scores(Multiple supported)', 'cynic'),
                    'id' => $prefix . 'scores',
                    'type' => 'textfield',
                    'std' => '',
                    'clone' => true,
                ),
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
                    'name' => __('Reviewer Name', 'cynic'),
                    'desc' => __('Name of a reviewer', 'cynic'),
                    'id' => $prefix . 'reviewer_name',
                    'type' => 'text',
                    'std' => '',
                    'clone' => false,
                ),
                array(
                    'name' => __('Reviewer Organization', 'cynic'),
                    'desc' => __('Name of a reviewer organization', 'cynic'),
                    'id' => $prefix . 'reviewer_org',
                    'type' => 'text',
                    'std' => '',
                    'clone' => false,
                ),
                array(
                    'name' => __('Customer Review Values', 'cynic'),
                    'desc' => __('Set values in percertage', 'cynic'),
                    'id' => $prefix . 'review_values',
                    'type' => 'select',
                    'std' => '20',
                    'options' => array(
                        '20' => __('1', 'cynic'),
                        '40' => __('2', 'cynic'),
                        '60' => __('3', 'cynic'),
                        '80' => __('4', 'cynic'),
                        '100' => __('5', 'cynic'),
                    ),
                    'clone' => false,
                )
        ));
        return $meta_boxes;
    }

}
