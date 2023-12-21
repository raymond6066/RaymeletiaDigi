<?php

class CynicSeoTopBannerWithVideo
{
    public function __construct()
    {
        add_shortcode('cynic_seo_top_banner_with_video', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        vc_add_shortcode_param('media_button', array($this, 'cynic_my_param_settings_field'));

    }

    public function cynic_my_param_settings_field($settings, $value, $tag, $single = false)
    {
        $output = '<button name="' . esc_attr($settings['param_name']) . '" data-target="' . $settings['anchor_insert'] . '"  class="button btn wpb_vc_param_value cynic_media_upload_btn785 ' . esc_attr($settings['param_name']) . ' ' .
            esc_attr($settings['type']) . '_field"   id="custom-insert-media-button" type="button" ><span class="wp-media-buttons-icon"></span> Add Media</button>';
        return $output;
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_seo_top_banner_with_video',
                'name' => __('Top Banner with Video', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "is_container" => false,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(

                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Video Source', 'cynic'),
                        'value' => array(
                            __('Select Video Source', 'cynic') => '',
                            __('Media', 'cynic') => 'media',
                            __('Youtube', 'cynic') => 'youtube',
                            __('Vimeo', 'cynic') => 'vimeo',
                        ),
                        'param_name' => 'video_source',
                        'description' => __('Select Video Source.', 'cynic'),
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Upload Video', 'cynic'),
                        'type' => 'media_button',
                        'param_name' => 'media_upload',
                        'value' => '',
                        'description' => __('You may upload vidoe by this button.', 'cynic'),
                        'anchor_insert' => 'media_video_url',
                        'dependency' => array(
                            'element' => 'video_source',
                            'value' => 'media',
                        ),
                    ),

                    array(
                        "holder" => "h2",
                        "class" => "media_video_url",
                        'heading' => __('Media URL', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'media_video_url',
                        'value' => '',
                        'description' => __('Please copy & paste media uploaded video url.', 'cynic'),
                        'dependency' => array(
                            'element' => 'video_source',
                            'value' => 'media',
                        ),
                    ),

                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => __('Vimeo Video URL', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'vimeo_video_url',
                        'value' => '',
                        'description' => __('Example : https://player.vimeo.com/video/258058640', 'cynic'),
                        'dependency' => array(
                            'element' => 'video_source',
                            'value' => 'vimeo',
                        ),
                    ),

                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => __('Youtube Video URL', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'youtube_video_url',
                        'value' => '',
                        'description' => __('Example : https://www.youtube.com/watch?v=K4wEI5zhHB0.', 'cynic'),
                        'dependency' => array(
                            'element' => 'video_source',
                            'value' => 'youtube',
                        ),
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => __('Sound Enable', 'cynic'),
                        'param_name' => 'sound_enable',
                        'description' => __('Vidoe sound Enable/Disabled.', 'cynic'),
                        'value' => array(__('Yes', 'cynic') => 'yes'),
                    ),

                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => 'Title',
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => '',
                    ),
                    array(
                        "holder" => "p",
                        "class" => "",
                        'heading' => 'Short Description',
                        'type' => 'textarea',
                        'param_name' => 'short_description',
                        'value' => '',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Description',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Read More Link',
                        'type' => 'vc_link',
                        'param_name' => 'readmore_link',
                        'value' => '',
                        'description' => __('Keep URL empty URL if you don\'t want', 'cynic'),
                    ),


                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'video_source' => '',
                'media_video_url' => '',
                'youtube_video_url' => '',
                'vimeo_video_url' => '',
                'sound_enable' => '',
                'title' => '',
                'short_description' => '',
                'readmore_link' => '',
                'form_shortcode' => '',
                'form_position' => '',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $sound_enable = (!empty($attributes['sound_enable']) && $attributes['sound_enable'] == 'yes') ? 1 : 0;
        $title = $attributes['title'];
        $video_source = $attributes['video_source'];
        $short_description = $attributes['short_description'];

        $readMorelink = $attributes['readmore_link'];
        $readMorelink = vc_build_link($readMorelink);


        $bg_video_url = '';
        $bg_video_class = '';
        $bg_video_id = '';
        if ($video_source == 'media') {
            $bg_video_url = $attributes['media_video_url'];
            $bg_video_class = 'video-bg';
        } elseif ($video_source == 'youtube') {
            $youtube_video_url = $attributes['youtube_video_url'];
            $bg_video_class = ' youtube-bg';
            if (!empty($youtube_video_url)) {
                parse_str(parse_url($youtube_video_url, PHP_URL_QUERY), $output);
                if (isset($output['v']) && !empty($output['v'])) ;
                $bg_video_id = $output['v'];
                $bg_video_url='https://www.youtube.com/embed/'.$bg_video_id.'?playlist='.$bg_video_id;

            }

        } elseif ($video_source == 'vimeo') {
            $bg_video_url = $attributes['vimeo_video_url'];
            $bg_video_class = ' vimeo-bg';
        }

        $anchorStatus = false;
        if (isset($readMorelink['url']) && !empty($readMorelink['url'])) {
            $anchorStatus = true;
            $aurl = $readMorelink['url'];
            $aurl = $readMorelink['url'];
            $arel = (!empty(($readMorelink['rel']))) ? $readMorelink['rel'] : '';
            $atarget = (($readMorelink['target'])) ? $readMorelink['target'] : '_self';
            $anchorHtml = "<a href=" . $aurl . " rel=" . $arel . ", target=" . $atarget . ">";
        }


        ob_start();
        if ((isset($anchorHtml) && !empty($anchorHtml)) && $anchorStatus) {
            echo esc_html_cynicSEO_string($anchorHtml);
        }


        ?>
        <div class="fullscreen-banner measure-performance-banner <?php echo esc_attr($extra_class); ?> <?php echo esc_attr($bg_video_class); ?> ">
            <?php if ($video_source == 'media' && !empty($bg_video_url)) { ?>
                <div class="video-bg">
                    <video autoplay loop muted>
                        <source src="<?php echo esc_url($bg_video_url); ?>" type="video/mp4">
                    </video>
                </div>
            <?php } else {
                ?>
                <div class="embed-responsive embed-responsive-16by9">
                    <?php
                    if ($video_source == 'vimeo') {
                        ?>
                        <iframe src="<?php echo esc_url($bg_video_url . '?autoplay=1&loop=1&title=0&byline=0&portrait=0&muted=' . $sound_enable); ?>"
                                width="1600" height="900" allowfullscreen></iframe>
                        <?php
                    } else {
                        ?>
                        <iframe src="<?php echo esc_url($bg_video_url . '&autoplay=1&loop=1&cc_load_policy=1rel=0&amp;controls=0&amp;showinfo=0&mute=' . $sound_enable); ?>"
                                allowfullscreen></iframe>
                        <?php
                    }

                    ?>
                </div>
                <?php
            } ?>
            <div class="content d-flex align-items-center justify-content-center">
                <div class="container text-center">
                    <h1><?php echo esc_html_cynicSEO_string($title) ?></h1>
                    <p><?php echo esc_html_cynicSEO_string($short_description) ?></p>

                    <div class="site-performance text-center">
                        <?php
                        echo apply_filters('the_content', $content);
                        ?>
                        <!-- End of form -->
                    </div>
                    <!-- End of .site-performance -->
                </div>
                <!-- End of .container -->
            </div>
            <!-- End of .content -->
        </div>
        <?php
        if ((isset($anchorHtml) && !empty($anchorHtml)) && $anchorStatus) {
            echo '</a>';
        }
        return ob_get_clean();
    }
}
