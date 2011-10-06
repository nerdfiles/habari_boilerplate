<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>

<?php if ( isset( $error ) ) { ?>

<p><?php _e('That login is incorrect.'); ?></p>

<?php } ?>

<?php if ( $loggedin ) { ?>

<p><?php _e('You are logged in as'); ?> <?php echo $user->username; ?>.</p>
<p><?php _e('Want to'); ?> <a href="<?php Site::out_url( 'habari' ); ?>/auth/logout"><?php _e('log out'); ?></a>?</p>

<?php } else { ?>

<?php Plugins::act( 'theme_loginform_before' ); ?>

<form 
    method="post" 
    action="<?php URL::out( 'auth', array( 'page' => 'login' ) ); ?>">
	
	<fieldset>
	
    	<div>
            <label for="habari_username"><small><strong><?php _e('Name:'); ?></strong></small></label>
            <input 
                type="text" 
                size="25" 
                name="habari_username" 
                id="habari_username" 
                tabindex="1" />
    	</div>
    	
    	<div>
    		<label for="habari_password"><small><strong><?php _e('Password:'); ?></strong></small></label>
    		<input 
                type="password" 
                size="25" 
                name="habari_password" 
                id="habari_password" />
    	</div>
    	
    	<?php Plugins::act( 'theme_loginform_controls' ); ?>
    	
	</fieldset>
	
	<fieldset>
	
    	<div>
    		<button 
                class="submit"
                type="submit" 
                value="<?php _e('GO!'); ?>">
                <?php _e('GO!'); ?>
            </button>
    	</div>
    	
    	<div id="password_utils">
    		<button 
                class="submit" 
                type="submit" 
                name="submit_button" 
                value="<?php _e('Reset password'); ?>">
                <?php _e('Reset password'); ?>
            </button>
    	</div>
	
	</fieldset>
	
</form>

<?php Plugins::act( 'theme_loginform_after' ); ?>

<?php
}
?>
