<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display ( 'header' ); ?>

	<div id="content">

		<article id="primaryContent">

			<h1 class=""><?php echo $tags_msg; ?></h1>
			
			<?php foreach ( $posts as $post ) { ?>
			<section id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?>">
				
				<h2 class=""><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
				
				<div class="entry">
				<?php echo $post->pubdate->out('F j, Y'); ?> -	<?php echo $post->content_excerpt; ?>
				</div>
				
				<div class="entryMeta">

    				<?php if ( $loggedin ) { ?>
    				<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
    				<?php } ?>
    				
					<?php if ( count( $post->tags ) ) { ?>
					<div class="tags"><?php _e('Tagged:'); ?> <?php echo $post->tags_out; ?></div>
					<?php } ?>
					<div class="commentCount"><?php $theme->comments_link($post,'%d Comments','%d Comment','%d Comments'); ?></div>
					
				</div>
				
			</section>
			<?php } ?>
			
			<div id="pagenav">
				<?php $theme->prev_page_link('&laquo; ' . _t('Newer Results')); ?> <?php $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?> <?php $theme->next_page_link('&raquo; ' . _t('Older Results')); ?>
			</div>
    			
        </article><!-- End #primaryContent -->
			
		<?php $theme->display ( 'sidebar' ); ?>
		
	</div><!-- End #content -->
	
	<?php $theme->display ( 'footer' ); ?>
