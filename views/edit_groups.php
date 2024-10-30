<h1><?=L_CHOOSE_EDIT_GROUP;?></h1>
<?php
  global $wpdb;
  if(isset($_GET['del'])){
    delete_group($_GET['del']);
    echo '<div id="message" class="updated fade"><p><strong>'.L_DELETED_GROUP.'.</strong></p></div>';
  }
  $query = $wpdb->get_results("SELECT * FROM wp_banners_groups",ARRAY_A);
?>
  <ul>
<?php
  foreach ($query as $row):
?>
  <li>[<?=$row['id']?>]  <?=$row['name']?> <a title="<?=$row['desc']?>" href="?page=Banners&do=newc&id=<?=$row['id']?>&edit"><?=L_EDIT;?></a> | <a href="?page=Banners&do=editc&del=<?=$row['id']?>"><?=L_REMOVE;?></a></li>
<?php
  endforeach;
?>
</ul>