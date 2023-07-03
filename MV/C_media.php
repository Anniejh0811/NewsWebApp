<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");

$breakingNews = FALSE;
$todayVideo = TRUE;
$zipcode = $_GET['zipcode'];

function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

$sql = "
SELECT * FROM newsarticle_img;
";

$sql2 = "
SELECT * FROM articletopic;
";

$sql3 = "
SELECT * FROM audio_table;
";

$result3 = mysqli_query($conn, $sql3);
$arr3 = array();
while ($row1 = mysqli_fetch_assoc($result3)) {
    $arr3[] = $row1;
}

$result2 = mysqli_query($conn, $sql2);
$arr2 = array();

while ($row1 = mysqli_fetch_assoc($result2)) {
    $arr2[] = $row1;
}

$result1 = mysqli_query($conn, $sql);
$arr1 = array();

while ($row1 = mysqli_fetch_assoc($result1)) {
    $arr1[] = $row1;
}

function validateVideoType($link) {
    $url_parsed_arr = parse_url($link);
    $imgArr = array("jpg", "gif", "png");
    $videoArr = array("mp4", "3gp", "ogg");


    foreach ($videoArr as $token) {
        if (stristr($url_parsed_arr['path'], $token) == TRUE) {
            // print "String contains: $token\n";
            return "video";
        }
    }
}

$new = "
SELECT * FROM newsarticle_img ORDER BY created DESC;
";
$resultNew = mysqli_query($conn, $new);
$arrNew = array();

while ($row1 = mysqli_fetch_assoc($resultNew)) {
    $arrNew[] = $row1;
}

$likes = "
SELECT * FROM newsarticle_img ORDER BY likes_img DESC;
";
$resultHot = mysqli_query($conn, $likes);
$arrHot = array();
  
while ($row1 = mysqli_fetch_assoc($resultHot)) {
    $arrHot[] = $row1;
}

$recommended = "
SELECT newsarticle.id, newsarticle.recommended, newsarticle_img.value, newsarticle_img.mediaId, newsarticle_img.created
FROM newsarticle_img
LEFT JOIN newsarticle
ON newsarticle.id = newsarticle_img.topicId
WHERE recommended=1
ORDER BY created DESC;
";

$resultRecommended = mysqli_query($conn, $recommended);
$arrRecommended = array();

while ($row1 = mysqli_fetch_assoc($resultRecommended)) {
    $arrRecommended[] = $row1;
  }

$arrVideo = array();

if ($_GET['cat'] === "you"){
  $arrVideo = $arrRecommended;
} else if($_GET['cat'] === "hot"){
  $arrVideo = $arrHot;
} else if($_GET['cat'] === "new"){
  $arrVideo = $arrNew;
} else{
  $arrVideo = $arr1;
}

$arrSelect = array();
if(isset($_GET['catOption']) && $_GET['catOption'] != NULL){
  $sqlSelect = "
  SELECT * FROM newsarticle_img
  WHERE topicId = ".$_GET['catOption'].
  ";"
  ;

  $resultSelect = mysqli_query($conn, $sqlSelect);
  while ($row1 = mysqli_fetch_assoc($resultSelect)) {
    $arrSelect[] = $row1;
  }
  $arrVideo = $arrSelect;
}

$arrAll = array();
if($_GET['catOption'] == 10 || !isset($_GET['catOption'])){
  $sqlAll = "
  SELECT * FROM newsarticle_img;
  ;"
  ;
  $resultAll = mysqli_query($conn, $sqlAll);
  while ($row1 = mysqli_fetch_assoc($resultAll)) {
    $arrAll[] = $row1;
  }
  $arrVideo = $arrAll;

}

$sqlVideo = "";
if(isset($_GET['cat']) && isset($_GET['catOption']) && $_GET['catOption'] != NULL && $_GET['cat'] != NULL){
  if($_GET['cat'] == "you"){
    if($_GET['catOption'] == 10){
      $sqlVideo = "
      SELECT newsarticle.id, newsarticle.recommended, newsarticle_img.value, newsarticle_img.mediaId, newsarticle_img.created
      FROM newsarticle_img
      LEFT JOIN newsarticle
      ON newsarticle.id = newsarticle_img.topicId
      WHERE recommended=1 ORDER BY created DESC;";

    } else {
      $sqlVideo = "
      SELECT newsarticle.id, newsarticle.recommended, newsarticle_img.value, newsarticle_img.mediaId, newsarticle_img.created
      FROM newsarticle_img
      LEFT JOIN newsarticle
      ON newsarticle.id = newsarticle_img.topicId
      WHERE recommended=1 AND topicId = ".$_GET['catOption'].
    " ORDER BY created DESC;";
    }
}

if($_GET['cat'] == "hot"){
    if($_GET['catOption'] == 10){
        $sqlVideo = "
        SELECT * FROM newsarticle_img ORDER BY likes_img DESC;
        ";
    } else {
        $sqlVideo = "
        SELECT * FROM newsarticle_img WHERE topicId = ".$_GET['catOption']." ORDER BY likes_img DESC;
        ";
    }
}

if($_GET['cat'] == "new"){
    if($_GET['catOption'] == 10){
      $sqlVideo = "
      SELECT * FROM newsarticle_img ORDER BY created DESC;
      ";
    } else{
      $sqlVideo = "
    SELECT * FROM newsarticle_img WHERE topicId = ".$_GET['catOption']." ORDER BY created DESC;
    ";
    }
}

$arrTgt = array();
$resultVideo = mysqli_query($conn, $sqlVideo);
while ($row1 = mysqli_fetch_assoc($resultVideo)) {
  $arrTgt[] = $row1;
}
$arrVideo = $arrTgt;
}

$arrAudio = array();
$arrAll2 = array();

if($_GET['catOption2'] == 10 || !isset($_GET['catOption2'])){
    $sqlAll2 = "
    SELECT * FROM audio_table;";

    $resultAll2 = mysqli_query($conn, " SELECT * FROM audio_table;");

    while ($row1 = mysqli_fetch_assoc($resultAll2)) {
        $arrAll2[] = $row1;
    }
    $arrAudio = $arrAll2;
}

$arrSelect2 = array();

if(isset($_GET['catOption2']) && $_GET['catOption2'] != NULL && $_GET['catOption2'] != 10){
  $sqlSelect2 = "
  SELECT * FROM audio_table
  WHERE audioTopic = ".$_GET['catOption2'].";"
  ;

  $resultSelect2 = mysqli_query($conn, $sqlSelect2);
  while ($row1 = mysqli_fetch_assoc($resultSelect2)) {
    $arrSelect2[] = $row1;
  }
  $arrAudio = $arrSelect2;
}

$arrNum = count($arr1);
$pgId = $_GET['pgId'];
$cat = $_GET['catOption'];
?>