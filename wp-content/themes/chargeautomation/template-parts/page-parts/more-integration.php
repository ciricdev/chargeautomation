<?php
/* Template Part for more integration */

$partner_integrations = new WP_Query([
    "post_type"         => 'partner-integration',
    'posts_per_page'    => -1,
    'orderby'           => 'title',
    'order'             => 'ASC',
    'post__not_in'      => [get_the_ID()]
]);
?>

<section class="ca-more-integration">
    <div class="ca-container">
        <div class="ca-more-integration__inner">
            <h2 class="ca-more-integration__heading" data-inviewport="fade-in-right"><?php esc_html_e('More Integrations', 'ca'); ?></h2>

            <?php if($partner_integrations->have_posts()): ?>
                <div class="ca-more-integration__items">

                    <?php
                    while ($partner_integrations->have_posts()):
                        $partner_integrations->the_post();
                        $title = get_the_title();
                        $excerpt = get_the_excerpt();
                        $image = get_the_post_thumbnail(get_the_ID(), 'full');
                    ?>

                        <div class="ca-more-integration__item" data-inviewport="fade-up">
                            <div class="ca-more-integration__item-inner">
                                <div>
                                    <?php if($image): ?>
                                        <div class="ca-more-integration__item-image">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($title): ?>
                                        <h3 class="ca-more-integration__title"><?php echo $title; ?></h3>
                                    <?php endif; ?>

                                    <?php if($excerpt): ?>
                                        <p class="ca-more-integration__excerpt"><?php echo $excerpt; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <a class="ca-more-integration__link" href="<?php the_permalink(); ?>"><?php esc_html_e('Learn More', 'ca'); ?> <span class="arrow-right">&rarr;</span></a>
                        </div>

                    <?php endwhile; wp_reset_query() ?>

                </div>
            <?php endif; ?>

        </div>
    </div>
</section>