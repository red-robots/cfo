<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ACStarter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acstarter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'acstarter_body_classes' );

add_action( 'wp_ajax_nopriv_the_staff_info', 'the_staff_info' );
add_action( 'wp_ajax_the_staff_info', 'the_staff_info' );
function the_staff_info() {
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$post_id = ($_POST['post_id']) ? $_POST['post_id'] : 0;
		$post = get_post($post_id);
		$html = '';
		if($post) {
			$html = get_staff_info_html($post);
		}
		$response['content'] = $html;
		echo json_encode($response);
	}
	else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();
}

function get_staff_info_html($obj) {
	$post_id = $obj->ID;
	$post_title = $obj->post_title;
	$content = $obj->post_content;
	$content = apply_filters('the_content',$content); 
	$job_title = get_field('team_title',$post_id); 
	$photo = get_field('team_photo',$post_id);
	ob_start(); ?>
	<div id="staffDetails" class="popup_wrapper">
		<div class="popupbg"></div>
		<div class="details clear animated fadeIn">
			<a id="closePopup"><span>x</span></a>
			<div class="inner clear">
				<div class="contentwrap clear">
					<header class="titlediv">
						<h2 class="ptitle"><?php echo $post_title;?></h2>
						<div class="jobtitle"><?php echo $job_title;?></div>
					</header>
					<?php if($photo) { ?>
					<img class="featured-image" src="<?php echo $photo['url']?>" alt="<?php echo $photo['title']?>" />
					<?php } ?>
					<?php echo $content;?>
				</div>
			</div>
		</div>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

function get_page_id_by_template($fileName) {
	$page_id = 0;
	if($fileName) {
		$pages = get_pages(array(
			'post_type' => 'page',
		    'meta_key' => '_wp_page_template',
		    'meta_value' => $fileName.'.php'
		));

		if($pages) {
			$row = $pages[0];
			$page_id = $row->ID;
		}
	}
	return $page_id;
}
