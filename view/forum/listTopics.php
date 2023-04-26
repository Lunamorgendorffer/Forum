<?php

$topics = $result["data"]['topics'];
// var_dump($topics)

    
?>

<h1>liste topics</h1>
<div class="container">
<?php foreach($topics as $topic ) {?>
<div class="card  " >
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title "><a href="#"><?=$topic->getTitle()?></a></h5>
    <p class="card-text"><?=$topic->getCreationdate()?></p>
    <p class="card-text"><?=$topic->getUser()->getPseudo()?></p>
    <a href="#" class="btn btn-primary">Add</a>
  </div>
  <?php } ?>
</div>
</div>







  
