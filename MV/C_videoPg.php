<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");

$videoId = $_GET['videoID'];
$sql5 = "
SELECT * FROM newsarticle_img WHERE mediaId='".$videoId."';
";
$result5 = mysqli_query($conn, $sql5);

$arr5 = array();
$row1 = mysqli_fetch_assoc($result5);
?>