<?php
   /*
      Plugin Name: Milardo banners
      Plugin URI: http://milardovich.com.ar/
      Description: A good plugin to administrate your banners.
      Version: 0.1
      Author: Sergio Milardovich
      Author URI: http://milardovich.com.ar
   */

	// Defines a lo milardo(klemode = true)
	define("MILARDO_PATH", dirname(__FILE__).'/', true);

	define("PLUGIN_LANGUAGE", "en", true);
	
	// Install/Uninstall/Generate admin pannel functions
	require_once MILARDO_PATH.'lib/install.lib.php';
	// Language functions
	require_once MILARDO_PATH.'lang/'.PLUGIN_LANGUAGE.'/main.php';
	// Front-end functions
	require_once MILARDO_PATH.'lib/front.lib.php';
	// Add/edit/remove(Back-end functions)
	require_once MILARDO_PATH.'lib/admin.lib.php';
	//Charts library
	require_once MILARDO_PATH.'lib/charts.lib.php';

	// Core actions
	add_action('activate_milabanners/main.php','milabanners_install');
	add_action('deactivate_milabanners/main.php', 'milabanners_remove');

	if(isset($_GET['redirect'])){
	  redirect_banner($_GET['redirect']);
	}


?>