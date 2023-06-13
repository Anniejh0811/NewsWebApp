<?php


$conn = new mysqli("localhost","root","root","THENEWS","8889");


$breakingNews = FALSE;
$todayVideo = TRUE;
$zipcode = $_GET['zipcode'];



function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

// if(!empty($_GET['articleId'])){
//   $todayVideo = FALSE;
//   $breakingNews = FALSE;
//   $articleId = $_GET['articleId'];
//   $sql = "
//     SELECT * FROM newsarticle
//     WHERE id='$articleId';
//   ";


    
//   $result = mysqli_query($conn, $sql);
//   $arr = mysqli_fetch_assoc($result);
// //   while ($row = mysqli_fetch_assoc($result)) {
// //     $arr[] = $row;
// //   }

//   $sql2 = "
//     SELECT newsarticle.id, newsarticle_img.value, newsarticle_img.imgId
//     FROM newsarticle
//     LEFT JOIN newsarticle_img
//     ON newsarticle.id = newsarticle_img.newsArticleId
//     WHERE id='$articleId' AND newsarticle_img.imgId IS NOT NULL;
//   ";
//   $topic = $arr['topic'];
//   $sql3 = "
//     SELECT newsarticle.id, newsarticle.pic FROM newsarticle
//     WHERE topic='$topic';
//   ";

//   $result2 = mysqli_query($conn, $sql3);
//   $arr2 = array();
//   while ($row1 = mysqli_fetch_assoc($result2)) {
//     $arr2[] = $row1;
//   }

//   $result1 = mysqli_query($conn, $sql2);
//   $arr1 = array();

//   while ($row1 = mysqli_fetch_assoc($result1)) {
//     $arr1[] = $row1;
//   }


// } else{
//   $breakingNews = TRUE;
//   $arr1 = array();
//   while ($row1 = mysqli_fetch_assoc($result1)) {
//     $arr1[] = $row1;
//   }
// }

  $sql = "
    SELECT * FROM newsarticle_img;
  ";

  $sql2 = "
  SELECT * FROM articletopic;
";

// $sql3 = "
// SELECT * FROM audio_table;
// ";

$sql3 = "
SELECT * FROM newsarticle WHERE topic='Lifestyle' ORDER BY created DESC ;
";

$sql4 = "
SELECT DISTINCT newsarticle.sub_title FROM newsarticle WHERE topic='Lifestyle';
";

$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);

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
$arrNum = count($arr1);
// prettyPrint($arr);
// prettyPrint($arr1);
// prettyPrint($arr2);
prettyPrint($arr3);
prettyPrint($arr4);


$pgId = $_GET['pgId'];
$cat = $_GET['catOption'];
require_once("header.php"); 
require_once("app.php"); 
?>

<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <link rel="stylesheet" href="
https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="
https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js">
    </script>

<!-- <div style="padding: 12px 8px 0px 8px;">
    <select style="font-weight: 500; text-align: center;" name="sample" id="sample" class="fa lifeOption ">
        <option style="font-weight: 500; text-align: center;" value="fa star" class="fa">&#xf005; Editor's Pick</option>
        <option style="font-weight: 500; text-align: center;" value="fa star" class="fa">&#xf005; Hot</option>
        <?php foreach($arr4 as $k => $v){ ?>
            <option><?=$v['sub_title']?></option>  
        <?php } ?>
    </select> 
</div> -->

<div style="padding: 12px 8px 0px 8px;">
<form id="lifeSearch" method="get" id="searchID">
                <input placeholder="Search Features" type="text" class="searchClass" 
                    id="searchInputID" value="" />
                <!-- <button type="submit">Search</button> -->
                <i class="fa fa-search background"></i>
            </form>
            </div>

<div style="background-color:white; margin:8px; border-radius: 5px;">
    <div class="outerCont">
        <div id="<?=$arr3[0]['id']?>" onclick="toArticlePg(this.id)" class="flexBox" >
            <img class="lifeImg" src="<?=$arr3[0]['pic']?>" alt="">
            <div class="life detail">
                <span class="articleTitle life"><?=$arr3[0]['title']?></span>
            </div>
        </div>
    </div>

    <div class="outerCont">
        <div id="<?=$arr3[1]['id']?>" onclick="toArticlePg(this.id)" class="flexBox">
        <div class="life detail right">
                <span class="articleTitle life "><?=$arr3[1]['title']?></span>
            </div>
            <img class="lifeImg" src="<?=$arr3[1]['pic']?>" alt="">       
        </div>
    </div>
    <div class="outerCont">
        <div id="<?=$arr3[2]['id']?>" onclick="toArticlePg(this.id)" class="flexBox">
        <img class="lifeImg" src="<?=$arr3[2]['pic']?>" alt="">        
        <div class="life detail">
                <span class="articleTitle life"><?=$arr3[2]['title']?></span>
            </div>
        </div>
    </div>
</div>

<div style="background-color:white; margin:8px; border-radius: 10px;">
<div class="flexBox lifeRecommended">
<?php
for ($x = 3; $x < count($arr3); $x+=1) { ?>
    <div id="<?=$arr3[$x]['id']?>" onclick="toArticlePg(this.id)" class="small_cont_life">
        <img class="lifeImg recommended" src="<?=$arr3[$x]['pic']?>" alt=""> 
        <span class="articleTitle life recommended"><?=$arr3[$x]['title']?></span>
    </div>
<?php } ?>
</div>
</div>
</body>
<?php require_once("footer.php"); ?>

</html>

<script type="text/javascript">
    $(document).ready(function(){
    $('.searchClass').autocomplete({
      source: "data.php",
      minLength: 1,
      select: function(event, ui)
      {
        $('.searchClass').val(ui.item.value);
      }
    }).data('ui-autocomplete')._renderItem = function(ul, item){
      return $("<li style='padding: 12px 8px;' class='ui-autocomplete-row'></li>")
        .data("item.autocomplete", item)
        .append(item.label)
        .appendTo(ul);
    };
});
   
    </script>