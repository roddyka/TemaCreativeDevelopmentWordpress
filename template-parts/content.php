<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package creativedevelopment
 */

 	$tags = get_the_tags(the_ID()); // Retrieve the tags for the post
	$tag_classes = '';
	$canvasType = '';
	if ($tags) {
		foreach ($tags as $tag) {
			$tag_classes .=  $tag->slug;
		}
	}

	if($tag_classes == 'html'){
		$canvasType = 'box-canvas';
	}
	if($tag_classes == 'css'){
		$canvasType = 'pyramid-canvas';
	}
	if($tag_classes == 'js'){
		$canvasType = 'circle-canvas';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("article_new"); ?>>
<div class="article_content_new">	
	<header class="entry-header <?php echo $canvasType;?>">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title ">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
		</header><!-- .entry-header -->

		<?php creativedevelopment_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'creativedevelopment' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'creativedevelopment' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div>
	<footer class="entry-footer article_content_footer  <?php echo $canvasType;?>">
		<?php 
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				creativedevelopment_posted_on();
				creativedevelopment_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; 
		?>
		<?php creativedevelopment_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
