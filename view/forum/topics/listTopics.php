<?php

$topics = $result["data"]['topics'];

// var_dump($topics)

    
?>


<h1 style="text-align: center; color: white; margin-bottom: 30px">liste topics</h1>
<div class="container" style="display: flex;flex-wrap: wrap;">
    <?php foreach($topics as $topic){ ?>
    <div class="card" style="background-image: url('https://i.pinimg.com/originals/c9/6d/09/c96d09dd9e2ac87f10301cb40f94e8d3.jpg'); width: 30%; margin: 25px; ">
    <img img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title" style ="text-align: center;"><a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?=$topic->getTitle()?></a></h5>
        <p class="card-text" style ="text-align: center;"><?=$topic->getCreationdate()?></p>
        <p class="card-text" style ="text-align: center;"><?=$topic->getUser()->getPseudo()?><br></p>
    </div>
</div>
<?php } ?>








  
