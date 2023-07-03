<script>
function toHomePg(){
  window.location.assign('home.php');
}
function topic(id){
  window.location.assign('home.php?id='+id);
}

function toBRNewsPg(id){
  window.location.assign('breakingNews.php?bkId='+id);
}

function toArticlePg(id){
  window.location.assign('article.php?articleId='+id);
}

function toVideo(){
  window.location.assign('media.php?pgId=video');
}

function videoPg(id){
  window.location.assign('videoPg.php?videoID='+id);
}

function toAudio(){
  window.location.assign('media.php?pgId=audio');
}

function toLife(){
  window.location.assign('life.php');
  $(".fa-users").css("color","#d3d3d3");
}

function collectionPg(id){
  window.location.assign('collection.php?collId='+id);
}

function toSaved(){
  window.location.assign('saved.php');
}

function openFullscreen(id) {
  const elem = document.getElementById(id);
  console.log(elem);
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
function toAudioPg(id){
  window.location.assign('audio.php?audioId='+id);
}

function detailedSearch(){
  document.getElementById("detailedSearch").submit();
}
function openNav() {
  document.getElementById("mySidenav").style.width = "220px";
}

function openSearchNav() {
  document.getElementById("searchNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function closeSearchNav() {
  document.getElementById("searchNav").style.width = "0";
}

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
  const elem = document.getElementById(id);
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
  

function expand(){
  if($( "a.seeArticle" ).text() == "See Article"){
      $( "a.seeArticle" ).text("Close Article");
  } else{
      $( "a.seeArticle" ).text("See Article");
  } 
}

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

function closeModal(){
    document.getElementById("selectModal").style.display = "none";
}

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
    var parentnode = document.getElementById("collectionTitleBox");
    var existnode = document.getElementById("collectionTitle");
    var x = document.createElement("INPUT");
    x.setAttribute("id", "collectionNameInput");
    x.setAttribute("type", "text");
    x.setAttribute("style", "margin: 8px 0px;box-sizing: border-box;display: block;height: 30px;width: 100%; border-radius: 2px; font-size: 18px; border: 1px solid #999999;");
    x.setAttribute("value", "<?=$collectionId?>");
    x.setAttribute("name", "EditNewName");
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

function lifeOption1(){
  document.getElementById('lifeSelect').submit();
}
function goBack(){
  history.back();
}
function back(){
  window.location.assign("media.php?pgId=audio");
}
</script>