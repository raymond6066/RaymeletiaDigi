<?php
//To Call The Comments Template For Illustration

if (!function_exists('cynic_illustration_comments')) {
    function cynic_illustration_comments($user_identity = null)
    {
        if (post_password_required()) {
            return;
        }
        if (have_comments()) : ?>
            <div class="comments-title">
                <h2>
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
                </h2>
            </div>
            <div class="comment-box">
                <ul class="comment-list">
                    <?php
                    wp_list_comments(array(
                        'style' => 'ul',
                        'short_ping' => true,
                        'avatar_size' => 120,
                        'callback' => 'cynic_comment',
                    ));
                    ?>
                </ul>
            </div>
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
            'author' => '<div class="row"><div class="form-group col-md-6"><input type="text" name="author" placeholder="' . __('Your Name', 'cynic') . '"></div>',
            'email' => '<div class="form-group col-md-6"><input type="email" name="email" placeholder="' . __('Email', 'cynic') . '"></div></div>'
        );

        $comments_args = array(
            'comment_field' => '<div class="row"><div class="form-group col-md-12"><textarea name="comment" id="comment-textarea" rows="7" placeholder="' . __("Write a comment", "cynic") . '"></textarea></div></div>',
            'fields' => $fields,
            'class_form' => 'comment-form',
            'comment_notes_after' => '',
            'title_reply' => __('Leave a Comment', 'cynic'),
            'title_reply_to' => __('Reply', 'cynic'),
            'comment_notes_before' => '',
            'submit_button' => '<div class="row"><div class="col-md-12"><footer class="form-footer"><button type="submit" class="custom-btn secondary-btn">' . __('Submit', 'cynic') . '</button></div></div>',
        );
        ?>
        <div class="comment-form">
            <div class="form-content">
                <div class="form-container">
                    <?php comment_form($comments_args); ?>
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
        <div id="div-comment-<?php comment_ID() ?>" class="comment-inner"><?php
    }
    if ($args['avatar_size'] != 0) {
        echo get_avatar($comment, $args['avatar_size']);
    } ?>
    <div class="media-body">
        <h5><?php comment_author(); ?> <span
                    class="comment-meta-date"><?php echo get_comment_date() . ' ' . get_comment_time() ?></span></h5>
        <p><?php comment_text(); ?></p>
        <?php
        if ($comment->comment_approved == '0') { ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'cynic'); ?></em>
            <br/><?php
        } ?>
        <span class="comment-reply-btn">
                <?php
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
            </span>
    </div>
    <?php
    if ('div' != $args['style']) : ?>
        </div><?php
    endif;
}


//function cynic_move_comment_field_to_bottom($fields)
//{
//    $comment_field = $fields['comment'];
//    unset($fields['comment']);
//    $fields['comment'] = $comment_field;
//    return $fields;
//}
//
//add_filter('comment_form_fields', 'cynic_move_comment_field_to_bottom');

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



