<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package creativedevelopment
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php if(is_front_page()){ ?>
	<section id="about" class="about " >
            <div id="empty" class="empty"></div>
            <article >
                <div class="title">
                    <h1>Creative Developer</h1>
                </div>
                <div class="description">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing 
                        elit, sed do eiusmod tempor incididunt ut labore et 
                        dolore magna aliqua. Ut enim ad minim veniam, quis 
                        nostrud exercitation ullamco laboris nisi ut aliquip</p>
                </div>
            </article>
        </section>
		<?php custom_recent_posts(); ?>
		<?php } else { ?>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

	}
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
