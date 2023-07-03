<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");

function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

$sql = "
SELECT * FROM newsarticle
WHERE saved=1;
";
 
$result = mysqli_query($conn, $sql);
$arr4 = array();
while ($row1 = mysqli_fetch_assoc($result)) {
    $arr4[] = $row1;
}

$sql2 = "
    SELECT newsarticle.id, newsarticle.pic, collection_table.*
    FROM newsarticle
    LEFT JOIN collection_table
    ON newsarticle.id = collection_table.articleIdColl;
";

$result3 = mysqli_query($conn, $sql2);
$arr5 = array();

while ($row1 = mysqli_fetch_assoc($result3)) {
    $arr5[] = $row1;
}

$sql5 = "
  SELECT * FROM collection_table;
";

$result1 = mysqli_query($conn, $sql5);
$arr2 = array();
while ($row1 = mysqli_fetch_assoc($result1)) {
    $arr2[] = $row1;
}

$collectionNum = intVal(count($arr2[0])) -1;

$query4 = "SHOW COLUMNS FROM collection_table";
$resultColumns = mysqli_query($conn,$query4);
$arrayColumnName = array();
while($row = mysqli_fetch_array($resultColumns)){
    $arrayColumnName[] = $row['Field'];
}

for ($x = 1; $x <= $collectionNum; $x++) { 
    $counter = "
    SELECT count(*) as total FROM collection_table 
    WHERE ".$arrayColumnName[$x]."=1;";
    $result10 = mysqli_query($conn, $counter);
    $row1 = mysqli_fetch_assoc($result10);
    $count = $row1['total'];
    $arr10[] = $count;
}

$limit = 0;
?>