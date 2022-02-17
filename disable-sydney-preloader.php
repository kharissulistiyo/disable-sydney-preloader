<?php

/**
 * Disable Sydney Preloader
 *
 * @package     Disable Sydney Preloader
 * @author      kharisblank
 * @copyright   2020 kharisblank
 * @license     GPL-2.0+
 *
 * @sy-disable-preloader
 * Plugin Name: Disable Sydney Preloader
 * Plugin URI:  https://easyfixwp.com/
 * Description: This plugin disables preloader animation on Sydney WordPress theme. No extra settings. Just install and enable this plugin.
 * Version:     0.0.7
 * Author:      kharisblank
 * Author URI:  https://easyfixwp.com
 * Text Domain: sy-disable-preloader
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

// Disallow direct access to file
defined( 'ABSPATH' ) or die( __('Not Authorized!', 'sy-disable-preloader') );

define( 'SY_DISABLE_PRELOADER_FILE', __FILE__ );
define( 'SY_DISABLE_PRELOADER_URL', plugins_url( null, SY_DISABLE_PRELOADER_FILE ) );

if ( !class_exists('SY_Disable_Preloader') ) :
  class SY_Disable_Preloader {

    public function __construct() {

      add_action( 'init', array($this, 'disable_preloader'), 9999 );

    }

    /**
     * Check whether Sydney theme is active or not
     * @return boolean true if either Sydney or Sydney Pro is active
     */
    function is_sydney_active() {

      $theme  = wp_get_theme();
      $parent = wp_get_theme()->parent();

      if ( ($theme != 'Sydney' ) && ($theme != 'Sydney Pro' ) && ($parent != 'Sydney') && ($parent != 'Sydney Pro') ) {
        return false;
      }

      return true;

    }

    /**
     * Disale preloader
     * @return void
     */
    function disable_preloader() {
      if( $this->is_sydney_active() ) {
        remove_action('sydney_before_site', 'sydney_preloader');
        remove_action('wp_body_open', 'sydney_preloader');
        remove_action('elementor/theme/before_do_header', 'sydney_preloader');        
      }
    }


  }
endif;

new SY_Disable_Preloader;
