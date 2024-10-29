<?php
/*
 * @link        
 * @since      1.0.0
 * @package    APOYL_AUTOTOP
 * @subpackage APOYL_AUTOTOP/includes
 * @author     凹凸曼 <jar-c@163.com>
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Apoyl_Autotop_i18n {


	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'apoyl-autotop',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
?>