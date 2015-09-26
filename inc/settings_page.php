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
function anarcho_cfunctions_pro_render_submenu_page() {

	// Variables
	$options = get_option( 'anarcho_cfunctions_pro_settings' );
	$content = isset( $options['anarcho_cfunctions_pro-content'] ) && ! empty( $options['anarcho_cfunctions_pro-content'] ) ? $options['anarcho_cfunctions_pro-content'] : '<?php

	/* Enter Your Custom Functions Here */';
	$error = get_option( 'anarcho_cfunctions_pro_error' );

	// Settings update message
	if ( isset( $_GET['settings-updated'] ) ) :
		?>
			<div id="message" class="updated">
				<p>
					<?php _e( 'Custom functions updated successfully.', 'anarcho_cfunctions_pro' ); ?>
				</p>
			</div>
		<?php
	endif;

	// Error message
	if ( $error == '1' ) :
            ?>
            <div id="message" class="error">
                <p>
                    <?php _e( 'Sorry, but your code causes a "Fatal error", so it is not applied!', 'anarcho_cfunctions_pro' ); ?><br/>
                    <?php _e( 'Please, check the code and try again.', 'anarcho_cfunctions_pro' ); ?>
                </p>
			</div>
            <?php
                endif;

	// Page
	?>
	<div class="wrap">
		<h2 style="text-align:center; color:cornflowerblue;">
			<?php _e( 'My Custom Functions Pro', 'anarcho_cfunctions_pro' ); ?>
			<br/>
			<span style="margin-top:1px; font-size:0.6em; color: black;">
                <?php _e( 'by <a href="http://mycyberuniverse.com/author.html" target="_blank" style="display:inline; padding:0;">Arthur "Berserkr" Gareginyan</a>', 'anarcho_cfunctions_pro' ); ?>
			<span/>
		</h2>
		<form name="anarcho_cfunctions_pro-form" action="options.php" method="post" enctype="multipart/form-data">
			<?php settings_fields( 'anarcho_cfunctions_pro_settings_group' ); ?>

                        <!-- SIDEBAR -->
			<div id="templateside" style="position:fixed; right:20px;">
                <?php do_action( 'anarcho_cfunctions_pro-sidebar-top' ); ?>
				<p style="margin-top: 0">
					<?php _e( 'This plugin allows you to EASILY and SAFELY add your own functions, snippets or any custom code to your site.', 'anarcho_cfunctions_pro' ) ?>
				</p>
				<p>
					<?php _e( 'To use, enter your custom functions, then click "Update Custom Functions". It\'s that simple!', 'anarcho_cfunctions_pro' ) ?>
				</p>
				<?php submit_button( __( 'Update Custom Functions', 'anarcho_cfunctions_pro' ), 'primary', 'submit', true ); ?>
                                <p style="margin-top:20px; border:1px solid rgb(184, 186, 184); border-radius:5px; padding:3px; text-align:center; background:rgb(234, 234, 234);">If you find it useful, consider making a donation:
                                        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JG3SB73K86FA8" target="_blank" rel="nofollow">
                                                <img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" alt="Make a donation">
                                        </a>
                                </p>
				<?php do_action( 'anarcho_cfunctions_pro-sidebar-bottom' ); ?>
			</div>
                        <!-- END-SIDEBAR-->

                        <!-- FORM -->
			<div id="container" style="margin-right:210px;">
				<?php do_action( 'anarcho_cfunctions_pro-form-top' ); ?>
				<div class="repeatingSection">
                  <div class="formRow">
                    <h3>
                        <label for="label">Label:</label>
                        <input type="text" name="label" id="label" value="" />
                    </h3>
					<textarea rows="10" name="anarcho_cfunctions_pro_settings[anarcho_cfunctions_pro-content]" id="anarcho_cfunctions_pro_settings[anarcho_cfunctions_pro-content]" ><?php echo esc_attr( $content ); ?></textarea>
                  </div>
                  <button type="button" class="button deleteSection">Delete</button>
                  <button type="button" class="button showHide">
                    <span>Show</span>
                    <span style="display: none">Hide</span>
                  </button>
				</div>
                </br>
                <button type="button" class="button addAnotherSection">Add Another Function</button>
				<?php do_action( 'anarcho_cfunctions_pro-textarea-bottom' ); ?>
				<?php do_action( 'anarcho_cfunctions_pro-form-bottom' ); ?>
			</div>
                        <!-- END-FORM -->

                        <!-- SCRIPT -->
			<script type="text/javascript" language="javascript">
                var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('anarcho_cfunctions_pro_settings[anarcho_cfunctions_pro-content]'), {
				     lineNumbers: true,
				     matchBrackets: true,
				     mode: 'application/x-httpd-php',
				     indentUnit: 4
				});
			</script>
                        <!-- END-SCRIPT -->

                        <!-- STYLE -->
			<style>
                textarea {
                    width: 100%;
                }

				.CodeMirror {
					border: 1px solid cornflowerblue;
					height: auto;
				}

                .repeatingSection {
                    border: 1px solid #D4CED7;
                    border-radius: 6px;
                    padding: 5px;
                    margin: 5px;
                    background-color: #EAEAEA;
                }
                .formRow {
                    padding: 2px;
                }
                .formRowRepeatingSection {
                    padding: 5px;
                    margin: 5px;
                    font-weight: bold;
                }
			</style>
                        <!-- END-STYLE -->

		</form>
	   </div>
	<?php
}
