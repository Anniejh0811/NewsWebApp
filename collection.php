<?php
require_once("MV/C_collection.php"); 
require_once("header.php"); 
require_once("app.php"); 
?>

<form id="changeName" method="post" action="">
<div class="collectionOuterMost">
    <div  class="collOuterBox">
        <div class="collTitleBox" id="collectionTitleBox">
            <span id="collectionTitle" class="sub_title"><?=$collectionId?></span>
            <i id="saveIcon" onclick="newNameSubmit()" class="fas fa-save"></i>
            <i id="cancelIcon" onclick="cancelEditName()" class="fas fa-times"></i>
            <input type="hidden" name="collId" value="<?=$collectionId?>">
        </div>
        <i id="editMenu" onclick="changeNavBar()" class="fas fa-ellipsis-v changeMenuBtn"></i>
    </div>
    <span class="savedArticleText"><?=$collectionTotal?> saved articles</span>
</div>
</form> 

<div class="recommended_cont margin_8">
    <div id="normalShow" class="article_cont">
        <?php foreach($arr5 as $key => $val) { ?>
            <img class="each_article savedList collection" src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)">
        <?php } ?>
    </div>

    <form method="post" id="removeArticleForm" action="">
        <div id="removeSelection" style="display:none;" class="article_cont">
            <?php foreach($arr5 as $key => $val) { ?>
                <div class="removeCheckBox">
                    <input name="removeArticle[<?=$key?>]" value="<?=$val['id']?>" class="checkbox-round" style="position:absolute;" type="checkbox">
                    <img style="width: 100%;"class="each_article savedList collection" src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)">
                </div>
            <?php } ?>
        </div>
    </form>
</div>

<div style="display:none;" id="removeBox" class="removeBox">
      <span onclick="cancelRemoveBox()" class="cancel">CANCEL</span>
      <span onclick="removeForm()" class="remove">REMOVE</span>
</div>

<div id="collectionNavBar" style="display:none;" class="sticky">
    <div class="navbar">
        <div class="each_cont collection vertical_align" onclick="toMainNavBar()">
            <i class="fas fa-arrow-left collectionIcon"></i>
        </div>
        <div class="each_cont collection vertical_align" id="addSavedBtn">
            <i class="fas fa-plus collectionIcon"></i>
        </div> 
        <div class="each_cont collection vertical_align" id="addSavedBtn">
            <i  onclick="removeSelect()" class="fas fa-minus collectionIcon"></i>
        </div> 
        <div class="each_cont vertical_align" onclick="editName()">
            <i class="fas fa-edit collectionIcon"></i>
        </div>    
        <form method="post" id="deleteBtn" action="">
            <div id="deleteColl" class="each_cont collection vertical_align" onclick="deleteCollection()">
                <i class="fas fa-trash-alt collectionIcon"></i>
            </div>  
        </form>
    </div>
</div>

<!-- The Modal -->
<div id="selectModal" class="modal">
  <!-- Modal content -->
<div class="modal-content">
    <div class="btn_group_add">
        <span class="addCollTitle" >Add Collection</span>

        <div class="flexBox">
        <span style="display:block;" onclick="closeModal()" id="closeModal" class="close">CLOSE</span>
        <span  onclick="addNewForm()" class="submission span_block">ADD</span>
    </div>
</div>


<form id="newForm" action="">
    <input name="collId" value="<?=$collectionId?>" type="hidden">
        <div class="article_cont modalSelect">
        <?php foreach($arr3 as $key => $val) { ?>
            <?php if($val[$collectionId]!=1){?>
                <div style="width: 32%;">
                    <input name="new[<?=$key?>]" value="<?=$val['id']?>" class="checkbox-round" style="position:absolute;" type="checkbox">
                    <img style="width: 100%;"class="each_article savedList collection" src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)">
                </div>
                <?php } ?>
        <?php } ?>
        </div>
    </div>
    </div>
</form>
</body>
<?php require_once("footer.php"); ?>
</html>

<script>
// Get the modal
var modal = document.getElementById("selectModal");

// Get the button that opens the modal
var btn = document.getElementById("addSavedBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
console.log(span);

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
</script>





  