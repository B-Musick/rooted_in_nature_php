<?php include 'partials/header.html' ?>
    <div id="landing-page-container">

        <?php
            
            $rectWidth = [10,18,30,60,50,70,90,65,55,30,15,5,2,4,7,20,40,20,10,15];
            for($x = count($rectWidth)-1; $x>=0; $x--){
                echo '<div class="rectangle" style="width:'.$rectWidth[$x].'vw;height:15px;"></div>';
            }
            
        ?>
        <div id="landing-main-page">Where science meets nature...</div>
    </div>
<?php include 'partials/footer.html' ?>
