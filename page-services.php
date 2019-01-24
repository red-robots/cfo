<?php
/**
 * Template Name: Services
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
		$args = array(
			'posts_per_page'   => -1,
			'orderby'          => 'menu_order',
			'order'            => 'ASC',
			'post_type'        => 'services',
			'post_status'      => 'publish'
		);
		$items = new WP_Query($args);
		if ( $items->have_posts() ) { ?>
		<div class="about-texts clear">
			<?php while ( $items->have_posts() ) : $items->the_post(); 
				$post_id = get_the_ID();
				$post_title = get_the_title();
				$row_title = title_formatter($post_title);
				$content = get_field('short_description',$post_id);
				?>
				<div class="textwrap clear">
					<div class="title">
						<h3 class="row-title"><?php echo $row_title;?></h3>
					</div>
					<div class="text">
						<div class="pad">
							<?php echo $content; ?>
							<div class="button reverse-button">
								<a class="btn xs" href="<?php the_permalink();?>">Learn More</a>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php } ?>
	</main><!-- #main -->

	<?php get_template_part("template-parts/bottom-info"); ?>
</div><!-- #primary -->

<?php
get_footer();
