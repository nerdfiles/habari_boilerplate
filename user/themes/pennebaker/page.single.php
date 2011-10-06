<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display ( 'header' ); ?>

	<div id="page">
	
    	<div id="content">
    
    		<article id="primaryContent">
    
                <section id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?>">
                
    				<h1><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
    				
    				<div class="entry">
    					<?php echo $post->content_out; ?>
    				</div>
    				
    				<div class="entryMeta">
    					<?php if ( $loggedin ) { ?>
    					<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
    					<?php } ?>
    				</div>
    				
                </section>
    		
    		</article><!-- End #primaryContent -->
    			
    		<?php $theme->display ( 'sidebar' ); ?>
    		
    	</div><!-- End #content -->
	
	</div><!-- End #page -->
	
	<?php $theme->display ( 'footer' ); ?>
