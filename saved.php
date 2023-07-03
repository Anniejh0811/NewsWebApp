<?php
require_once("MV/C_saved.php"); 
require_once("header.php"); 
require_once("app.php"); 
?>

<script>
  $( document ).ready(function() {
    $(".fa-users").css("color","#d3d3d3");
    $(".fa-home").css("color","#d3d3d3");
    $(".fa-music").css("color","#d3d3d3");
    $(".fa-film").css("color","#d3d3d3");
});
</script>

<div style="margin: 8px;">
    <div style="text-align:right;">
        <i style="font-size: 20px; padding:8px;" id="addBtn" class="fas fa-plus"></i>
    </div>
<span style="padding:0px 4px; margin-bottom: 0px; margin-top:8px;" class="sub_title">Collections</span>
<div style="overflow:scroll;" class="flexBox">
    <?php for ($x = 0; $x < $collectionNum; $x++) {  ?>
        <div>
        <div onclick="collectionPg(this.id)" id="<?=$arrayColumnName[intVal($x)+1]?>" class="collCont">
        
        <?php if(intVal($arr10[$x]) <= 4){ 
        
            $limit = $arr10[$x];
           } else {
            
            $limit = 4;
           } ?>

  
            <?php   
            $w = 0;
            $i = 0;
                while ($i < count($arr5)) { ?>
                    
                    <?php if(intVal($w) > intVal($limit)-1){
                        break;

                    } ?>
                   
                    <?php  //if($arr5[$i]['Collection'.(intVal($x)+1)] =='1'){?>
                    <?php if($arr5[$i][$arrayColumnName[intVal($x)+1]] =='1'){?>
                        <img class="collImg" src="<?=$arr5[$i]['pic']?>" >
                        
                        <?php $w++;?>
                    <?php } ?>
            <?php  $i++;  ?>
            <?php } ?>
        </div>
        <div >
            <span class="collTitle"><?=$arrayColumnName[intVal($x)+1]?></span>
  
        </div>
        </div>
    <?php } ?>

    
</div>
</div>
<div style="margin:8px;" class="recommended_cont">
    <span class="sub_title">Saved Articles</span>
    <div class="article_cont">
    <?php foreach($arr4 as $key => $val) { ?>
        <img class="each_article savedList" src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)">
    <?php } ?>
    </div>
</div>



<form id="collNameSubmit" method="post" action="create_collection.php">
<!-- The Modal -->
<div id="modal" class="modal">

  <!-- Modal content -->    
  <div class="modal-content">
    <div style="padding:16px; border-bottom: 1px solid #888">
        <span>Add Collection</span>
    </div>
    <div style="padding: 16px;">
        <div style="margin-bottom: 4px;">
            <span>Collection Name</span>
        </div>
        <div>
        <input name="collName" style="height: 30px; width:100%; box-sizing:border-box;" type="text">
        </div>
    </div>
    <div style="display:flex; padding: 16px; justify-content: right;">
    <span style="display: block;" class="close">CLOSE</span>
    <span style="display: block;" onclick="nameSubmit()" class="submission">ADD</span>

  </div>
  </div>
</div>
</form>
<script>
// Get the modal
var modal = document.getElementById("modal");

// Get the button that opens the modal
var btn = document.getElementById("addBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


function nameSubmit(){
    document.getElementById("collNameSubmit").submit();
}
</script>







<?php require_once("footer.php"); ?>

</body>
</html>