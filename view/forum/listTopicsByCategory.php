<?php

$categories = $result["data"]["categories"];
// $categories2 = $result["data"]["categories2"];
$topics = $result["data"]["topics"];
// var_dump($topics);
$ids = $result["data"]["id"]
    
?>

<?php 

echo "<h1 style='text-align: center; color: white; margin-bottom: 30px'>" .$categories->getNameCategory()."</h1>"; 
// var_dump($categories);
?>
<div class="container" style="display: flex;flex-wrap: wrap;">
    <?php foreach($ids as $id){ 
        // var_dump($id->getCategory())?>
    <div class="card" style="background-image: url('https://i.pinimg.com/originals/c9/6d/09/c96d09dd9e2ac87f10301cb40f94e8d3.jpg'); width: 30%; margin: 25px; ">
    <img img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title" style ="text-align: center;"><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$id->getId()?>"><?=$id->getTitle()?></a></h5>
        <p class="card-text" style ="text-align: center; color:white"><?=$id->getCreationdate()?></p>
        <p class="card-text" style ="text-align: center; color:white"><?=$id->getUser()->getPseudo()?><br></p>
    </div>
    <div class="button" style="display: flex;justify-content: center;">
        <a href="index.php?ctrl=forum&action=deleteTopic&id=<?=$id->getId()?>">Delete</a>
        <?= var_dump($id->getId())?>
    </div>
</div>
<?php } ?>
<div class="container" style="display: flex;justify-content: center;;">
    <a  class="btn btn-primary" href="index.php?ctrl=forum&action=viewAddTopic&id=<?=$_GET['id']?>">Add</a>
</div>

<?= var_dump($id->getId())?>