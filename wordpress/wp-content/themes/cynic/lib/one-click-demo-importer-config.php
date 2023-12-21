<?php

/* Author: axilweb
 * To Add the customization,configure one click demo importer.
 * To change this template file, choose Tools | Templates
 */
function cynic_import_files()
{
    return array(
        array(
            'categories' => array('Digital Agency'),
            'import_file_name' => 'Cynic - Modern Onepage',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-one-page-demo-content/cynic-content.xml',
            'import_widget_file_url' => '',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-one-page-demo-content/cynic-customizer.txt',
            'import_redux' => array(
                array(
                    'file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-one-page-demo-content/cynic-options.json',
                    'option_name' => 'cynic_options',
                ),
            ),
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-one-page-demo-content/demo-modern-one-page-agency.jpg',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/modern-one-page-agency/',
        ),
        array(
            'categories' => array('Digital Agency'),
            'import_file_name' => 'Cynic - Modern Big Agency',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-big-agency-demo-content/cynic-content.xml',
            'import_widget_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-big-agency-demo-content/cynic-widgets.json',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-big-agency-demo-content/cynic-customizer.txt',
            'import_redux' => array(
                array(
                    'file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-big-agency-demo-content/cynic-options.json',
                    'option_name' => 'cynic_options',
                ),
            ),
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-big-agency-demo-content/demo-modern-big-digital-agency.jpg',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/modern-big-digital-agency',
        ),
        array(
            'categories' => array('Digital Agency'),
            'import_file_name' => 'Cynic - Modern Small Agency',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-small-agency-demo-content/cynic-content.xml',
            'import_widget_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-small-agency-demo-content/cynic-widgets.json',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-small-agency-demo-content/cynic-customizer.txt',
            'import_redux' => array(
                array(
                    'file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-small-agency-demo-content/cynic-options.json',
                    'option_name' => 'cynic_options',
                ),
            ),
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-small-agency-demo-content/demo-modern-small-digital-agency.jpg',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/modern-small-digital-agency',
        ),
        array(
            'categories' => array('Digital Agency'),
            'import_file_name' => 'Cynic - Classic Onepage',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-one-page-demo-content/cynic-content.xml',
            'import_widget_file_url' => '',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-one-page-demo-content/cynic-customizer.txt',
            'import_redux' => array(
                array(
                    'file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-one-page-demo-content/cynic-options.json',
                    'option_name' => 'cynic_options',
                ),
            ),
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-one-page-demo-content/demo-classic-one-page-agency.jpg',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/classic-one-page-agency/',
        ),
        array(
            'categories' => array('Digital Agency'),
            'import_file_name' => 'Cynic - Classic Big Agency',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-big-agency-demo-content/cynic-content.xml',
            'import_widget_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-big-agency-demo-content/cynic-widgets.json',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-big-agency-demo-content/cynic-customizer.txt',
            'import_redux' => array(
                array(
                    'file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-big-agency-demo-content/cynic-options.json',
                    'option_name' => 'cynic_options',
                ),
            ),
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-big-agency-demo-content/demo-classic-big-digital-agency.jpg',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/classic-big-digital-agency',
        ),
        array(
            'categories' => array('Digital Agency'),
            'import_file_name' => 'Cynic - Classic Small Agency',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-small-agency-demo-content/cynic-content.xml',
            'import_widget_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-small-agency-demo-content/cynic-widgets.json',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-small-agency-demo-content/cynic-customizer.txt',
            'import_redux' => array(
                array(
                    'file_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-small-agency-demo-content/cynic-options.json',
                    'option_name' => 'cynic_options',
                ),
            ),
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/classic-small-agency-demo-content/demo-classic-small-digital-agency.jpg',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/classic-small-digital-agency',
        ),
        array(
            'categories' => array('SEO Agency'),
            'import_file_name' => 'Cynic - Modern SEO Agency',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-seo-agency-demo-content/cynic-content.xml',
            'import_widget_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-seo-agency-demo-content/cynic-widgets.json',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-seo-agency-demo-content/cynic-customizer.txt',
            'import_redux' => array(
                array(
                    'file_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-seo-agency-demo-content/cynic-options.json',
                    'option_name' => 'cynic_options',
                ),
            ),
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/modern-seo-agency-demo-content/demo-modern-seo-agency.jpg',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/modern-seo-agency/',
        ),
        array(
            'categories' => array('Trendy Agency'),
            'import_file_name' => 'Cynic - Trendy One Page Agency',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/trendy-one-page-agency-demo-content/cynic-content.xml',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/trendy-one-page-agency-demo-content/cynic-customizer.txt',
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/trendy-one-page-agency-demo-content/trendy-one-page-agency.png',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/trendy-one-page-agency/',
        ),
        array(
            'categories' => array('Trendy Agency'),
            'import_file_name' => 'Cynic - Trendy Small Digital Agency',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/trendy-small-digital-agency-demo-content/cynic-content.xml',
            'import_widget_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/trendy-small-digital-agency-demo-content/cynic-widgets.json',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/trendy-small-digital-agency-demo-content/cynic-customizer.txt',
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/trendy-small-digital-agency-demo-content/trendy-small-digital-agency.png',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/trendy-small-digital-agency/',
        ),
        array(
            'categories' => array('Illustration'),
            'import_file_name' => 'Cynic - Illustration One Page Agency',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/illustrated-one-page-agency-demo-content/cynic-content.xml',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/illustrated-one-page-agency-demo-content/cynic-customizer.txt',
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/illustrated-one-page-agency-demo-content/illustrated-one-page-agency.png',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/illustrated-one-page-agency/',
        ),
        array(
            'categories' => array('Illustration'),
            'import_file_name' => 'Cynic - Illustration Small Digital Agency',
            'import_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/illustrated-small-digital-agency-demo-content/cynic-content.xml',
            'import_widget_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/illustrated-small-digital-agency-demo-content/cynic-widgets.json',
            'import_customizer_file_url' => trailingslashit(get_template_directory_uri()) . 'lib/illustrated-small-digital-agency-demo-content/cynic-customizer.txt',
            'import_preview_image_url' => trailingslashit(get_template_directory_uri()) . 'lib/illustrated-small-digital-agency-demo-content/illustrated-small-digital-agency.png',
            'import_notice' => __('Importing may take 5-10 minutes.', 'cynic'),
            'preview_url' => 'http://axilthemes.com/themes/cynic/illustrated-small-digital-agency',
        )
    );
}

add_filter('pt-ocdi/import_files', 'cynic_import_files');

function ocdi_before_widgets_import($selected_import)
{
    // Remove 'Hello World!' post
    wp_delete_post(1, true);
    // Remove 'Sample page' page
    wp_delete_post(2, true);

    //Remove Initial Widgets
    if ('Cynic - Modern SEO Agency' === $selected_import['import_file_name']) {
        $sidebars_widgets = get_option('sidebars_widgets');
        $sidebars_widgets['blog-sidebar'] = array();
        update_option('sidebars_widgets', $sidebars_widgets);


        $sidebars_widgets = get_option('sidebars_widgets');
        $sidebars_widgets['blog-sidebar'] = array();
        update_option('sidebars_widgets', $sidebars_widgets);
    }

}

add_action('pt-ocdi/before_widgets_import', 'ocdi_before_widgets_import');


function ocdi_before_content_import($selected_import)
{
    wp_delete_post(3, true);
}

add_action('pt-ocdi/before_content_import', 'ocdi_before_content_import');

/*
 * Automatically assign
 * "Front page",
 * "Posts page" and menu
 * locations after the importer is done
 */

function cynic_after_import($selected_import)
{
    if ('Cynic - Modern Big Agency' === $selected_import['import_file_name']) {

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Front Page');

        $blog_page_id = get_page_by_title('Blog');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);
        //Adding Revolution Slider to the page

        if (class_exists('RevSlider')) {
            get_template_part(ABSPATH . 'wp-admin/includes/file.php');
            $slider_array = array(
                ABSPATH . "/wp-content/plugins/cynic-features/importer/demo/classic-modern-agency/modern_big_rev_slider.zip",
            );
            $slider = new RevSlider();

            foreach ($slider_array as $filepath) {
                $slider->importSliderFromPost(true, true, $filepath);
            }
        }

        $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        ));
        update_option('cynic_theme_type', 'classic-modern-agency');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    } elseif ('Cynic - Modern Small Agency' === $selected_import['import_file_name']) {

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Front Page');

        $blog_page_id = get_page_by_title('Blog');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);
        //Adding Revolution Slider to the page

        if (class_exists('RevSlider')) {
            get_template_part(ABSPATH . 'wp-admin/includes/file.php');
            $slider_array = array(
                ABSPATH . "/wp-content/plugins/cynic-features/importer/demo/classic-modern-agency/modern_big_rev_slider.zip",
            );
            $slider = new RevSlider();

            foreach ($slider_array as $filepath) {
                $slider->importSliderFromPost(true, true, $filepath);
            }
        }

        $dms_menu = get_term_by('name', 'DMS Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $dms_menu->term_id,
        ));
        update_option('cynic_theme_type', 'classic-modern-agency');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    } elseif ('Cynic - Modern Onepage' === $selected_import['import_file_name']) {

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Homepage');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        //Adding Revolution Slider to the page

        if (class_exists('RevSlider')) {
            get_template_part(ABSPATH . 'wp-admin/includes/file.php');
            $slider_array = array(
                ABSPATH . "/wp-content/plugins/cynic-features/importer/demo/classic-modern-agency/rev_slider.zip",
            );
            $slider = new RevSlider();

            foreach ($slider_array as $filepath) {
                $slider->importSliderFromPost(true, true, $filepath);
            }
        }
        $onepage_main_menu = get_term_by('name', 'Onepage Menu', 'nav_menu');
        $onepage_service_menu = get_term_by('name', 'One Page Service Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $onepage_main_menu->term_id,
            'secondary' => $onepage_service_menu->term_id,
        ));

        update_option('cynic_theme_type', 'classic-modern-agency');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    } elseif ('Cynic - Classic Big Agency' === $selected_import['import_file_name']) {

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Front Page');

        $blog_page_id = get_page_by_title('Blog');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);
        //Adding Revolution Slider to the page

        if (class_exists('RevSlider')) {
            get_template_part(ABSPATH . 'wp-admin/includes/file.php');
            $slider_array = array(
                ABSPATH . "/wp-content/plugins/cynic-features/importer/demo/classic-modern-agency/clasic_big_rev_slider.zip",
            );
            $slider = new RevSlider();

            foreach ($slider_array as $filepath) {
                $slider->importSliderFromPost(true, true, $filepath);
            }
        }
        $main_menu = get_term_by('name', 'Classic Big Main Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $main_menu->term_id
        ));
        update_option('cynic_theme_type', 'classic-modern-agency');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    } elseif ('Cynic - Classic Small Agency' === $selected_import['import_file_name']) {

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Front Page');

        $blog_page_id = get_page_by_title('Blog');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);
        //Adding Revolution Slider to the page

        if (class_exists('RevSlider')) {
            get_template_part(ABSPATH . 'wp-admin/includes/file.php');
            $slider_array = array(
                ABSPATH . "/wp-content/plugins/cynic-features/importer/demo/classic-modern-agency/clasic_big_rev_slider.zip",
            );
            $slider = new RevSlider();

            foreach ($slider_array as $filepath) {
                $slider->importSliderFromPost(true, true, $filepath);
            }
        }
        $main_menu = get_term_by('name', 'Classic Small Main Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $main_menu->term_id
        ));
        update_option('cynic_theme_type', 'classic-modern-agency');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    } elseif ('Cynic - Classic Onepage' === $selected_import['import_file_name']) {

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Homepage');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        //Adding Revolution Slider to the page

        if (class_exists('RevSlider')) {
            get_template_part(ABSPATH . 'wp-admin/includes/file.php');
            $slider_array = array(
                ABSPATH . "/wp-content/plugins/cynic-features/importer/demo/classic-modern-agency/classic_one_page_rev_slider.zip",
            );
            $slider = new RevSlider();

            foreach ($slider_array as $filepath) {
                $slider->importSliderFromPost(true, true, $filepath);
            }
        }
        $onepage_main_menu = get_term_by('name', 'Onepage Menu', 'nav_menu');
        $onepage_service_menu = get_term_by('name', 'One Page Service Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $onepage_main_menu->term_id,
            'secondary' => $onepage_service_menu->term_id,
        ));
        update_option('cynic_theme_type', 'classic-modern-agency');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);

    } elseif ('Cynic - Modern SEO Agency' === $selected_import['import_file_name']) {

        // Assign page as homepage and blog
        $front_page_id = get_page_by_title('Home');
        $blog_page_id = get_page_by_title('Blog');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);

        if (class_exists('RevSlider')) {
            get_template_part(ABSPATH . 'wp-admin/includes/file.php');
            $slider_array = array(
                wp_normalize_path(WP_PLUGIN_DIR . "/cynic-features/importer/demo/seo-agency/banner-carousel.zip"),
            );
            $slider = new RevSlider();

            foreach ($slider_array as $filepath) {
                $slider->importSliderFromPost(true, true, $filepath);
            }
        }

        /************************************************************************
         * Settings Menu
         ************************************************************************/

        $primary_menu = get_term_by('name', 'Main Menu', 'nav_menu');
        $footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
                'primary' => $primary_menu->term_id,
                'footer_menu' => $footer_menu->term_id
            )
        );

        /************************************************************************
         * Reorder sidebar widgets
         ************************************************************************/

        $sidebars_widgets = get_option('sidebars_widgets');
        $sidebars_widgets['blog-sidebar'][1] = "cynic_recent_post_widget-1";
        update_option('sidebars_widgets', $sidebars_widgets);

        update_option('cynic_theme_type', 'seo-agency');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    } elseif ('Cynic - Trendy One Page Agency' === $selected_import['import_file_name']) {

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Trendy Homepage');

        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);

        $trendy_one_page_menu = get_term_by('name', 'One Page Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $trendy_one_page_menu->term_id,
        ));

        update_option('cynic_theme_type', 'trendy-agency');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    } elseif ('Cynic - Trendy Small Digital Agency' === $selected_import['import_file_name']) {

        // Assign page as homepage and blog
        $front_page_id = get_page_by_title('Small Homepage');
        $blog_page_id = get_page_by_title('Blog Version 1');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);


        $trendy_small_page_menu = get_term_by('name', 'Small Agency Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $trendy_small_page_menu->term_id,
        ));

        update_option('cynic_theme_type', 'trendy-agency');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    } elseif ('Cynic - Illustration One Page Agency' === $selected_import['import_file_name']) {

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Illustrated Home');

        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);

        $trendy_one_page_menu = get_term_by('name', 'Illustrated One Page Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $trendy_one_page_menu->term_id,
        ));
        update_option('cynic_theme_type', 'illustration');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    } elseif ('Cynic - Illustration Small Digital Agency' === $selected_import['import_file_name']) {

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Illustrated Home');

        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);

        $trendy_one_page_menu = get_term_by('name', 'Illustrated Small Digital Agency Menu', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary' => $trendy_one_page_menu->term_id,
        ));
        update_option('cynic_theme_type', 'illustration');
        update_option('cynic_theme_demo_import', 'demo_imported');
        update_option('cynic_theme_active_demo', $selected_import['import_file_name']);
    }


}

add_action('pt-ocdi/after_import', 'cynic_after_import');

function cynic_change_time_of_single_ajax_call()
{
    return 20;
}

add_action('pt-ocdi/time_for_one_ajax_call', 'cynic_change_time_of_single_ajax_call');

add_filter('pt-ocdi/disable_pt_branding', '__return_true');

// To make demo imported items selected
add_action('admin_footer', 'cynic_pt_ocdi_add_scripts');

function cynic_pt_ocdi_add_scripts()
{
    $demo_imported = get_option('cynic_theme_active_demo');
    if (!empty($demo_imported)) {
        ?>
        <script>
            jQuery(document).ready(function ($) {
                $('.ocdi__gl-item.js-ocdi-gl-item').each(function () {
                    var ocdi_theme_title = $(this).data('name');
                    var current_ocdi_theme_title = '<?php echo strtolower($demo_imported); ?>';
                    if (ocdi_theme_title == current_ocdi_theme_title) {
                        $(this).addClass('active_demo');
                        return false;
                    }
                });
            });
        </script>
        <?php
    }
}