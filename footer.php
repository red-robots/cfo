</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="mid-wrapper clear">
			<div class="footbg"></div>
			<div class="footer-menu-wrap clear">
			<?php 
				//$menus = wp_get_nav_menu_items( 'Footer Menu' );
				wp_nav_menu( array( 'menu' => 'Footer Menu', 'menu_id' => 'footer-menu','link_before'=>'<span>','after_before'=>'<span>' ) ); 
			?>
			</div>

			<div class="colophon">
				<div class="inside clear">
				<span class="copyright">&copy; <?php echo date('Y') ?> <?php echo get_bloginfo('name') ?></span>
					<?php 
						$menus = wp_get_nav_menu_items( 'Colophon' );
						//wp_nav_menu( array( 'menu' => 'Colophon', 'menu_id' => 'colophon-menu') ); 
						if($menus) { ?>
							<div class="menu-colophon-container">
								<ul id="colophon-menu" class="menu">
									<?php foreach($menus as $m) { 
										$menu_title = $m->title; 
										$menu_url = $m->url; 
										$obj_id = $m->object_id;
										$basename = ($obj_id) ? basename($menu_url): '';
										?>
										<?php if($menu_title) { ?>
										<li><a data-slug="<?php echo $basename?>" href="<?php echo $menu_url?>"><?php echo $menu_title?></a></li>
										<?php  } ?>	
									<?php  } ?>	
								</ul>
							</div>
						<?php  } ?>
				</div>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="ml-loader-wrap"><div class="ml-loader"> <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>       
<?php wp_footer(); ?>

</body>
</html>
