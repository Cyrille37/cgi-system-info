<?php

/*
  Plugin Name: CGI System Info
  Plugin URI: https://github.com/Cyrille37/cgi-system-info
  Description: Getting system information about Php and WordPress
  Author: Cyrille Giquello
  Author URI: http://cyrille37.myopenid.com/
  Version: 1.0

  Copyright (c) 2012 Cyrille Giquello

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License along with this program;
  if not:
  - get it at http://www.gnu.org/licenses/gpl-3.0.en.html
  - or write to the Free Software Foundation, Inc.,
  51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

if (!defined('ABSPATH')) {
	header('Location:/');
	exit();
}
if (!class_exists('CgiSystemInfo')) {

	class CgiSystemInfo {

		const PLUGIN = 'cgi-system-info';
		const WP_ROLE = 'edit_pages';
		const PAGE_OVERVIEW = 'cgi-system-info_overview';

		public function __construct() {

			register_activation_hook(__FILE__, array($this, 'wp_activate'));
			register_deactivation_hook(self::PLUGIN, array($this, 'wp_deactivate'));

			add_action('admin_init', array($this, 'wp_admin_init'));
			add_action('admin_menu', array($this, 'wp_admin_menu'));
		}

		public function wp_activate() {
			
			//self::_log(__METHOD__);

			// Nothing done, plugin is activated
			// return false ;

			// L’extension n’a pu être activée, car elle a déclenché une erreur fatale.
			//	Fatal error: Uncaught exception 'Exception' with message 'Argh!' 
			//throw new Exception('Argh!');

			// Page blanche avec le messsage html
			//wp_die('<p>Argh!<p><ul><li>Revenir plus tard</li><li>Ne jamais revenir</li></ul>');
		}

		public function wp_deactivate() {

			//self::_log(__METHOD__);
			
		}

		public function wp_admin_init() {
			
		}

		public function wp_admin_menu() {

			add_menu_page(__('System Info', self::PLUGIN), __('System Info', self::PLUGIN), self::WP_ROLE, self::PAGE_OVERVIEW,
				array($this, 'wp_on_menu'));

			add_submenu_page(self::PAGE_OVERVIEW, __('Overview', self::PLUGIN), __('Overview', self::PLUGIN), self::WP_ROLE,
				self::PAGE_OVERVIEW, array($this, 'wp_on_menu'));
		}

		public function wp_on_menu() {

			switch ($_GET['page']) {
				case self::PAGE_OVERVIEW :

					include( __DIR__ . '/templates/page_overview.php' );
					break;
			}
		}

		public static function _log( $msg )
		{
			if(is_array($msg) || is_object($msg))
				error_log( print_r($msg,true) );
			else
				error_log($msg);
		}

	}

	global $cgiSystemInfo;
	$cgiSystemInfo = new CgiSystemInfo();
}
