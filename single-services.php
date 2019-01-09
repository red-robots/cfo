<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */

get_header(); 
$page_id = get_page_id_by_template('page-services');
$banner = get_field('banner_image',$page_id);
if($banner) { ?>
<div class="subpage-banner">
	<img class="banner-image" src="<?php echo $banner['url']?>" alt="" />
	<div class="titlediv">
		<h1 class="page-title full-wrapper"><span><?php echo get_the_title();?></span></h1>
	</div>
</div>
<?php } ?>
	<div id="primary" class="full-content-area clear nopadbottom">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php if(get_the_content()) { ?>
			<div class="mid-wrapper clear">
				<div class="entry-content">
					<?php //the_content();?>
				</div>
			</div>
			<?php } ?>

			<div class="mid-wrapper clear">
				<?php $rows1 = get_field('row_1_content'); ?>
				<?php if($rows1) { ?>
					<div class="contentrow clear">	
						<?php foreach($rows1 as $rr) { 
							$title1 = $rr['title'];
							$content1 = $rr['content'];
							$colClass = 'full';
							if($title1 && $content1) {
								$colClass = 'columned';
							}
							else if(empty($title1) && $content1) {
								$colClass = 'full';
							}

							$section_title = title_formatter($title1);
							?>	

							<div class="textwrap clear <?php echo $colClass?>">
								<?php if($title1) { ?>
								<div class="titlediv col"><div class="pad clear"><h3 class="row-title"><?php echo $section_title; ?></h3></div></div>
								<?php } ?>
								<?php if($content1) { ?>
								<div class="contentdiv col"><div class="pad clear"><?php echo $content1; ?></div></div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<?php 
					$row_2_title = get_field('row_2_title'); 
					$row_2_bg = get_field('row_2_bg_image'); 
					$row_2_contents = get_field('row_2_content'); 
					$row2BgStyle = '';
					if($row_2_bg) {
						$row2BgStyle = ' style="background-image:url('.$row_2_bg['url'].')"';
					}
				?>
			</div>

			<?php if($row_2_title) { ?>
				<div class="divBgImg clear"<?php echo $row2BgStyle;?>>
					<div class="mid-wrapper clear">
						<div class="title2"><?php echo $row_2_title;?></div>
					</div>
				</div>
			<?php } ?>

			<?php if($row_2_contents) { 
				$total_rows = count($row_2_contents); 
				$divClass = 'twoCol';
				if($total_rows==1) {
					$divClass = 'full';
				}
				elseif($total_rows==3) {
					$divClass = 'threeCol';
				}
				?>
				<div class="mid-wrapper row2content clear <?php echo $divClass;?>">
					<div class="row clear">
					<?php foreach($row_2_contents as $rc) { 
						$title2 = $rc['title'];
						$content2 = $rc['content'];
						?>
						<div class="group">
							<div class="pad clear">
								<?php if($title2) { ?>
									<h2 class="title"><?php echo $title2; ?></h2>
								<?php } ?>
								<?php if($content2) { ?>
									<div class="text"><?php echo $content2; ?></div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
			<?php } ?>


			<?php 
				$row_3_title = get_field('row_3_title'); 
				$row_3_bg = get_field('row_3_bg_image'); 
				$row3BgStyle = '';
				if($row_3_bg) {
					$row3BgStyle = ' style="background-image:url('.$row_3_bg['url'].')"';
				}
				$row_3_content = get_field('row_3_content'); 
			?>

			<?php if($row_3_title) { ?>
				<div class="divBgImg clear"<?php echo $row3BgStyle;?>>
					<div class="mid-wrapper clear">
						<div class="title2"><?php echo $row_3_title;?></div>
					</div>
				</div>
			<?php } ?>

			<?php if($row_3_content) { ?>
				<div class="mid-wrapper bottomtext clear">
					<?php echo $row_3_content;?>
				</div>
			<?php } ?>

		<?php endwhile; ?>
	</div><!-- #primary -->

<?php
get_footer();
