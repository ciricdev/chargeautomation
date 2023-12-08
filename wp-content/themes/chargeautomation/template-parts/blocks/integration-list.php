<?php
if (isset($block['data']['preview_image_help'])) :    /* rendering in inserter preview  */
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else : ?>

<div class="ca-block ca-block-integration-list">
    <div class="ca-container">
        <!-- Create ACF Fields and Code  -->
    </div>
</div>

<?php endif ?>
