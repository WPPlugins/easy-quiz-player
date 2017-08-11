<?php
/*
Plugin Name: Easy Quiz Player
Version: 1.0.11
Plugin URI: http://easyquizplayer.com
Author URI: http://easyquizplayer.com
Description:  Easy Quiz Player is the most professional and versatile tool for creating a quiz on your WordPress page. Easy Quiz Player lets you publish your own quiz, with your own questions, on your page within minutes.
*/

//Config
// $GLOBALS['EasyQuizPlayerServer'] = 'http://localhost/millionmind_easyquiz/public';
$GLOBALS['EasyQuizPlayerServer'] = 'https://quiz.easyquizplayer.com';


if(!defined('ABSPATH')) exit;
if(!class_exists('EAZYQUIZPLAYER'))
{
    class EAZYQUIZPLAYER
    {
        var $plugin_version = '1.0.10';
        var $plugin_url;
        var $plugin_path;

        function __construct()
        {
            define('EAZYQUIZPLAYER_VERSION', $this->plugin_version);
            define('EAZYQUIZPLAYER_SITE_URL',site_url());
            define('EAZYQUIZPLAYER_URL', $this->plugin_url());
            define('EAZYQUIZPLAYER_PATH', $this->plugin_path());
            $this->plugin_includes();
            add_action('wp_enqueue_scripts', array( &$this, 'plugin_scripts' ), 0 );
			add_action('admin_menu', 'easyquizplayer_manage_page');
        }
        function plugin_includes()
        {
            if(is_admin( ) )
            {
				//For admin
            }
			add_shortcode('easyquizplayer', 'easyquizplayer_func');
			add_shortcode('eqp', 'easyquizplayer_func');

        }
        function plugin_scripts()
        {
            if (!is_admin())
            {
                wp_enqueue_script('jquery');
			}
        }
        function plugin_url()
        {
            if($this->plugin_url) return $this->plugin_url;
            return $this->plugin_url = plugins_url( basename( plugin_dir_path(__FILE__) ), basename( __FILE__ ) );
        }
        function plugin_path(){
            if ( $this->plugin_path ) return $this->plugin_path;
            return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
        }
        function add_plugin_action_links($links, $file)
        {
            if ( $file == plugin_basename( dirname( __FILE__ ) . '/main.php' ) )
            {
                $links[] = '<a href="options-general.php?page=million-mind-easyquiz-settings">Settings</a>';
            }
            return $links;
        }
        function add_options_menu()
        {
            if(is_admin())
            {
                add_options_page('Easy Quiz Player Settings', 'Easy Quiz Player', 'manage_options', 'million-mind-easyquiz-settings', array(&$this, 'display_options_page'));
            }
        }
    }
    $GLOBALS['easy_quiz_player'] = new EAZYQUIZPLAYER();
}

function easyquizplayer_func( $atts ) {
    $random_number = mt_rand(1000000000, 99999999999) ;
    return "<script id='mm-script-" . $random_number . "' type='text/javascript' src='" . $GLOBALS['EasyQuizPlayerServer']  . "/js/quizplayer/embed.js?quiz={$atts['id']}&language={$atts['language']}&size={$atts['size']}&script=mm-script-" . $random_number . "&design={$atts['design']}&width={$atts['width']}&height={$atts['height']}&fb_page=&fb_app=&question_id=0' charset='utf-8'></script>";
}

function easyquizplayer_manage_page() {
        if(function_exists('add_menu_page'))
        add_menu_page( __('EasyQuizPlayer'),
            __('Easy Quiz Player'), 'manage_options', 'easyquizplayer-page', 'easy_quiz_player_manage','',3);
        }

function easy_quiz_player_manage () {

    easy_quiz_player_load_css();
    include "eqz_website.php";
}

function easy_quiz_player_load_css()
{
    // bootstrap.css
    wp_register_style('bootstrap-style', plugins_url( 'css/bootstrap.css', __FILE__ ), array(), '', 'all' );
    wp_enqueue_style('bootstrap-style');

    // bootstrap-responsive.css
    wp_register_style('bootstrap-responsive-style', plugins_url( 'css/bootstrap-responsive.css', __FILE__ ), array(), '', 'all' );
    wp_enqueue_style('bootstrap-responsive-style');

    // index.css
    wp_register_style('index-style', plugins_url( 'css/index.css', __FILE__ ), array(), '', 'all' );
    wp_enqueue_style('index-style');

    // wordpress.css
    wp_register_style('wp-style', plugins_url( 'css/wordpress.css', __FILE__ ), array(), '', 'all' );
    wp_enqueue_style('wp-style');
}

