<?php

/**
 * @class CynicSEOPostTypes
 * @abstract
 */
class CynicSEOPostTypes
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
            'name' => _x('Our Work', 'post type general name', 'cynic'),
            'singular_name' => _x('Our Work', 'post type singular name', 'cynic'),
            'menu_name' => _x('Our Work', 'admin menu', 'cynic'),
            'name_admin_bar' => _x('Our Work', 'add new on admin bar', 'cynic'),
            'add_new' => _x('Add New', 'Our Work', 'cynic'),
            'add_new_item' => __('Add New', 'cynic'),
            'new_item' => __('New Work', 'cynic'),
            'edit_item' => __('Edit Work', 'cynic'),
            'view_item' => __('View Work', 'cynic'),
            'all_items' => __('All Works', 'cynic'),
            'search_items' => __('Search Works', 'cynic'),
            'parent_item_colon' => __('Parent Work:', 'cynic'),
            'not_found' => __('No Work found.', 'cynic'),
            'not_found_in_trash' => __('No Work found in Trash.', 'cynic')
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
            'name' => _x('Our Work Categories', 'taxonomy general name', 'cynic'),
            'singular_name' => _x('Our Work Category', 'taxonomy singular name', 'cynic'),
            'search_items' => __('Search Our Work Categories', 'cynic'),
            'all_items' => __('All Our Work Categories', 'cynic'),
            'parent_item' => __('Parent Work Category', 'cynic'),
            'parent_item_colon' => __('Parent Work Category:', 'cynic'),
            'edit_item' => __('Edit Work Category', 'cynic'),
            'update_item' => __('Update Work Category', 'cynic'),
            'add_new_item' => __('Add New Work Category', 'cynic'),
            'new_item_name' => __('New Work Category Name', 'cynic'),
            'menu_name' => __('Our Work Category', 'cynic'),
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

        /**
         * @abstract FAQ post type
         */
        $labels = array(
            'name' => _x('FAQs', 'post type general name', 'cynic'),
            'singular_name' => _x('FAQs', 'post type singular name', 'cynic'),
            'menu_name' => _x('FAQs', 'admin menu', 'cynic'),
            'name_admin_bar' => _x('FAQs', 'add new on admin bar', 'cynic'),
            'add_new' => _x('Add New', 'reviews', 'cynic'),
            'add_new_item' => __('Add New FAQs', 'cynic'),
            'new_item' => __('New FAQs', 'cynic'),
            'edit_item' => __('Edit FAQs', 'cynic'),
            'view_item' => __('View FAQs', 'cynic'),
            'all_items' => __('All FAQs', 'cynic'),
            'search_items' => __('Search FAQs', 'cynic'),
            'parent_item_colon' => __('Parent FAQs:', 'cynic'),
            'not_found' => __('No Faq found.', 'cynic'),
            'not_found_in_trash' => __('No FAQs found in Trash.', 'cynic')
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
            'name' => _x('FAQs Categories', 'taxonomy general name', 'cynic'),
            'singular_name' => _x('FAQs Category', 'taxonomy singular name', 'cynic'),
            'search_items' => __('Search FAQs Categories', 'cynic'),
            'all_items' => __('All FAQs Categories', 'cynic'),
            'parent_item' => __('Parent FAQs Category', 'cynic'),
            'parent_item_colon' => __('Parent FAQs Category:', 'cynic'),
            'edit_item' => __('Edit FAQs Category', 'cynic'),
            'update_item' => __('Update FAQs Category', 'cynic'),
            'add_new_item' => __('Add New FAQs Category', 'cynic'),
            'new_item_name' => __('New FAQs Category Name', 'cynic'),
            'menu_name' => __('FAQs Category', 'cynic'),
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


        /**
         * @abstract Careers post type
         */
        $labels = array(
            'name' => _x('Job Posts', 'post type general name', 'cynic'),
            'singular_name' => _x('Job Post', 'post type singular name', 'cynic'),
            'menu_name' => _x('Job Posts', 'admin menu', 'cynic'),
            'name_admin_bar' => _x('Job Posts', 'add new on admin bar', 'cynic'),
            'add_new' => _x('Add New', 'cv', 'cynic'),
            'add_new_item' => __('Add New Job Post', 'cynic'),
            'new_item' => __('New Job Post', 'cynic'),
            'edit_item' => __('Edit Job Post', 'cynic'),
            'view_item' => __('View Job Posts', 'cynic'),
            'all_items' => __('All Job Posts', 'cynic'),
            'search_items' => __('Search Career', 'cynic'),
            'parent_item_colon' => __('Parent:', 'cynic'),
            'not_found' => __('No Job Post found.', 'cynic'),
            'not_found_in_trash' => __('No Job Post found in Trash.', 'cynic')
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

    }

    public function cynicSEO_register_meta_boxes($meta_boxes = array())
    {
        $prefix = 'cynic_case_studies_counter_';
        $meta_boxes[] = array(
            'id' => $prefix . 'blocks',
            'title' => __('Case Studies Count Block', 'cynic'),
            'post_types' => array('case_studies'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'counter',
                    'name' => 'Case Study Counter',
                    'type' => 'group',
                    'clone' => true,
                    'sort_clone' => true,
                    'collapsible' => true,
                    'group_title' => array('field' => 'counter'), // ID of the subfield
                    'save_state' => true,

                    'fields' => array(
                        array(
                            'name' => 'Counter Value',
                            'id' => $prefix . 'value',
                            'type' => 'text',
                        ),

                        array(
                            'name' => 'Icon Type',
                            'id' => 'icon_type',
                            'type' => 'select',
                            'attributes' => array(
                                'class' => $prefix . 'icon_type',
                            ),
                            'options' => array(
                                'font_icons' => 'Font Icons',
                                'image_icon' => 'Image Icons'
                            )
                        ),

                        array(
                            'name' => 'Counter Icon',
                            'id' => $prefix . 'icon',
                            'type' => 'text',
                            'attributes' => array(
                                'class' => $prefix . 'font_icons cynicIconsPicker',
                            ),
                        ),

                        array(
                            'id' => $prefix . 'image_icon',
                            'name' => __('Image Icon', 'cynic'),
                            'attributes' => array(
                                'class' => $prefix . 'image_icon',
                            ),
                            'type' => 'file_advanced',
                            'max_file_uploads' => 1,
                        ),

                        array(
                            'name' => 'Counter Title',
                            'id' => $prefix . 'title',
                            'type' => 'text',
                        )
                    ),
                ),
            ),
        );

        $prefix = 'cynic_case_studies_';

        $meta_boxes[] = array(
            'id' => $prefix . 'blocks',
            'title' => __('Case Studies Block', 'cynic'),
            'post_types' => array('case_studies'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'tab_logo',
                    'name' => __('Tab Logo', 'cynic'),
                    'type' => 'file_advanced',
                    'max_file_uploads' => 1
                ),
                array(
                    'name' => 'Overview Title',
                    'id' => $prefix . 'overview_title',
                    'type' => 'text',
                ),
                array(
                    'id' => $prefix . 'information',
                    'name' => 'Case Study Information',
                    'type' => 'group',
                    'clone' => true,
                    'sort_clone' => true,
                    'collapsible' => true,
                    'group_title' => array('field' => 'name'), // ID of the subfield
                    'save_state' => true,

                    'fields' => array(
                        array(
                            'name' => 'Title',
                            'id' => $prefix . 'title',
                            'type' => 'text',
                        ),
                        array(
                            'name' => 'Description',
                            'id' => $prefix . 'description',
                            'type' => 'textarea',
                        ),
                        array(
                            'id' => $prefix . 'image',
                            'name' => __('Image', 'cynic'),
                            'type' => 'file_advanced',
                            'max_file_uploads' => 1
                        ),
                        array(
                            'id' => $prefix . 'link_target',
                            'name' => __('Image Position', 'cynic'),
                            'type' => 'select',
                            'std' => 'left',
                            'options' => array(
                                'left' => __('Left', 'cynic'),
                                'right' => __('Right', 'cynic'),
                            ),
                        ),
                        array(
                            'id' => $prefix . 'bullet_point_blocks',
                            'type' => 'group',
                            'clone' => true,
                            'collapsible' => true,
                            'save_state' => true,
                            'group_title' => array('field' => 'bullet_points'),
                            'fields' => array(
                                array(
                                    'id' => $prefix . 'bullet_points',
                                    'type' => 'text',
                                    'name' => 'Bullet Points',
                                )
                            ),
                        ),
                    ),
                ),
            ),
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
                        '2' => __('Title With Banner', 'cynic'),
                        '1' => __('Only Title', 'cynic'),
                        '0' => __('Empty Title', 'cynic'),
                    ),
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

        $prefix = 'cynic_post_image_';

        $meta_boxes[] = array(
            'id' => 'cynic_post_image',
            'title' => __('Image Position', 'cynic'),
            'post_types' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'position',
                    'name' => __('Image Position', 'cynic'),
                    'type' => 'radio',
                    'std' => '1',
                    'options' => array(
                        '1' => __('Top', 'cynic'),
                        '2' => __('Bottom', 'cynic'),
                    ),
                ),
                array(
                    'id' => $prefix . 'video_length',
                    'name' => __('Video Length', 'cynic'),
                    'type' => 'textfield',
                )
            ));

        // Service information block for portfolio
        $prefix = 'cynic_portfolio_';
        $meta_boxes[] = array(
            'id' => $prefix . 'banner',
            'title' => __('Top Slider Block', 'cynic'),
            'post_types' => array('portfolio'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(

                array(
                    'id' => $prefix . 'type_image',
                    'name' => __('Images', 'cynic'),
                    'desc' => __('Upload a logo for service block', 'cynic'),
                    'type' => 'file_advanced'
                ),
            ));

        $meta_boxes[] = array(
            'id' => $prefix . 'video',
            'title' => __('Top Video Block', 'cynic'),
            'post_types' => array('portfolio'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(

                array(
                    'desc' => __('Please add video url from youtube/vimeo', 'cynic'),
                    'id' => $prefix . 'type_video',
                    'name' => __('Portfolio Video', 'cynic'),
                    'type' => 'url',
                    'attributes' => array(
                        'style' => 'width:90%',
                    ),
                ),
            ));

        // Service information block for portfolio
        $meta_boxes[] = array(
            'id' => $prefix . 'service_information',
            'title' => __('Service information', 'cynic'),
            'post_types' => array('portfolio'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(

                array(
                    'name' => __('Service Logo', 'cynic'),
                    'desc' => __('Upload a logo for service block', 'cynic'),
                    'id' => $prefix . 'service_image',
                    'name' => __('Service Logo', 'cynic'),
                    'type' => 'file_advanced',
                    'max_file_uploads' => 1
                ),
                array(
                    'name' => __('Service title', 'cynic'),
                    'desc' => __('Title for service block', 'cynic'),
                    'id' => $prefix . 'service_title',
                    'type' => 'textfield',
                    'std' => '',
                    'clone' => false,
                ),
                array(
                    'name' => __('Service Button Text', 'cynic'),
                    'desc' => __('Button text for service block', 'cynic'),
                    'id' => $prefix . 'button_text',
                    'type' => 'textfield',
                    'std' => '',
                    'clone' => false,
                ),
                array(
                    'id' => $prefix . 'button_link',
                    'name' => __('Button Link', 'cynic'),
                    'type' => 'textfield',
                    'std' => '',
                    'desc' => __('Link should be (www.yoursiteurl.com)', 'cynic'),
                ),
                array(
                    'id' => $prefix . 'button_open_type',
                    'name' => __('Open link (Same/New) window', 'cynic'),
                    'type' => 'radio',
                    'std' => '1',
                    'options' => array(
                        '1' => __('Same Window', 'cynic'),
                        '2' => __('New Window', 'cynic'),
                    ),
                ),
                array(
                    'name' => __('Service Bullet Points', 'cynic'),
                    'desc' => __('Add Bullet Points(Multiple supported)', 'cynic'),
                    'id' => $prefix . 'service_bullet_points',
                    'type' => 'textarea',
                    'std' => '',
                    'clone' => true,
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
                    'name' => __('Reviewer Designation', 'cynic'),
                    'desc' => __('Name of a reviewer', 'cynic'),
                    'id' => $prefix . 'designation',
                    'type' => 'text',
                    'std' => '',
                    'clone' => false,
                ),
                array(
                    'name' => __('Customer Review Values', 'cynic'),
                    'desc' => __('Set values in percertage', 'cynic'),
                    'id' => $prefix . 'review_values',
                    'type' => 'select',
                    'std' => 'stars-100',
                    'options' => array(
                        'stars-20' => __('1', 'cynic'),
                        'stars-30' => __('1.5', 'cynic'),
                        'stars-40' => __('2', 'cynic'),
                        'stars-50' => __('2.5', 'cynic'),
                        'stars-60' => __('3', 'cynic'),
                        'stars-70' => __('3.5', 'cynic'),
                        'stars-80' => __('4', 'cynic'),
                        'stars-90' => __('4.5', 'cynic'),
                        'stars-100' => __('5', 'cynic'),
                    ),
                    'clone' => false,
                )
            ));


        $prefix = 'positions_';

        $meta_boxes[] = array(
            'id' => 'cynic_position_job_title',
            'title' => __('Position Labels', 'cynic'),
            'post_types' => array('positions'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Title', 'cynic'),
                    'id' => $prefix . 'job_field_title',
                    'type' => 'text',
                    'clone' => false,
                    'placeholder' => 'Position',
                    'desc' => __('Set Position Label text', 'cynic'),
                ),

                array(
                    'name' => __('Details Title', 'cynic'),
                    'id' => $prefix . 'job_description_field_title',
                    'type' => 'text',
                    'clone' => false,
                    'placeholder' => 'Job details',
                    'desc' => __('Set Position Details Label text', 'cynic'),
                ),
            ));

        $meta_boxes[] = array(
            'id' => 'cynic_position_number',
            'title' => __('Position Vacancy', 'cynic'),
            'post_types' => array('positions'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Title', 'cynic'),
                    'id' => $prefix . 'number_of_post_title',
                    'type' => 'text',
                    'clone' => false,
                    'placeholder' => 'Number Of Positions'
                ),
                array(
                    'name' => __('Total Vacancy', 'cynic'),
                    'id' => $prefix . 'number_of_post',
                    'type' => 'text',
                    'placeholder' => '0',
                    'clone' => false,
                ),
            ));

        $meta_boxes[] = array(
            'id' => 'cynic_positions_department',
            'title' => __('Department', 'cynic'),
            'post_types' => array('positions'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Title', 'cynic'),
                    'id' => $prefix . 'category_title',
                    'type' => 'text',
                    'placeholder' => 'Department',
                    'desc' => __('Leave empty if you don\'t want to show.', 'cynic'),
                    'clone' => false,
                ),
            ));

        $meta_boxes[] = array(
            'id' => 'cynic_positions_qualifications',
            'title' => __('Qualifications', 'cynic'),
            'post_types' => array('positions'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Title', 'cynic'),
                    'id' => $prefix . 'subtitle_text',
                    'type' => 'text',
                    'std' => '',
                    'clone' => false,
                    'placeholder' => 'Key of qualifications'
                ),
                array(
                    'name' => __('Qualifications Bullet Points', 'cynic'),
                    'desc' => __('Add Qualifications(Multiple supported)', 'cynic'),
                    'id' => $prefix . 'features',
                    'type' => 'textarea',
                    'clone' => true,
                ),
            ));

        $meta_boxes[] = array(
            'id' => 'cynic_positions_skills',
            'title' => __('Skills', 'cynic'),
            'post_types' => array('positions'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Title', 'cynic'),
                    'id' => $prefix . 'skill_sub_title_text',
                    'type' => 'text',
                    'std' => '',
                    'placeholder' => 'Technical skills',
                    'clone' => false,
                ),
                array(
                    'name' => __('Skills Bullet Points', 'cynic'),
                    'desc' => __('Add Skills(Multiple supported)', 'cynic'),
                    'id' => $prefix . 'skills',
                    'type' => 'textarea',
                    'std' => '',
                    'clone' => true,
                ),
            ));

        $meta_boxes[] = array(
            'id' => 'cynic_positions_job_locations',
            'title' => __('Job Locations', 'cynic'),
            'post_types' => array('positions'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Title', 'cynic'),
                    'id' => $prefix . 'job_location_sub_title_text',
                    'type' => 'text',
                    'std' => '',
                    'placeholder' => 'Job Locations',
                    'clone' => false,
                ),

                array(
                    'name' => __('locations', 'cynic'),
                    'id' => $prefix . 'job_location_text',
                    'type' => 'text',
                    'std' => '',
                    'placeholder' => '',
                    'clone' => false,
                ),
                array(
                    'name' => __('More information', 'cynic'),
                    'desc' => __('HTML is supported', 'cynic'),
                    'id' => $prefix . 'more_info',
                    'type' => 'textarea',
                    'std' => '',
                    'clone' => false,
                ),
            ));

        return $meta_boxes;
    }

}
