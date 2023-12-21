<?php
$isFeatured = get_post_meta(get_the_ID(), 'cynic_post_featured', true);
$class = (isset($isFeatured) && $isFeatured == 1) ? "featured-item" : ""; ?>
<div class="<?php echo esc_attr($class); ?>">
    <?php if (is_single()) { ?>
        <h2><?php the_title(); ?></h2>
        <?php
    } else { ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php
    }
    if (get_post_format() != "video") { ?>
        <figure>
            <?php
            if (is_single()) {
                echo "Here";
                the_post_thumbnail(cynicGetblogThumbnilSize('single'), array('class' => 'img-fluid blog-details-img'));
            } else { ?>
                <a href="<?php the_permalink() ?>"
                   class="img-container d-block blog-media post-format-<?php echo get_post_format() ?>">
                    <?php the_post_thumbnail(cynicGetblogThumbnilSize('blog'), array('class' => 'img-fluid blog-details-img')); ?>
                </a>
                <?php
            } ?>
        </figure>
        <?php
    }
    cynic_post_meta();
    if (is_single()) {
        the_content();
    } else { ?>
        <?php the_excerpt(); ?>
        <!-- Read More Link -->
        <a href="<?php the_permalink(); ?>"
           class="custom-btn secondary-btn"><?php echo __('Read More', 'cynic'); ?></a>
        <?php
    }
    ?>
</div>