<?php
/**
 * The home template file.
 *
 * @package Bizworx
 */

get_header(); 

$layout = bizworx_blog_layout();

?>

	<div id="primary" class="content-area <?php echo ( $layout == 'fullwidth' )  ? 'col-md-12 ' : 'col-md-9 '; echo esc_attr($layout); ?>">
		<main id="main" class="blog-main post-wrap" role="main">

		<?php if ( have_posts() ) : ?>

		<div class="posts-layout">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>
		</div>

		<?php
			the_posts_pagination( array(
				'mid_size'  => 1,
			) );
		?>	

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
	if ( $layout == 'classic' ) :
	get_sidebar();
	endif;
?>
<?php get_footer(); ?>