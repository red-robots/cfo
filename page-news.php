<?php
/**
 * Template Name: News
 */

get_header(); 
$banner = get_field('banner_image'); ?>

	<div id="primary" class="full-content-area nopadding clear">
		<?php if( get_the_content() ) { ?>
		<main id="main" class="site-main mid-wrapper clear" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="mid-content-wrap clear text-center large-text width50">
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
		</main><!-- #main -->
		<?php } ?>

		<div class="mid-wrapper clear">
			<?php
			$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
			$args = array(
				'posts_per_page'   => 12,
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'paged'			   => $paged
			);
			$blogs = new WP_Query($args);
			if ( $blogs->have_posts() ) {  ?>
			<div class="category-list clear">
				<div class="the-posts clear">
					<?php while ( $blogs->have_posts() ) : $blogs->the_post(); 
						$post_id = $p->post_id;
						$thumbnail_id = get_post_thumbnail_id($post_id);
						$feat_image = wp_get_attachment_image_src($thumbnail_id,'large');
						$post_title = get_the_title();
						$content = get_the_content();
						$content = strip_tags($content);
						$excerpt = shortenText($content,300," ");
						$post_date = get_the_date();
						$the_post_date = date('F Y',strtotime($post_date));		
						$pagelink = get_permalink(); ?>
						<div class="post-entry">
							<div class="inner-pad clear">
								<div class="inside clear">
									<?php if($feat_image) { ?>
									<div class="featimage" style="background-image:url('<?php echo $feat_image[0]?>')"></div>
									<?php } ?>
									<div class="textwrap clear">
										<header class="post-info">
											<h3 class="post-title"><?php echo $post_title; ?></h3>
										</header>
										<p class="excerpt"><?php echo $excerpt; ?></p>
										<div class="buttondiv text-center">
											<a class="btn" href="<?php echo $pagelink; ?>">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>	
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<?php } else { ?>
				<div class="mid-content-wrap clear text-center large-text">
					<div class="entry-content">
						<p class="no-post"><strong>No posts found.</strong></p>
					</div>
				</div>
			<?php } ?>
			<?php
	            $total_pages = $blogs->max_num_pages;
	            if ($total_pages > 1){ ?>
	                <div id="pagination" class="pagination-wrapper clear">
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
	                <?php
	            }
	        ?>
    	</div>

	</div><!-- #primary -->

<?php
get_footer();
