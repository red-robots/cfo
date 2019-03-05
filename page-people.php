<?php
/**
 * Template Name: People
 */

get_header(); 
$banner = get_field('banner_image'); ?>

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
						$team_link = get_permalink();
						?>
						<div id="team_<?php the_ID();?>" data-id="<?php the_ID();?>" class="team <?php echo ($photo) ? 'has-photo':'no-photo';?>">
							<div class="inside clear">
								<div class="photo">
									<a href="<?php echo $team_link ?>">
										<?php if($photo) { ?>
											<img src="<?php echo $photo['url'];?>" alt="<?php echo $photo['title'];?>" />
										<?php } else { ?>
											<img src="<?php echo get_bloginfo('template_url')?>/images/nophoto.jpg" alt="" />
										<?php } ?>
									</a>
								</div>
								<a class="info" href="<?php echo $team_link ?>">
									<h3><?php echo $team_name; ?></h3>
									<?php if($team_title) { ?>
									<span class="jobtitle"><?php echo $team_title; ?></span>
									<?php } ?>
									<span class="buttondiv">
										<span class="pagelink">Bio</span>
									</span>
								</a>
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
