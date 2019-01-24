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

	<?php get_template_part("template-parts/bottom-info"); ?>

	
</div><!-- #primary -->

<?php
get_footer();
