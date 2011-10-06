<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>

	<footer id="footer">
	   <section>
	       <p><?php Options::out('title'); ?> <?php _e('is powered by'); ?> <a href="http://www.habariproject.org/" title="Habari">Habari</a> | <a href="<?php Site::out_url('admin'); ?>">Dashboard</a></p>
	   </section>
	</footer><!-- End #footer -->
	
</div><!-- End #wrapper -->

<!--










          This section has been intentionally left blank.










-->

<?php $theme->footer(); ?>

</body>

</html>
