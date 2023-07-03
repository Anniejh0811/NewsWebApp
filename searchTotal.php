<?php


$conn = new mysqli("localhost","root","root","THENEWS","8889");


$breakingNews = FALSE;
$todayVideo = TRUE;
$zipcode = $_GET['zipcode'];

function validateMediaType3($link) {
  $url_parsed_arr = parse_url($link);
  $imgArr = array("jpg", "gif", "png");
  $videoArr = array("mp4", "3gp", "ogg");
  foreach ($imgArr as $token) {
      if (stristr($url_parsed_arr['path'], $token) == TRUE) {
          // print "String contains: $token\n";
          return "image";
      }
  }

  foreach ($videoArr as $token) {
      if (stristr($url_parsed_arr['path'], $token) == TRUE) {
          // print "String contains: $token\n";
          return "video";
      }
  }
}

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
SELECT newsarticle.* FROM newsarticle WHERE newsarticle.title LIKE '%".$_GET["term"]."%' OR newsarticle.topic LIKE '%".$_GET["term"]."%';
";

// $sql5 = "
// SELECT newsarticle_img.* FROM newsarticle_img WHERE newsarticle_img.mediaName LIKE '%".$_GET["term"]."%' OR newsarticle.topic LIKE '%".$_GET["term"]."%';
// ";

$sql5 = "
        SELECT articletopic.topicname, 
        newsarticle_img.* FROM newsarticle_img 
        LEFT JOIN articletopic ON articletopic.id = newsarticle_img.topicId 
        WHERE mediaName LIKE '%".$_GET["term"]."%' OR topicname LIKE '%".$_GET["term"]."%';";
      // echo $videoT;
    
     

      $sql6 = "
      SELECT articletopic.topicname, 
      audio_table.* FROM audio_table 
      LEFT JOIN articletopic ON articletopic.id = audio_table.audioTopic 
      WHERE title LIKE '%".$_GET["term"]."%' OR topicname LIKE '%".$_GET["term"]."%';
        ";

$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);
$result5 = mysqli_query($conn, $sql5);
$result6 = mysqli_query($conn, $sql6);

$output = array();
$arr4 = array();
$temp_array = array();
// $temp_array['value'] = "Editor's Pick";
// $temp_array['label'] = 50;
// // $output[]=$temp_array;
// array_push($output, $temp_array); 
// $temp_array['value'] = "New";
// $temp_array['label'] = 51;
// array_push($output, $temp_array); 
// $output[]=$temp_array;
$id = 0;
while ($row1 = mysqli_fetch_assoc($result4)) {
    // $arr4[] = $row1;
 
    $temp_array['href'] = $row1['pic'];
    $temp_array['value'] = $row1['title'];
    // $temp_array['label'] = $row['sub_title'];
    // $temp_array['label'] = $id;
    $temp_array['label'] =  $row1['id'];
    $temp_array['type'] = "other";
    array_push($output, $temp_array); 
    $id++;

    // $output[]=$temp_array;

}

// echo json_encode($output);
$temp_array1 = array();
while ($row1 = mysqli_fetch_assoc($result5)) {
  // $arr4[] = $row1;

  if(validateMediaType3($row1['value']) =="video"){
    $temp_array1['href'] = $row1['value'];
    $temp_array1['value'] = $row1['mediaName'];
    $temp_array1['type'] = "video";
    $temp_array1['label'] = $row1['mediaId'];
    array_push($output, $temp_array1); 
  } 
 
  // echo json_encode($output);


  // $output[]=$temp_array;

}

$temp_array2 = array();
while ($row1 = mysqli_fetch_assoc($result6)) {
  // $arr4[] = $row1;

  $temp_array2['href'] = $row1['pic'];
  $temp_array2['value'] = $row1['title'];
  // $temp_array['label'] = $row['sub_title'];
  $temp_array2['label'] = $row1['audioId'];
  $temp_array2['type'] = "audio";
  array_push($output, $temp_array2); 
 

  // $output[]=$temp_array;

}
  echo json_encode($output);

// echo json_encode($output);
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