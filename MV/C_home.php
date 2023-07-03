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

// echo $_GET['id'];
if(!empty($_GET['id']) && $_GET['id'] != "Today"){
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
} else if($_GET['id'] == "Today"){
  // echo 1;
  $breakingNews = TRUE;
  $arr1 = array();
  $id = $_GET['id'];
  while ($row1 = mysqli_fetch_assoc($result1)) {
    $arr1[] = $row1;
  }
} else {
  // echo 1;
  $id = "Today";
  $breakingNews = TRUE;
  $arr1 = array();
  while ($row1 = mysqli_fetch_assoc($result1)) {
    $arr1[] = $row1;
  }
}



// prettyPrint($arr);
// prettyPrint($arr1);
// prettyPrint($topicArr);


?>