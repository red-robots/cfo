<?php
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$count = count_published_post('post');
$args = array(
	'posts_per_page'   => 9,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish',
);
if($count>=12) {
	$args['paged'] = $paged;
}

$posts = new WP_Query($args);
if ( $posts->have_posts() ) { ?>
<div id="js_reload" class="post-sidebar">
	<div class="post-sidebar-content clear">
		<div class="titlediv"><span>News &amp; Insights Archive</span></div>
		<div class="archive-list clear">
			<ul class="post-listing">
			<?php $j=1; while ( $posts->have_posts() ) : $posts->the_post(); 
				$post_id = get_the_ID();
				$post_title = get_the_title();
				$post_date = get_the_date();
				$the_date = date('F Y',strtotime($post_date));
				$pagelink = get_permalink();
				?>
				<li class="link<?php echo ($j==1) ? ' first':''?>">
					<a href="<?php echo $pagelink;?>"><?php echo $post_title;?></a>
					<div class="date"><?php echo $the_date;?></div>
				</li>
			<?php $j++; endwhile; wp_reset_postdata(); ?>
			</ul>


			<?php if($count>=12) { 
	            $total_pages = $posts->max_num_pages;
	            if ($total_pages > 1){ ?>
	                <div id="archive_pagination" class="pagination archive_pagination clear">
	                    <div class="the_paginate_list clear">
	                        <?php
	                            $pagination = array(
	                                'base' => @add_query_arg('pg','%#%'),
	                                'format' => '?paged=%#%',
	                                'current' => $paged,
	                                'total' => $total_pages,
	                                'prev_text' => __( '&laquo;', 'red_partners' ),
	                                'next_text' => __( '&raquo;', 'red_partners' ),
	                                'type' => 'plain'
	                            );
	                            echo paginate_links($pagination);
	                        ?>
	                    </div>
	                </div>
	            <?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>