<?php
require_once("MV/C_life.php"); 
require_once("header.php"); 
require_once("app.php"); 
?>
<script>
$( document ).ready(function() {
    $(".fa-users").css("color","#d3d3d3");
    $(".fa-bookmark").css("color","#d3d3d3");
    $(".fa-home").css("color","#d3d3d3");
    $(".fa-film").css("color","#d3d3d3");
});
</script>
<div class="selectionOuterCont">
    <form id="lifeSelect" action="">
        <select name="lifeOption" onchange="lifeOption1()" style="border: solid 1px #999999; width: 96%; margin-left: 8px;font-family: Arima;font-size: 18px; text-align: center;" name="sample" id="sample" >
            <option <?php if( ($_GET['lifeOption']) == '100' && isset($_GET['lifeOption'])) { echo 'selected'; } ?> value="100" style=" text-align: center;"> Search</option>
            <option <?php if( ($_GET['lifeOption']) == '50' || !isset($_GET['lifeOption'])) { echo 'selected'; } ?> value="50" style=" text-align: center;"> Editor's Pick</option>
            <option <?php if( ($_GET['lifeOption']) == '51' && isset($_GET['lifeOption'])) { echo 'selected'; } ?> value="51" style="text-align: center;"> Hot</option>
            <?php foreach($arr5 as $k => $v){ ?>
                <option <?php if( ($_GET['lifeOption']) == $v['subTitleID'] && isset($_GET['lifeOption'])) { echo 'selected'; } ?> value="<?=$v['subTitleID']?>"><?=$v['subTitleName']?></option>  
            <?php } ?>
        </select> 
    </form>

    <?php if($_GET['lifeOption'] == 100){?>
    <form style="margin:8px;" method="get" id="searchID">
        <div style="display:flex;">
        <input placeholder="Search Features" type="text" class="searchClass" 
            id="searchInputID" value="" />
        <i class="fa fa-search background"></i>
        </div>
    </form>
    <?php } ?>
</div>

<div class="lifeTopBox">
    <div class="outerCont">
    <?php if(count($arr3)>0){?>
        <div id="<?=$arr3[0]['id']?>" onclick="toArticlePg(this.id)" class="flexBox" >
            <img class="lifeImg" src="<?=$arr3[0]['pic']?>" alt="">
            <div class="life detail">
                <span class="articleTitle life"><?=$arr3[0]['title']?></span>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if(count($arr3)>1){?>
    <div class="outerCont">
        <div id="<?=$arr3[1]['id']?>" onclick="toArticlePg(this.id)" class="flexBox">
        <div class="life detail right">
                <span class="articleTitle life "><?=$arr3[1]['title']?></span>
            </div>
            <img class="lifeImg" src="<?=$arr3[1]['pic']?>" alt="">       
        </div>
    </div>
    <?php } ?>
    <?php if(count($arr3)>2){?>
    <div class="outerCont">
        <div id="<?=$arr3[2]['id']?>" onclick="toArticlePg(this.id)" class="flexBox">
        <img class="lifeImg" src="<?=$arr3[2]['pic']?>" alt="">        
        <div class="life detail">
                <span class="articleTitle life"><?=$arr3[2]['title']?></span>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<div class="lifeBottomBox">
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
<?php if($_GET['lifeOption'] == 100){?>
    //  $(document).ready(function(){
        console.log(1);
    $('.searchClass').autocomplete({
      source: "data.php",
      minLength: 1,
      create: function (event,ui){
               $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                console.log(item.label);
                return $("<li onclick='subtmitSearch(this.id)' id="+item.label+" style='padding: 12px 8px;' class='ui-autocomplete-row'></li>")
        .data("ui-autocomplete-item", item)
        .append(item.value)
        .appendTo(ul);
            };
        },
    });
 <?php } ?>


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