<?php

function create_new_group($name,$desc,$w,$h){
  global $wpdb;
  return $wpdb->query("
		  INSERT INTO wp_banners_groups (
		  `id` ,
		  `name` ,
		  `desc` ,
		  `w` ,
		  `h`
		  )
		  VALUES (
		  NULL , '$name', '$desc', '$w', '$h'
		  );
  ");
}
function edit_group($id,$name,$desc,$w,$h){
  global $wpdb;
  return $wpdb->query("UPDATE `wp_banners_groups` SET `name` = '$name',
`desc` = '$desc', `desc` = '$w', `h` = '$h' WHERE `id` =$id LIMIT 1 ;");
}
function delete_group($id){
  global $wpdb;
  return $wpdb->query("DELETE FROM `wp_banners_groups` WHERE `id` = $id LIMIT 1");
}
function get_group_info($id){
  global $wpdb;
  $id = intval($id);
  $row = $wpdb->get_row("SELECT * FROM wp_banners_groups WHERE id = $id LIMIT 1", ARRAY_A);
  return $row;
}
function get_groups_select($id){
  global $wpdb;
  $buff;
  $query = $wpdb->get_results("SELECT * FROM wp_banners_groups ORDER BY name DESC",ARRAY_A);
  $buff .= '<select name="groupid">';
  foreach ($query as $row):
    $buff .= '<option value="'.$row['id'].'"';
    if(get_banner_group($id) == $row['id']):
      $buff .= ' selected';
    endif;
    $buff .= '>'.$row['name'].'</option>';
  endforeach;
  $buff .= '</select>';
  return $buff;
}
function add_banner($groupid,$title,$link,$path,$expires,$clicks,$type,$status){
  global $wpdb;
  return $wpdb->query("INSERT INTO `wp_banners_items` (
  `itid` ,
  `groupid` ,
  `title` ,
  `link` ,
  `path` ,
  `type` ,
  `expiration_date` ,
  `expiration_clicks`,
  `status`
  )
  VALUES (
  NULL , '$groupid', '$title', '$link', '$path', '$type', '$expires', '$clicks', '$status'
  );
  ");
  unset($_POST);
}
function edit_banner($id,$groupid,$title,$link,$path,$expires,$clicks,$type,$status){
  global $wpdb;
  $id = (int)$id;
  $groupid = (int)$groupid;
  $status = (int)$status;
  return $wpdb->query("UPDATE `wp_banners_items` SET 
`title` = '$title',
`link` = '$link',
`path` = '$path',
`type` = '$type',
`expiration_clicks` = '$clicks',
`groupid` = '$groupid',
`status` = $status WHERE `itid` =$id LIMIT 1 ;");
  unset($_POST);
}
function get_banner_info($id){
  global $wpdb;
  $id = intval($id);
  $row = $wpdb->get_row("SELECT * FROM wp_banners_items WHERE itid = $id LIMIT 1", ARRAY_A);
  return $row;
}
function get_last_banner_id(){
  global $wpdb;
  $row = $wpdb->get_row("SELECT * FROM wp_banners_items ORDER BY itid DESC LIMIT 1", ARRAY_A);
  return $row['itid'];
}
function delete_banner($id){
  global $wpdb;
  return $wpdb->query("DELETE FROM `wp_banners_items` WHERE `itid` = $id LIMIT 1");
}
function get_width($id){
  global $wpdb;
  $row = $wpdb->get_row("SELECT * FROM wp_banners_items, wp_banners_groups WHERE itid = $id AND id = groupid",ARRAY_A);
  return $row['w'];
}
function get_height($id){
  global $wpdb;
  $row = $wpdb->get_row("SELECT * FROM wp_banners_items, wp_banners_groups WHERE itid = $id AND id = groupid",ARRAY_A);
  return $row['h'];
}
function get_last_group_id(){
  global $wpdb;
  $row = $wpdb->get_row("SELECT * FROM wp_banners_groups ORDER BY id DESC LIMIT 1", ARRAY_A);
  return $row['id'];
}
function get_banner_group($id){
  global $wpdb;
  $row = $wpdb->get_row("SELECT * FROM wp_banners_items WHERE itid = $id LIMIT 1", ARRAY_A);
  return $row['groupid'];
}
function has_groups(){
  global $wpdb;
  $row = $wpdb->get_results("SELECT * FROM wp_banners_groups");
  echo var_dump($row);
}
?>