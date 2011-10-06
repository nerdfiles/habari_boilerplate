<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>

<?php Plugins::act( 'theme_searchform_before' ); ?>

    <form 
        method="get" 
        id="searchform" 
        action="<?php URL::out('display_search'); ?>">
        
        <fieldset>
            
            <div>
                <input 
                    type="text" 
                    id="s" 
                    name="criteria" 
                    value="<?php 
                        if ( isset( $criteria ) ) { 
                            echo htmlentities($criteria, ENT_COMPAT, 'UTF-8'); 
                        } else { 
                            _e('Search'); 
                        } ?>" />
            </div>
            
        </fieldset>
        
        <fieldset>
        
            <div>
                <button 
                    type="submit" 
                    id="searchsubmit" 
                    value="<?php _e('Search'); ?>">
                
                    <?php _e('Search'); ?>
                
                </button>
            </div>
            
        </fieldset>
        
    </form><!-- End #searchform -->
     
<?php Plugins::act( 'theme_searchform_after' ); ?>
