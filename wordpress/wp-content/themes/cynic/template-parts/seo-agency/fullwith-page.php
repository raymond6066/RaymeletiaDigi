<?php
/*
Template Name: Full-width layout
Template Post Type: post, page, event
*/
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php 
        the_content();
        cynic_inner_page_pagination();
    ?>
<?php endwhile; ?>

<?php if (isset($cynic_options[CYNIC_PREFIX.'page_comment_section']) && ($cynic_options[CYNIC_PREFIX.'page_comment_section']==1)) : ?>
    <section class="o-hidden blog-content author-sec">
        <?php
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif; ?>
    </section>
<?php endif; ?>


<?php get_footer();