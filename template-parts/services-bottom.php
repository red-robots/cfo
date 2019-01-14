<?php
$page_id = get_page_id_by_template('page-services');
$bottom_title1 = get_field('title_1',$page_id);
$bottom_title2 = get_field('title_2',$page_id);
$bottom_button_label = get_field('button_label',$page_id);
$bottom_button_link = get_field('button_link',$page_id);
$background_image = get_field('background_image',$page_id);
$bottom_bg = '';
if($background_image) {
	$bottom_bg = ' style="background-image:url('.$background_image['url'].')"';
}
?>
<?php if($bottom_title1 || $bottom_title2) { ?>
<div class="bottom-info clear"<?php echo $bottom_bg?>>
	<div class="pad clear">
		<h2 class="title1"><?php echo $bottom_title1; ?></h2>
		<?php if($bottom_title2) { ?>
		<p class="title2"><?php echo $bottom_title2; ?></p>
		<?php } ?>
		<?php if($bottom_button_label && $bottom_button_link) { ?>
		<div class="button">
			<a class="btn" href="<?php echo $bottom_button_link;?>"><?php echo $bottom_button_label;?></a>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>