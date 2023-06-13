<?php


$conn = new mysqli("localhost","root","root","THENEWS","8889");

$results = mysqli_query($conn, "SELECT * FROM articletopic");

// $result1 = mysqli_query($conn, "SELECT * FROM newsarticle");

// if(mysqli_query($conn, "SELECT * FROM articletopic")){
//     echo 1;
// }else{
//     echo mysqli_error($conn);
// }
// $row = mysqli_fetch_array($result);
// print_r(mysqli_fetch_array($result), MYSQLI_NUM);
// $breakingNews = TRUE;
$arrs = array();
while ($row = mysqli_fetch_assoc($results)) {
  // printf("%s (%s)\n", $row[0], $row[1]);
  $arrs[] = $row;
}

// $arr1 = array();
// while ($row1 = mysqli_fetch_assoc($result1)) {
//   // printf("%s (%s)\n", $row[0], $row[1]);
//   $arr1[] = $row1;
// }
// print_r($arr);

function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

// prettyPrint($arr);
prettyPrint($arrs);

// $rows = '';
// while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
//   $rows[] = $row;
// }


?>