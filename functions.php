<?php
/**
 * creativedevelopment functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package creativedevelopment
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function creativedevelopment_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on creativedevelopment, use a find and replace
		* to change 'creativedevelopment' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'creativedevelopment', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'creativedevelopment' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'creativedevelopment_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'creativedevelopment_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function creativedevelopment_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'creativedevelopment_content_width', 640 );
}
add_action( 'after_setup_theme', 'creativedevelopment_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function creativedevelopment_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'creativedevelopment' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'creativedevelopment' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'creativedevelopment_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function creativedevelopment_scripts() {
	wp_enqueue_style( 'creativedevelopment-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'creativedevelopment-style', 'rtl', 'replace' );

	wp_enqueue_script( 'creativedevelopment-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'creativedevelopment_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

wp_register_script( 'threejs', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js', null, null, true );
wp_enqueue_script('Threejs');


function custom_recent_posts() {
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 5, // Number of recent posts to display
		'orderby' => 'date', // Order by post date
		'order' => 'ASC'
	);
	$recent_posts = new WP_Query($args);

	if ($recent_posts->have_posts()) {
		echo "<div id='service'>";
		while ($recent_posts->have_posts()) {
			$recent_posts->the_post();
			$post_id = get_the_ID();
			$tags = get_the_tags(); // Retrieve the tags for the post
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
			echo '<section class="service service-'.$tag_classes.' sticky"><article>';
			echo '<div class="canvas-container">';
			echo '<div class="canvas" id="'.$canvasType.'"></div>';
			echo '</div>';
			echo '<div class="text">';
			echo '<h2><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
			echo '<p>' . get_the_excerpt() . '</p>';
			echo '<a href="' . get_the_permalink() . '">Leia mais sobre ' . get_the_title() . '</a>';
			echo '</div>';
			echo '</article></section>';
		}
		echo "</div>";
	}

	wp_reset_postdata();
}

 