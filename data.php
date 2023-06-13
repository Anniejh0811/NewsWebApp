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

  $sql = "
    SELECT * FROM newsarticle_img;
  ";

  $sql2 = "
  SELECT * FROM articletopic;
";

// $sql3 = "
// SELECT * FROM audio_table;
// ";

$sql3 = "
SELECT * FROM newsarticle WHERE topic='Lifestyle' ORDER BY created DESC ;
";

$sql4 = "
SELECT DISTINCT newsarticle.sub_title FROM newsarticle WHERE topic='Lifestyle' AND newsarticle.sub_title LIKE '%".$_GET["term"]."%' ORDER BY newsarticle.sub_title ASC;
";

$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);

$output = array();
$arr4 = array();
$temp_array = array();
$temp_array['value'] = "<i class='fa-regular fa-star'></i> Editor's Pick";
$output[]=$temp_array;
$temp_array['value'] = "<i class='fa-regular fa-star'></i> New";
$output[]=$temp_array;
while ($row1 = mysqli_fetch_assoc($result4)) {
    // $arr4[] = $row1;
 
    
    $temp_array['value'] = $row1['sub_title'];
    // $temp_array['label'] = $row['sub_title'];

    $output[]=$temp_array;
}


echo json_encode($output);
$arr3 = array();
while ($row1 = mysqli_fetch_assoc($result3)) {
    // $arr3[] = $row1;
    
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
$arrNum = count($arr1);
// prettyPrint($arr);
// prettyPrint($arr1);
// prettyPrint($arr2);
// prettyPrint($arr3);
// prettyPrint($arr4);


// $pgId = $_GET['pgId'];
// $cat = $_GET['catOption'];
// require_once("header.php"); 
// require_once("app.php"); 
// echo $output;
?>