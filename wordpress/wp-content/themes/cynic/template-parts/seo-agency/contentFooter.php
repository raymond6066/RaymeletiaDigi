

<div class="post-nav row align-items-center">
    <?php
    $cynic_options = cynic_options();
    if (isset($cynic_options['cynic_display_blog_social_share']) && ($cynic_options['cynic_display_blog_social_share'] == 1)) : ?>
        <div class="nav-social-links d-flex align-items-center col-md">
            <?php
            $sharePreText = getCynicOptionsVal('blog_social_share_titletext');
            if ($sharePreText):
                ?>
                <span class="share-label"><?php echo esc_html($sharePreText, 'cynic') ?></span>
                <?php
            endif
            ?>
            <a class="c-facebook share-facebook" target="_blank"
               href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>"
               title="Share on Facebook."><i class="fa fa-facebook"></i></a>
            <a class="c-twitter share-twitter" target="_blank"
               href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>"
               title="Tweet this!"><i class="fa fa-twitter"></i></a>
            <a class="c-linkedin share-linkedin" target="_blank"
               href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>"
               title="Share on LinkedIn"><i class="fa fa-linkedin"></i></a>
            <a class="c-google-plus share-google-plus-1" target="_blank"
               href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a>
            <a class="c-google-plus share-google-plus-1" target="_blank"
               href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
               echo esc_url($url); ?>"><i class="fa fa-pinterest"></i></a>
        </div>
    <?php endif; ?>
    <?php
    if (getCynicOptionsVal('blog_prev_next_botton')):
        ?>
        <div class="prev-next ml-auto col-md text-md-right">
            <?php
            $preAnchorText = (getCynicOptionsVal('blog_prev_button_text')) ? getCynicOptionsVal('blog_prev_button_text') : '&lt; ' . __('PREV', 'cynic');
            $nextAnchorText = (getCynicOptionsVal('blog_next_button_text')) ? getCynicOptionsVal('blog_next_button_text') : __('NEXT', 'cynic') . ' &gt;';
            $nextPreSeparator = (getCynicOptionsVal('blog_prev_next_button_separator_sign')) ? getCynicOptionsVal('blog_prev_next_button_separator_sign') : ' | ';

            $previousAnchor = (get_previous_post_link('%link', $preAnchorText));
            $nextAnchor = (get_next_post_link('%link', $nextAnchorText));
            ?>
            <?php
            if (!empty($previousAnchor)) {
                echo esc_html_decode($previousAnchor);
            } else {
                ?>
                <a class="disabled" href="javascript:void(0)" rel="prev"><?php echo esc_html($preAnchorText) ?></a>
                <?php
            }
            echo esc_html_decode("<span>" . $nextPreSeparator . "</span>");
            if (!empty($nextAnchor)) {
                echo esc_html_decode($nextAnchor);
            } else {
                ?>
                <a class="disabled" href="javascript:void(0)" rel="next"><?php echo esc_html($nextAnchorText) ?></a>
                <?php
            }
            ?>
        </div>
        <?php
    endif;
    ?>

</div>