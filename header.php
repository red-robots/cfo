<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
<?php wp_head(); ?>
</head>
<?php
$logo = get_custom_logo();
$classes[] = ( is_front_page()  ) ? 'homepage':'subpage';
$client_login_title = get_field('client_login_title','options');
$client_login_link = get_field('client_login_link','options');
?>
<body <?php body_class($classes); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'acstarter' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper">
			
			<div class="logo">
				<?php if($logo) { ?>
					<?php if(is_front_page() ) { ?>
						<?php echo $logo; ?>
					<?php } else { ?>
						<a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_bloginfo('template_url')?>/images/logo-subpage.png" alt="<?php bloginfo('name'); ?>" itemprop="logo"/></a>
					<?php } ?>
				<?php } else { ?>
					<h2 class="logo-name"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h2>
				 <?php } ?>	
			</div>

			<?php if($client_login_title && $client_login_link) { ?>
			<div class="clientLogin">
				<a href="<?php echo $client_login_link;?>"><?php echo $client_login_title;?></a>
			</div>
			<?php } ?>	

			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span></span></button>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
			<nav id="site-mobile-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'mobile-primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
	</div><!-- wrapper -->
	</header><!-- #masthead -->

	<?php get_template_part("template-parts/banner"); ?>

	<div id="content" class="site-content">


