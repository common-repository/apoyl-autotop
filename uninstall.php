<?php
if (!defined('WP_UNINSTALL_PLUGIN')){
  	exit;
}
global $wpdb;
$option_name = 'apoyl-autotop-settings';
delete_option( $option_name);
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}apoyl_autotop");

?>