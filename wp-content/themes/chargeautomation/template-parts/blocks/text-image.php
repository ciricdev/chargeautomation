<?php
if (isset($block['data']['preview_image_help'])) :    /* rendering in inserter preview  */
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else : ?>

<div class="ca-block ca-block-text-image">
    <?php if($content = get_field('content')) : ?>
        <div class="ca-block-text-image__content">
            <div class="ca-container" data-inviewport="fade-in-right">
                <?php echo $content; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if($image = get_field('image')) : ?>
        <img class="ca-block-text-image__image" src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" data-inviewport="fade-in">
    <?php endif; ?>
</div>

<?php endif ?>
