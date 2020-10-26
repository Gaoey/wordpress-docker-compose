<?php

$footer_bar = Catmandu_Theme_Options::get_option( 'field-footer-bar-enable' );

if ( ! $footer_bar ) {
	return;
}
?>

<footer id="colophon" class="site-footer">
	<div class="colophon-bottom">
		<div class="container">
			
			<?php 
			catmandu_get_copyright();
			
			catmandu_get_site_info();
			?>

		</div> <!-- .container -->
	</div> <!-- .colophon-bottom -->
</footer> <!-- footer ends here -->