<?php
/**
 * The template for displaying all single posts.
 *
 * @package Bizworx
 */

get_header(); ?>
	
	<?php if (get_theme_mod('fullwidth_single')) { //Check if the post needs to be full width
		$fullwidth = 'fullwidth';
	} else {
		$fullwidth = '';
	} ?>

	<div id="primary" class="content-area col-md-8 <?php echo esc_attr( $fullwidth ); ?>">
		<main id="main" class="blog-main post-wrap" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>
			
			<div class="single-post-nav">
				<span class="prev-post-nav"><?php previous_post_link('&larr; %link'); ?></span>
				<span class="next-post-nav"><?php next_post_link('%link &rarr;'); ?></span>
			</div>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( get_theme_mod('fullwidth_single', 0) != 1 ) {
	get_sidebar();
} ?>
<?php get_footer(); ?>
