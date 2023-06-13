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
  function toAudio(){
    window.location.assign('media.php?pgId=audio');
  }

  function toLife(){
    window.location.assign('life.php');
  }

  function collectionPg(id){
    window.location.assign('collection.php?collId='+id);
  }
</script>