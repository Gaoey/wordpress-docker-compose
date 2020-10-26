<?php 
if( ! is_active_sidebar( 'footer-one' ) && ! is_active_sidebar( 'footer-two' ) && ! is_active_sidebar( 'footer-three' )  ){
	return;
} 
?>

<div id="footer-widgets">
	<div class="container">
		<div class="inner-wrapper">
			<?php 

			catmandu_before_footer_widgets();

			catmandu_get_footer_widgets(); 

			catmandu_after_footer_widgets();

			?>
		</div><!-- .inner-wrapper -->
	</div>  <!-- .container -->
</div> <!-- #footer-widgets -->