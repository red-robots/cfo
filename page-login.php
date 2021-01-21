<?php
/**
 * Template Name: Client Login
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

			<?php 
				$login_main_title = get_field('login_title'); 
				$login_title1 = get_field('link_one_title'); 
				$login_link1 = get_field('link_one_url'); 
				$login_title2 = get_field('link_2_title'); 
				$login_link2 = get_field('link_2_url'); 
				$login_title3 = get_field('link_3_Title'); 
				$login_link3 = get_field('link_3_url'); 
			?>

			<?php if($login_main_title) { ?>
				<h2 class="login-title"><span class="icon"><i class="fas fa-lock"></i></span><?php echo $login_main_title;?></h2>
			<?php } ?>

			<div class="login-options clear">
				<div class="row clear">
				<?php if($login_title1 && $login_link1) { ?>
					<div class="login-btn login1">
						<div class="inside clear">
							<a href="<?php echo $login_link1;?>" target="_blank">
								<?php echo $login_title1;?>
								<span class="icon"><i class="fa fa-chevron-right"></i></span>
							</a>
						</div>
					</div>
				<?php } ?>
				<?php if($login_title2 && $login_link2) { ?>
					<div class="login-btn login2">
						<div class="inside clear">
							<a href="<?php echo $login_link2;?>" target="_blank">
								<?php echo $login_title2;?>
								<span class="icon"><i class="fa fa-chevron-right"></i></span>
							</a>
						</div>
					</div>
				<?php } ?>
				<?php if($login_title3 && $login_link3) { //?>
					<div class="login-btn login2">
						<div class="inside clear">
							<a href="<?php echo $login_link3;?>" target="_blank">
								<?php echo $login_title3;?>
								<span class="icon"><i class="fa fa-chevron-right"></i></span>
							</a>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>

		<?php endwhile; ?>
	</main><!-- #main -->

	
</div><!-- #primary -->

<?php
get_footer();
