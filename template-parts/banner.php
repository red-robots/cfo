<?php
if( is_front_page() ) {
	$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'homepage'));
	if ( have_posts() ) : the_post();  
	$banner = get_field('banner_image_homepage');
	$tagline1 = get_field('tagline_1');
	$tagline2 = get_field('tagline_2');
	
	if($banner) { ?>
	<div class="banner-wrap clear">
		<div class="banner-image clear">
			<img src="<?php echo $banner['url']?>" alt="<?php echo $banner['title']?>" />
		</div>
		<div class="banner-caption">
			<?php if($tagline1) { ?>
			<div class="tagline1"><?php echo $tagline1;?></div>
			<?php } ?>
			<?php if($tagline2) { ?>
			<div class="tagline2"><?php echo $tagline2;?></div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>

	<?php endif; ?>
<?php } else { ?>

	<?php $post_type = get_post_type(); 
	if($post_type=='page') { 
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

<?php } ?>