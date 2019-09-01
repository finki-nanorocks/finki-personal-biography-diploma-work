<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bizworx
 */
 
get_header(); ?>
		<div id="primary" class="col-md-9 content-area">
			<main id="main" class="blog-main post-wrap" role="main">
				<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile; 
				?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
			</main> <!-- /main -->
		</div> <!-- /.blog-main -->
		<?php get_sidebar(); ?>
<?php get_footer(); ?>