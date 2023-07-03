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

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />     
    <title>THE NEWS</title>
    <link rel="stylesheet" type="text/css" href="stylesAdmin.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@400;500;600;700&family=Engagement&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
  </head>
  <header>
    <div>
        <!-- <a href=""><?=$row['topicname']?></a> -->
        <i class="fa fa-bars icon" onclick="openNavAdmin()"></i>
    </div>
    <div class="logo">
        <span style="color:black; "onclick="toHomePg()">THE NEWS <span style="color: #E9133E;" >ADMIN</span></span>
    </div>
   
  </header>
  <body>
    <ol>
      <?=$list?>
    </ol>

    <form style="margin:8px;" action="create_article.php" method="POST">
      <div class="adminEachBox">
        <p>Title</p>
        <p><input type="text" name="title" placeholder="title"></p>
      </div>
      <div class="adminEachBox">
        <p>Picture</p>
        <p><textarea name="pic" placeholder="pic"></textarea></p>
      </div>
      <div class="adminEachBox">
        <p>Content</p>
        <p><textarea name="content" placeholder="content"></textarea></p>
      </div>
      <div class="adminEachBox">
        <p>Topic</p>
        <p><textarea name="topic" placeholder="topic"></textarea></p>
      </div>
      <div class="adminEachBox">
        <p>Likes</p>
        <p><input type="number" name="likes" placeholder="likes"></p>
      </div>
      <div class="adminEachBox">
        <p>hates</p>
        <p><input type="number" name="hates" placeholder="hates"></p>
      </div>
      <div class="adminEachBox adminCheckBox">
        <p>Recommended</p>
        <p><input type="checkbox" name="recommended" placeholder="recommended"></p>
        </div>
        <div class="adminEachBox adminCheckBox">
        <p>BreakingNews</p>
      <p><input type="checkbox" name="breakingNews" placeholder="breakingNews"></p>
      </div>
      <div class="adminEachBox">
        <p>Author</p>
      <p><input type="text" name="author" placeholder="author"></p>
      </div>
      
      <p><input type="submit"></p>
    </form>

    <div id="mySidenav" class="sidenav" >
      <div style="padding: 16px; text-align: right;">
          <i class="fa fa-times icon" style="font-size: 25px;" onclick="closeNavAdmin()"></i>
      </div>

      <h2><span>Sections</span></h2>

      <h2><span>Media</span></h2>
      <div class="eachMenu" onclick="toAudio()">
          <span>Audio</span>
      </div>
      <div class="eachMenu" onclick="toVideo()">
          <span>Video</span>
      </div>
  </div>
    
  </body>
</html>

<script>
  function openNavAdmin() {
  document.getElementById("mySidenav").style.width = "220px";
}

function closeNavAdmin() {
  document.getElementById("mySidenav").style.width = "0px";
}
</script>