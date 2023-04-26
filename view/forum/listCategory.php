<?php

$categories = $result["data"]['categories'];
    
?>

<h1>liste Categories</h1>

<?php
foreach($categories as $category ){
    // var_dump($posts)

    ?>
    <p><?=$category -> getNameCategory()?></p>
   <?php
}



  
