<h1><?=L_CHOOSE_EDIT_BANNER;?></h1>
<?php
  global $wpdb;
  if(isset($_GET['del'])){
    delete_banner($_GET['del']);
    echo '<div id="message" class="updated fade"><p><strong>'.L_DELETED_BANNER.'.</strong></p></div>';
  }
  $query = $wpdb->get_results("SELECT * FROM wp_banners_items",ARRAY_A);
?>
  <ul>
<?php
  foreach ($query as $row):
?>
  <li>[<?=$row['itid']?>]  <?=$row['title']?>(<?=$row['path']?>) <a title="<?=$row['title']?>" href="?page=Banners&do=newb&id=<?=$row['itid']?>&edit"><?=L_EDIT;?></a> | <a href="?page=Banners&do=editb&del=<?=$row['itid']?>"><?=L_REMOVE;?></a></li>
<?php
  endforeach;
?>
</ul>