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

	$browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
	$classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

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
	$phone_number = get_field('phone_number',$post_id);
	$email_address = get_field('email_address',$post_id);
	$address = get_field('address',$post_id);
	$staff_pagelink = get_permalink($post_id);
	$has_info = ($photo || $phone_number || $email_address || $address) ? true : false;
	ob_start(); ?>
	<div id="staffDetails" class="popup_wrapper staff_information">
		<div class="popupbg"></div>
		<div class="details clear animated fadeIn">
			<a id="closePopup"><span>x</span></a>
			<div class="inner clear">
				<div class="contentwrap clear ajax_contentdiv">
					<div class="textcontent <?php echo ($has_info) ? 'half':'full';?>">
						<header class="titlediv">
							<h2 class="ptitle"><?php echo $post_title;?></h2>
							<div class="jobtitle"><?php echo $job_title;?></div>
						</header>

						<?php if($has_info) { ?>
							<div class="imageContainer small-screen">
								<?php if($photo) { ?>
								<img class="featured-image" src="<?php echo $photo['url']?>" alt="<?php echo $photo['title']?>" />
								<?php } ?>

								<div class="contact-details clear">
									<?php if($phone_number) { ?>
										<div class="phone"><span class="label"><i class="fa fa-phone"></i></span><span class="value"><a href="tel:<?php echo format_phone_number($phone_number);?>"><?php echo $phone_number;?></a></span></div>
									<?php } ?>

									<?php if($email_address) { ?>
										<div class="email"><span class="label"><i class="fa fa-envelope"></i></span><span class="value"><a href="mailto:<?php echo antispambot($email_address,1);?>"><?php echo $email_address;?></a></span></div>
									<?php } ?>

									<?php if($address) { ?>
										<div class="address"><span class="label"><i class="fa fa-map-marker-alt"></i></span><span class="value"><?php echo $address;?></span></div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>

						<?php echo $content;?>
					</div>
					
					<?php if($has_info) { ?>
						<div class="imageContainer large-screen">
							<?php if($photo) { ?>
							<img class="featured-image" src="<?php echo $photo['url']?>" alt="<?php echo $photo['title']?>" />
							<?php } ?>

							<?php if($phone_number || $email_address || $address) { ?>
							<div class="contact-details clear">
								<?php if($phone_number) { ?>
									<div class="phone c-info"><span class="label"><i class="fa fa-phone"></i></span><span class="value"><a href="tel:<?php echo format_phone_number($phone_number);?>"><?php echo $phone_number;?></a></span></div>
								<?php } ?>

								<?php if($email_address) { ?>
									<div class="email c-info"><span class="label"><i class="fa fa-envelope"></i></span><span class="value"><a href="mailto:<?php echo antispambot($email_address,1);?>"><?php echo $email_address;?></a></span></div>
								<?php } ?>

								<?php if($address) { ?>
									<div class="address c-info"><span class="label"><i class="fa fa-map-marker-alt"></i></span><span class="value"><?php echo $address;?></span></div>
								<?php } ?>
							</div>
							<?php } ?>

							<div class="share-info">
								<a class="sharebio" href="mailto:?subject=<?php echo $post_title; ?>&body=<?php echo $staff_pagelink; ?>"><span class="icon"><i class="far fa-envelope"></i></span> Share Bio</a>
							</div>
						</div>
					<?php } ?>

				</div>
			</div>
		</div>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_action( 'wp_ajax_nopriv_get_the_page_content', 'get_the_page_content' );
add_action( 'wp_ajax_get_the_page_content', 'get_the_page_content' );
function get_the_page_content() {
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$slug = ($_POST['post_name']) ? $_POST['post_name'] : '';
		$html = ajax_get_page_content($slug);
		$response['content'] = $html;
		echo json_encode($response);
	}
	else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();
}

function ajax_get_page_content($slug=null) {
	global $wpdb;
	if(empty($slug)) return '';
	$content = '';
	$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}posts WHERE post_name='".$slug."' AND post_status = 'publish'", OBJECT );
	if($result) { 
		ob_start(); 
		$page_title = $result->post_title;
		$content = $result->post_content;
		$page_content = apply_filters('the_content', $content);
		?>

		<div id="staffDetails" class="popup_wrapper staff_information">
			<div class="popupbg"></div>
			<div class="details clear animated fadeIn">
				<a id="closePopup"><span>x</span></a>
				<div class="inner clear">
					<div class="contentwrap clear ajax_contentdiv">
						<div class="textcontent full">
							<header class="titlediv">
								<h1 class="ptitle"><?php echo $page_title;?></h1>
							</header>
							<?php echo $page_content;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php 
		$content = ob_get_contents();
		ob_end_clean();
	}
	return $content;
}

function format_phone_number($string) {
	$string = trim($string);
	$string = preg_replace('/\s+/','',$string);
	$string = preg_replace('@[^0-9a-z\+]+@i', '', $string);
	return $string;
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


function get_posts_by_categories($taxonomy='category',$numberPost=3) {
    global $wpdb;
    $tax_terms = get_terms($taxonomy, array('hide_empty' => true));
    $prefix = $wpdb->prefix;
    $records = array();
    if($tax_terms) {
        foreach($tax_terms as $t) {
            $term_id = $t->term_id;
            $term_name = $t->name;
            $limit = ($numberPost>1) ? ' LIMIT ' . $numberPost :'';
            $query = "SELECT rel.term_taxonomy_id as term_id,p.ID as post_id FROM ".$prefix."term_relationships as rel,".$prefix."posts as p
                      WHERE rel.object_id=p.ID AND rel.term_taxonomy_id=".$term_id." AND p.post_status='publish' ORDER BY p.menu_order ASC" . $limit;
            $results = $wpdb->get_results( $query, OBJECT );
            $items = ($results) ? $results : '';
            $args = array(
                    'term_id'=>$term_id,
                    'term_name'=>$term_name,
                    'posts'=>$items
                );
            $records[] = $args;
        }
    }     
    return $records;
}

function title_formatter($string) {
	if($string) {
		$parts = explode(' ',trim($string));
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
	} else {
		$row_title = '';
	}
	return $row_title;
}

function shortenText($str, $limit, $brChar = ' ', $pad = '...')  {
    if (empty($str) || strlen($str) <= $limit) {
        return $str;
    }
    $output = substr($str, 0, ($limit+1));
    $brCharPos = strrpos($output, $brChar);
    $output = substr($output, 0, $brCharPos);
    $output = preg_replace('#\W+$#', '', $output);
    $output .= $pad;
    return $output;
}

function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


function latest_post_by_archives($limitNum=15) {
	global $wpdb;
	$tableName = $wpdb->prefix.'posts';
	$query = "SELECT ID,post_title,post_date, MONTH(post_date) AS month, YEAR(post_date) AS year FROM ".$tableName." WHERE post_type='post' AND post_status = 'publish'
			  GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC LIMIT " . $limitNum;
	$result = $wpdb->get_results($query);
	return ($result) ? $result : false;
}

function count_published_post($postTypeName='post') {
	global $wpdb;
	$result = $wpdb->get_row( "SELECT count(*) as total FROM {$wpdb->prefix}posts WHERE post_type='".$postTypeName."' AND post_status = 'publish'", OBJECT );
	return ($result) ? $result->total : 0;
}
