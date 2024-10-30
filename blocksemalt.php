<?php
/*
Plugin Name: Block Semalt
Plugin URI: http://brickyardmarketing.com
Description: Activate this plugin and block semalt from your site.  Its that easy.
Version: 1.0
Author: Ryno Strategic Solutions
Author URI: http://brickyardmarketing.com
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'BlockSemalt' ) ) :

	class BlockSemalt {

		static function enable () {
			include_once ( ABSPATH . '/wp-admin/includes/misc.php' );
			$htaccess_file =  ABSPATH . '.htaccess';

			$rules = "RewriteEngine on\n";
			$rules .= "RewriteCond %{HTTP_REFERER} ^http://([^.]+\.)*semalt\.com [NC]\n";
			$rules .= "RewriteRule (.*) http://www.semalt.com [R=301,L]\n";
			
			$rules = explode ( "\n", $rules );
			insert_with_markers( $htaccess_file, 'Block Semalt', $rules );
		}

		static function disable () {
			include_once ( ABSPATH . '/wp-admin/includes/misc.php' );
			$htaccess_file =  ABSPATH . '.htaccess';

			insert_with_markers ( $htaccess_file, 'Block Semalt', '' );
		}
	}

	register_activation_hook ( __FILE__, array( 'BlockSemalt', 'enable' ) );
	register_deactivation_hook ( __FILE__, array( 'BlockSemalt', 'disable' ) );

endif;