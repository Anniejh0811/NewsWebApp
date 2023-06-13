<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");

$result = mysqli_query($conn, "SELECT * FROM articletopic");

$result1 = mysqli_query($conn, "SELECT * FROM newsarticle");

// if(mysqli_query($conn, "SELECT * FROM articletopic")){
//     echo 1;
// }else{
//     echo mysqli_error($conn);
// }
// $row = mysqli_fetch_array($result);
// print_r(mysqli_fetch_array($result), MYSQLI_NUM);
$breakingNews = TRUE;
$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
  // printf("%s (%s)\n", $row[0], $row[1]);
  $arr[] = $row;
}

$arr1 = array();
while ($row1 = mysqli_fetch_assoc($result1)) {
  // printf("%s (%s)\n", $row[0], $row[1]);
  $arr1[] = $row1;
}
// print_r($arr);

function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

prettyPrint($arr);
prettyPrint($arr1);

// $rows = '';
// while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
//   $rows[] = $row;
// }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />     <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Arima:wght@400;500;600;700&family=Engagement&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <body>
    <header>

            <div>
                <a href=""><?=$row['topicname']?></a>
                <i class="fa fa-bars icon"></i>
            </div>
            <div class="logo">
                <span>THE NEWS</span>
            </div>
            <div>
                <i class="fa fa-search icon"></i>
            </div>

    </header>
      <!-- menu  -->
      <div class="menu_outerbox" >
        <?php
        foreach($arr as $key => $val) { 
          if($val['topicname'] == "Today"){?>
          <div class="vertical_align">
            <div class="center">
              <!-- <p>Today</p> -->
              <img class="todayTopic" style="" src="<?=$val['link']?>" alt="" onclick="toHomePg()">
            </div>
            <span><?=$val['topicname']?></span>
          </div>
          <?php } else {?>
          <div class="vertical_align" onclick="topic('<?=$val['topicname']?>')">
            <img src="<?=$val['link']?>" alt="">
            <span><?=$val['topicname']?></span>
          </div>
          <?php } ?>
        <?php } ?>
      </div>
      
  
    <main>
      <!-- breaking news -->
      <?php if($breakingNews == TRUE) {?>
        <div style="position:relative; top: 10px; ">
        <span style="background: #bb5050; color: white;">&nbsp;Breaking&nbsp;<span style="background: white; color: black;">&nbsp;New&nbsp;</span></span>

        </div>
        <div style="background: rgba(230, 227, 227, 0.35); display: flex; align-items:center; padding: 8px;" >
        <?php
        foreach($arr1 as $key => $val) { 
          if($val['BNmain'] == TRUE){?>
          <span style="display:block; font-family: inter; font-size: 14px; line-height:initial; font-weight:600;"><?=$val['title']?></span>
          <img style="width: 129px; height: 89px;" src="<?=$val['pic']?>" alt="">
          <?php } ?>
        <?php } ?>

        </div>

      <?php } ?>

      <!-- Today's Reels -->
      <video src="ex1.mp4" type="video/mp4" controls></video>

      <div style="padding: 8px 0px; width:100%; ">
      <span style="display: block; font-family: Arima; font-weight: 500; font-size: 20px; margin: 8px 0px;">Recommended News</span>
      <div style="display:flex; flex-wrap: wrap; ">
  
      <?php foreach($arr1 as $key => $val) { ?>
        <img style="width: 50%;" src="<?=$val['pic']?>" alt="">

      <?php } ?>
      </div>
      </div>
    </main>

    <div class="sticky">
      <div class="navbar">
        <div class="each_cont vertical_align" >
          <i class="fas fa-music"></i>
          <span class="each_menu_title">Life</span>
        </div>
        <div class="each_cont vertical_align">
          <i class="fas fa-regular fa-film"></i>
          <span class="each_menu_title">Media</span>
        </div>
        <div class="each_cont vertical_align">
          <i class="fas fa-home"></i>
          <span class="each_menu_title">Home</span>
        </div>
        <div class="each_cont vertical_align">
          <i class="fas fa-users"></i>
          <span class="each_menu_title">Community</span>
        </div>
        <div class="each_cont vertical_align">
          <i class="fas fa-bookmark"></i>
          <span class="each_menu_title">Saved</span>
        </div>

</body>
</html>
