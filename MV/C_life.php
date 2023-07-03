<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");

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
SELECT * FROM newsarticle WHERE topic='Lifestyle' ORDER BY created DESC ;
";

$sql4 = "
SELECT DISTINCT newsarticle.sub_title FROM newsarticle WHERE topic='Lifestyle';
";

$sql5 = "
SELECT * FROM subTitle_table;
";

$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);
$result5 = mysqli_query($conn, $sql5);

$arr5 = array();
while ($row1 = mysqli_fetch_assoc($result5)) {
    $arr5[] = $row1;
}

$arr4 = array();
while ($row1 = mysqli_fetch_assoc($result4)) {
    $arr4[] = $row1;
}

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

if($_GET['lifeOption'] != NULL){
    $query = "";
    if($_GET['lifeOption'] == 50){
        $query = "
        SELECT * FROM newsarticle WHERE topic='Lifestyle' ORDER BY created DESC ;
        ";
    } else if($_GET['lifeOption'] == 51){
        $query = "
        SELECT * FROM newsarticle WHERE topic='Lifestyle' ORDER BY likes DESC ;        ";
    } else {
        $query = "
        SELECT * FROM newsarticle WHERE topic='Lifestyle' AND sub_title = \"{$_GET['lifeOption']}\" ORDER BY created DESC ;
        ";
    }
   
    $resultOption = mysqli_query($conn, $query);

    $arrOption = array();
    while ($row1 = mysqli_fetch_assoc($resultOption)) {
        $arrOption[] = $row1;
    }
    $arr3 = $arrOption;
}


$pgId = $_GET['pgId'];
$cat = $_GET['catOption'];

?>