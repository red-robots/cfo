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

<?php if ( have_posts() ) : the_post();  
$about_title = get_field('about_title');
$about_description = get_field('about_description');
$about_image = get_field('about_image');

$circle_image1 = get_field('circle_1_image');
$circle_text1 = get_field('circle_1_text');
$circle_title1 = get_field('circle_1_title');
$circle_link1 = get_field('circle_1_link');

$circle_image2 = get_field('circle_2_image');
$circle_text2 = get_field('circle_2_text');
$circle_title2 = get_field('circle_2_title');
$circle_link2 = get_field('circle_2_link');

$circle_image3 = get_field('circle_3_image');
$circle_text3 = get_field('circle_3_text');
$circle_title3 = get_field('circle_3_title');
$circle_link3 = get_field('circle_3_link');

$circles[] = array('title'=>$circle_title1,'text'=>$circle_text1,'image'=>$circle_image1,'link'=>$circle_link1);
$circles[] = array('title'=>$circle_title2,'text'=>$circle_text2,'image'=>$circle_image2,'link'=>$circle_link2);
$circles[] = array('title'=>$circle_title3,'text'=>$circle_text3,'image'=>$circle_image3,'link'=>$circle_link3);
?>

<div id="primary" class="mid-wrapper clear">
	<div class="about-info clear">
		<?php if($about_title) { ?>
		<div class="titlediv">
			<div class="title"><?php echo $about_title; ?></div>
			<div class="description"><?php echo $about_description; ?></div>
		</div>
		<?php } ?>
	</div>

	<div class="three-boxes">
		<div class="row clear">
		<?php foreach($circles as $c) { 
		$img = $c['image'];
		$title = $c['title'];
		$desc = $c['text']; 
		$link = $c['link']; 
		?>
			<?php if($img) { ?>
			<div class="box-image">
				<div class="pad clear">
					<a href="<?php echo $link?>" class="imgwrap homebox clear">
						<img src="<?php echo $img['url']?>" alt="<?php echo $img['title']?>" />
						<span class="name"><?php echo $title;?></span>
					</a>
					<?php if($desc) { ?>
					<div class="desc clear animated">
						<?php echo $desc;?>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
		</div>
	</div>
</div>
<?php endif; ?>


<?php
get_footer();
