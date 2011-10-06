<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php Plugins::act( 'theme_sidebar_top' ); ?>

	<aside id="secondaryContent" class="">

        <section class="widget">
            <div class="inner">
            	<h1>
            	   <a id="rss" href="<?php $theme->feed_alternate(); ?>" class="block"><?php _e('Subscribe to Feed'); ?></a>
                </h1>
        	</div>
    	</section>
    	    
        <section class="widget">
            <div class="inner">
            	<h1><?php _e('Asides'); ?></h1>
            	<ul>
                    <?php foreach($asides as $post): ?>
                    <li>
                        <span class="date">
                        <?php echo $post->pubdate->out('F j, Y'); ?> - 
                        </span>
                        <a href="<?php echo $post->permalink; ?>"><?php echo $post->title_out; ?></a>
                        <?php echo $post->content_out; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    
    	<?php $theme->area( 'sidebar' ); ?>
	
	</aside><!-- End #secondaryContent -->
	
<?php Plugins::act( 'theme_sidebar_bottom' ); ?>
