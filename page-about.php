<?php
/**
 * Template Name: About
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
				$button_label = $row['button_label'];
				$button_link = $row['button_link'];
				$str = $row['title'];
				$parts = explode(' ',trim($str));
				$count_str = count($parts);
				$offset = ceil($count_str/2);
				$row_title = '<span>';
				$i=1; foreach($parts as $a) {
					$comma = ($i>1) ? ' ' : '';
					if($i<=$offset) {
						$row_title .= $comma . $a;
						if($i==$offset) {
							$row_title .= '</span>';
						}
					} else {
						$row_title .= $comma . $a;
					}
					$i++;
				}
				$row_title = trim($row_title);
				$row_title = preg_replace('/\s+/', ' ', $row_title);
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
	$footnote = get_field('footnote');
	?>
	<?php if($title4) { ?>
	<div class="section4-title clear">
		<div class="mid-wrapper clear"><h2 class="title"><?php echo $title4;?></h2></div>
	</div>
	<div class="section4-content mid-wrapper clear">
		<div class="mid-content-wrap clear">
			<div class="text-content text-justify"><?php echo $content4?></div>
			<?php if($button_label4 && $button_link4) { ?>
			<div class="button text-center">
				<a class="btn xs" href="<?php echo $button_link4?>"><?php echo $button_label4?></a>
			</div>
			<?php } ?>

			<?php if($footnote) { ?>
			<div class="footnote"><?php echo $footnote; ?></div>
			<?php } ?>
		</div>
	</div>

	<?php } ?>	
</div><!-- #primary -->

<?php
get_footer();
