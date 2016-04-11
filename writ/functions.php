<?php
/**
 * writ functions and definitions
 *
 * @package writ
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750; /* pixels */
}
function writ_content_width() {
	if ( is_page_template( 'template-full-width.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1000;
	}
}
add_action( 'template_redirect', 'writ_content_width' );

if ( ! function_exists( 'writ_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function writ_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on writ, use a find and replace
	 * to change 'writ' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'writ', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * Set post thumbnail size.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 'auto' );
	add_image_size( 'slider-thumbnail', 1000, 550, true ); // future use

	 // Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'link', 'quote', 'video' ) );

	// Switches default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'writ_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'writ' ),
					'secondary' => __( 'Secondary Menu', 'writ' ),
					'footer' => __('Footer Menu', 'writ')
 ) );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( array( 'editor-style.css', writ_font_url() ) );

	 // This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // writ_setup
add_action( 'after_setup_theme', 'writ_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function writ_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'writ' ),
		'id'            => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'First Footer Widget Area', 'writ' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Second Footer Widget Area', 'writ' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Third Footer Widget Area', 'writ' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'writ_widgets_init' );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Crimson Text by default is localized. For languages that use characters
 * not supported by the font, the font can be disabled.
 *
 * Returns the font stylesheet URL or empty string if disabled.
 */
function writ_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Crimson Text, translate these to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Crimson Text font: on or off', 'writ' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'PT Serif:400,700,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles
 */
function writ_scripts() {
	wp_enqueue_style( 'writ-serif', writ_font_url(), array(), null );
	wp_enqueue_style( 'writ-style', get_stylesheet_uri() );

	wp_enqueue_script( 'writ-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130728', true );
	wp_enqueue_script( 'writ-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20130728', true );
	// wp_enqueue_script( 'writ-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.1' );
	wp_enqueue_script( 'writ-keyboard-accessible-navigation', get_template_directory_uri() . '/js/keyboard-accessible-navigation.js', array( 'jquery' ), '20130729', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'writ_scripts' );

/**
 * Enqueue Google font style to admin screen for custom header display.
 *
 */
function writ_admin_font() {
	wp_enqueue_style( 'writ-serif', writ_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'writ_admin_font' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function writ_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'writ' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'writ_wp_title', 10, 2 );

/*
 */
function writ_img_caption_shortcode( $output, $atts, $content ) {
	/* We're not worried abut captions in feeds, so just return the output here. */
	if ( is_feed() )
		return $output;

	/* Set up the default arguments. */
	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);

	/* Merge the defaults with user input. */
	$attr = shortcode_atts( $defaults, $atts, 'caption' );

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	/* Set the width class: if the width is larger than 750, set it to 750 get the right styles. */
	if ( 750 <= $attr['width'] ) {
		$width_class = 750;
	} else {
		$width_class = $attr['width'] . ' smaller-than-750';
	}

	/* Set up the attributes for the caption <div>. */
	$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . ' width-' . esc_attr( $width_class ) . '"';
	$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

	/* Open the caption <div>. */
	$output = '<div' . $attributes .'>';

	/* Allow shortcodes for the content the caption was created for. */
	$output .= do_shortcode( $content );

	/* Append the caption text. */
	$output .= '<p class="wp-caption-text">' . $attr['caption'] . '</p>';

	/* Close the caption </div>. */
	$output .= '</div>';

	/* Return the formatted, clean caption. */
	return $output;
}
add_filter( 'img_caption_shortcode', 'writ_img_caption_shortcode', 10, 3 );

/**
 * Filters the HTML containing the attachment that is prepended to the post to use
 * the large image size (instead of the medium default).
 */
function writ_prepend_attachment( $prepend ) {
	$prepend = '<p class="attachment">';
	$prepend .= wp_get_attachment_link(0, 'large', false);
	$prepend .= '</p>';

	return $prepend;
}
add_filter( 'prepend_attachment', 'writ_prepend_attachment' );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function writ_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'writ_setup_author' );

/**
 * Returns true if a blog has more than 1 category.
 */
function writ_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so writ_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so writ_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in writ_categorized_blog.
 */
function writ_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'writ_category_transient_flusher' );
add_action( 'save_post',     'writ_category_transient_flusher' );

/**
*	Returns a "Read More" link for excerpts.
* @since writ 1.2
*/
function writ_excerpt_more( $more ) {
	return '<a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . __( 'Read more', 'writ' ) . '</a>';
}
add_filter( 'excerpt_more', 'writ_excerpt_more' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Jetpack setup
 */
require get_template_directory() . '/inc/jetpack.php';
