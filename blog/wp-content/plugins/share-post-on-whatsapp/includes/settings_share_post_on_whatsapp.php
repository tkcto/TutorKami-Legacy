<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( current_user_can('manage_options') ) { 

		//getting all settings
		$share_post_on_whatsapp= get_option('share_post_on_whatsapp');

        if (isset( $_POST['add_opt_submit'] ) && wp_verify_nonce($_POST['add_opt_submit'], 'add_opt_submit') ){
			
			$share_post_on_whatsapp= sanitize_text_field( $_POST['share_post_on_whatsapp'] );	
			$saved= sanitize_text_field( $_POST['saved'] );


			if(isset($share_post_on_whatsapp) ) {
				update_option('share_post_on_whatsapp', $share_post_on_whatsapp);
			}

			if($saved==true) {
				
				$message='saved';
			} 
		}
		
		
		if ( $message == 'saved' ) {
		echo ' <div class="updated"><p><strong>Settings Saved.</strong></p></div>';
		}
 } 

  
?>
 
   
    <div class="wrap">
        <form method="post" id="settingForm" action="">
		<h2><?php _e('Enable/Disable WhatsApp Share Icon','');?></h2>
		<table class="form-table">
		
	
	    <tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="share_post_on_whatsapp"><?php _e('Enable/Disable WhatsApp Share Icon','');?></label>
			</th>
			<td>
			<select style="width:220px" name="share_post_on_whatsapp" id="share_post_on_whatsapp">
			<option value='hide' <?php if($hsabffe_hide_admin_bar == 'hide') { echo "selected='selected'" ; } ?>>Disable Whatsapp Icon</option>
			<option value='show' <?php if($share_post_on_whatsapp == 'show') { echo "selected='selected'" ; } ?>>Enable Whatsapp Icon
			
			</option>
		   </select>
		   <br />
			</td>
		</tr>
	   
		<tr>
		  <td>
		  <p class="submit">
		<input type="hidden" name="saved"  value="saved"/>
        <input type="submit" name="add_opt_submit" class="button-primary" value="Save Changes" />
		  <?php if(function_exists('wp_nonce_field')) wp_nonce_field('add_opt_submit', 'add_opt_submit'); ?>
        </p></td>
		</tr>
		</table>
		
        
       </form>
      
    </div>

