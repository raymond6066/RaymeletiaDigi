<?php
// To Call The Comments Template For SEO Agency
if (!function_exists('cynic_trendy_agency_comments')) {
    function cynic_trendy_agency_comments($user_identity = null)
    {
        if (post_password_required()) {
            return;
        }
        ?>
        <div id="comments" class="comments-area">
            <?php if (have_comments()) : ?>
                <h3 class="comments-title">
                    <?php
                    $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
                    if ($num_comments == 0) {
                        echo esc_html_e('No Comments', 'cynic');
                    } elseif ($num_comments > 1) {
                        echo esc_html($num_comments . ' ');
                        ?>
                        <?php echo esc_html_e('Comments', 'cynic'); ?>
                        <?php
                    } else {
                        echo esc_html_e('1 Comment', 'cynic');
                    }
                    ?>
                </h3>
                <ul class="commentlist">
                    <?php
                    wp_list_comments(array(
                        'style' => 'ul',
                        'short_ping' => true,
                        'avatar_size' => 32,
                        'callback' => 'cynic_comment',
                    ));
                    ?>
                </ul>

                <?php
                echo esc_html(get_the_comments_navigation());
            endif; // have_comments()
            ?>

            <?php // If comments are closed and there are comments, let's leave a little note, shall we?
            if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
                <p class="no-comments"><?php esc_html_e('Comments are closed.', 'cynic'); ?></p>
            <?php endif; ?>

            <?php //comment_form();

            $commenter = wp_get_current_commenter();
            $req = get_option('require_name_email');
            $aria_req = ($req ? " aria-required='true'" : '');
            $fields = array(
                'author' => '<div class="form-group col-md-6"><input type="text" name="author" placeholder="' . __('Full Name', 'cynic') . '"></div>',
                'email' => '<div class="form-group col-md-6"><input type="email" name="email" placeholder="' . __('Email', 'cynic') . '"></div>'
            );

            $comments_args = array(
                'comment_field' => '<div class="form-group col-md-12"><textarea name="comment" id="comment-textarea" rows="3" placeholder="' . __("Message", "cynic") . '"></textarea></div>',
                'fields' => $fields,
                'class_form' => 'comment-form row',
                'comment_notes_after' => '',
                'title_reply' => __('Leave a Comment', 'cynic'),
                'title_reply_to' => __('Reply', 'cynic'),
                'comment_notes_before' => '',
                'submit_button' => '<div class="col-md-12"><footer class="form-footer"><button type="submit" class="custom-btn btn-big grad-style-ef">' . __('Submit Comment', 'cynic') . '</button></div>',
            );
            ?>
            <div class="comment-form">
                <div class="form-content">
                    <div class="form-container">
                        <?php comment_form($comments_args); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

function cynic_comment($comment, $args, $depth)
{
    if ('div' === $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li ';
        $add_below = 'div-comment';
    } ?>
    <<?php echo esc_attr($tag);
    comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>"><?php
    if ('div' != $args['style']) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
    <div class="comment-author vcard"><?php
    if ($args['avatar_size'] != 0) {
        echo get_avatar($comment, $args['avatar_size']);
    }
    printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
    <div class="comment-meta commentmetadata">
        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><?php
            /* translators: 1: date, 2: time */
            printf(
                '%1s at %2s',
                get_comment_date(),
                get_comment_time()
            ); ?>
        </a>
    </div>
    </div><?php
    if ($comment->comment_approved == '0') { ?>
        <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'cynic'); ?></em>
        <br/><?php
    } ?>
    <div class="comment-text"><?php comment_text(); ?></div>

    <div class="reply"><?php
    comment_reply_link(
        array_merge(
            $args,
            array(
                'add_below' => $add_below,
                'depth' => $depth,
                'max_depth' => $args['max_depth']
            )
        )
    ); ?>
    </div><?php
    if ('div' != $args['style']) : ?>
        </div><?php
    endif;
}


function cynic_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'cynic_move_comment_field_to_bottom');

function cynic_getDefaultImages($imageArr = array(), $thumbsize = '', $classs = '', $height = '', $width = '')
{

    if (isset($imageArr['id']) && !empty($imageArr['id'])) {
        return wp_get_attachment_image($imageArr['id'], $thumbsize);
    } else {

        if (isset($imageArr['url']) && !empty($imageArr['url'])) {
            return '<img src="' . $imageArr['url'] . '"' . esc_attr($classs) . ' class="' . esc_attr($classs) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '">';
        } else {
            return '<img src="' . CYNIC_THEME_URI . '/images/default-image.png" class="' . esc_attr($classs) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '">';
        }
    }
}

/**
 * @param $blogType
 * @return mixed
 */

function cynicGetblogThumbnilSize($blogType = 'single')
{
    $thumbnilsize = 'full';
    $blog_single_sidebar = cynic_is_check_val('cynic_blog_single_sidebar', true);
    $blog_sidebar = cynic_is_check_val('cynic_blog_sidebar', true);
    if (getCynicOptionsVal('layouts') == 1) {
        if ($blogType == 'single') {
            if ($blog_single_sidebar) {
                $thumbnilsize = 'cynic-trendy-blog-thumbnail-without-slidebar';
            } else {
                $thumbnilsize = 'cynic-trendy-blog-thumbnail-with-slidebar';
            }
        } else {
            if ($blog_sidebar) {
                $thumbnilsize = 'cynic-trendy-blog-thumbnail-without-slidebar';
            } else {
                $thumbnilsize = 'cynic-trendy-blog-thumbnail-with-slidebar';
            }
        }
    }
    return $thumbnilsize;
}

function cynic_get_bubble_color($colors)
{
    $rgb_color = cynic_haxtoRGB($colors);
    $shape_color = !empty($colors) ? "rgb(" . $rgb_color . ")" : "rgb(237,247,255)";
    return $shape_color;
}

function cynic_haxtoRGB($hex)
{
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    $string = $r . ',' . $g . ',' . $b;
    return $string;
}