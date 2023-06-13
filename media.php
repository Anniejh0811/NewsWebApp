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

$sql3 = "
SELECT * FROM audio_table;
";

$result3 = mysqli_query($conn, $sql3);
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
prettyPrint($arr1);
prettyPrint($arr2);
prettyPrint($arr3);

$pgId = $_GET['pgId'];
$cat = $_GET['catOption'];
require_once("header.php"); 
require_once("app.php"); 
print_r($zipcode);
?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    <script>
        function toAudioPg(id){
    window.location.assign('audio.php?audioId='+id);
  }
    </script>
    

<div class="flexBox media">
    <div class="mediaMenu" id="videoBtn" <?php if($pgId == "video" || $pgId == "") echo "style='border-bottom: 2px solid #636363;'"; ?> onclick="video()">
        <span id="videoSpan" <?php if($pgId == "video" || $pgId == "") echo "style='color: black;'"; ?>>VIDEO</span>
    </div>
    <div class="mediaMenu" id="audioBtn" onclick="audio()" <?php if($pgId == "audio") echo "style='border-bottom: 2px solid #636363;'"; ?> >
        <span id="audioSpan" <?php if($pgId == "audio") echo "style='color: black;'"; ?>>AUDIO</span>
    </div>
</div>

<div style="padding:4px 8px;">


<?php if($pgId == "video" || $pgId == ""){ ?>
    <form id="cat" action="">
        <input type="text" style="display:none;" name="pgId" value="video">
        <div class="flexBox category">
        <span id="you" <?php if ($_GET['cat'] === "you") { echo 'class="option selected"'; } else {echo 'class="option"';} ?> onclick ="submitCat(this.id)">For you</span>
        <span id="new" <?php if ($_GET['cat'] === "new") { echo 'class="option selected"'; } else {echo 'class="option"';} ?> onclick ="submitCat(this.id)">New</span>
        <span id="hot" <?php if ($_GET['cat'] === "hot") { echo 'class="option selected"'; } else {echo 'class="option"';} ?> onclick ="submitCat(this.id)">Hot</span>
        <!-- <span class="option">Most Liked</span> -->

        <select class="option" name="catOption" onchange="submitCat(this.id)" >
            <option <?php if (intVal($cat) === 9 || $cat === NULL) { echo 'selected'; } ?>  value="9">All</option>
            <?php foreach($arr2 as $k => $v){ ?>
            <option <?php if (intVal($cat) === $k && isset($_GET['catOption'])) { echo 'selected'; } ?>   value="<?=$k?>"><?=$v["topicname"]?></option>
            <?php } ?>
        </select>
    </div>
</form>
<div class="videoCont">
    <?php foreach($arr1 as $key => $val){  ?>
        <?php if(validateVideoType($val['value']) == TRUE){?>
           
            <video id="video<?=$key?>" onclick="openFullscreen(this.id)" style="height: 200px;width:33.3%;" autoplay controls muted src="<?=$val["value"]?>"></video>
          
            <?php } ?>
    <?php } ?>
</div>

<?php } else {?>    
    <form id="cat2" action="">
        <input type="text" style="display:none;" name="pgId" value="audio">
        <div class="flexBox category">
           
        <select class="option" name="catOption2" onchange="submitOption()" >
            <option <?php if ($_GET['catOption2'] === 9 ||$_GET['catOption2'] == NULL ) { echo 'selected'; } ?>  value="9">All</option>
            <?php foreach($arr2 as $k => $v){ ?>
            <option <?php if ($_GET['catOption2'] == $k && isset($_GET['catOption2'])) { echo 'selected'; } ?>   value="<?=$k?>"><?=$v["topicname"]?></option>
            <?php } ?>
        </select>
    </div>
</form>

<div class="audioCont">
    <?php foreach($arr3 as $key => $val){  ?>
        <div onclick="toAudioPg(this.id)" id="audio<?=$val['audioId']?>" style="border-bottom: #d6d5d5 solid 1px;">
            <div class="flexBox audio">
                <img class="audioImg" src="<?=$val['pic']?>" alt="">
                <div class="podDescBox">
                    <span class="podTitle"><?=$val['title']?></span>
                    <span><?=$val['audioDesc']?></span>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

   

<?php } ?>
</div>
<?php require_once("footer.php"); ?>
</body>
<script>
    function video(){   
        window.location.assign('?pgId=video');
    }

    function audio(){    

        window.location.assign('?pgId=audio');
    }

    function submitCat(id){
        var x = document.createElement("INPUT");
        x.style.display = "none";
  x.setAttribute("type", "text");
  x.setAttribute("value", id);
  x.setAttribute("name", "cat");
  document.getElementById("you").appendChild(x);
        document.getElementById("cat").submit();
    }

    function submitOption(){

        document.getElementById("cat2").submit();
    }

    function openFullscreen(id) {
  console.log("hitting");
//   var myVideo =  $("#3");
//   var elem = myVideo;
//   console.log(myVideo);
  const elem = document.getElementById(id);
//   elem.webkitRequestFullscreen;
//   console.log(elem.webkitRequestFullscreen);
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}


function audioPg(id){
//     $.ajax({
//   url: "ajaxfile.php",
//   type: "GET",
//   data: {
//     audioId: id
//   },

//   success : function(result){
//                //set result to div or target 
//               //ex $("#divid).html(result)
//               console.log(result);
//         }
// //   success: function( result ) {
// //     $( "#weather-temp" ).html( "<strong>" + result + "</strong> degrees" );
// //   }
// });

// location.assign("audio.php?id="id);
}
// function toAudioPg(id){
//     window.location.assign('audio.php?audioId='+id);
//   }
</script>