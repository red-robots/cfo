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
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="ml-loader-wrap"><div class="ml-loader"> <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>       
<?php wp_footer(); ?>

</body>
</html>
