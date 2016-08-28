<?php
/**
* Template name: Blog
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package realest
 */

get_header(); realeast_page_title();?>

	<div id="primary" class="content-area col-center">
	
		<main id="main" class="site-main eight-col" role="main">
		<?php
		$post = array(
			'post_type' => 'post',
			);
		$post_query = new WP_Query( $post );


		if ( $post_query->have_posts() ) {
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
			
				 get_template_part( 'template-parts/content' ); 

			}} else {
				//no posts
			}
			wp_reset_postdata(); 
			 ?>
		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->


<?php get_footer(); ?>
