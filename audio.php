<?php


$conn = new mysqli("localhost","root","root","THENEWS","8889");


$breakingNews = FALSE;
$todayVideo = TRUE;



function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

// if(!empty($_GET['articleId'])){
//   $todayVideo = FALSE;
//   $breakingNews = FALSE;
//   $articleId = $_GET['articleId'];
//   $sql = "
//     SELECT * FROM newsarticle
//     WHERE id='$articleId';
//   ";


    
//   $result = mysqli_query($conn, $sql);
//   $arr = mysqli_fetch_assoc($result);
// //   while ($row = mysqli_fetch_assoc($result)) {
// //     $arr[] = $row;
// //   }

//   $sql2 = "
//     SELECT newsarticle.id, newsarticle_img.value, newsarticle_img.imgId
//     FROM newsarticle
//     LEFT JOIN newsarticle_img
//     ON newsarticle.id = newsarticle_img.newsArticleId
//     WHERE id='$articleId' AND newsarticle_img.imgId IS NOT NULL;
//   ";
//   $topic = $arr['topic'];
//   $sql3 = "
//     SELECT newsarticle.id, newsarticle.pic FROM newsarticle
//     WHERE topic='$topic';
//   ";

//   $result2 = mysqli_query($conn, $sql3);
//   $arr2 = array();
//   while ($row1 = mysqli_fetch_assoc($result2)) {
//     $arr2[] = $row1;
//   }

//   $result1 = mysqli_query($conn, $sql2);
//   $arr1 = array();

//   while ($row1 = mysqli_fetch_assoc($result1)) {
//     $arr1[] = $row1;
//   }


// } else{
//   $breakingNews = TRUE;
//   $arr1 = array();
//   while ($row1 = mysqli_fetch_assoc($result1)) {
//     $arr1[] = $row1;
//   }
// }

//   $sql = "
//     SELECT * FROM newsarticle_img;
//   ";

//   $sql2 = "
//   SELECT * FROM articletopic;
// ";

$audioId = explode('audio', $_GET['audioId'])[1];
// print_r($audioId);
$sql3 = "
SELECT * FROM audio_table
WHERE audioId=$audioId;
";

$result3 = mysqli_query($conn, $sql3);
$arr3 = array();
$row1 = mysqli_fetch_assoc($result3);

// while ($row1 = mysqli_fetch_assoc($result3)) {
//     $arr3[] = $row1;
//   }

// $result2 = mysqli_query($conn, $sql2);
// $arr2 = array();

// while ($row1 = mysqli_fetch_assoc($result2)) {
//     $arr2[] = $row1;
//   }

//     $result1 = mysqli_query($conn, $sql);
//   $arr1 = array();

//   while ($row1 = mysqli_fetch_assoc($result1)) {
//     $arr1[] = $row1;
//   }

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
$arrNum = count($arr1);
// prettyPrint($arr);
// prettyPrint($row1);


// require_once("header.php"); 
require_once("app.php"); 
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
    <body>
        <div onclick="back()" style="padding:8px; position:absolute; top:0;">
            <i style="font-size: 20px;padding:4px;" class="fas fa-arrow-left"></i>
        </div>
        <div class="audioPgCont">
            <div class="audioPgCont_sub">
                <div class="audioPic">
                    <img src="<?=$row1['pic']?>" alt="">
                </div>
                <div class="articleTitle audio">
                    <span><?=$row1['title']?></span>
                </div>
                <div class="audioControl">
                    <audio controls>
                        <source src="<?=$row1['audioLink']?>" type="audio/mpeg">
                    </audio>
                </div>

                <div class="audioDesc">
                <p class="articleContent audio"><?=$row1['audioDesc']?></p>
                </div>
            </div>
        </div>


        <!-- <div class="black">
    <div class="message">
        This is a popup message.
    </div>
</div> -->
  
    </body>
</html>

<script>
    function back(){
        window.location.assign("media.php?pgId=audio");
    }
</script>