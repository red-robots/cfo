<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */
get_header(); 
global $post;
$pageID = $post->ID;
$post_type = get_post_type(); 
$banner = ''; 
$news_page_title = '';
$post_class ='full-content-area clear'; ?>
<?php if($post_type=='post') { 
	$post_class = 'content-area';
	$news_page_id = get_page_id_by_template('page-news');
	// $news_page_title = get_the_title($news_page_id);
	// $new_page_link = get_permalink($news_page_id);
	// $banner = get_field('banner_image');
	$default_news_banner = get_field('news_post_banner',$news_page_id);
	$post_thumbnail_id = get_post_thumbnail_id( $pageID );
	$featImage = wp_get_attachment_image_src($post_thumbnail_id,'large');

	if($featImage) {
		$banner = $featImage[0];
	} else {
		$banner = $default_news_banner['url'];
	}

	$styleBg = ($banner) ? ' style="background-image:url('.$banner.')"' : '';

	if($banner) { ?>
		<div class="subpage-banner post-banner"<?php echo $styleBg;?>>
			<img style="display:none" class="banner-image" src="<?php echo $banner?>" alt="" />
			<div class="titlediv">
				<h1 class="page-title full-wrapper"><span><?php echo get_the_title();?></span></h1>
			</div>
		</div>
	<?php } ?>
<?php } ?>

	<div id="primary" class="mid-wrapper clear <?php echo ($banner) ? 'has-banner':'no-banner';?>">
		<?php if($post_type=='post' && $news_page_title) {  ?>
			<div class="breadcrumb mid-wrapper clear" style="display:none;">
				<a href="<?php echo $new_page_link?>"><?php echo $news_page_title?></a>
				<span class="sep">/</span>
				<span class="active"><?php echo get_the_title();?></span>
			</div>
		<?php } ?>

		<main id="main" class="content-sidebar" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
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
			<?php endwhile; ?>
		</main><!-- #main -->

		<div class="sidebar right">
			<?php get_sidebar(); ?>
		</div>
	</div><!-- #primary -->

<?php
get_footer();
