<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display ( 'header' ); ?>

	<div id="content">

		<article id="primaryContent">

			<?php foreach ( $posts as $post ) { ?>
			
				<section id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?>">
					
					<h1 class=""><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
                        
                    <div class="cal"><?php echo $post->pubdate_out; ?></div>
                        
					<div class="entry">
						<?php echo $post->content_out; ?>
					</div>
					
					<div class="entryMeta">
						
						<?php if ( count( $post->tags ) ) { ?>
						<div class="tags"><?php _e('Tagged:'); ?> <?php echo $post->tags_out; ?></div>
						<?php } ?>
						
						<div class="commentCount"><?php $theme->comments_link($post,'%d Comments','%d Comment','%d Comments'); ?></div>	
											
    					<?php if ( $loggedin ) { ?>
    					<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
    					<?php } ?>
    					
					</div>
					
				</section>
				
			<?php } ?>

    			<nav id="pagenav" class="clear">
    				<?php $theme->prev_page_link('&laquo; ' . _t('Newer Posts')); ?> <?php $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?> <?php $theme->next_page_link('&raquo; ' . _t('Older Posts')); ?>
    			</nav>
    			
		</article><!-- End #primaryContent -->
			
		<?php $theme->display('sidebar'); ?>
		
	</div><!-- End #content -->
	
	<?php $theme->display ( 'footer' ); ?>
