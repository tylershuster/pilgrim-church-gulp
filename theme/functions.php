<?php
/**
 * Theme Functions &
 * Functionality
 *
 */


/* =========================================
		ACTION HOOKS & FILTERS
   ========================================= */

/**--- Actions ---**/

add_action( 'after_setup_theme',  'theme_setup' );

add_action( 'wp_enqueue_scripts', 'theme_styles' );

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/**--- Filters ---**/



/* =========================================
		HOOKED Functions
   ========================================= */

/**--- Actions ---**/


/**
 * Setup the theme
 *
 * @since 1.0
 */
function theme_setup() {

	// Let wp know we want to use html5 for content
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption'
	) );


	// Let wp know we want to use post thumbnails

	add_theme_support( 'post-thumbnails' );



	// Register navigation menus for theme
	/*
	register_nav_menus( array(
		'primary' => 'Main Menu',
		'footer'  => 'Footer Menu'
	) );
	*/


	// Let wp know we are going to handle styling galleries
	/*
	add_filter( 'use_default_gallery_style', '__return_false' );
	*/


	// Stop WP from printing emoji service on the front
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );


	// Remove toolbar for all users in front end
	show_admin_bar( false );


	// Add Custom Image Sizes
	/*
	add_image_size( 'ExampleImageSize', 1200, 450, true ); // Example Image Size
	...
	*/


	// WPML configuration
	// disable plugin from printing styles and js
	// we are going to handle all that ourselves.
	define( 'ICL_DONT_LOAD_NAVIGATION_CSS', true );
	define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	define( 'ICL_DONT_LOAD_LANGUAGES_JS', true );


	// Contact Form 7 Configuration needs to be done
	// in wp-config.php. add the following snippet
	// under the line:
	// define( 'WP_DEBUG', false );
	/*
	//Contact Form 7 Plugin Configuration
	define ( 'WPCF7_LOAD_JS',  false ); // Added to disable JS loading
	define ( 'WPCF7_LOAD_CSS', false ); // Added to disable CSS loading
	define ( 'WPCF7_AUTOP',    false ); // Added to disable adding <p> & <br> in form output
	*/


	// Library Loader
	get_template_part( 'library/library-loader' );
	get_template_part( 'includes/includes-loader' );
}


/**
 * Register and/or Enqueue
 * Styles for the theme
 *
 * @since 1.0
 */
function theme_styles() {

	$theme_dir = get_template_directory_uri();

	wp_enqueue_style( 'main', "$theme_dir/assets/css/main.css", array(), null, 'all' );
}


/**
 * Register and/or Enqueue
 * Scripts for the theme
 *
 * @since 1.0
 */
function theme_scripts() {

	$theme_dir = get_template_directory_uri();

	wp_enqueue_script( 'main', "$theme_dir/assets/js/main.js", array(), null, true );
	// wp_enqueue_script( 'dropcap', "$theme_dir/assets/js/vendor/dropcap.js", array(), null, true );
}

add_action( 'after_setup_theme', 'pilgrim_register_menus' );

function pilgrim_register_menus() {

  register_nav_menu( 'main', __( 'Main Navigation', 'pilgrim' ) );

  register_nav_menu( 'footer', __( 'Footer Navigation', 'pilgrim' ) );

}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function pilgrim_widgets_init() {

	add_filter('widget_text', 'do_shortcode');

	register_sidebar( array(
		'name'          => 'Footer Widgets',
		'id'            => 'footer',
		'before_widget' => '<div class="footer__widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget__title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'pilgrim_widgets_init' );


function pilgrim_wp_title( $title, $sep ) {
	global $paged, $page;

	$title = str_replace( $sep, '', $title );

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= " $sep " . get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );

	if ( is_home() || is_front_page() )
		$title = get_bloginfo( 'name' );

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'pilgrim' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'pilgrim_wp_title', 99, 2 );

function data_uri( $site ) {

	switch( $site ) {

		case 'facebook':

			return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADkAAAA5CAYAAACMGIOFAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2hpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDowNTgwMTE3NDA3MjA2ODExODA4M0NDMTM4MEMyQTVFQiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpCOEE0QzYyREE2MTYxMUUyOEJFQUJDRTMzOERDQjM5MCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpCOEE0QzYyQ0E2MTYxMUUyOEJFQUJDRTMzOERDQjM5MCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M2IChNYWNpbnRvc2gpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6QUM3QUJGQTkzODIwNjgxMThDMTQ5OEFGOTgxQUJBQ0UiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MDU4MDExNzQwNzIwNjgxMTgwODNDQzEzODBDMkE1RUIiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz41CyRwAAAB3UlEQVR42mK0Dp/LzMDAUAzE6UCsxDB8wAsgngDEPSxAog6KhxuQAOIOIOZmAhJpDMMbpDJBfTycgQQTwwgAo54c9eSoJwcXYBl0DmJmYjDWlWIw05Vm0NcUZ5AQ4WXg52Vn+PX7DxD/Zfj89RfDz19/Gd5++M7w8s1XhvYZh4aOJxkZGRh8nTQYEoINGMSEuDDk2dlYwJiXmx3MV5QRANNDxpMgh9fm2DNYGcoMz+QqwMfBML3Rh0FWkm94FjxMTIwMrUXONPXggHsywFWTQV9DfPhWIawsTAzxgfrDu560NJJjEBbgHN71pIU+4ZJ05+F7DKu2X2V4+PQ9w4+ff4aeJzWUhPHK7zh0l6Fl2sGhnVzFRbnxyq/ffWPo50luTja88o+ffxj6ngS1UfGBf//+j/ZCRj056slRT46ODGCAIyuSKNK/Y14MQTUPn31kiC5aO7xj8sHTD8M/uT58+nH4e/LBkxEQkw+eDXNP/vv/n+HRcM+ToDFXYvuYQ9aTxJasNK0nbSLmUVSPeiQtYfjy7ddoi2fUk6OeHPXkqCdHPTnqyVFPjnpy1JOjnhz15KgnRz056slRT1LBky+GuR9fgDw5e5h7cjZoIKsRiL8BcT7D8Fp0D98XAhBgADmobvcuZlasAAAAAElFTkSuQmCC";

		break;

		case "twitter":

			return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADkAAAA6CAYAAAAKjPErAAAAAXNSR0IArs4c6QAAAAlwSFlzAAAuIwAALiMBeKU/dgAABCZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IlhNUCBDb3JlIDUuNC4wIj4KICAgPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICAgICAgPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIKICAgICAgICAgICAgeG1sbnM6dGlmZj0iaHR0cDovL25zLmFkb2JlLmNvbS90aWZmLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOmV4aWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vZXhpZi8xLjAvIgogICAgICAgICAgICB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iCiAgICAgICAgICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyI+CiAgICAgICAgIDx0aWZmOlJlc29sdXRpb25Vbml0PjI8L3RpZmY6UmVzb2x1dGlvblVuaXQ+CiAgICAgICAgIDx0aWZmOkNvbXByZXNzaW9uPjU8L3RpZmY6Q29tcHJlc3Npb24+CiAgICAgICAgIDx0aWZmOlhSZXNvbHV0aW9uPjMwMDwvdGlmZjpYUmVzb2x1dGlvbj4KICAgICAgICAgPHRpZmY6T3JpZW50YXRpb24+MTwvdGlmZjpPcmllbnRhdGlvbj4KICAgICAgICAgPHRpZmY6WVJlc29sdXRpb24+MzAwPC90aWZmOllSZXNvbHV0aW9uPgogICAgICAgICA8ZXhpZjpQaXhlbFhEaW1lbnNpb24+NTc8L2V4aWY6UGl4ZWxYRGltZW5zaW9uPgogICAgICAgICA8ZXhpZjpDb2xvclNwYWNlPjE8L2V4aWY6Q29sb3JTcGFjZT4KICAgICAgICAgPGV4aWY6UGl4ZWxZRGltZW5zaW9uPjU4PC9leGlmOlBpeGVsWURpbWVuc2lvbj4KICAgICAg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";

		break;

		case "instagram":

			return "data:image/png;base64,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";

		break;

		case "wordpress":

			return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2ZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDpGNzdGMTE3NDA3MjA2ODExOEY2MkRFNDY3Q0MwMjlCQSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo1MERBOTc2NkNEQzExMUUwOEVCQ0ZGQ0I0NzE3QjY2QSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo1MERBOTc2NUNEQzExMUUwOEVCQ0ZGQ0I0NzE3QjY2QSIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IE1hY2ludG9zaCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjAzODAxMTc0MDcyMDY4MTFBNjEzRDM1MUZDMzJCMTNCIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkY3N0YxMTc0MDcyMDY4MTE4RjYyREU0NjdDQzAyOUJBIi8+IDwvcmRmOkRlc2NyaXB0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";

		break;
	}
}