<?php
/**
 * Template Name: About
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
			$items[] = array(
						'title' => get_field('section_1_title'),
						'content' => get_field('section_1_text'),
						'button_label' => '',
						'button_link'	=> ''
					);
			$items[] = array(
						'title' => get_field('section_2_title'),
						'content' => get_field('section_2_text'),
						'button_label' => get_field('section_2_link_text'),
						'button_link'	=> get_field('section_2_link')
					);
			$items[] = array(
						'title' => get_field('section_3_title'),
						'content' => get_field('section_3_text'),
						'button_label' => get_field('section_3_link_text'),
						'button_link'	=> get_field('section_3_link')
					);
			?>
			<div class="about-texts clear">
			<?php foreach($items as $row) { 
				$content = $row['content'];
				$str = $row['title'];
				$arr = explode(' ',trim($str));
				$row_title = '';
				$button_label = $row['button_label'];
				$button_link = $row['button_link'];

				$i=1; foreach($arr as $a) {
					if($i==1) {
						$row_title .= '<span>'.$a.'</span> ';
					} else {
						$row_title .= $a;
					}
					$i++;
				}
				?>
				<div class="textwrap clear">
					<div class="title">
						<h3 class="row-title"><?php echo $row_title;?></h3>
					</div>
					<div class="text">
						<div class="pad">
							<?php echo $content; ?>
							<?php if($button_label && $button_link) { ?>
							<div class="button">
								<a class="btn xs" href="<?php echo $button_link?>"><?php echo $button_label?></a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
		<?php endwhile; ?>
	</main><!-- #main -->

	<?php
	$title4 = get_field('section_4_title');
	$content4 = get_field('section_4_text');
	$button_label4 = get_field('section_4_link_text');
	$button_link4 = get_field('section_4_link');
	?>
	<?php if($title4) { ?>
	<div class="section4-title clear">
		<div class="mid-wrapper clear"><h2 class="title"><?php echo $title4;?></h2></div>
	</div>
	<div class="section4-content mid-wrapper clear text-justify">
		<div class="mid-content-wrap clear">
			<?php echo $content4?>
			<?php if($button_label4 && $button_link4) { ?>
			<div class="button">
				<a class="btn xs" href="<?php echo $button_link4?>"><?php echo $button_label4?></a>
			</div>
			<?php } ?>
		</div>
	</div>

	<?php } ?>	
</div><!-- #primary -->

<?php
get_footer();
