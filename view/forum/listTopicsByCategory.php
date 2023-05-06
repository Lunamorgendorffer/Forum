<?php

$categories = $result["data"]["categories"];
// $categories2 = $result["data"]["categories2"];
$topics = $result["data"]["topics"];
// var_dump($topics);
$ids = $result["data"]["id"]

    
?>

<?php 

echo "<h1 style='text-align: center;  margin-bottom: 30px'>" .$categories->getNameCategory()."</h1>"; 
// var_dump($categories);
?>
<div class="container">
    <div class="flex"style="display: flex;flex-wrap: wrap; justify-content: center;">
        <?php foreach($ids as $id){ 
            // var_dump($id->getCategory())?>
        <div class="card rounded" style="background-color:#032f70; width: 30%; margin: 25px; ">
        <div class="card-body">
            <h5 class="card-title" style ="text-align: center;"><a class="text-decoration-none" style="color:white;" href="index.php?ctrl=forum&action=detailTopic&id=<?=$id->getId()?>"><?=$id->getTitle()?></a></h5>
            <p class="card-text" style ="text-align: center; color:white"><sub>created: <i><?=$id->getCreationdate()?></i><sub></p>
            <p class="card-text" style ="text-align: center; color:white">Post by:<?=$id->getUser()->getPseudo()?></p>
        </div>
        <?php if(App\Session::getUser()){
            if(App\Session::getUser()->getId() == $id->getUser()->getId() ||App\Session::isAdmin()){ ?>
        <div class="button" style="display: flex;justify-content: center; gap:10px ">
            <a class="btn btn-secondary" href="">Edit</a>
            <a class="btn btn-danger" href="index.php?ctrl=forum&action=deleteTopic&id=<?=$id->getId()?>">Delete</a>
        </div>
        <?php }} ?>
    </div>
    <?php } ?>
</div>
<?php if(App\Session::getUser()){?>
    <div style="display: flex; justify-content: center;;">
        <button style="background-color:#032f70; width: 10%; height: 45px; border:none; border-radius: 10px;">
            <a class="text-decoration-none"  style="color: white;" href="index.php?ctrl=forum&action=viewAddTopic&id=<?=$_GET['id']?>">New Topic</a>
        </button>
    </div>
<?php } ?>


