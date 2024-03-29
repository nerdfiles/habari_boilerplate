<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php if ( Session::has_messages() ) {
		Session::messages_out();
	}
?>

<section id="comments">

	<h1><?php $theme->comments_count($post,'%d Responses','%d Response','%d Responses'); ?> <?php _e('to'); ?> <?php echo $post->title; ?></h1>
	
    <a href="<?php echo $post->comment_feed_link; ?>"><?php _e('Feed for this Entry'); ?></a>

	<?php if ( $post->comments->pingbacks->count ) : ?>
	
	<section id="pings">
	
        <h1><?php $theme->pingback_count($post); ?></h1>
        <ul id="pings-list">
        	<?php foreach ( $post->comments->pingbacks->approved as $pingback ) : ?>
        		<li id="ping-<?php echo $pingback->id; ?>">
        
        				<div class="comment-content">
        				<?php echo $pingback->content; ?>
        				</div>
        				<div class="ping-meta"><a href="<?php echo $pingback->url; ?>" title=""><?php echo $pingback->name; ?></a></div>
        		</li>
        	<?php endforeach; ?>
        </ul>
        
	</section><!-- End #pings -->
			
    <?php endif; ?>

    <section id="commentlist">
    
    	<h1 class="commentheading"><?php echo $post->comments->comments->approved->count; ?> <?php echo _n( 'Comment', 'Comments', $post->comments->comments->approved->count ); ?></h1>
    	
    	<ul class="">
    
    		<?php if ( $post->comments->moderated->count ) { ?>
    		
                <?php 
                    foreach ( $post->comments->comments->moderated as $comment ) :
        			
        			$class = 'class="comment';
        			if ( $comment->status == Comment::STATUS_UNAPPROVED ) {
        				$class.= '-unapproved';
        			}
        			$class.= '"';
        		?>
        
    			<li id="comment-<?php echo $comment->id; ?>" <?php echo $class; ?>>
                    
                    <div class="comment-content">
                        <?php echo $comment->content_out; ?>
                    </div>
                    
                    <div class="comment-meta">#<a href="#comment-<?php echo $comment->id; ?>" class="counter" title="<?php _e('Permanent Link to this Comment'); ?>"><?php echo $comment->id; ?></a> |
                        <span class="commentauthor"><?php _e('Comment by'); ?> <?php $theme->comment_author_link($comment); ?></span>
                        <span class="commentdate"> <?php _e('on'); ?> <a href="#comment-<?php echo $comment->id; ?>" title="<?php _e('Time of this comment'); ?>"><?php $comment->date->out('M j, Y h:ia'); ?></a></span><h5><?php if ( $comment->status == Comment::STATUS_UNAPPROVED ) : ?> <em><?php _e('In moderation'); ?></em><?php endif; ?></h5>
                    </div>
                </li>
    
        		<?php endforeach; ?>
    		
    		<?php } else { ?>
    		
    			<li><?php _e('There are currently no comments.'); ?></li>
    			
    		<?php } ?>
    	</ul>
	
	</section><!-- End #commentlist -->
	
	<section id="commentform">

        <?php $post->comment_form()->out(); ?>
        
	</section><!-- End #commentform -->

</section>
