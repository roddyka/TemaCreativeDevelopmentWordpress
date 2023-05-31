<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package creativedevelopment
 */

?>


	<footer id="colophon" class="site-footer sticky">
		<section id="contact" class="contact full-screen">
            <a href=""><?php 
$admin_email = get_option( 'admin_email' );  echo $admin_email ?></a>
			<div class="site-info" style="display:flex">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'creativedevelopment' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'creativedevelopment' ), 'Rodrigo Antunes' );
					?>
				</a>
				<span class="sep"> | </span>
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'creativedevelopment' ), 'creativedevelopment', '<a href="http://underscores.me/">Underscores.me</a>' );
					?>
			</div><!-- .site-info -->
        </section>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
