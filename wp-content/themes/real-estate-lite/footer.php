<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package realest
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="col-center bottom-border">

	<div class="<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>three-col <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>

	<div class="<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>three-col <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div>

	<div class="<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>three-col <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div>

	<div class="<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>three-col <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-4' ); ?>
	</div>
	</div><!--col center-->
	<div class="col-center">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'realest' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'realest' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'realest' ), 'realest', '<a href="http://thepixeltribe.com" rel="designer"> The Pixel Tribe</a>' ); ?>
		</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
