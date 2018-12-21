<?php
/**
 * Template Name: Why Us
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
			$items[] = array(
						'title' => get_field('section_1_title'),
						'content' => get_field('section_1_text'),
						'button_label' => '',
						'button_link'	=> ''
					);
			$items[] = array(
						'title' => get_field('section_2_title'),
						'content' => get_field('section_2_text'),
						'button_label' => '',
						'button_link'	=> ''
					);
			$items[] = array(
						'title' => get_field('section_3_title'),
						'content' => get_field('section_3_text'),
						'button_label' => '',
						'button_link'	=> ''
					);
			$items[] = array(
						'title' => get_field('section_4_title'),
						'content' => get_field('section_4_text'),
						'button_label' => '',
						'button_link'	=> ''
					);
			?>
			<div class="about-texts why-us clear">
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


</div><!-- #primary -->

<?php
get_footer();
