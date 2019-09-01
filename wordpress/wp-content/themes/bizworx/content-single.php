<?php
/**
 * Template part for displaying single post
 *
 * @package Bizworx
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( '<h1 class="title-post entry-title">', '</h1>' ); ?>

		<div class="single-meta">
			<?php bizworx_posted_on(); 
				bizworx_edit_link(); 
			?>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumb">
			<?php the_post_thumbnail('bizworx-large-thumb'); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bizworx' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
