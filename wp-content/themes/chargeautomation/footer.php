<?php
/**
 * Theme Footer
 * See also inc/template-parts/footer.php
 *
 * @package Page Builder Framework
 */
?>	
 <?php
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

		do_action( 'wpbf_before_footer' );

		if ( get_theme_mod( 'footer_layout' ) !== 'none' ) do_action( 'wpbf_footer' );

		do_action( 'wpbf_after_footer' );

		?>
	</div>


<?php do_action( 'wpbf_body_close' ); ?>

<?php wp_footer(); ?>
<script>
jQuery('.inner').on('click mouseover',function(){
	jQuery('.modal-popup').hide();
	var popup = jQuery(this).attr('data-pop');
	jQuery('#'+popup).show();
});
jQuery('.close').on('click',function(){
	jQuery('.modal-popup').hide();
})
</script>
</body>

</html>