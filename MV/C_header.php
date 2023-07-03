<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");

$results = mysqli_query($conn, "SELECT * FROM articletopic");

$arrs = array();
while ($row = mysqli_fetch_assoc($results)) {
    $arrs[] = $row;
  }
  $newsArticle = "";
  $newsArticleArr = array();
  $articleArr = array();
  $audioArr = array();
  $videoArr = array();

if($_GET['type']=="article"){
  if($_GET['topic'] != NULL  && $_GET['topic'] != 10){
    $sqlQuery = "
      SELECT * FROM newsarticle
      WHERE topic='".$_GET['topic']."';
      ";
    if($_GET['startDate'] !=NULL && $_GET['endDate'] !=NULL){
      $sqlQuery = "
      SELECT * FROM newsarticle
      WHERE topic='".$_GET['topic']."' AND DATE(created) between '".$_GET[startDate]."' and '".$_GET[endDate]."';
      ";
    }
  } else{
    if($_GET['startDate'] !=NULL && $_GET['endDate'] !=NULL){
      $sqlQuery = "
      SELECT * FROM newsarticle
      WHERE DATE(created) between '".$_GET[startDate]."' and '".$_GET[endDate]."';
      ";
    }else{
      $sqlQuery = "
      SELECT * FROM newsarticle;
      ";
    }
   
  }
  $newsArticle = mysqli_query($conn,$sqlQuery);
  while ($row = mysqli_fetch_assoc($newsArticle)) {
    $newsArticleArr[] = $row;
  }
}

if($_GET['type']=="video"){
 
  if($_GET['topic'] != NULL && $_GET['topic'] != 10){
    
    $sqlQuery = "
    SELECT articletopic.topicname, 
    newsarticle_img.* FROM newsarticle_img 
    LEFT JOIN articletopic ON articletopic.id = newsarticle_img.topicId 
    WHERE topicname='".$_GET['topic']."';
      ";
      if($_GET['startDate'] !=NULL && $_GET['endDate'] !=NULL){
        $sqlQuery = "
        SELECT articletopic.topicname, 
        newsarticle_img.* FROM newsarticle_img 
        LEFT JOIN articletopic ON articletopic.id = newsarticle_img.topicId 
        WHERE topicname='".$_GET['topic']."' AND DATE(created) between '".$_GET[startDate]."' and '".$_GET[endDate]."';";
      }
    
  } else {
    if($_GET['startDate'] !=NULL && $_GET['endDate'] !=NULL){
      $sqlQuery = "
        SELECT articletopic.topicname, 
        newsarticle_img.* FROM newsarticle_img 
        LEFT JOIN articletopic ON articletopic.id = newsarticle_img.topicId 
        WHERE DATE(created) between '".$_GET[startDate]."' and '".$_GET[endDate]."';";
   
    }else {
      echo "b";
      $sqlQuery = "
      SELECT articletopic.topicname, 
      newsarticle_img.* FROM newsarticle_img 
      LEFT JOIN articletopic ON articletopic.id = newsarticle_img.topicId 
      ;
        ";
    }
  }

  $newsArticle = mysqli_query($conn, $sqlQuery);
  while ($row = mysqli_fetch_assoc($newsArticle)) {
    $newsArticleArr[] = $row;
  }
  
}

if($_GET['type']=="audio"){
  if($_GET['topic'] != NULL  && $_GET['topic'] != 10){
    $sqlQuery = "
    SELECT articletopic.topicname, 
    audio_table.* FROM audio_table 
    LEFT JOIN articletopic ON articletopic.id = audio_table.audioTopic 
    WHERE topicname='".$_GET['topic']."';
      ";
     
      if($_GET['startDate'] !=NULL && $_GET['endDate'] !=NULL){
        $sqlQuery = "
        SELECT articletopic.topicname, 
        audio_table.* FROM audio_table 
        LEFT JOIN articletopic ON articletopic.id = audio_table.audioTopic 
        WHERE topicname='".$_GET['topic']."' AND DATE(audioCreated) between '".$_GET[startDate]."' and '".$_GET[endDate]."';";
        echo $sqlQuery;
      }
    
  } else {
    if($_GET['startDate'] !=NULL && $_GET['endDate'] !=NULL){
      $sqlQuery = "
      SELECT articletopic.topicname, 
      audio_table.* FROM audio_table 
      LEFT JOIN articletopic ON articletopic.id = audio_table.audioTopic 
      WHERE DATE(audioCreated) between '".$_GET[startDate]."' and '".$_GET[endDate]."';";
      echo $sqlQuery;
    } else {
    $sqlQuery = "
      SELECT articletopic.topicname, 
      audio_table.* FROM audio_table 
      LEFT JOIN articletopic ON articletopic.id = audio_table.audioTopic 
      ;
        ";
    }
  }

  $newsArticle = mysqli_query($conn, $sqlQuery);
  while ($row = mysqli_fetch_assoc($newsArticle)) {
    $newsArticleArr[] = $row;
  }
  
}


if($_GET['type']=="10"){
  $articleT = "
  SELECT * FROM newsarticle 
  ;";

  $videoT = "
  SELECT * FROM newsarticle_img 
  ;";

  $audioT = "
  SELECT * FROM audio_table 
  ;";

    if($_GET['topic'] != "10" && $_GET['topic'] != NULL){
      $articleT = "
      SELECT * FROM newsarticle WHERE topic='".$_GET['topic']."'
      ;";

      $videoT = "
      SELECT articletopic.topicname, 
      newsarticle_img.* FROM newsarticle_img 
      LEFT JOIN articletopic ON articletopic.id = newsarticle_img.topicId 
      WHERE topicname='".$_GET['topic']."';";
    
      $audioT = "
      SELECT articletopic.topicname, 
      audio_table.* FROM audio_table 
      LEFT JOIN articletopic ON articletopic.id = audio_table.audioTopic 
      WHERE topicname='".$_GET['topic']."';
        ";

      if($_GET['startDate'] !=NULL && $_GET['endDate'] !=NULL){
        $articleT = "
        SELECT * FROM newsarticle WHERE topic='".$_GET['topic']."' AND DATE(created) between '".$_GET[startDate]."' and '".$_GET[endDate]."'
        ;";
    
        $videoT = "
        SELECT articletopic.topicname, 
        newsarticle_img.* FROM newsarticle_img 
        LEFT JOIN articletopic ON articletopic.id = newsarticle_img.topicId 
        WHERE topicname='".$_GET['topic']."' AND DATE(created) between '".$_GET[startDate]."' and '".$_GET[endDate]."'
        ;";
      
        $audioT = "
        SELECT articletopic.topicname, 
        audio_table.* FROM audio_table 
        LEFT JOIN articletopic ON articletopic.id = audio_table.audioTopic 
        WHERE topicname='".$_GET['topic']."' AND DATE(audioCreated) between '".$_GET[startDate]."' and '".$_GET[endDate]."'
          ;";
      }
    } 

  if($_GET['startDate'] !=NULL && $_GET['endDate'] !=NULL && $_GET['topic'] ==NULL){
    $articleT = "
    SELECT * FROM newsarticle WHERE DATE(audioCreated) between '".$_GET[startDate]."' and '".$_GET[endDate]."'
    ;";
  
    $videoT = "
    SELECT * FROM newsarticle_img WHERE DATE(audioCreated) between '".$_GET[startDate]."' and '".$_GET[endDate]."'
    ;";
  
    $audioT = "
    SELECT * FROM audio_table WHERE DATE(audioCreated) between '".$_GET[startDate]."' and '".$_GET[endDate]."'
    ;";
  }

  $newsArticle = mysqli_query($conn, $articleT);
  $videoResult = mysqli_query($conn, $videoT);
  $audioResult = mysqli_query($conn, $audioT);
  while ($row = mysqli_fetch_assoc($newsArticle)) {
    $articleArr[] = $row;
  }
  while ($row = mysqli_fetch_assoc($videoResult)) {
    $videoArr[] = $row;
  }
  while ($row = mysqli_fetch_assoc($audioResult)) {
    $audioArr[] = $row;
  }
}

function validateMediaType2($link) {
  $url_parsed_arr = parse_url($link);
  $imgArr = array("jpg", "gif", "png");
  $videoArr = array("mp4", "3gp", "ogg");
  foreach ($imgArr as $token) {
    if (stristr($url_parsed_arr['path'], $token) == TRUE) {
        return "image";
    }
  }

  foreach ($videoArr as $token) {
    if (stristr($url_parsed_arr['path'], $token) == TRUE) {
        return "video";
    }
  }
}

?>