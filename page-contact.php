<?php
/**
 * Template Name: Contact Us
 */

get_header(); 
$banner = get_field('banner_image'); ?>

<div id="primary" class="full-content-area clear contact-content">
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
			$section_1_title = get_field('section_1_title');
			$phone_title = get_field('phone_title');
			$phone_number = get_field('phone');
			$email_title = get_field('email_title');
			$email = get_field('email');
		?>
		<div class="contact-info text-center">

			<div class="section-one clear">
				<?php if($section_1_title) { ?>
				<h2 class="section-title"><span class="span"><?php echo $section_1_title; ?></span></h2>
				<?php } ?>

				<?php if($phone_title && $phone_number) { ?>
				<div class="row-info clear">
					<div class="info value fullwidth"><span><?php echo $phone_number; ?></span></div>
				</div>
				<?php } ?>

				<?php if($email_title && $email) { ?>
				<div class="row-info clear">
					<div class="info value fullwidth"><span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span></div>
				</div>
				<?php } ?>
			</div>

			<?php
				$section_2_title = get_field('section_2_title');
				$charlotte_location_title = get_field('charlotte_location_title');
				$charlotte_location_address = get_field('charlotte_location_address');
				$charlotte_map = get_field('charlotte_map');
				$charlotte_google_map_link = get_field('charlotte_google_map_link');

				$chapel_hill_location_title = get_field('chapel_hill_location_title');
				$chapel_hill_location_address = get_field('chapel_hill_location_address');
				$chapel_hill_map = get_field('chapel_hill_map');
				$chapel_hill_google_map_link = get_field('chapel_hill_google_map_link');

				$address[] = array(
							'title'=>$charlotte_location_title,
							'address'=>$charlotte_location_address,
							'map_image'=>$charlotte_map,
							'map_link'=>$charlotte_google_map_link
						);

				$address[] = array(
							'title'=>$chapel_hill_location_title,
							'address'=>$chapel_hill_location_address,
							'map_image'=>$chapel_hill_map,
							'map_link'=>$chapel_hill_google_map_link
						);
			?>

			<div class="section-two clear">
				<?php if($section_2_title) { ?>
				<h2 class="section-title"><span class="span"><?php echo $section_2_title; ?></span></h2>
				<?php } ?>

				<div class="locations clear">
					<?php foreach($address as $a) { 
						$title = $a['title'];
						$address_text =  $a['address'];
						$map_image = ( $a['map_image'] ) ? $a['map_image']['url'] : get_bloginfo('template_url').'/images/unknown-map.jpg';
						$map_link = ( $a['map_link'] ) ? $a['map_link'] : '#';
						if($title && $address_text) {  ?>
						<div class="office">
							<div class="inside clear">
								<div class="name"><?php echo $title;?></div>
								<div class="map-image"><img src="<?php echo $map_image;?>" alt="" /></div>
								<div class="address"><?php echo $address_text;?></div>
								<div class="link">
									<a href="<?php echo $map_link;?>" target="_blank">Get Directions <span class="icon"><i class="fa fa-chevron-right"></i></span></a>
								</div>
							</div>
						</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>

		</div>
	</main><!-- #main -->

	<?php 
		$section_3_title = get_field('section_3_title');
		$section_3_description = get_field('section_3_description');
		$section_3_button_text = get_field('section_3_button_text');
		$section_3_link = get_field('section_3_link');
		$section_3_image = get_field('section_3_image');
	?>
	<div class="contact-bottom clear text-center">
		<div class="text clear">
		<?php if($section_3_title) { ?>
			<h2 class="section-title"><?php echo $section_3_title; ?></h2>
		<?php } ?>
		<?php if($section_3_description) { ?>
			<div class="description"><?php echo $section_3_description; ?></div>
		<?php } ?>
		<?php if($section_3_button_text && $section_3_link) { ?>
			<div class="buttondiv">
				<a href="<?php echo $section_3_link; ?>"><?php echo $section_3_button_text; ?></a>
			</div>
		<?php } ?>
		</div>
		<?php if($section_3_image) { ?>
			<div class="bgImage" style="background-image:url('<?php echo $section_3_image['url']; ?>');"></div>
		<?php } ?>
	</div>

</div><!-- #primary -->

<?php
get_footer();
