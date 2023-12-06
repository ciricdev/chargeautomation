<?php
if (isset($block['data']['preview_image_help'])) :    /* rendering in inserter preview  */
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else :
    $faqs = get_field('faqs');
    $chosen_items = get_field('chosen_items');
?>

    <?php if($faqs) : ?>
        <div class="ca-block ca-block-faqs">
            <?php foreach($faqs as $faq) : ?>

                <?php foreach($faq as $faq_group) : ?>

                    <h2><?php echo $faq_group['title'] ?></h2>

                    <?php foreach($faq_group['chosen_items'] as $item) : ?>

                        <?php if($question = get_field('question', $item)) : ?>
                            <p><?php echo $question ?></p>
                        <?php endif; ?>

                        <?php if($answer = get_field('answer', $item)) : ?>
                            <p><?php echo $answer ?></p>
                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php endforeach; ?>

            <?php endforeach; ?>
        </div>

        <div class="ca-accordion">
            <div class="ca-accordion__trigger">
                trigger
            </div>
            <div class="hidden ca-accordion__content">
                content
            </div>
        </div>
    <?php endif; ?>

<?php endif ?>
