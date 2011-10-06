<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display ( 'header' ); ?>

	<div id="content">

            <article id="primaryContent">
    		
    			<nav id="post-nav">
    				<?php if ( $previous = $post->ascend() ): ?>
    				<span class="left"> &laquo; <a href="<?php echo $previous->permalink ?>" title="<?php echo $previous->slug ?>"><?php echo $previous->title ?></a></span>
    				<?php endif; ?>
    				<?php if ( $next = $post->descend() ): ?>
    				<span class="right"><a href="<?php echo $next->permalink ?>" title="<?php echo $next->slug ?>"><?php echo $next->title ?></a> &raquo;</span>
    				<?php endif; ?>
    			</nav>
			
				<section id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?>">
					
					<h1 class=""><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
						
					<div class="cal"><?php echo $post->pubdate_out; ?></div>
						
					<div class="entry">
						<?php echo $post->content_out; ?>
					</div>
					
					<div class="entryMeta">
					
    					<?php if ( $loggedin ) { ?>
    					<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
    					<?php } ?>
    					
						<?php if ( count( $post->tags ) ) { ?>
						<div class="tags"><?php _e('Tagged:'); ?> <?php echo $post->tags_out; ?></div>
						<?php } ?>
						
					</div>

				</section><!-- End #post-{$n} -->
			
			<?php include 'commentform.php'; ?>
			
        </article><!-- End #primaryContent -->
			
		<?php $theme->display ( 'sidebar' ); ?>
		
	</div><!-- End #content -->
	
	<?php $theme->display ( 'footer' ); ?>
