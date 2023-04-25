<?php

$topics = $result["data"]['topics'];
var_dump($topics)

    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){
    // var_dump($topics)

    ?>
    <p><?=$topic->getTitle()." ".$topic->getCreationdate()." de ".$topic->getUser()->getPseudo()."<br>"?></p>
   <?php
}



  
