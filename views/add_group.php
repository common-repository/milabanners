<?php
global $wpdb;
require_once MILARDO_PATH.'lib/admin.lib.php';
if(isset($_POST['add_group'])){
  create_new_group($_POST['name'],$_POST['desc'],$_POST['w'],$_POST['h']);
 echo '<div id="message" class="updated fade"><p><strong>'.L_GROUP_SUCCESS.'. <a href="?page=Banners&do=newc&id='.get_last_group_id().'&edit">['.L_EDIT.']</a></strong></p></div>';
}
if(isset($_POST['edit_group'])){
 edit_group($_POST['id'],$_POST['name'],$_POST['desc'],$_POST['w'],$_POST['h']);
 echo '<div id="message" class="updated fade"><p><strong>'.L_EDIT_SUCCESS_GROUP.'.</strong></p></div>';
}
if(isset($_GET['id'])){
  $row = get_group_info($_GET['id']);
  $name = $row['name'];
  $h = $row['h'];
  $w = $row['w'];
  $description = $row['desc'];
  echo '<h1>'.L_EDIT_GROUP.'</h1>';
} else {
  echo '<h1>'.L_ADD_GROUP.'</h1>';
}
?>

<form method="post">
<table class="form-table">
	<tr>
		<th><label for="name"><?=L_NAME;?></label></th>
		<td><input value="<?=$name;?>" type="text" name="name" id="name" class="regular-text" /><?=L_CHOOSE_GROUP_NAME;?></td>
	</tr>
	<tr>
		<th><label for="name"><?=L_H;?></label></th>
		<td><input value="<?=$h;?>" type="text" name="h" id="h" class="regular-text" /><?=L_BANNERS_H;?></td>
	</tr>
	<tr>
		<th><label for="name"><?=L_W;?></label></th>
		<td><input value="<?=$w;?>" type="text" name="w" id="w" class="regular-text" /><?=L_BANNERS_W;?></td>
	</tr>
	<tr>
		<th><label for="description"><?=L_DESCRIPTION;?></label>(<?=L_OPTIONAL;?>)</th>
		<td><input value="<?=$description?>" type="text" name="desc" id="description" class="regular-text" /></td>
	</tr>
</table>
<p class="submit">
<?php
  if(!isset($_GET['edit'])):
?>
	<input type="submit" class="button-primary" value="<?=L_ADD;?>" name="add_group" />
<?php
  else:
?>
	<input type="hidden" name="id" value="<?=$_GET['id']?>" />
	<input type="submit" class="button-primary" value="<?=L_EDIT;?>" name="edit_group" />
<?php
  endif;
?>
</p>
</form>