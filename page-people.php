<?php
/**
 * Template Name: People
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

	<div id="primary" class="full-content-area clear">
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

			<?php
			$args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'menu_order',
				'order'            => 'ASC',
				'post_type'        => 'team',
				'post_status'      => 'publish'
			);
			$items = new WP_Query($args);
			if ( $items->have_posts() ) { ?>
			<div class="team-list clear">
				<div class="row clear">
					<?php while ( $items->have_posts() ) : $items->the_post();
						$photo = get_field('team_photo'); 
						$team_name = get_the_title();
						$team_title = get_field('team_title'); 
						?>
						<div id="team_<?php the_ID();?>" data-id="<?php the_ID();?>" class="team <?php echo ($photo) ? 'has-photo':'no-photo';?>">
							<div class="inside clear">
								<div class="photo">
								<?php if($photo) { ?>
									<img src="<?php echo $photo['url'];?>" alt="<?php echo $photo['title'];?>" />
								<?php } else { ?>
									<img src="<?php echo get_bloginfo('template_url')?>/images/nophoto.jpg" alt="" />
								<?php } ?>
								</div>
								<div class="info">
									<h3><?php echo $team_name; ?></h3>
									<?php if($team_title) { ?>
									<div class="jobtitle"><?php echo $team_title; ?></div>
									<?php } ?>
									<div class="buttondiv">
										<a class="pagelink">Bio</a>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<?php } ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
