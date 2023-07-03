<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");

function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

$deleteKey = $_POST['deleteInput'];
$collectionId = $_GET['collId'];
$EditNewName = $_POST['EditNewName'];

if(isset($EditNewName) && $EditNewName !=""){
    $queryEditName = "
    ALTER TABLE collection_table CHANGE ".$collectionId." $EditNewName INT NULL;
    ";
    $resultNewName = mysqli_query($conn,"
    ALTER TABLE collection_table CHANGE ".$collectionId." $EditNewName INT NULL;
    ");
    echo "<script> location.href='?collId=$EditNewName'; </script>";
}

if(isset($deleteKey)){
    $queryDelete = "
    ALTER TABLE collection_table DROP COLUMN ".$collectionId."
    ";
    $resultDelete = mysqli_query($conn,$queryDelete);
    echo "<script> location.href='saved.php'; </script>";
}


if(!empty($_GET['new'])){
    foreach($_GET['new'] as $count => $id){
        $query2 = "UPDATE collection_table SET "."$collectionId"." = 1 WHERE articleIdColl ="."$id";
        $result2 = mysqli_query($conn,$query2);
        // echo $query2;
    }
}

if(!empty($_POST['removeArticle'])){
    foreach($_POST['removeArticle'] as $count => $id){
        $query2 = "UPDATE collection_table SET "."$collectionId"." = NULL WHERE articleIdColl ="."$id";
        $result2 = mysqli_query($conn,$query2);
        echo $query2;
    }
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
SELECT newsarticle.id, newsarticle.pic, collection_table.$collectionId
FROM newsarticle
LEFT JOIN collection_table
ON newsarticle.id = collection_table.articleIdColl
WHERE ".$collectionId."=1;
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



$sql3 = "
SELECT newsarticle.id, newsarticle.pic, collection_table.*
FROM newsarticle
LEFT JOIN collection_table
ON newsarticle.id = collection_table.articleIdColl
;
";

$result3 = mysqli_query($conn, $sql3);
$arr3 = array();
while ($row1 = mysqli_fetch_assoc($result3)) {
$arr3[] = $row1;
}

$collectionTotal = count($arr5);

$query4 = "SHOW COLUMNS FROM collection_table";
$resultColumns = mysqli_query($conn,$query4);
$arrayColumnName = array();
while($row = mysqli_fetch_array($resultColumns)){
    $arrayColumnName[] = $row['Field'];
    // echo $row['Field']."<br>";
}

for ($x = 1; $x <= $collectionNum; $x++) { 
    $counter = "
    SELECT count(*) as total FROM collection_table 
    WHERE".$arrayColumnName[$x]."=1;";
    $result10 = mysqli_query($conn, $counter);
    $row1 = mysqli_fetch_assoc($result10);
    $count = $row1['total'];
    $arr10[] = $count;
}

$limit = 0;

$newSaved = $_GET['new[0]'];

?>