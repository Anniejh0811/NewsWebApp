<?php
require_once("MV/C_videoPg.php"); 
require_once("app.php"); 
require_once("head.php"); 
?>
<div onclick="goBack()" class="videoPgBackBtn">
    <i  class="fas fa-arrow-left"></i>
</div>
<video onclick="openFullscreen(this.id)" id="<?=$row1['mediaId']?>" class="videoPgVideo" src="<?=$row1['value']?>" controls></video>
