<?php
/**
 * The template for displaying a single property.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package realest
 */

get_header(); ?>

	<div id="primary" class="content-area col-center">
     	<main id="main" class="site-main <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>eight-col <?php else : ?>twelve-col<?php endif; ?>"  role="main">

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php echo Realia_Template_Loader::load( 'content-property' ); ?>
			<?php endwhile; ?>

			<?php the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'realest' ),
				'next_text'          => __( 'Next page', 'realest' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'realest' ) . ' </span>',
			) ); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		
	
		</main><!-- #main -->
     	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="secondary" class="widget-area four-col" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
		<?php else : ?>
		<?php endif; ?>
	</div><!-- #primary -->
	</div><!-- /.content -->


<?php get_footer(); ?>
