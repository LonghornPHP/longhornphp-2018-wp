<?php
/* Template Name: Home */
get_header();
?>

<div class="top-section" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="text-left col-sm-4 logo-wrap">
				<?php echo wp_get_attachment_image( get_field('logo', 'options'), 'large' ); ?>
			</div>
			<div class="text-center col-sm-8">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_nav_menu( array( 'theme_location' => 'home_buttons' ) ); ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>

<div class="section-register" id="register">
	<div class="container">
		<h2 class="text-center">Buy a Ticket</h2>
		<?php the_field('home_registration_embed_code'); ?>
	</div>
</div>

<div
	class="section-about"
	style="background-image: url('<?php echo wp_get_attachment_image_url( get_field('home_description_image'), 'large' ); ?>');">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-lg-8 mx-auto text-center">
				<?php the_field('home_description_content'); ?>
				<?php the_field('home_description_mailchimp_embed'); ?>
			</div>
		</div>
	</div>
</div>

<div class="section-sponsors" id="sponsors">
	<div class="container">
		<div class="text-center">
			<h2>Sponsors</h2>
			<?php the_field('home_sponsors_intro'); ?>
		</div>
		<?php get_template_part( 'template-parts/sponsors' ); ?>
	</div>
</div>

<?php
get_footer();
