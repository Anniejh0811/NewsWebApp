<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");

$breakingNews = FALSE;
$todayVideo = TRUE;

function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

function validateVideoType($link) {
    $url_parsed_arr = parse_url($link);
    $imgArr = array("jpg", "gif", "png");
    $videoArr = array("mp4", "3gp", "ogg");
 

    foreach ($videoArr as $token) {
        if (stristr($url_parsed_arr['path'], $token) == TRUE) {
            return "video";
        }
    }
  }

$audioId = explode('audio', $_GET['audioId'])[1];

$sql3 = "
SELECT * FROM audio_table
WHERE audioId=$audioId;
";

$result3 = mysqli_query($conn, $sql3);
$row1 = mysqli_fetch_assoc($result3);

?>