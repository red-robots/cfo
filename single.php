<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */
get_header(); 
$post_type = get_post_type(); ?>
<?php if($post_type=='post') { ?>

<?php } ?>

	<div id="primary" class="full-content-area clear">
		<main id="main" class="site-main mid-wrapper clear" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title();?></h1>
				</header>
				<div class="entry-content">
					<?php the_content();?>
				</div>

				<?php if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif; ?>

			<?php endwhile; ?>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php
get_footer();
