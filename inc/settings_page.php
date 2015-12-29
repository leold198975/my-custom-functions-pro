<?php

/**
 * Prevent Direct Access
 */
defined('ABSPATH') or die("Restricted access!");

/**
 * Render Settings Page
 *
 * @since 0.1
 */
function mcfunctions_pro_render_submenu_page() {

	// Settings update message
	if ( isset( $_GET['settings-updated'] ) ) :
            ?>
			<div id="message" class="updated">
				<p>
					<?php _e( 'Custom functions updated successfully.', 'mcfunctions_pro' ); ?>
				</p>
			</div>
            <?php
	endif;

	// Error message
    $error = get_option( 'mcfunctions_pro_error' );
	if ( $error == '1' ) :
            ?>
            <div id="message" class="error">
                <p>
                    <?php _e( 'Sorry, but your code causes a "Fatal error", so it is not applied!', 'mcfunctions_pro' ); ?><br/>
                    <?php _e( 'Please, check the code and try again.', 'mcfunctions_pro' ); ?>
                </p>
            </div>
            <?php
    endif;

	// Page
	?>
	<div class="wrap">
		<h2>
			<?php _e( 'My Custom Functions Pro', 'mcfunctions_pro' ); ?>
			<br/>
			<span>
                <?php _e( 'by <a href="http://mycyberuniverse.com/author.html" target="_blank">Arthur "Berserkr" Gareginyan</a>', 'mcfunctions_pro' ); ?>
			<span/>
		</h2>
		<form name="mcfunctions_pro-form" action="options.php" method="post" enctype="multipart/form-data">
			<?php settings_fields( 'mcfunctions_pro_settings_group' ); ?>

			<!-- SIDEBAR -->
			<div id="templateside">
                <?php do_action( 'mcfunctions_pro-sidebar-top' ); ?>
				<p>
					<?php _e( 'This plugin allows you to EASILY and SAFELY add your own functions, snippets or any custom code to your site.', 'mcfunctions_pro' ) ?>
				</p>
				<p>
					<?php _e( 'To use, enter your custom functions, then click "Update Custom Functions". It\'s that simple!', 'mcfunctions_pro' ) ?>
				</p>
				<?php submit_button( __( 'Update Custom Functions', 'mcfunctions_pro' ), 'primary', 'submit', true ); ?>
				<p class="donate">If you find it useful, consider making a donation:
					<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JG3SB73K86FA8" target="_blank" rel="nofollow">
                        <img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" alt="Make a donation">
					</a>
				</p>
				<?php do_action( 'mcfunctions_pro-sidebar-bottom' ); ?>
			</div>
			<!-- END-SIDEBAR -->

			<!-- FORM -->
			<div id="container">
				<?php do_action( 'mcfunctions_pro-form-top' ); ?>

				<div class="repeatingSection">
                    <h3>
                        <label for="mcfunctions_pro[label-0]">Label:</label>
                        <input type="text" name="mcfunctions_pro[label-0]" id="mcfunctions_pro[label-0]" size="50%" value="" />
                    </h3>
                    <span class="func" style="//display: none;">
                        <textarea name="mcfunctions_pro[function-0]" id="mcfunctions_pro[function-0]" class="func_editor" placeholder="Enter Your Custom Function Here"><?php echo esc_attr( get_option( 'mcfunctions_pro[function-0]' ) ); ?></textarea>
                    </span>
                    <button type="button" class="button showHide">
                        <span><?php _e( 'Show', 'mcfunctions_pro' ); ?></span>
                        <span style="display: none"><?php _e( 'Hide', 'mcfunctions_pro' ); ?></span>
                    </button>
                    <button type="button" class="button-primary deleteSection button-del"><?php _e( 'Delete', 'mcfunctions_pro' ); ?></button>
				</div>
                </br>
                <button type="button" class="button addAnotherSection">Add Another Function</button>
				<?php do_action( 'mcfunctions_pro-textarea-bottom' ); ?>
				<?php do_action( 'mcfunctions_pro-form-bottom' ); ?>
			</div>
			<!-- END-FORM -->

		</form>
	   </div>
	<?php
}