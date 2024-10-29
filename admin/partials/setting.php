<?php
/*
 * @link http://www.apoyl.com
 * @since 1.0.0
 * @package APOYL_AUTOTOP
 * @subpackage APOYL_AUTOTOP/admin/partials
 * @author 凹凸曼 <jar-c@163.com>
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (isset($_POST['apoyl-autotop-wpnonce']) && check_admin_referer($options_name, 'apoyl-autotop-wpnonce')) {

        $arr_options = array(
        	'open'=>isset ( $_POST ['open'] ) ? ( int ) sanitize_key ( $_POST ['open'] ) :  0,
            'topcontent' => sanitize_textarea_field($_POST['topcontent']),
            'author' => sanitize_text_field($_POST['author']),
            'interval' => sanitize_text_field($_POST['interval']),


        );
   
        $updateflag = update_option($options_name, $arr_options);
        $updateflag = true;
    }
    $arr = get_option($options_name);

    
    ?>
    <?php if( !empty( $updateflag ) ) { echo '<div id="message" class="updated fade"><p>' . esc_html__('updatesuccess','apoyl-autotop') . '</p></div>'; } ?>
    
    <div class="wrap">
    
<?php   require_once APOYL_AUTOTOP_DIR . 'admin/partials/nav.php';?>
    </p>
    	<form
    		action="<?php echo esc_url(admin_url('options-general.php?page=apoyl-autotop-settings'));?>"
    		name="settings-apoyl-autotop" method="post">
    		<table class="form-table">
    			<tbody>
    				<tr>
    					<th><label><?php esc_html_e('open','apoyl-autotop'); ?></label></th>
    					<td><input type="checkbox" class="regular-text"
    						value="1" id="open" name="open" <?php checked( '1', $arr['open'] ); ?> >
    					<?php esc_html_e('open_desc','apoyl-autotop'); ?>
    					</td>
    				</tr>
                    <tr>
                        <th><label><?php esc_html_e('topcontent','apoyl-autotop'); ?></label></th>
                        <td><textarea rows="20" style="max-width:800px;" class="large-text code"
                                      id="topcontent" name="topcontent"><?php  echo esc_textarea($arr['topcontent']); ?></textarea>
                            <p class="description"><?php esc_html_e('topcontent_desc','apoyl-autotop'); ?>--<strong><?php _e('calldev_desc','apoyl-aiarticle'); ?></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php esc_html_e('author','apoyl-autotop'); ?></label></th>
                        <td><input type="text" class="regular-text" value="<?php echo esc_attr($arr['author']); ?>" id="author" name="author">
                            <p class="description"><?php esc_html_e('author_desc','apoyl-autotop'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php esc_html_e('interval','apoyl-autotop'); ?></label></th>
                        <td><input type="text" class="regular-text" value="<?php echo esc_attr($arr['interval']); ?>" id="interval" name="interval">
                            <p class="description"><?php esc_html_e('interval_desc','apoyl-autotop'); ?>--<strong><?php _e('calldev_desc','apoyl-aiarticle'); ?></strong></p>
                        </td>
                    </tr>


    			</tbody>
    		</table>
                <?php
                wp_nonce_field("apoyl-autotop-settings","apoyl-autotop-wpnonce");
                submit_button();
                ?>
               
    </form>
    </div>