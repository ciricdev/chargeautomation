<?php
if (isset($block['data']['preview_image_help'])) :    /* rendering in inserter preview  */
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else :
    $faqs = get_field('faqs');
    $chosen_items = get_field('chosen_items');
?>

<div class="ca-block ca-block-faqs">

    <?php if($faqs) : ?>
        <div class="ca-container">
            <div class="ca-block-faqs__head">
                <img class="ca-block-faqs__question-mark" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icons/ic-question-mark.svg' ?>" alt="<?php _e('Question Mark Icon', 'ca') ?>" data-inviewport>
                <?php if($heading = get_field('heading')) : ?>
                    <h2 class="ca-block-faqs__heading" data-inviewport="fade-down"><?php echo $heading ?></h2>
                <?php endif; ?>
            </div>

            <div class="ca-block-faqs__main">
                <?php foreach($faqs as $faq) : ?>
                    <?php foreach($faq as $faq_group) : ?>

                        <?php if($faq_group['title']) : ?>
                            <h3 class="ca-block-faqs__title" data-inviewport="fade-down"><?php echo $faq_group['title'] ?></h3>
                        <?php endif; ?>

                        <?php if($faq_group['chosen_items']) : ?>
                            <?php foreach($faq_group['chosen_items'] as $item) : ?>

                                <div class="ca-accordion" data-inviewport="fade-down">
                                    <div class="ca-accordion__trigger">
                                        <?php if($question = get_field('question', $item)) : ?>
                                            <h4 class="ca-block-faqs__question"><?php echo $question ?></h4>
                                        <?php endif; ?>

                                        <svg class="ca-accordion__icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"><path fill="none" stroke="#15ACE1" d="m.41 17 10-8-10-8"/></svg>
                                    </div>
                                    <div class="hidden ca-accordion__content">
                                        <?php if($answer = get_field('answer', $item)) : ?>
                                            <p class="ca-block-faqs__answer"><?php echo $answer ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>

                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php endif ?>
