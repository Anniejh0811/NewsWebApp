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

// $rows = '';
// while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
//   $rows[] = $row;
// }


?>

<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <ol>
      <?=$list?>
    </ol>
    <form action="create_article.php" method="POST">
      <p><input type="text" name="title" placeholder="title"></p>
      <p><textarea name="pic" placeholder="pic"></textarea></p>
      <p><textarea name="content" placeholder="content"></textarea></p>
      <p><textarea name="topic" placeholder="topic"></textarea></p>
      <p><input type="number" name="likes" placeholder="likes"></p>
      <p><input type="number" name="hates" placeholder="hates"></p>
      <p><input type="boolean" name="recommended" placeholder="recommended"></p>
      <!-- <p><input type="text" name="created" placeholder="created"></p> -->
      <p><input type="text" name="breakingNews" placeholder="breakingNews"></p>
      <p><input type="text" name="author" placeholder="author"></p>

      <p><input type="submit"></p>
    </form>


    
  </body>
</html>