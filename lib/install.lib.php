<?php
  /* Install/delete plugin */
  function milabanners_install(){
    global $wpdb;
  //TABLA PARA CLICKS
    $wpdb->query("CREATE TABLE IF NOT EXISTS `wp_banners_clicks` (
  `clickid` int(11) unsigned NOT NULL auto_increment,
  `bannerid` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`clickid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;
");
  //TABLA DE CAMPAÑAS
  $wpdb->query("
CREATE TABLE IF NOT EXISTS `wp_banners_groups` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `desc` text NOT NULL,
  `w` int(11) NOT NULL COMMENT 'width in pixels',
  `h` int(11) NOT NULL COMMENT 'height in pixels',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;
");
  // TABLA DE IMPRESIONES
  $wpdb->query("
CREATE TABLE IF NOT EXISTS `wp_banners_impresions` (
  `impid` int(11) unsigned NOT NULL auto_increment,
  `ip` varchar(16) NOT NULL,
  `date` datetime NOT NULL,
  `bannerid` int(11) NOT NULL,
  PRIMARY KEY  (`impid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1");
  // TABLA DE BANNERS
  $wpdb->query("
CREATE TABLE IF NOT EXISTS `wp_banners_items` (
  `itid` int(11) unsigned NOT NULL auto_increment,
  `groupid` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `link` varchar(256) NOT NULL COMMENT 'URL of the link',
  `path` varchar(256) NOT NULL COMMENT 'Image path',
  `type` varchar(16) NOT NULL,
  `status` int(1) NOT NULL default '1',
  `expiration_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `expiration_clicks` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL,
  PRIMARY KEY  (`itid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1");
  }
  function milabanners_remove(){
    global $wpdb;
    $wpdb->query("DROP TABLE `wp_banners_clicks`");
    $wpdb->query("DROP TABLE `wp_banners_impresions`");
    $wpdb->query("DROP TABLE `wp_banners_items`");
    $wpdb->query("DROP TABLE `wp_banners_groups`");
  }


  function milabanners_menu(){
    global $wpdb;
    switch($_GET['do']){
      case 'newc':
      include_once MILARDO_PATH.'views/add_group.php';
      break;
      case 'editc':
      include_once MILARDO_PATH.'views/edit_groups.php';
      break;
      case 'newb':
      include_once MILARDO_PATH.'views/add_banner.php';
      break;
      case 'editb':
      include_once MILARDO_PATH.'views/edit_banners.php';
      break;
      default:
      include_once MILARDO_PATH.'views/main.php';
      break;
    }
  }
 
  function milabanners_admin_actions(){
    add_menu_page("Banners", "Banners", 1,"Banners", "milabanners_menu", get_settings('siteurl')."/wp-content/plugins/milabanners/media/announce.png");
    add_submenu_page("Banners", "Banners", L_NEW_GROUP, 1,"Banners&do=newc", "milabanners_menu");
    add_submenu_page("Banners", "Banners", L_EDIT_GROUPS, 1,"Banners&do=editc", "milabanners_menu");
    add_submenu_page("Banners", "Banners", L_NEW_BANNER, 1,"Banners&do=newb", "milabanners_menu");
    add_submenu_page("Banners", "Banners", L_EDIT_BANNERS, 1,"Banners&do=editb", "milabanners_menu");

  }
  add_action('admin_menu', 'milabanners_admin_actions');
?>