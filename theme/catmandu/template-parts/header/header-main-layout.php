<?php
/**
 * Header main layout template
 *
 * @since 1.0.0
 * @author CodeManas
 * @copyright 2019 CodeManas. All RIghts Reserved !
 */
?>

<header id="masthead" class="site-header <?php echo catmandu_header_menu_layouts(); ?>" >
	
	<div class="container">

		<?php catmandu_before_masthead_content(); ?>
		
		<?php catmandu_masthead_content(); ?>

		<?php catmandu_after_masthead_content(); ?>

	</div> <!-- .container -->

</header>

