<?php
/**
 * Template Name: Home Page
 *
 * Page Template to Charge Automation Home
 *
 * @package Page Builder Framework
 */
 
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<?php 
echo do_shortcode('[smartslider3 slider=2]');
?>
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
<div class="grey-section testimonials-section">
<div class="ugb-container__wrapper">
<h2 class="text-center">Happy Clients</h2>
<div class="col-md-6 col-md-offset-3">
<p class="text-center">ChargeAutomation is the best way to process booking payments. <br> We handle millions of dollars every year for forward-thinking businesses around the world.</p>
</div>
<div class="testimonials">
<ul id="owl-demo" class="owl-carousel" >

<?php
	global $post;
	query_posts('post_type=testimonie');?>
	<?php if ( have_posts() ) : ?>
	<?php while (have_posts()) : the_post(); ?>  
        <?php $clname= get_post_custom_values('Testimoniename'); 
                    if($clname[0] != ""){
                 
                ?>
                 <?php }else{ ?>
                      <?php } ?>      
      
      <li>
		  <div class="client">
<div class="client-name"> <?php the_title(); ?> </div>
	<div class="property-name"><?=$clname[0]?> </div>
			  <div class="star"></div>
</div>
<div class="testimonie-box">  <?php the_content(); ?>  </div>
</li>                     
<?php endwhile; ?>
	<?php else : ?>

	<?php endif; ?>
	<?php wp_reset_query();?>
    
    </ul>
    </div>
	
	<div class="wp-block-button aligncenter"><a class="wp-block-button__link" href="https://app.chargeautomation.com/register">GET STARTED NOW</a></div>
	
</div>
</div>	

<div class="blue-section overlay-section">
<div class="ugb-container__wrapper">
	<h2>Why Charge Automation?</h2>
	<p class="mini-container">We are the first and only company to offer this range of simple yet sophisticated payment processing solutions. Our proprietary platform is designed to fit the needs from the smallest B&B operator to the largest multi-chain hotels.</p>
	
	<div class="flip-box">
		<!--first flip-->
		<div class="flip-item">
			<!--hide-content-->
			<div class="flip-hide-content">
				<div class="flip-hide-contentbox">
			<h5>PCI COMPLIANCE</h5>
			<p>No customer data or sensitive payment information is ever stored on your system. ChargeAutomation keeps you PCI-compliant 24/7/365 and at no extra cost.</p>
					</div>
			</div>
				<!--hide-content closed-->
			<div class="flip-item-content">
			<h5>PCI COMPLIANCE</h5>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/pci.png" alt="pci">
				<p class="small-text">ChargeAutomation keeps you PCI-compliant
24/7/365 and at no extra cost.</p>
				<div class="clearfix"></div>
			</div>
		</div>
		<!--second flip-->
		<div class="flip-item">
			<!--hide-content-->
			<div class="flip-hide-content">
				<div class="flip-hide-contentbox">
			<h5>PRICE</h5>
			<p>Pay nominal fee of <span class="big-tag">0.15%</span>+ $0.25 per successful payment collection.
</p>
					</div>
			</div>
				<!--hide-content closed-->
		<div class="flip-item-content">
			
			<h5>PRICE</h5>
			<!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/graph.svg" alt="price graph"> -->
			<h6>Pay nominal fee of <span class="big-tag">0.15%</span>+ $0.25 per successful payment collection.</h6>
			
			<div class="column-box">
				<!--One item-->
				<div class="column-item">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nosetup.svg" alt="No setup, monthly, or hidden fees">
					<p class="small-text">No setup, monthly, 
or hidden fees</p>
				</div>
				<!--One item closed-->
				<!--One item-->
				<div class="column-item">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/payonly.svg" alt="Pay only for what you use">
					<p class="small-text">Pay only for
what you use</p>
				</div>
				<!--One item closed-->
				<!--One item-->
				<div class="column-item">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/realtime.svg" alt="Real-timefee reporting">
					<p class="small-text">Real-time
fee reporting</p>
				</div>
				<!--One item closed-->
			</div>
			
				<div class="clearfix"></div>
			</div>
		</div>
		
		<!--last flip-->
		<div class="flip-item">
			<div class="flip-item-content">
				<!--hide-content-->
			<div class="flip-hide-content">
				<div class="flip-hide-contentbox">
			<h5>CUSTOMIZED INTEGRATION</h5>
			<p>Develop a solution that suites your specific requirement</p>
					<a href="https://chargeautomation.com/contact-us/">CONTACT SALES <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrow-right.svg" alt="arrow"> </a>
					</div>
			</div>
				<!--hide-content closed-->
			<h5>ENTERPRISE</h5>
				<p class="small-text">Charge Automation offers customized 
integration at scale. Get in touch for details</p>
				<div class="bubble-box">
				<!--One item-->
				<div class="bubble-item">
					Account Management
					</div>
				<!--One item-->
				<div class="bubble-item">
					Volume discounts
					</div>
					<!--One item-->
				<div class="bubble-item">
					Migration assistance
					</div>
					<!--One item-->
				<div class="bubble-item">
					Dedicated support
					</div>
					</div>
				<a href="https://chargeautomation.com/contact-us/">CONTACT SALES <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrow-right.svg" alt="arrow"> </a>
		</div>
		</div>
	
	</div>
	
	<div class="wp-block-button aligncenter"><a class="wp-block-button__link" href="https://app.chargeautomation.com/register">GET STARTED NOW</a></div>
</div>
</div>	

<div class="dark-section cta-section">
	<div class="ugb-container__wrapper">
<h1>Get Help!</h1>
	<p>Please use the form below to reach out <br> or drop us a line at support@chargeautomation.com</p>
<div class="wp-block-button aligncenter"><a class="wp-block-button__link" href="https://chargeautomation.com/contact-us/">CONTACT US</a></div>
	</div>
</div>

<div class="footer-box">
	<div class="footer-column">
		<div class="footer-column-content">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon_pin.svg" alt="address icon">
		<p>30 Wellington St W 5th Floor <br>
Toronto, Canada, M5L 1E2</p>
	</div>
	</div>
	<div class="footer-column">
		<div class="footer-column-content">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon_phone.svg" alt="phone icon">
		<p>TEL: +1.416.831.3598<br>
FAX: 1.888.852.8660</p>
	</div>
	</div>
</div>
<?php get_footer(); ?>