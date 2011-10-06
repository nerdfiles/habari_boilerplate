<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display ( 'header' ); ?>

	<div id="content">

		<article id="primaryContent">
		
    		<?php include 'loginform.php'; ?>
    		
		</article><!-- End #primaryContent -->
		
		<?php $theme->display ( 'sidebar' ); ?>
		
	</div><!-- End #content -->
	
	<?php $theme->display ( 'footer' ); ?>
