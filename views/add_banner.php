<?php
global $wpdb;
require_once MILARDO_PATH.'lib/admin.lib.php';
if(isset($_GET['id'])){
  echo '<h1>'.L_EDIT_BANNER.'</h1>';
  if(isset($_POST['edit_banner'])){
    edit_banner($_POST['id'],$_POST['groupid'],$_POST['title'],$_POST['link'],$_POST['path'],$_POST['expires'],$_POST['clicks'],$_POST['type'],$_POST['status']);
    echo '<div id="message" class="updated fade"><p><strong>'.L_EDITED_BANNER.'</strong></p></div>';
  }
  $id = $_GET['id'];
  $row = get_banner_info($_GET['id']);
} else {
  echo '<h1>'.L_ADD_BANNER.'</h1>';
  if(isset($_POST['add_banner'])){
    add_banner($_POST['groupid'],$_POST['title'],$_POST['link'],$_POST['path'],$_POST['expires'],$_POST['clicks'],$_POST['type'],$_POST['status']);
    echo '<div id="message" class="updated fade"><p><strong>'.L_ADDED_BANNER.' <a href="?page=Banners&do=newb&id='.get_last_banner_id().'&edit">['.L_EDIT.']</a></strong></p></div>';
  }
}
?>

<form method="post">

<table class="form-table">
	<tr>
		<th><label for="title"><?=L_TITLE;?>(<?=L_OPTIONAL;?>)</label></th>
		<td><input value="<?=$row['title'];?>" type="text" name="title" id="title" class="regular-text" /><?=L_BANNER_TITLE;?></td>
	</tr>
	<tr>
		<th><label for="path">URL</label></th>
		<td><input value="<?=$row['path'];?>" type="text" name="path" id="path" class="regular-text" /><?=L_BANNER_URL;?></td>
	</tr>
	<tr>
		<th><label for="link">Link</label></th>
		<td><input value="<?=$row['link'];?>" type="text" name="link" id="link" class="regular-text" /><?=L_BANNER_LINK;?></td>
	</tr>
	<tr>
		<th><label for="link">Clicks</label></th>
		<td><input value="<?=$row['expiration_clicks'];?>" type="text" name="clicks" id="clicks" class="regular-text" /><?=L_CLICKS_LIMIT;?> <b>(<?=L_LEAVE_BLANK_CASE;?>)</b></td>
	</tr>
	<tr>
		<th><label for="target"><?=L_TARGET;?></label></th>
		<td><select name="type"><option value=""><?=L_SELF_WINDOW;?></option><option value="_blank" <?php if($row['type'] !== ""){ echo 'selected'; } ?>><?=L_NEW_WINDOW;?></option></select><?=L_HOWTO_OPEN_BANNER;?></td>
	</tr>
	<tr>
		<th><label for="groupid">Campaña</label></th>
		<td><?=get_groups_select($id);?><?=L_CHOOSE_GROUP;?></td>
	</tr>
	<tr>
	<th><label for="status"><?=L_STATUS;?></label></th>
		<td><select name="status"><option value="1"><?=L_ENABLED;?></option><option value="0"<?php if($row['status'] == 0){ echo ' selected'; } ?>><?=L_DISABLED;?></option></select><?=L_ED_BANNER;?></td>
	</tr>
<?php 
 if(isset($_GET['id'])){
?>
<tr>
<th>Vista previa</th>
<td><img src="<?=get_option('siteurl');?>/wp-content/plugins/milabanners/lib/third_party/phpthumb/phpThumb.php?src=<?=$row['path']?>&h=<?=get_height($row['itid']);?>&w=<?=get_width($row['itid']);?>&iar=1" /></td>
</tr>
<?=generate_custom_banner_chart($row['itid']);?>
<?php
 }
?>
</table>
<p class="submit">
<?php
  if(!isset($_GET['edit'])):
?>
	<input type="submit" class="button-primary" value="<?=L_ADD;?>" name="add_banner" />
<?php
  else:
?>
	<input type="hidden" name="id" value="<?=$_GET['id']?>" />
	<input type="submit" class="button-primary" value="<?=L_EDIT;?>" name="edit_banner" />
<?php
  endif;
?>
</p>
</form>