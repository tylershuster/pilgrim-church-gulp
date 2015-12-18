<?php
/**
 * Header file common to all
 * templates
 *
 */
$menu_args = array(
	'theme_location' => 'main',
	'menu' => 'main',
	'menu_id' => '',
	'echo' => true,
	'walker' => ''
);

$sun_info = date_sun_info( time(), 40.583143, -122.412897 );

if( time() < $sun_info['sunrise'] || time() > $sun_info['sunset'] ) {
	$dayphase = 'nighttime';
} else {
	$dayphase = 'daytime';
}


?>
<!doctype html>
<html class="site <?php echo $dayphase; ?>" <?php language_attributes(); ?>>
<head>
	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<![endif]-->

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/favicon-194x194.png" sizes="194x194">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo get_bloginfo('url'); ?>/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<title><?php wp_title( '|' ); ?></title>

	<?php wp_head(); ?>
	<script async defer src="<?php echo get_template_directory_uri(); ?>/assets/js/core.js"></script>
</head>
<body <?php body_class( 'site__body' ); ?>>

	<nav class="site__social">
		<a href="tel:5302433121">530-243-3121</a>
		<a href="https://www.facebook.com/ReddingPilgrimUCC"><img width="24" height="24" src="<?php echo data_uri('facebook'); ?>" /></a>
		<a href="https://twitter.com/PilgrimUCCRedd"><img width="24" height="24" src="<?php echo data_uri('twitter'); ?>"></a>
		<a href="https://instagram.com/pilgrimchurchredding/"><img width="24" height="24" src="<?php echo data_uri('instagram'); ?>" /></a>
		<?php if( is_user_logged_in() ): ?><a href="<?php if( current_user_can( 'edit_pages') && is_singular() ) { echo get_edit_post_link(); } else { echo admin_url(); } ?>"><img width="24" height="24" src="<?php echo data_uri( 'wordpress' ); ?>" /></a><?php endif; ?>
	</nav>

	<header class="site__body__header">
		<a class="header__title" href="<?php echo get_bloginfo('url'); ?>">
			<h1>Redding Pilgrim<br />Congregational Church, UCC</h1>
		</a>
		<nav class="header__nav"><?php wp_nav_menu( $menu_args ); ?></nav>
	</header>

	<main class="site__body__main">