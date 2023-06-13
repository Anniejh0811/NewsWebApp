<?php


$conn = new mysqli("localhost","root","root","THENEWS","8889");
$result = mysqli_query($conn, "SELECT * FROM articletopic");
$result1 = mysqli_query($conn, "SELECT * FROM newsarticle");

$breakingNews = FALSE;
$todayVideo = TRUE;

$arr = array();
$topicArr = array();
while ($row = mysqli_fetch_assoc($result)) {
  $arr[] = $row;
  $topicArr[] = $row['topicname'];
}

function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

if(!empty($_GET['id'])){
  $todayVideo = FALSE;
  $breakingNews = FALSE;
  $id = $_GET['id'];
  $sql = "
    SELECT * FROM newsarticle
    WHERE topic='$id';
  ";
  $result1 = mysqli_query($conn, $sql);
  $arr1 = array();

  while ($row1 = mysqli_fetch_assoc($result1)) {
    $arr1[] = $row1;
  }
} else{
  $breakingNews = TRUE;
  $arr1 = array();
  while ($row1 = mysqli_fetch_assoc($result1)) {
    $arr1[] = $row1;
  }
}

// prettyPrint($arr);
// prettyPrint($arr1);
// prettyPrint($topicArr);

require_once("header.php"); 
require_once("app.php"); 
?>

    <!-- menu  -->
      <!-- menu  -->
      <div class="menu_outerbox" >
        <?php
        foreach($arr as $key => $val) { ?>
          <?php // if($val['topicname'] == "Today"){?>
            <?php if($id!=NULL && $val['topicname'] == $id){?>
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
        <div class="bknews_title_cont">
          <span class="breaking">&nbsp;Breaking&nbsp;<span class="news">&nbsp;New&nbsp;</span></span>
        </div>
        <?php foreach($arr1 as $key => $val) { 
          if($val['BNmain'] == TRUE){?>
            <div class="bknews_cont" onclick="toBRNewsPg(<?=$val['id']?>)">
              <span class="bknews_text"><?=$val['title']?></span>
              <img class="bknews_pic" src="<?=$val['pic']?>" alt="">
            </div>
          <?php } ?>
        <?php } ?>
      <?php } ?>

      <!-- Today's Reels -->
      <?php if($todayVideo === TRUE){ ?>
        <video src="ex1.mp4" type="video/mp4" controls></video>
      <?php } ?>

      <!-- recommended news  -->
      <div class="recommended_cont">
        <span class="sub_title">Recommended News</span>
          <div class="article_cont">
            <?php foreach($arr1 as $key => $val) { ?>
              <img class="each_article" src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)">
            <?php } ?>
          </div>
      </div>

    </main>
    </div>
    <?php require_once("footer.php"); ?>
  </body>
</html>
