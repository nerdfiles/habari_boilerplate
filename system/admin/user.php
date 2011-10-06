<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php include('header.php');?>

<div class="container navigation">
	<span class="pct40">
		<form>
		<select class="navigationdropdown" onChange="navigationDropdown.filter();" name="navigationdropdown">
			<option value="all"><?php _e('All options'); ?></option>
		</select>
		</form>
	</span>
	<span class="or pct20">
		<?php _e('or'); ?>
	</span>
	<span class="pct40">
		<input id="search" type="search" placeholder="<?php _e('search users'); ?>">
	</span>
</div>


<div class="container transparent userstats">
<?php
	$message_bits = array();
	$post_statuses = Post::list_post_statuses();
	unset( $post_statuses[array_search( 'any', $post_statuses )] );
	foreach ( $post_statuses as $status_name => $status_id ) {
		$count = Posts::count_by_author( $edit_user->id, $status_id );
		if ( $count > 0 ) {
			$message = '<strong><a href="' . URL::get( 'admin', array( 'page' => 'posts', 'user_id' => $edit_user->id, 'type' => Post::type( 'any' ), 'status' => $status_id ) ) . '">';
			$message .= sprintf( '%d ' . _n( _t( $status_name . ' post' ), _t( $status_name . ' posts' ), $count ), $count ) ;
			$message .= '</a></strong>';
			$message_bits[] = $message;
		}
	}
	if ( count($message_bits) == 0 ) {
		echo "<p>" . _t('No published posts.') . "</p>\n";
	}
	else {
		echo Format::and_list( $message_bits );
	}
?>
</div>

<?php echo $form; ?>

<?php include('footer.php');?>
