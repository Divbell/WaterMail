<?php
/**
 * a main layout for watermail
 */

?>

<html>
    <head>
        <?php include("layout/head.php") ?>
    </head>
    <body>
        <div class="main-page">
            <?php include($navigation) ?>

            <?php include($content) ?>

            <?php include($footer) ?>
        </div>
    </body>
</html>