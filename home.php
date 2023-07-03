
<?php 
require_once("MV/C_home.php"); 
require_once("header.php"); 
require_once("app.php"); 
?>
<script>
  $( document ).ready(function() {
    $(".fa-users").css("color","#d3d3d3");
    $(".fa-bookmark").css("color","#d3d3d3");
    $(".fa-music").css("color","#d3d3d3");
    $(".fa-film").css("color","#d3d3d3");
});
</script>

      <!-- menu  -->
      <div class="menu_outerbox" >
        <?php
        foreach($arr as $key => $val) { ?>
            <?php if($id!=NULL && $val['topicname'] == $id){?>
          <div class="vertical_align circle">
            <div class="center">
              <img class="todayTopic" style="" src="<?=$val['link']?>" alt="" onclick="topic('<?=$val['topicname']?>')">
            </div>
            <span><?=$val['topicname']?></span>
          </div>
          <?php } else {?>
          <div class="vertical_align circle" onclick="topic('<?=$val['topicname']?>')">
            <img src="<?=$val['link']?>" alt="">
            <span><?=$val['topicname']?></span>
          </div>
          <?php } ?>
        <?php } ?>
      </div>

    <main>
      <!-- breaking news -->
      <?php if($breakingNews == TRUE) {?>
        <div class="bknews_title_cont">
          <span class="breaking">&nbsp;Breaking&nbsp;<span class="news">&nbsp;New&nbsp;</span></span>
        </div>
        <?php foreach($arr1 as $key => $val) { 
          if($val['BNmain'] == TRUE){?>
            <div class="bknews_cont" onclick="toBRNewsPg(<?=$val['id']?>)">
              <span class="bknews_text"><?=$val['title']?></span>
              <img class="bknews_pic" src="<?=$val['pic']?>" alt="">
            </div>
          <?php } ?>
        <?php } ?>
      <?php } ?>

      <!-- Today's Reels -->
      <?php if($todayVideo === TRUE){ ?>
        <video src="Pictures/ex1.mp4" type="video/mp4" controls></video>
      <?php } ?>

      <!-- recommended news  -->
      <div class="recommended_cont">
        <span class="sub_title">Recommended News</span>
          <div class="article_cont">
            <?php foreach($arr1 as $key => $val) { ?>
              <img class="each_article" src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)">
            <?php } ?>
          </div>
      </div>

    </main>
    </div>
    <?php require_once("footer.php"); ?>
  </body>
</html>
