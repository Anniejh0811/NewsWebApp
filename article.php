<?php

$conn = new mysqli("localhost","root","root","THENEWS","8889");

$breakingNews = FALSE;
$todayVideo = TRUE;

function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

if(!empty($_GET['articleId'])){
  $todayVideo = FALSE;
  $breakingNews = FALSE;
  $articleId = $_GET['articleId'];
  $sql = "
    SELECT * FROM newsarticle
    WHERE id='$articleId';
  ";
 
  $result = mysqli_query($conn, $sql);
  $arr = mysqli_fetch_assoc($result);

  $sql2 = "
    SELECT newsarticle.id, newsarticle_img.value, newsarticle_img.mediaId
    FROM newsarticle
    LEFT JOIN newsarticle_img
    ON newsarticle.id = newsarticle_img.newsArticleId
    WHERE id='$articleId' AND newsarticle_img.mediaId IS NOT NULL;
  ";
  $topic = $arr['topic'];
  $sql3 = "
    SELECT newsarticle.id, newsarticle.pic FROM newsarticle
    WHERE topic='$topic';
  ";

  $result2 = mysqli_query($conn, $sql3);
  $arr2 = array();
  while ($row1 = mysqli_fetch_assoc($result2)) {
    $arr2[] = $row1;
  }

  $result1 = mysqli_query($conn, $sql2);
  $arr1 = array();

  while ($row1 = mysqli_fetch_assoc($result1)) {
    $arr1[] = $row1;
  }

} else{
  $breakingNews = TRUE;
  $arr1 = array();
  while ($row1 = mysqli_fetch_assoc($result1)) {
    $arr1[] = $row1;
  }
}
$arrNum = count($arr1)+1;
// echo $arrNum;

require_once("header.php"); 
require_once("app.php"); 
?>
 <?php 
      function validateMediaType($link) {
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
 
      ?>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="CSS/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
  <div class="articleProfile">
      <img src="Pictures/economic.png" alt="">
      <span><?=$arr['author']?></span>
  </div>

  <div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
      <div class="carousel-inner" >
        <div class="item active">
          <img data-slide-no="0" src="<?=$arr['pic']?>" alt="New york" style="width:100%; min-height: 300px;">
        </div>
    
        <?php foreach($arr1 as $key => $val){ ?>
          <?php if($val["value"]!=NULL){?>
            <div class="item ">
              <?php if(validateMediaType($val["value"])=="image"){?>   
                <img data-slide-no="<?=intVal($key)+1?>" src="<?=$val['value']?>" style="width:100%; min-height: 300px;">
              <?php } ?>
              <?php if(validateMediaType($val["value"])=="video"){?>
                <video data-slide-no="<?=intVal($key)+1?>" src="<?=$val['value']?>" style="width:100%; min-height: 300px;" controls autoplay></video>
              <?php } ?>
            </div>
          <?php } ?>
        <?php } ?>
      </div> 
  <?php if($arrNum > 1){ ?>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev" onclick="prev()">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next" onclick="next()">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
  <?php } ?>
  </div>

  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="myCarousel-target active"></li>
    <?php foreach($arr1 as $key => $val){ ?>
        <?php if($val["value"]!=NULL){?>
        <li data-target="#myCarousel" data-slide-to="<?=intval($key)+1?>" class="myCarousel-target"></li>
        <?php } ?>
    <?php } ?>
    </ol>
</div>



<script type="text/javascript">
    $(function() {
        // $('#myCarousel').carousel({interval: 2000});
        $('#myCarousel').on('slide', function() {
            var to_slide = $('.carousel-item.active').attr('data-slide-no');
            $('.myCarousel-target.active').removeClass('active');
            $('.carousel-indicators [data-slide-to=' + to_slide + ']').addClass('active');
        });
        $('.myCarousel-target').on('click', function() {
            $('#myCarousel').carousel(parseInt($(this).attr('data-slide-to')));
            console.log(parseInt($(this).attr('data-slide-to')));
            $('.myCarousel-target.active').removeClass('active');
            $(this).addClass('active');
        });
    });

    function next(){
        $('#myCarousel').carousel('next');
        var nextIndicator = parseInt($('.myCarousel-target.active').attr('data-slide-to'))+1;
        if(nextIndicator > <?=$arrNum?>){
            nextIndicator = 0;
        }
        $( ".myCarousel-target" ).each(function( index ) {
            if ( index == nextIndicator ) {
                $('.myCarousel-target.active').removeClass('active');
                $( "[data-slide-to="+ index +"]" ).addClass('active');
            } 
        });
    }    

    function prev(){
        $('#myCarousel').carousel('prev');
        var nextIndicator = parseInt($('.myCarousel-target.active').attr('data-slide-to'))-1;
        if(nextIndicator < 0 ){
            nextIndicator = <?=$arrNum?>;
        }
        $( ".myCarousel-target" ).each(function( index ) {
            if ( index == nextIndicator ) {
                $('.myCarousel-target.active').removeClass('active');
                $( "[data-slide-to="+ index +"]" ).addClass('active');
            } 
        });
    }   
    </script>

    <div class="articleContentBox">
      <div>
        <span class="articleTitle"><?=$arr['title']?></span>
      </div>
      <div class="flexBox spaceBetween">
          <a class="seeArticle" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" onclick="expand()">See Article</a>
          <div class="iconArticle">
              <i class="far fa-regular fa-heart"></i>
              <i class="far fa-thumbs-down"></i>
              <i class="fas fa-solid fa-share-square"></i>
          </div>
      </div>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p class="articleContent"><?=$arr['content']?></p>
        </div>
      </div>
    </div>
    <div class="relatedArticlePg">
        <span class="sub_title">Related Articles</span>
        <div class="relatedArticleBox" >
        
            <?php foreach($arr2 as $key => $val){ ?>
                <?php if($val['id'] != $articleId){ ?>
                <img src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)" >
                <?php } ?>
            <?php } ?>
        </div>
    </div>
  </body>
  <?php require_once("footer.php"); ?>
</html>

