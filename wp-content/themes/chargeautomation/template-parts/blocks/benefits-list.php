<?php
if (isset($block['data']['preview_image_help'])) :    /* rendering in inserter preview  */
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else :
    $faqs = get_field('faqs');
    $chosen_items = get_field('chosen_items');
?>

<div class="ca-block ca-block-benefits-list">
    <div class="ca-container">
        <div class="ca-block-benefits-list__wrap">
            <div class="ca-block-benefits-list__inner">
                <?php if($heading = get_field('heading')) : ?>
                    <h2 class="ca-block-benefits-list__heading" data-inviewport="fade-in-right"><?php echo $heading ?></h2>
                <?php endif; ?>

                <?php if($content = get_field('content')) : ?>
                    <div class="ca-block-benefits-list__content" data-inviewport="fade-in-right">
                        <?php echo $content ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if($lists = get_field('list')) : ?>
                <ul class="ca-block-benefits-list__list">
                    <?php foreach($lists as $list) : ?>
                        <li class="ca-block-benefits-list__list-item" data-inviewport="fade-in-left">
                            <?php
                                $list_icon =  get_stylesheet_directory_uri() . '/assets/images/icons/ic-plus.svg';
                                echo file_get_contents($list_icon);
                            ?>
                            <?php echo $list['text'] ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endif ?>
