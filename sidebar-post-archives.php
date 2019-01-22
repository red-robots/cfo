<?php
$args = array(
		'posts_per_page'   => -1,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish'
		);
$posts = get_posts($args);
if($posts) { 
	$count_post = count($posts);
?>
<div class="post-sidebar<?php echo ($count_post>20) ? ' overflow':'';?>">
	<div class="titlediv"><span>News &amp; Insights Archive</span></div>
	<div class="archive-list clear">
		<ul class="post-listing">
		<?php $j=1; foreach($posts as $ar) {
			$post_id = $ar->ID; 
			$post_title = $ar->post_title;
			$post_date = $ar->post_date;
			$the_date = date('F Y',strtotime($post_date));
			$pagelink = get_permalink($post_id);
			?>
			<li class="link<?php echo ($j==1) ? ' first':''?>">
				<a href="<?php echo $pagelink;?>"><?php echo $post_title;?></a>
				<div class="date"><?php echo $the_date;?></div>
			</li>
		<?php $j++; } ?>
		</ul>
	</div>
</div>

<?php } ?>