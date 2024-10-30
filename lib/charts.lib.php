<?php
  function generate_clicks_chart(){
    global $wpdb;
    $query = $wpdb->get_results("SELECT COUNT(*) as day FROM wp_banners_clicks GROUP BY DAY(date) ASC", ARRAY_A);
    $chart = 'http://chart.apis.google.com/chart?cht=lc&chs=400x250&chd=t:';
    foreach($query as $row){
      $click[] = $row['day']*10;
    }
    $clicks = implode(",",$click);
    $chart = '<img src="'.$chart.$clicks.'" />';
    return $chart;
  }

  function generate_custom_banner_chart($id){
    global $wpdb;
    $row = $wpdb->get_row("SELECT * FROM `wp_banners_items` WHERE itid = $id", ARRAY_A);
    $total_clicks = $row['expiration_clicks'];
    if($row['expiration_clicks']>=1){
      $clicked = $row['clicks'];
      $clicked_percent = $clicked*100/$total_clicks;
      $rest_percent = 100-$clicked_percent;
      $rest = $row['expiration_clicks']-$row['clicks'];
      $img = '
<tr><th>Clicks</th><td><img src="http://chart.apis.google.com/chart?cht=p3&chd=t:'.$rest_percent.','.$clicked_percent.'&chco=CCCCCC,333333&chs=400x100&chp=0.628&chl=Restantes('.$rest.')|Usados('.$clicked.')" /></td></tr>';
      echo $img;
    }
  }

?>
