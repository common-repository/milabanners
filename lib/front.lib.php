<?php
  function rotate_banners($groupid){
    global $wpdb;
    $buff;
    $row = $wpdb->get_row("SELECT * FROM wp_banners_items WHERE expiration_clicks <= clicks AND groupid = $groupid AND status = 1 ORDER BY RAND() LIMIT 1",ARRAY_A);
    add_impression($row['itid']);
    $buff .= '<a ';
    if(!empty($row['type'])){
      $buff .= 'target="'.$row['type'].'"';
    }
    $buff .= 'href="?redirect='.$row['itid'].'"><img src="'.get_option('siteurl').'/wp-content/plugins/milabanners/lib/third_party/phpthumb/phpThumb.php?src='.$row['path'].'&h='.get_height($row['itid']).'&w='.get_width($row['itid']).'&iar=1" /></a>';
    return $buff;
  }
  function get_url($id){
    global $wpdb;
    $row = $wpdb->get_row("SELECT * FROM wp_banners_items WHERE itid = $id",ARRAY_A);
    return $row['path'];
  }
  function get_redirection_link($id){
    global $wpdb;
    $row = $wpdb->get_row("SELECT * FROM wp_banners_items WHERE itid = $id",ARRAY_A);
    return $row['link'];
  }
  function redirect_banner($id){
    global $wpdb;
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d H:i:s");
    $wpdb->query("UPDATE `wp_banners_items` SET `clicks` = clicks+1 WHERE `itid` =$id LIMIT 1 ;");
    $wpdb->query("INSERT INTO `wp_banners_clicks` (
      `clickid` ,
      `bannerid` ,
      `ip` ,
      `date`
      )
      VALUES (
      NULL , '$id', '$ip', '$date'
      );
    ");
    add_action('template_redirect', 'do_redirect_banner');
  }
  function add_impression($id){
    global $wpdb;
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d H:i:s");
    $wpdb->query("INSERT INTO `wp_banners_impresions` (
	`impid` ,
	`ip` ,
	`date` ,
	`bannerid`
	) VALUES (
	  NULL , '$ip', '$date', '$id'      );
      ");
    

  }
  function do_redirect_banner(){
    wp_redirect(get_redirection_link($_GET['redirect']));
  }
?>