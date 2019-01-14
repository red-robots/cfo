<?php
/**
 * Template Name: Our Values
 */

get_header(); 
$banner = get_field('banner_image'); ?>

<div id="primary" class="full-content-area clear nopadbottom">
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


		<?php
			$values_description = get_field('values_description');
			$values = get_field('values');
		?>
		<div class="values-section clear">
			<div class="description">
				<div class="inside clear">
					<?php echo $values_description; ?>
				</div>
			</div>
			<div class="values">
				<?php if($values) { ?>
				<ul class="list">
					<?php foreach($values as $v) { ?>
						<li><?php echo $v['value']; ?></li>
					<?php } ?>
				</ul>
				<?php } ?>
			</div>
		</div>
	</main><!-- #main -->

	<?php
		$bottom_title1 = get_field('title_1');
		$bottom_title2 = get_field('title_2');
		$bottom_button_label = get_field('button_label');
		$bottom_button_link = get_field('button_link');
		$background_image = get_field('background_image');
		$bottom_bg = '';
		if($background_image) {
			$bottom_bg = ' style="background-image:url('.$background_image['url'].')"';
		}
	?>
	<?php if($bottom_title1 || $bottom_title2) { ?>
	<div class="bottom-info clear"<?php echo $bottom_bg?>>
		<div class="pad clear">
			<h2 class="title1"><?php echo $bottom_title1; ?></h2>
			<p class="title2"><?php echo $bottom_title2; ?></p>
			<?php if($bottom_button_label && $bottom_button_link) { ?>
			<div class="button">
				<a class="btn" href="<?php echo $bottom_button_link;?>"><?php echo $bottom_button_label;?></a>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>

	
</div><!-- #primary -->

<?php
get_footer();
