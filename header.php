
<?php
 require_once("MV/C_header.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />     
    <title>THE NEWS</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@400;500;600;700&family=Engagement&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
  </head>
  <header>
    <div>
        <a href=""><?=$row['topicname']?></a>
        <i class="fa fa-bars icon" onclick="openNav()"></i>
    </div>
    <div class="logo">
        <span onclick="toHomePg()">THE NEWS</span>
    </div>
    <div>
        <i class="fa fa-search icon" onclick="openSearchNav()"></i>
    </div>
  </header>
<body>
  <div id="mySidenav" class="sidenav" >
      <div style="padding: 16px; text-align: right;">
          <i class="fa fa-times icon" style="font-size: 25px;" onclick="closeNav()"></i>
      </div>

      <h2><span>Sections</span></h2>
      <?php foreach($arrs as $k => $val){ ?>
        <div class="eachMenu" onclick="topic('<?=$arrs[$k]['topicname']?>')">
            <span><?=$arrs[$k]['topicname']?></span>
        </div>
      <?php } ?>

      <h2><span>Media</span></h2>
      <div class="eachMenu" onclick="toAudio()">
          <span>Audio</span>
      </div>
      <div class="eachMenu" onclick="toVideo()">
          <span>Video</span>
      </div>
  </div>

  <div id="searchNav" class="sidenavsearch" >
      <div class="searchTitle">
        <span>Search</span>
          <i class="fa fa-times icon" onclick="closeSearchNav()"></i>
      </div>
      <div class="searchInputOuterBox">
        <input class="searchClass2" id="searchInputID" placeholder="Search Features" type="text" value="" />
        <i class="fa fa-search"></i>
      </div>

    <div class="content">
      <form id="detailedSearch" action="">
      <input type="hidden" value="1"; name="searchApply">
      <div class="flexBox">
        <div class="detailedSearch type">
          <span>Type</span>
          <select class="option"  name="type">
            <option <?php if (intVal($_GET['type']) === 10) { echo 'selected'; } ?> value="10">All</option>
            <option <?php if (($_GET['type']) === "article") { echo 'selected'; } ?> value="article">Article</option>
            <option <?php if (($_GET['type']) === "video") { echo 'selected'; } ?> value="video">Video</option>
            <option <?php if (($_GET['type']) === "audio") { echo 'selected'; } ?> value="audio">Audio</option>
          </select>
        </div>
        <div class="detailedSearch topic">
          <span>Topic</span>
          <select class="option" name="topic" >
          <option <?php if (intVal($_GET['topic']) === 10) { echo 'selected'; } ?> value="10">All</option>
          <?php foreach($arrs as $k => $val){ ?>
            <option <?php if (($_GET['topic']) === $val['topicname']) { echo 'selected'; } ?> value="<?=$val['topicname']?>"><?=$val['topicname']?></option>
          <?php } ?>
          </select>
        </div>
        </div>
        <!-- duration -->
        <div class="duratonOuterBox">
          <span>Duration</span>
          <div class="flexBox">
            <input value="<?php if (isset($_GET['startDate']) == true) { echo $_GET['startDate']; } ?>" name="startDate" type="date">
            <span class="dash">&nbsp;-&nbsp;</span>
            <input value="<?php if (isset($_GET['endDate']) == true) { echo $_GET['endDate']; } ?>" name="endDate" type="date">
          </div>
        </div>
      
        <div class="detailedSearchBtnBox">
          <span class="close">CLOSE</span>
          <span class="submission" onclick="detailedSearch()">APPLY</span>
      </div>
    </div>
    </form>
    <div class="collapsible">
      <span id="openBtn">Detailed Search</span>
    </div>

  <?php if($_GET['type']=="video"){?>
    <div class="searchResult">
    <?php foreach($newsArticleArr as $k => $val){?>
      <?php if(validateMediaType2($val['value']) =="video"){?>
      <div id="video<?=$key?>" onclick="openFullscreen(this.id)" class="innerBox">
      <div class="flexBox typeVideo">
        <video src="<?=$val['value']?>" ></video>
        <div class="desc">
          <span class="name"><?=$val['mediaName']?></span>
          <span class="created"><?=date_format(date_create($val['created']),"Y/m/d")?></span>
        </div>
      </div>
    </div>
      <?php } ?>
    <?php } ?>
    </div>
  <?php } ?>

  <?php if($_GET['type']=="audio"){?>
    <div class="searchResult">
    <?php foreach($newsArticleArr as $k => $val){?>
      <div id="<?=$val['audioId']?>" onclick="toAudioPg('audio'+this.id)" class="innerBox">
      <div class="flexBox typeAudio">
        <img src="<?=$val['pic']?>">
        <div class="desc">
          <span class="name"><?=$val['title']?></span>
          <span class="created"><?=date_format(date_create($val['audioCreated']),"Y/m/d")?></span>
        </div>
      </div>
    </div>
    <?php } ?>
    </div>
  <?php } ?>

  <?php if($_GET['type']=="article"){?>
    <div class="searchResult">
    <?php foreach($newsArticleArr as $k => $val){?>
      <div id="<?=$val['id']?>" onclick="toArticlePg(this.id)" class="innerBox">
      <div class="flexBox typeArticle">
        <img src="<?=$val['pic']?>"  >
        <div class="desc">
          <span class="name"><?=$val['title']?></span>
          <span class="created "><?=date_format(date_create($val['audioCreated']),"Y/m/d")?></span>
        </div>
      </div>
    </div>
    <?php } ?>
    </div>
  <?php } ?>

  <?php if($_GET['type']=="10"){?>
    <?php if(!empty($articleArr)){?>
    <div class="searchResult">
    <span class="listTitle">Article</span>
    <?php foreach($articleArr as $k => $val){?>
      <div  id="<?=$val['id']?>" onclick="toArticlePg(this.id)" class="innerBox ">
      <div class="flexBox typeArticle">
        <img src="<?=$val['pic']?>">
        <div class="desc">
          <span class="name"><?=$val['title']?></span>
          <span class="created "><?=date_format(date_create($val['audioCreated']),"Y/m/d")?></span>
        </div>
      </div>
    </div>
    <?php } ?>
    </div>
  <?php } ?>

  <?php if(!empty($videoArr)){?>
    <div class="searchResult">
    <span class="listTitle">Video</span>
    <?php foreach($videoArr as $k => $val){?>
      <?php if(validateMediaType2($val['value']) =="video"){?>
      <div class="innerBox">
      <div class="flexBox typeVideo">
        <video id="video<?=$key?>" onclick="openFullscreen(this.id)" src="<?=$val['value']?>"></video>
        <div class="desc">
          <span class="name"><?=$val['mediaName']?></span>
          <span class="created"><?=date_format(date_create($val['created']),"Y/m/d")?></span>
        </div>
      </div>
    </div>
      <?php } ?>
    <?php } ?>
    </div>
  <?php } ?>

    <?php if(!empty($audioArr)){?>
      <div class="searchResult">
      <span sclass="listTitle">Audio</span>
      <?php foreach($audioArr as $k => $val){?>
        <div id="<?=$val['audioId']?>" onclick="toAudioPg('audio'+this.id)" class="innerBox ">
        <div class="flexBox typeAudio">
          <img src="<?=$val['pic']?>">
          <div class="desc">
            <span class="name"><?=$val['title']?></span>
            <span class="created"><?=date_format(date_create($val['audioCreated']),"Y/m/d")?></span>
          </div>
        </div>
      </div>
      <?php } ?>
      </div>
    <?php } ?>
  <?php } ?>
  </div>


<script type="text/javascript">
  $(document).ready(function(){
    $('.searchClass2').autocomplete({
      source: "searchTotal.php",
      minLength: 1,
      create: function (event,ui){
          $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
          // console.log(item.type);
          if(item.type == "video"){
            return $("<li onclick='videoPg(this.id)' id="+item.label+" style='display:flex; padding: 12px 8px; border-bottom:solid 1px #ddd;' class='ui-autocomplete-row'></li>")
            .data("ui-autocomplete-item", item)
            .append('<div class="resultListBox"><video src="' + item.href + '" autoplay></video>' )
            .append('<span class="resultListDesc">[VIDEO] '+item.value+'</span></div>')
            .appendTo(ul);
          } else if(item.type == "audio"){

            return $("<li onclick='toAudioPg(this.id)' id=audio"+item.label+" style='display:flex; padding: 12px 8px; border-bottom:solid 1px #ddd;' class='ui-autocomplete-row'></li>")
            .data("ui-autocomplete-item", item)
            .append('<div class="resultListBox"><img src="' + item.href + '" />' )
            .append('<span class="resultListDesc">[AUDIO] '+item.value+'</span></div>')
            .appendTo(ul);
          } else{
            return $("<li onclick='toArticlePg(this.id)' id='"+item.label+"' style='display:flex; padding: 12px 8px; border-bottom:solid 1px #ddd;' class='ui-autocomplete-row'></li>")
          .data("ui-autocomplete-item", item)
          .append('<div class="resultListBox"><img src="' + item.href + '" />' )
          .append('<span class="resultListDesc">[ARTICLE] '+item.value+'</span></div>')
          .appendTo(ul);
          }
        };
      },
    });
  });

  function subtmitSearch(id){
      var x = document.createElement("INPUT");
      x.style.display = "none";
      x.setAttribute("type", "text");
      x.setAttribute("value", id);
      x.setAttribute("name", "lifeOption");
      document.getElementById("searchID").appendChild(x);

      $('#searchID').submit();
  }
</script>

<script>
$( document ).ready(function() {
  <?php if($_GET['searchApply'] == 1){ ?>
    document.getElementById("searchNav").style.width = "100%";

  <?php } ?>
});


var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.previousElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
      content.style.borderBottom = "none";
      document.getElementById("openBtn").style.borderTop = "none";
    }
  });
}
</script>

<?php require_once('app.php'); ?>


