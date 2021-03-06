<?php
/**
 * The template for displaying news article post.
 *
 */
get_header(); 
global $post;
$pageID = $post->ID;
$post_type = get_post_type(); 
$banner = ''; 
$news_page_title = '';
$post_class ='full-content-area clear'; 
$post_class = 'content-area';
$news_page_id = get_page_id_by_template('page-news');
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


	<div id="primary" class="mid-wrapper clear <?php echo ($banner) ? 'has-banner':'no-banner';?>">
		<main id="main" class="content-sidebar" role="main">
			<?php while ( have_posts() ) : the_post(); 
				$custom_post_date = get_field('date_subtitle');	 ?>
				<?php if($banner) { ?>
					<div class="entry-content">
						<?php the_content();?>
					</div>
				<?php } else { ?>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title();?></h1>
						<?php if ($custom_post_date) { ?>
						<div class="date"><?php echo $custom_post_date; ?></div>
						<?php } ?>
					</header>
					<div class="entry-content">
						<?php the_content();?>
					</div>
				<?php } ?>

				<div class="post-sharer clear">
					<a class="linkedin" target="popup" data-href="https://www.linkedin.com/cws/share?url=<?php echo get_permalink(); ?>" onclick="javascript:window.open(this.dataset.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="icon fab fa-linkedin"></span></a>
					<a class="twitter" data-href="https://twitter.com/share?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo get_permalink(); ?>" rel="nofollow" onclick="javascript:window.open(this.dataset.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="icon fab fa-twitter-square"></span></a>
					<a class="facebook" target="_blank" data-href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" onclick="javascript:window.open(this.dataset.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="icon fab fa-facebook"></span></a>
					<a class="email" href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_permalink(); ?>"><span class="icon fas fa-envelope-square"></span></a>
				
					<?php 
					$printable_version = get_field('printable_version');
					if($printable_version) { ?>
					<a class="print" target="_blank" title="Printable Version" href="<?php echo $printable_version['url'];?>"><span class="icon fas fa-print"></span></a>
					<?php } ?>
				</div>

			<?php endwhile; ?>

			

		</main><!-- #main -->

		<div class="sidebar right">
			<?php get_template_part("sidebar-post-archives"); ?>
		</div>
	</div><!-- #primary -->

<?php
get_footer();
