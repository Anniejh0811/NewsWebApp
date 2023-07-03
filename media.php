<?php 
  require_once("MV/C_media.php"); 
  require_once("header.php"); 
  require_once("app.php"); 
?>
<script>
$( document ).ready(function() {
    $(".fa-users").css("color","#d3d3d3");
    $(".fa-bookmark").css("color","#d3d3d3");
    $(".fa-home").css("color","#d3d3d3");
    $(".fa-music").css("color","#d3d3d3");
});
</script>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="CSS/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
</head>

<body>
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
        
          <select class="option" name="catOption" onchange="submitCat(this.id)" >
              <option <?php if (intVal($cat) === 10 || $cat === NULL) { echo 'selected'; } ?>  value="10">All</option>
              <?php foreach($arr2 as $k => $v){ ?>
              <option <?php if (intVal($cat) === intVal($k)+1 && isset($_GET['catOption'])) { echo 'selected'; } ?>   value="<?=intVal($k)+1?>"><?=$v["topicname"]?></option>
              <?php } ?>
          </select>
          <i onclick="video()" class="fa fa-refresh refreshBtn" aria-hidden="true"></i>
      </div>
  </form>
  <div class="videoCont">
      <?php foreach($arrVideo as $key => $val){  ?>
          <?php if(validateVideoType($val['value']) == TRUE){?>
              <!-- <video id="video<?=$key?>" onclick="openFullscreen(this.id)" style="height: 200px;width:33.3%;" autoplay muted src="<?=$val["value"]?>"></video> -->
              <video id="<?=intVal($key)+1?>" onclick="videoPg(this.id)" style="height: 200px;width:33.3%;" autoplay muted src="<?=$val["value"]?>"></video>

              <?php } ?>
      <?php } ?>
  </div>

  <?php } else {?>    
      <form id="cat2" action="">
          <input type="text" style="display:none;" name="pgId" value="audio">
          <div class="flexBox category">
            
          <select class="option" name="catOption2" onchange="submitOption()" >
              <option <?php if ($_GET['catOption2'] === 10 ||$_GET['catOption2'] == NULL ) { echo 'selected'; } ?>  value="10">All</option>
              <?php foreach($arr2 as $k => $v){ ?>
              <option <?php if ($_GET['catOption2'] == intVal($k)+1 && isset($_GET['catOption2'])) { echo 'selected'; } ?>   value="<?=intVal($k)+1?>"><?=$v["topicname"]?></option>
              <?php } ?>
          </select>
      </div>
  </form>

  <div class="audioCont">
      <?php foreach($arrAudio as $key => $val){  ?>
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
