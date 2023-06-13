<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");


$results = mysqli_query($conn, "SELECT * FROM articletopic");

$arrs = array();

while ($row = mysqli_fetch_assoc($results)) {
    // printf("%s (%s)\n", $row[0], $row[1]);
    $arrs[] = $row;
  }


//   function prettyPrint($a) {
//     echo "<pre>";
//     print_r($a);
//     echo "</pre>";
//   }
//   echo '<pre>';
//   print_r($arrs);
//   echo '</pre>';
  // prettyPrint($arr);
//   prettyPrint($arrs);
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />     
    <!-- <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"> -->

    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- <script src="app.js"></script> -->
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@400;500;600;700&family=Engagement&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
        <!-- <div class="outline"> -->
    <header>
      <div>
          <a href=""><?=$row['topicname']?></a>
          <i class="fa fa-bars icon" onclick="openNav()"></i>
      </div>
      <div class="logo">
          <span onclick="toHomePg()">THE NEWS</span>
      </div>
      <div>
          <i class="fa fa-search icon"></i>
      </div>
    </header>

<body>

<div id="mySidenav" class="sidenav">
    <div style="padding: 16px; text-align: right;">
        <i class="fa fa-times icon" style="font-size: 25px;" onclick="closeNav()"></i>
    </div>
    <!-- <div style="padding: 16px; font-size: 20px;">
        <span>Sections</span>
    </div> -->

    <h2><span>Sections</span></h2>
  <?php foreach($arrs as $k => $val){ ?>
    <div class="eachMenu" onclick="topic('<?=$arrs[$k]['topicname']?>')">
        <span><?=$arrs[$k]['topicname']?></span>
    </div>
    <?php } ?>

    <!-- <div class="line"></div> -->
    <h2><span>Media</span></h2>
    <div class="eachMenu" onclick="toAudio()">
        <span>Audio</span>
    </div>
    <div class="eachMenu" onclick="toVideo()">
        <span>Video</span>
    </div>
</div>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "220px";
//   document.getElementById("mySidenav").style.backgroundColor = "white";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

