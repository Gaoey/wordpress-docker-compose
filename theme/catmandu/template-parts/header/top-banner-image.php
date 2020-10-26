<?php
/**
 * After header banner template file
 *
 * @since 1.0.0
 * @author CodeManas
 * @copyright 2019 CodeManas. All RIghts Reserved !
 */
?>

<?php catmandu_before_top_banner_image(); ?>
	
	<div id="custom-header" style="background: url('<?php echo esc_url( get_theme_file_uri( 'assets/images/custom-header.jpg' ) ); ?>')">
		<div class="custom-header-content">
			<div class="container">
				<?php catmandu_top_banner_image(); ?>
			</div> <!-- .container -->
		</div>  <!-- .custom-header-content -->
	</div> <!-- .custom-header -->

<?php catmandu_before_top_banner_image(); ?>