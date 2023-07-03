<?php
require_once("MV/C_audio.php"); 
require_once("app.php"); 
require_once("head.php"); 
?>
    <div onclick="back()" class="listBackBtn">
        <i class="fas fa-arrow-left"></i>
    </div>
    <div class="audioPgCont">
        <div class="audioPgCont_sub">
            <div class="audioPic">
                <img src="<?=$row1['pic']?>" alt="">
            </div>
            <div class="articleTitle audio">
                <span><?=$row1['title']?></span>
            </div>
            <div class="audioControl">
                <audio controls>
                    <source src="<?=$row1['audioLink']?>" type="audio/mpeg">
                </audio>
            </div>

            <div class="audioDesc">
            <p class="articleContent audio"><?=$row1['audioDesc']?></p>
            </div>
        </div>
    </div>
    </body>
</html>