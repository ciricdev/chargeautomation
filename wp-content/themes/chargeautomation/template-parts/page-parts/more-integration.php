<?php
/* Template Part for more integration */

$partner_integrations = new WP_Query([
    "post_type"         => 'partner-integration',
    'posts_per_page'    => -1,
    'orderby'           => 'title',
    'order'             => 'ACS'
]);
?>

<section class="more-integration">
    <div class="container">
        <div class="more-integration__inner">
            <h2 class="heading-secondary"><?php esc_html_e('More Integrations', 'ca'); ?></h2>

            <?php if($partner_integrations): ?>

            <div class="more-integration__items">

                <?php 
                foreach($partner_integrations as $partner_integration):
                    $title = get_the_title(); 
                    $excerpt = get_the_excerpt();
                ?>

                    <div class="more-integration__item">

                        <?php if($title): ?>

                        <h3 class="heading-third"><?php echo $title; ?></h3>

                        <?php endif; ?>

                        <?php if($excerpt): ?>

                        <p class="more-integration__item-text"><?php echo $excerpt; ?></p>

                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>"><?php esc_html_e('Learn More', 'ca'); ?> <span class="arrow-right">&rarr;</span></a>

                    </div>

                <?php endforeach; ?>
            
            </div>

            <?php endif; ?>

        </div>
    </div>
</section>