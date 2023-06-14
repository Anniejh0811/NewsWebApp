<?php


$conn = new mysqli("localhost","root","root","THENEWS","8889");



function prettyPrint($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

$deleteKey = $_POST['deleteInput'];
$collectionId = $_GET['collId'];
$EditNewName = $_POST['EditNewName'];

// $queryDelete = "ALTER TABLE collection_table
// DROP COLUMN"+"$collectionId"+"";";

if(isset($EditNewName) && $EditNewName !=""){
    $queryEditName = "
    ALTER TABLE collection_table CHANGE ".$collectionId." $EditNewName INT NULL;
    ";
    // echo $queryEditName;
    $resultNewName = mysqli_query($conn,"
    ALTER TABLE collection_table CHANGE ".$collectionId." $EditNewName INT NULL;
    ");
    echo "<script> location.href='?collId=$EditNewName'; </script>";
}

if(isset($deleteKey)){
    $queryDelete = "
    ALTER TABLE collection_table DROP COLUMN ".$collectionId."
    ";
    $resultDelete = mysqli_query($conn,$queryDelete);
    echo "<script> location.href='saved.php'; </script>";
}

// echo $queryDelete;

// prettyPrint($_GET['new']);



if(!empty($_GET['new'])){
    foreach($_GET['new'] as $count => $id){
        $query2 = "UPDATE collection_table SET "."$collectionId"." = 1 WHERE articleIdColl ="."$id";
        $result2 = mysqli_query($conn,$query2);
        // echo $query2;
    }
}

if(!empty($_POST['removeArticle'])){
    foreach($_POST['removeArticle'] as $count => $id){
        $query2 = "UPDATE collection_table SET "."$collectionId"." = NULL WHERE articleIdColl ="."$id";
        $result2 = mysqli_query($conn,$query2);
        echo $query2;
    }
}


$sql = "
SELECT * FROM newsarticle
WHERE saved=1;
";


    
$result = mysqli_query($conn, $sql);
$arr4 = array();
while ($row1 = mysqli_fetch_assoc($result)) {
$arr4[] = $row1;
}



$sql2 = "
SELECT newsarticle.id, newsarticle.pic, collection_table.$collectionId
FROM newsarticle
LEFT JOIN collection_table
ON newsarticle.id = collection_table.articleIdColl
WHERE ".$collectionId."=1;
";

// print_r($sql2);

$result3 = mysqli_query($conn, $sql2);
$arr5 = array();

while ($row1 = mysqli_fetch_assoc($result3)) {
$arr5[] = $row1;
}


$sql5 = "
  SELECT * FROM collection_table;
";

$result1 = mysqli_query($conn, $sql5);
$arr2 = array();
while ($row1 = mysqli_fetch_assoc($result1)) {
$arr2[] = $row1;
}
// print_r(count($arr2[0]));
$collectionNum = intVal(count($arr2[0])) -1;
// print_r($collectionNum);
// prettyPrint($arr2);
// prettyPrint($arr4);

// prettyPrint($arr5);

// $counter = "
// SELECT count(*) as total FROM collection_table 
// WHERE Collection1=1;
// ";


$sql3 = "
SELECT newsarticle.id, newsarticle.pic, collection_table.*
FROM newsarticle
LEFT JOIN collection_table
ON newsarticle.id = collection_table.articleIdColl
;
";

$result3 = mysqli_query($conn, $sql3);
$arr3 = array();
while ($row1 = mysqli_fetch_assoc($result3)) {
$arr3[] = $row1;
}

// prettyPrint($arr3);

// $result10 = mysqli_query($conn, $counter);
// $arr10 = array();
// $row1 = mysqli_fetch_assoc($result10);
// $count = $row1['total'];

// print_r($count);
$collectionTotal = count($arr5);

$query4 = "SHOW COLUMNS FROM collection_table";
$resultColumns = mysqli_query($conn,$query4);
$arrayColumnName = array();
while($row = mysqli_fetch_array($resultColumns)){
    $arrayColumnName[] = $row['Field'];
    // echo $row['Field']."<br>";
}

// prettyPrint($arrayColumnName);

// $countArr = array();
for ($x = 1; $x <= $collectionNum; $x++) { 
    // echo $x;
    $counter = "
    SELECT count(*) as total FROM collection_table 
    WHERE".$arrayColumnName[$x]."=1;";
    // echo $counter;
    $result10 = mysqli_query($conn, $counter);
    $row1 = mysqli_fetch_assoc($result10);
    $count = $row1['total'];
    $arr10[] = $count;
    // $row = mysql_fetch_assoc($result10);
// $count = $row['count'];
    // print_r($count);
    //  print_r(mysqli_result($result8, 0));
    // $countArr[] = $result8;
}

// print_r($arr10);

// prettyPrint($countArr);
$limit = 0;



$newSaved = $_GET['new[0]'];

// $cars = $_POST['cars'];
// foreach($newSaved as $car => $val):
//     echo $val."<br>";
// endforeach;









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
<!-- <i style="font-size: 16px; padding:8px; padding-top:16px; " class="fas fa-arrow-left"></i> -->

<form id="changeName" method="post" action="">
<div style="margin:0px 0px 0px 8px; margin-top: 16px; padding:0px;" class="recommended_cont">
    <div  style="display:flex; justify-content:space-between; align-items:center;">
        <div style="width: 55%; display:flex; align-items:center;" id="collectionTitleBox">
            <span id="collectionTitle" class="sub_title"><?=$collectionId?></span>
            <i id="saveIcon" onclick="newNameSubmit()" style="margin-left: 8px;display: none; padding:7px; background-color: #E9133E; color: white; border-radius: 5px;" class="fas fa-save"></i>
            <i id="cancelIcon" onclick="cancelEditName()" style="margin-left: 8px;display: none; padding:7px; background-color: #ddd; color: white; border-radius: 5px;" class="fas fa-times"></i>
            <input type="hidden" name="collId" value="<?=$collectionId?>">
        </div>
        <i id="editMenu" style="font-size: 16px; padding:8px; margin-right:16px;" onclick="changeNavBar()" class="fas fa-ellipsis-v"></i>
    </div>
    <span style="font-family: Arima; font-size: 14px;"><?=$collectionTotal?> saved articles</span>
</div>
<div style="margin:8px;" class="recommended_cont">
</form> 


    <div id="normalShow" class="article_cont">
        <?php foreach($arr5 as $key => $val) { ?>
            <img class="each_article savedList collection" src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)">
            <!-- <div style="width: 32%;">
                <input name="new[<?=$key?>]" value="<?=$val['id']?>" class="checkbox-round" style="position:absolute;" type="checkbox">
                <img style="width: 100%;"class="each_article savedList collection" src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)">
            </div> -->
        <?php } ?>
    </div>

    <form method="post" id="removeArticleForm" action="">
        <div id="removeSelection" style="display:none;" class="article_cont">
            <?php foreach($arr5 as $key => $val) { ?>
                <!-- <img class="each_article savedList collection" src="<?=$val['pic']?>" alt="" onclick="toArticlePg(<?=$val['id']?>)"> -->
                <div style="width: 32%;">
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
        <i style="font-size: 16px; padding:8px;" class="fas fa-arrow-left"></i>
    </div>
    <div class="each_cont collection vertical_align" id="addSavedBtn">
        <i style="font-size: 16px; padding:8px; " class="fas fa-plus"></i>
    </div> 
    <div class="each_cont collection vertical_align" id="addSavedBtn">
        <i style="font-size: 16px; padding:8px;" onclick="removeSelect()" class="fas fa-minus"></i>
    </div> 
    <div class="each_cont vertical_align" onclick="editName()">
        <i style="font-size: 16px; padding:8px; " class="fas fa-edit"></i>
    </div>    
    <form method="post" id="deleteBtn" action="">
        <div id="deleteColl" class="each_cont collection vertical_align" onclick="deleteCollection()">
            <i style="font-size: 16px; padding:8px; " class="fas fa-trash-alt"></i>
        </div>  
    </form>
    </div>
</div>


<script>
    function removeSelect(){
        document.getElementById("normalShow").style.display = "none";
        document.getElementById("removeSelection").style.display = "flex";
        document.getElementById("removeBox").style.display = "flex";
    }

    function cancelRemoveBox(){
        document.getElementById("normalShow").style.display = "flex";
        document.getElementById("removeSelection").style.display = "none";
        document.getElementById("removeBox").style.display = "none";
    }

     function deleteCollection(){
            var c = confirm("Do you want to delete Collection?");

            if (c == true) {
                var x = document.createElement("INPUT");
                x.setAttribute("type", "hidden");
                x.setAttribute("value", "D");
                x.setAttribute("name", "deleteInput");
                document.getElementById("deleteColl").appendChild(x);
                document.getElementById("deleteBtn").submit();
                } 
        }


    function editName(){
        document.getElementById("collectionTitle").style.display ="None";
        // document.getElementById("editMenu").style.display ="None";
        var parentnode = document.getElementById("collectionTitleBox");
        var existnode = document.getElementById("collectionTitle");
        var x = document.createElement("INPUT");
        x.setAttribute("id", "collectionNameInput");
                x.setAttribute("type", "text");
                x.setAttribute("style", "margin: 8px 0px;box-sizing: border-box;display: block;height: 30px;width: 100%; border-radius: 2px; font-size: 18px; border: 1px solid #999999;");
                x.setAttribute("value", "<?=$collectionId?>");
                x.setAttribute("name", "EditNewName");
                // document.getElementById("collectionTitleBox").appendChild(x);
                parentnode.insertBefore(x,existnode);
                document.getElementById("saveIcon").style.display ="block";
                document.getElementById("cancelIcon").style.display ="block";

    }

    function cancelEditName(){
        document.getElementById("collectionTitle").style.display ="block";
        document.getElementById("collectionNameInput").style.display ="none";
        document.getElementById("saveIcon").style.display ="none";
                document.getElementById("cancelIcon").style.display ="none";
                
    }

    function newNameSubmit(){
        document.getElementById("changeName").submit();
     
                
    }
</script>

<!-- The Modal -->
<div id="selectModal" class="modal">

  <!-- Modal content -->
<div class="modal-content">
    <div style="padding:8px; border-bottom: 1px solid #888; display:flex; justify-content:space-between;">
        <span style="display: block; padding:8px;" >Add Collection</span>

        <div style="display:flex;">
        <span style="display: block;" class="close">CLOSE</span>
        <span style="display: block;" onclick="addNewForm()" class="submission">ADD</span>
    </div>



</div>


<form id="newForm" action="">
    <input name="collId" value="<?=$collectionId?>" type="hidden">
    <div style="padding: 16px;">
        <div style="margin-bottom: 4px;">
            <span>Collection Name</span>
        </div>
        <div>
        <input name="collName" style="height: 30px; width:100%; box-sizing:border-box;" type="text">
        </div>
    </div>

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
    <!-- <div style="display:flex; padding: 16px; justify-content: right;">
        <span style="display: block;" class="close">CLOSE</span>
        <span style="display: block;" onclick="nameSubmit()" class="submission">ADD</span>
    </div> -->
  </div>
</div>
</form>

<script>
// Get the modal
var modal = document.getElementById("selectModal");

// Get the button that opens the modal
var btn = document.getElementById("addSavedBtn");

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
</script>



    </body>

    <?php require_once("footer.php"); ?>
    </html>

    <script>
        function changeNavBar(){
            
            const mainNavBar = document.getElementById("mainNavBar");
            const collectionNavBar = document.getElementById("collectionNavBar");

            if(mainNavBar.style.getPropertyValue('display') == "none" ){

                mainNavBar.style.display = "flex";
                collectionNavBar.style.display = "none";
            } else{
                mainNavBar.style.display = "none";
                collectionNavBar.style.display = "flex";
            }
            

            
            


        }
        function toMainNavBar(){
            const mainNavBar = document.getElementById("mainNavBar");
            mainNavBar.style.display = "flex";

            const collectionNavBar = document.getElementById("collectionNavBar");
            collectionNavBar.style.display = "none";
        }

        function addNewForm(){
            document.getElementById("newForm").submit();
        }

        function removeForm(){
            document.getElementById("removeArticleForm").submit();
        }

       
    </script>
    