<?php
if (isset($block['data']['preview_image_help'])) :    /* rendering in inserter preview  */
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else :
    $select_type_of_documentation = get_field('select_type_of_documentation');
?>

<div class="ca-block ca-block-documentation">
    <div class="ca-container">
        <div class="ca-block-documentation__wrapper">
            <?php if($heading = get_field('heading')) : ?>
                <h2 data-inviewport="fade-in-right"><?php echo $heading ?></h2>
            <?php endif; ?>

            <?php if($select_type_of_documentation[0] === 'Content') : ?>
                <?php if($documentation_content = get_field('documentation_content')) : ?>
                    <?php foreach($documentation_content as $content) : ?>
                        <div data-inviewport="fade-in-right">
                            <?php echo $content['content'] ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if($select_type_of_documentation[1] === 'Link') : ?>
                <?php if($documentation_link = get_field('documentation_link')) : ?>
                    <div class="ca-block-documentation__link-items">
                        <?php foreach($documentation_link as $link) : ?>
                            <div data-inviewport="fade-in-right">
                                <div class="ca-block-documentation__link-item">
                                    <div class="ca-block-documentation__link-image-wrap">
                                        <div class="ca-block-documentation__link-image-inner">
                                            <img class="ca-block-documentation__link-image" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/logos/chargeautomation-logo.svg' ?>" alt="<?php _e('Charge Automation Logo') ?>">
                                        </div>
                                        <div class="ca-block-documentation__link-image-inner">
                                            <img class="ca-block-documentation__link-image" src="<?php echo $link['icon']['url'] ?>" alt="<?php echo $link['icon']['alt'] ?>">
                                        </div>
                                    </div>

                                    <div class="ca-block-documentation__content">
                                        <strong class="ca-block-documentation__title"><?php echo $link['title'] ?></strong>
                                        <p class="ca-block-documentation__description"><?php echo $link['description'] ?></p>
                                    </div>

                                    <?php if($link['link']) : ?>
                                        <a class="ca-block-documentation__link" href="<?php echo $link['link']['url'] ?>"><?php echo $link['link']['title'] ?></a>
                                    <?php endif; ?>

                                    <a class="ca-block-documentation__link-absolute" href="<?php echo $link['link']['url'] ?>"></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endif ?>
