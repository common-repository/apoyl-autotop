<?php
/*
 * @link  
 * @since 1.0.0
 * @package APOYL_AUTOTOP
 * @subpackage APOYL_AUTOTOP/admin
 * @author 凹凸曼 <jar-c@163.com>
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Apoyl_Autotop_Admin
{

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/admin.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/admin.js', array(
            'jquery'
        ), $this->version, false);
    }

    public function links($alinks)
    {
        $links[] = '<a href="' . esc_url(get_admin_url(null, 'options-general.php?page=apoyl-autotop-settings')) . '">' . __('settingsname', 'apoyl-autotop') . '</a>';
        $alinks = array_merge($links, $alinks);
        
        return $alinks;
    }

    public function menu()
    {
        add_options_page(__('settings', 'apoyl-autotop'), __('settings', 'apoyl-autotop'), 'manage_options', 'apoyl-autotop-settings', array(
            $this,
            'settings_page'
        ));
    }

    public function settings_page()
    {
        global $wpdb;
        $options_name = 'apoyl-autotop-settings';
        isset($_GET['do'])?$do = sanitize_text_field($_GET['do']):$do='';
        if ($do == 'list') {
            require_once plugin_dir_path(__FILE__) . 'partials/list.php';
        } else {
            require_once plugin_dir_path(__FILE__) . 'partials/setting.php';
        }
    }
    public function publish_post_btn($post_ID){
		global $wpdb;
		$arr = get_option('apoyl-autotop-settings');
        $obj = get_post($post_ID);
        if(isset($obj->post_title)&&$arr['open']&&$arr['topcontent']&&$arr['author']){
            $content=esc_html__('testreply','apoyl-autotop');
            $file= apoyl_autotop_file('randcontent');
            if($file){
                include $file;
            }

            $comment_id=0;



            if (isset($content)){

                $commentdata = array(
                    'comment_post_ID' => $post_ID,
                    'comment_author' => $arr['author'],
                    'comment_author_email' => '',
                    'comment_author_url' => '',
                    'comment_content' => $content,
                    'comment_type' => 'comment',
                    'comment_parent' => 0,
                    'user_id' => 0,
                    'comment_approved' => 1,
                    'comment_date' => current_time('mysql'),
                    'comment_date_gmt' => current_time('mysql', 1),
                );
                $comment_id = wp_insert_comment( $commentdata );
                $data = array(
                    'user_id' => 0,
                    'post_id' => $post_ID,
                    'comment_id' => $comment_id,
                    'message' => $content,
                    'addtime'=>current_time('timestamp')
                );
                $format = array(
                    '%d',
                    '%d',
                    '%d',
                    '%s',
                    '%d'
                );

                $wpdb->insert($wpdb->prefix . 'apoyl_autotop', $data);
            }



        }
    }


}
