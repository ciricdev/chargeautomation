<?php
    $why_charge_automation_heading = get_field('why_charge_automation_heading', 'option');
    $why_charge_automation_content = get_field('why_charge_automation_content', 'option');
?>

<?php if($why_charge_automation_heading || $why_charge_automation_content) : ?>
    <section class="ca-why-charge-automation">
        <div class="ca-container">
            <?php if($why_charge_automation_heading) : ?>
                <h2 class="ca-why-charge-automation__heading"><?php echo $why_charge_automation_heading ?></h2>
            <?php endif; ?>

            <?php if($why_charge_automation_content) : ?>
                <div class="ca-why-charge-automation__content">
                    <?php echo $why_charge_automation_content ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>