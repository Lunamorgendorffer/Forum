<?php

$categories = $result["data"]['category'];
    
?>

<h1>liste message</h1>

<?php
foreach($categories as $category ){
    // var_dump($posts)

    ?>
    <p><?=$category -> getNameCategory()?></p>
   <?php
}



  
