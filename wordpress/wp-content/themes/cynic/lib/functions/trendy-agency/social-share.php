<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */

if ( ! function_exists('cynic_trendy_agency_sharing_icon_links') ) {
    function cynic_trendy_agency_sharing_icon_links( ) {

        global $post;
        $facebook = get_theme_mod('cynic_blog_social_share_facebook_section', 1);
        $twitter = get_theme_mod('cynic_blog_social_share_twitter_section', 1);
        $google_plus = get_theme_mod('cynic_blog_social_share_google_plus_section', 1);
        $linkedin = get_theme_mod('cynic_blog_social_share_linkedin_section', 1);
        $pinterest = get_theme_mod('cynic_blog_social_share_pinterest_section', 1);

        $html = '<ul class="social-icons text-md-right">';

        if($facebook){
            // facebook
            $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='. get_the_permalink();
            $html .= '<li><a href="'. esc_url( $facebook_url ) .'" target="_blank"  rel="noopener" class="aw-facebook"><i class="fab fa-facebook-f"></i></a></li>';
        }

        if($twitter){
            // twitter
            $twitter_url = 'https://twitter.com/share?'. esc_url(get_permalink()) .'&amp;text='. get_the_title();
            $html .= '<li><a href="'. esc_url( $twitter_url ) .'" target="_blank"  rel="noopener" class="aw-twitter"><i class="fab fa-twitter"></i></a></li>';
        }

        if($google_plus){
            // google plus
            $google_plus_url = 'https://plus.google.com/share?url='. esc_url(get_permalink());
            $html .= '<li><a href="'. esc_url( $google_plus_url ) .'" target="_blank"  rel="noopener" class="aw-google-plus"><i class="fab fa-google-plus-g"></i></a></li>';
        }

        if($linkedin){
            // linkedin
            $linkedin_url = 'http://www.linkedin.com/shareArticle?url='. esc_url(get_permalink()) .'&amp;title='. get_the_title();
            $html .= '<li><a href="'. esc_url( $linkedin_url ) .'" target="_blank"  rel="noopener" class="aw-linkdin"><i class="fab fa-linkedin-in"></i></a></li>';
        }

        if($pinterest){
            // pinterest
            $pinterest_url = 'https://pinterest.com/pin/create/bookmarklet/?url='. esc_url(get_permalink()) .'&amp;description='. get_the_title() .'&amp;media='. esc_url(wp_get_attachment_url( get_post_thumbnail_id($post->ID)) );
            $html .= '<li><a href="'. esc_url( $pinterest_url ) .'" target="_blank"  rel="noopener" class="aw-pinterest"><i class="fab fa-pinterest"></i></a></li>';
        }

        $html .= '</ul>';

        echo wp_kses_post($html);

    }
}
