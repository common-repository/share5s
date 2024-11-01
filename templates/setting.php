<?php
if (!defined('ABSPATH')) exit();

if ( isset( $_POST['reset_options'] ) && $_POST['reset_options'] === 'true' ) {
    $this->reset_option();
}
?>
<div class="wrap">
    <h2>Share5s setting plugin</h2>
	<?php if( isset($_GET['settings-updated']) ) { ?>
        <div id="message" class="updated">
            <p><strong><?php _e('Settings saved.') ?></strong></p>
        </div>
	<?php } ?>

    <?php if (!$this->was_setting()) { ?>
    <form method="post" action="options.php">
		<?php settings_fields( 'share5s-settings' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Username</th>
                <td><input type="text" name="share5s_username" value="<?php echo get_option('share5s_username'); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">Password</th>
                <td><input type="password" name="share5s_password" value="<?php echo get_option('share5s_password'); ?>" /></td>
            </tr>
        </table>
		<?php submit_button(); ?>
    </form>
    <?php }else { ?>
        <form action="<?php echo admin_url( 'admin.php?page=share5s-settings' ); ?>" method="post">
            <button type="submit" class="button button-primary">Click to reset plugin options</button>
            <input type="hidden" name="reset_options" value="true" />
        </form>
    <?php } ?>
</div>