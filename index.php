<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */
get_header(); 
$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'homepage'));
?>
<div class="wrapper">
	<?php if ( have_posts() ) : the_post();  
	$about_title = get_field('about_title');
	$about_description = get_field('about_description');
	$about_image = get_field('about_image');
	?>

	<div class="about-info clear">
		<?php if($about_title) { ?>
		<div class="titlediv">
			<div class="title"><?php echo $about_title; ?></div>
			<div class="description"><?php echo $about_description; ?></div>
		</div>
		<?php } ?>

		<div class="photodiv">
			<?php if($about_image) { ?>
			<div class="image" style="background-image:url(<?php echo $about_image['url']?>)">
				<div class="pad"><img src="<?php echo $about_image['url']?>" alt="<?php echo $about_image['title']?>" /></div>
			</div>
			<?php } ?>
		</div>
	</div>

	<?php endif; ?>
</div>

<?php
get_footer();
