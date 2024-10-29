<?php
/*
 * Plugin Name: apoyl-autotop
 * Plugin URI:  http://www.girltm.com/
 * Description: 基于用户自定义顶贴内容（比如顶、赞、顶一个，感谢分享等），无需要人工干预自动顶贴，让平台人气更加活跃。
 * Version:     1.1.0
 * Author:      凹凸曼
 * Author URI:  http://www.girltm.com/
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: apoyl-autotop
 * Domain Path: /languages
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define('APOYL_AUTOTOP_VERSION','1.0.0');
define('APOYL_AUTOTOP_PREFIX','apoyl_autotop');
define('APOYL_AUTOTOP_FILE',plugin_basename(__FILE__));
define('APOYL_AUTOTOP_URL',plugin_dir_url( __FILE__ ));
define('APOYL_AUTOTOP_DIR',plugin_dir_path( __FILE__ ));

function apoyl_autotop_activate(){
    require plugin_dir_path(__FILE__).'includes/activator.php';
    Apoyl_Autotop_Activator::activate();
    Apoyl_Autotop_Activator::install_db();
}
register_activation_hook(__FILE__, 'apoyl_autotop_activate');


require plugin_dir_path(__FILE__).'includes/autotop.php';
function apoyl_autotop_file($filename)
{
    $file = WP_PLUGIN_DIR . '/apoyl-common/v1/apoyl-autotop/components/' . $filename . '.php';
    if (file_exists($file))
        return $file;
    return '';
}
function apoyl_autotop_run(){

    $plugin=new APOYL_AUTOTOP();
    $plugin->run();
}
apoyl_autotop_run();
?>