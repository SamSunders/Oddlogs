<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package realest
 */

get_header(); ?>

	<div id="primary" class="content-area col-center">
		<main id="main" class="site-main twelve-col" role="main">
<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
			</header><!-- .page-header -->

			<?php
			/**
			 * realia_before_property_archive
			 */
			do_action( 'realia_before_property_archive' );
			?>

		
				<div class="property-box-archive type-box item-per-row-3">
					<div class="properties-row">
			<?php endif; ?>

			<?php $index = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
					<div class="property-container">
						<?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
					</div><!-- /.property-container -->

					
					
				<?php $index++; ?>
			<?php endwhile; ?>

			
					</div><!-- /.properties-row -->
				</div><!-- /.property-box-archive -->
	

			<?php
			/**
			 * realia_after_property_archive
			 */
			do_action( 'realia_after_property_archive' );
			?>

			<?php the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'realest' ),
				'next_text'          => __( 'Next page', 'realest' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'realest' ) . ' </span>',
			) ); ?>



		</main><!-- #main -->

	</div><!-- #primary -->


<?php get_footer(); ?>
