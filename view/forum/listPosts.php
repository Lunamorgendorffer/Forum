<?php

$posts = $result["data"]['post'];
    
?>

<h1>liste message</h1>

<?php
foreach($posts as $post ){
    // var_dump($posts)

    ?>
    <p><?=$post->getMessage()." ".$post->getMesscreationdate()." de ".$post->getUser()->getPseudo()."<br>"?></p>
   <?php
}



  
