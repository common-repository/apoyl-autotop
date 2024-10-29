<?php

/*
 * @link http://www.girltm.com/
 * @since 1.0.0
 * @package Apoyl_Autoto
 * @subpackage Apoyl_Autoto/public
 * @author 凹凸曼 <jar-c@163.com>
 *
 */
class Apoyl_Autotop_Public
{

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }


    public function contentview($content)
    {

        global $wpdb;

        $arr = get_option('apoyl-autotop-settings');
        $str='';
        if (isset($arr['open'])&&$arr['open']>0 && is_single()) {
            $file= apoyl_autotop_file('randschedule');
            if($file){
                include $file;
            }
        }
        return $content;

    }

}