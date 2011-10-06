<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display ( 'header' ); ?>

	<div id="content">

		<article id="primaryContent">
			<section class="entry">
                <h1>404</h1>
    			<p><?php _e("It seems you couldn't find what you are looking for."); ?></p><p><?php _e('Perhaps you can try searching.'); ?></p>
    			<?php $theme->display ( 'searchform' ); ?>
			</section>
		</article><!-- End #primaryContent -->

		<?php $theme->display ( 'sidebar' ); ?>
	</div>

	<?php $theme->display ( 'footer' ); ?>
