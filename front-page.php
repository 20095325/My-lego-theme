<?php
/**
 * home page template
 *
 * @package lego-theme
 * @since 1.0.0
 */

get_header();
get_template_part('template-parts/banner', 'title');

$recent_post = wp_get_recent_posts(
    array(
        'numberposts' => 1,
        // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    )
);

?>

<div class="content-area">
    <section class="position-relative pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 overflow-hidden">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 align-items-center">
                        <div class="home-page-content">
                            <h2>
                                <?php echo $recent_post[0]['post_title'] ?>
                            </h2>
                            <?php force_balance_tags(the_excerpt()); ?>

                            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" role="button"
                                class="btn btn-primary btn-sm">View Latest Articles</a>
                        </div>
                        <div class="home-featured-img">
                            <?php echo get_the_post_thumbnail($recent_post[0]['ID'], 'large'); ?>
                        </div>

                    </div>
                    <?php legotheme_pagination(); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 overflow-hidden">
                    <h2 class="pb-5">Latest Sets</h2>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                        <?php
                        $recent_sets = wp_get_recent_posts(
                            array(
                                'numberposts' => 3,
                                'post_status' => 'publish',
                                'post_type' => 'lego_sets'
                            )
                        );
                        if (!empty($recent_sets)) {

                            foreach ($recent_sets as $set) {

                                ?>
                                <article id="post-<?php echo $set['ID']; ?>" <?php post_class('col'); ?>>
                                    <div class="card">
                                        <img src="<?php echo get_the_post_thumbnail_url($set['ID'], 'large'); ?>" class="p-4"
                                            alt="<?php echo get_post_meta(get_post_thumbnail_id($set['ID']), '_wp_attachment_image_alt', TRUE); ?>">
                                        <div class="card-body">
                                            <h3 class=""><a href="<?php the_permalink($set['ID']); ?>"><?php echo $set['post_title']; ?></a></h3>
                                            <p class="excerpt">
                                                <?php echo get_post_meta($set['ID'], 'set_number', true); ?> |
                                                <?php echo implode(",", wp_get_post_terms($set['ID'], 'theme', array('fields' => 'names'))); ?>
                                            </p>
                                            <a href="<?php the_permalink($set['ID']); ?>" class="btn btn-primary"><?php esc_html_e('View set ->', 'legotheme'); ?></a>
                                        </div>
                                    </div>
                                </article>
                                <?php

                            }

                        } else {

                            get_template_part('template-parts/content', 'none');

                        }

                        ?>
                    </div>
                    <?php legotheme_pagination(); ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer();