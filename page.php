<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
$banner = '';
if( !is_front_page() ) { 
	$banner = get_field('banner_image');
	if($banner) { ?>
	<div class="subpage-banner">
		<img class="banner-image" src="<?php echo $banner['url']?>" alt="" />
		<div class="titlediv">
			<h1 class="page-title full-wrapper"><span><?php echo get_the_title();?></span></h1>
		</div>
	</div>
	<?php } ?>
<?php } ?>

	<div id="primary" class="full-content-area clear">
		<main id="main" class="site-main mid-wrapper clear" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="mid-content-wrap clear text-center large-text">
					<?php if($banner) { ?>
						<div class="entry-content">
							<?php the_content();?>
						</div>
					<?php } else { ?>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title();?></h1>
						</header>
						<div class="entry-content">
							<?php the_content();?>
						</div>
					<?php } ?>
				</div>
			<?php endwhile; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
