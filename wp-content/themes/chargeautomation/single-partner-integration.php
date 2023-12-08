<?php
/**
 * The template for displaying PMS Partner Integration single page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ca
 */

get_header();

// Header ACF Fileds
$override_thumbnail = get_field('override_thumbnail');
$override_title = get_field('override_title');
$integration_type = get_field('integration_type');

//
?>

<div class="ca-single ca-single-pms-partner-integration">
    <header class="ca-single-pms-partner-integration__header">
        <div class="ca-container ca-single-pms-partner-integration__wrapper">
            <div class="ca-single-pms-partner-integration__image">
                <div class="ca-single-pms-partner-integration__thumbnail">
                    <?php if($override_thumbnail) : ?>
                        <img class="ca-single-pms-partner-integration__thumbnail__image" src="<?php echo $override_thumbnail['url'] ?>" alt="<?php echo $override_thumbnail['alt'] ?>">
                    <?php else : ?>
                        <?php echo get_the_post_thumbnail(get_the_id(), 'full', ['class' => 'ca-single-pms-partner-integration__thumbnail__image']) ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="ca-single-pms-partner-integration__content">
                <h1 class="ca-single-pms-partner-integration__title"><?php echo $override_title ? $override_title : get_the_title() ?></h1>

                <?php if($integration_type) : ?>
                    <strong class="ca-single-pms-partner-integration__integrated-type"><?php _e('Integrated Type:') ?></strong>
                    <span class="ca-single-pms-partner-integration__integrated-type-name"><?php echo sprintf('via %s', $integration_type) ?></span>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div>
        <main>
            <?php the_content(); ?>
        </main>

        <?php
            #-- Why Charge Automation
            get_template_part('template-parts/page-parts/why-charge-automation');

            #-- More Integrations
            get_template_part('template-parts/page-parts/more-integration');
        ?>

    </div>
</div>

<?php
get_footer();