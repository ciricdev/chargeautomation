<?php
if (isset($block['data']['preview_image_help'])) :    /* rendering in inserter preview  */
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else :
    $faqs = get_field('faqs');
    $chosen_items = get_field('chosen_items');
?>

<div class="ca-block ca-block-faqs">
    <?php if($faqs) : ?>

        <?php if($heading = get_field('heading')) : ?>
            <h2><?php echo $heading ?></h2>
        <?php endif; ?>

        <?php foreach($faqs as $faq) : ?>
            <?php foreach($faq as $faq_group) : ?>

                <?php if($faq_group['title']) : ?>
                    <h3><?php echo $faq_group['title'] ?></h3>
                <?php endif; ?>

                <?php if($faq_group['chosen_items']) : ?>
                    <?php foreach($faq_group['chosen_items'] as $item) : ?>

                        <div class="ca-accordion">
                            <div class="ca-accordion__trigger">
                                <?php if($question = get_field('question', $item)) : ?>
                                    <h4><?php echo $question ?></h4>
                                <?php endif; ?>
                            </div>
                            <div class="hidden ca-accordion__content">
                                <?php if($answer = get_field('answer', $item)) : ?>
                                    <p><?php echo $answer ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>

            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php endif ?>
