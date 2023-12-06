<?php
/**
 * Template Name: Logo Page
 *
 * Page Template to Charge Automation Home
 *
 * @package Page Builder Framework
 */
 
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>


		<div id="content">

			<?php do_action( 'wpbf_content_open' ); ?>
			
			<?php wpbf_inner_content(); ?>

				<?php do_action( 'wpbf_inner_content_open' ); ?>

				<main id="main" class="wpbf-main<?php echo wpbf_singular_class(); // WPCS: XSS ok. ?>">

					<?php do_action( 'wpbf_main_content_open' ); ?>

					<?php wpbf_title(); ?>

					<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div class="entry-content" itemprop="text">

						<?php the_content(); ?>

						<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'page-builder-framework' ),
							'after'  => '</div>',
						) );
						?>

					</div>

					<?php endwhile; endif; ?>

					<?php comments_template(); ?>

					<?php do_action( 'wpbf_main_content_close' ); ?>

				</main>

				<?php do_action( 'wpbf_inner_content_close' ); ?>

			<?php wpbf_inner_content_close(); ?>

			<?php do_action( 'wpbf_content_close' ); ?>
			
		</div>
<?php
phpinfo();
   $data = file_get_contents("https://testapptor1a.chargeautomation.com/api/get-payment-gateways");
  	


  $json = json_decode( $data );
  
foreach( $json->data as $logo){
?>

<div class="wp-block-column">
<div class="wp-block-image"><figure class="aligncenter"><img src="<?php echo $logo->logo;  ?>" alt="" class="wp-image-151"></figure></div>



<p class="has-text-color has-very-dark-gray-color"><strong><?php echo $logo->name;  ?></strong></p>



<p class="has-text-color has-very-dark-gray-color hidden">canada</p>
</div>


<?php  } ?>

<?php get_footer(); ?>