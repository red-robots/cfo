<?php
/**
 * Template Name: News
 */

get_header(); 
$banner = get_field('banner_image');
if($banner) { ?>
<div class="subpage-banner">
	<img class="banner-image" src="<?php echo $banner['url']?>" alt="" />
	<div class="titlediv">
		<h1 class="page-title full-wrapper"><span><?php echo get_the_title();?></span></h1>
	</div>
</div>
<?php } ?>

	<div id="primary" class="full-content-area nopadding clear">
		<?php if( get_the_content() ) { ?>
		<main id="main" class="site-main mid-wrapper clear" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="mid-content-wrap clear text-center large-text width50">
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
		<?php } ?>

		<?php
		$categories = get_posts_by_categories('category',3);
		if( $categories ) {  ?>
		<div class="category-list clear">
			<?php $c=1; foreach($categories as $cat) { 
				$category_name = $cat['term_name']; 
				$the_posts = $cat['posts'];  ?>
				<div class="category clear<?php echo ($c==1) ? ' first':'';?>">
					<header class="category-name">
						<h2><?php echo $category_name; ?></h2>
					</header>
					<?php if($the_posts) { ?>
					<div class="mid-wrapper clear">
						<div class="the-posts clear">
							<?php foreach($the_posts as $p) {
								$post_id = $p->post_id;
								$thumbnail_id = get_post_thumbnail_id($post_id);
								$feat_image = wp_get_attachment_image_src($thumbnail_id,'large');
								$post_title = get_the_title($post_id);
								$data = get_post($post_id);
								$post_title = $data->post_title;
								$content = $data->post_content;
								$excerpt = shortenText($content,300," ");
								$excerpt = strip_tags($excerpt);
								$post_date = $data->post_date;
								$the_post_date = date('F Y',strtotime($post_date));		
								$pagelink = get_permalink($post_id);						
							?>
							<div class="post-entry">
								<div class="inner-pad clear">
									<div class="inside clear">
										<?php if($feat_image) { ?>
										<div class="featimage" style="background-image:url('<?php echo $feat_image[0]?>')"></div>
										<?php } ?>
										<div class="textwrap clear">
											<header class="post-info">
												<h3 class="post-title"><?php echo $post_title; ?></h3>
												<div class="date"><?php echo $the_post_date; ?></div>
											</header>
											<p class="excerpt"><?php echo $excerpt; ?></p>
											<div class="buttondiv text-center">
												<a class="btn" href="<?php echo $pagelink; ?>">Read More</a>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
			<?php $c++; } ?>
		</div>
		<?php } ?>

	</div><!-- #primary -->

<?php
get_footer();
