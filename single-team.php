<?php
/**
 * The template for displaying team single post.
 *
 */
get_header(); 
?>

	<div id="primary" class="mid-wrapper clear staff_information">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
				$job_title = get_field('team_title'); 
				$photo = get_field('team_photo');
				$phone_number = get_field('phone_number');
				$email_address = get_field('email_address');
				$address = get_field('address',$post_id);
				$has_info = ($photo || $phone_number || $email_address || $address) ? true : false;
			?>
			<main id="main" class="content-sidebar" role="main">
				<header class="titlediv">
					<h2 class="ptitle"><?php the_title(); ?></h2>
					<div class="jobtitle"><?php echo $job_title;?></div>
				</header>

				<?php if($has_info) { ?>
					<div class="imageContainer small-screen">
						<?php if($photo) { ?>
						<img class="featured-image" src="<?php echo $photo['url']?>" alt="<?php echo $photo['title']?>" />
						<?php } ?>

						<div class="contact-details clear">
							<?php if($phone_number) { ?>
								<div class="phone"><span class="label"><i class="fa fa-phone"></i></span><span class="value"><a href="tel:<?php echo format_phone_number($phone_number);?>"><?php echo $phone_number;?></a></span></div>
							<?php } ?>

							<?php if($email_address) { ?>
								<div class="email"><span class="label"><i class="fa fa-envelope"></i></span><span class="value"><a href="mailto:<?php echo $email_address;?>"><?php echo $email_address;?></a></span></div>
							<?php } ?>

							<?php if($address) { ?>
								<div class="address"><span class="label"><i class="fa fa-map-marker-alt"></i></span><span class="value"><?php echo $address;?></span></div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>

				<?php the_content();?>
			</main><!-- #main -->

			<?php if($has_info) { ?>
				<div class="imageContainer large-screen">
					<?php if($photo) { ?>
					<img class="featured-image" src="<?php echo $photo['url']?>" alt="<?php echo $photo['title']?>" />
					<?php } ?>

					<div class="contact-details clear">
						<?php if($phone_number) { ?>
							<div class="phone"><span class="label"><i class="fa fa-phone"></i></span><span class="value"><a href="tel:<?php echo format_phone_number($phone_number);?>"><?php echo $phone_number;?></a></span></div>
						<?php } ?>

						<?php if($email_address) { ?>
							<div class="email"><span class="label"><i class="fa fa-envelope"></i></span><span class="value"><a href="mailto:<?php echo $email_address;?>"><?php echo $email_address;?></a></span></div>
						<?php } ?>

						<?php if($address) { ?>
							<div class="address"><span class="label"><i class="fa fa-map-marker-alt"></i></span><span class="value"><?php echo $address;?></span></div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		<?php endwhile; ?>
	</div><!-- #primary -->

<?php
get_footer();
