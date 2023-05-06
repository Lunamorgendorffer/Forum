<?php

$topic = $result["data"]['topic'];
$messages = $result["data"]["messages"];
// var_dump($messages);
var_dump($messages);
$title="Detail topic"; 

 
?>


<h1 style="text-align: center; margin-bottom: 30px"><?=$topic->getTitle()?></h1>
<div class="container">
    <div class="flex"style="display: flex;flex-wrap: wrap; justify-content: center;">
        <?php foreach ($messages as $message){ 
            // var_dump($message);?>
        <div class="card" style="background-color:#032f70;; width: 30%; margin: 25px;">
        <div class="card-body">
            <p class="card-text" style="text-align: center; color: white; "><strong><?=$message->getMessage()?></strong></p>
            <p class= "card-text" style ="text-align: center; color: white;"></small><?=$message->getUser()->getPseudo()?></small></p>
        </div>
        <?php if(App\Session::getUser()){
            if(App\Session::getUser()->getId() == $message->getUser()->getId()||App\Session::isAdmin()){ ?>
            <div class="button" style="display: flex;justify-content: center;">
                <a  class="btn btn-secondary" href="index.php?ctrl=forum&action=viewEditPost&id=<?=$_GET['id']?>">Edit</a>
                <a  class="btn btn-danger" href="index.php?ctrl=forum&action=deletePost&id=<?=$message->getId()?>"> Delete</a>
            </div>
        <?php }}?> 
    </div>
    <?php } ?>
    <?php if(App\Session::getUser()){?>
    <div class="container" style="display: flex;justify-content: center;;">
        <button style="background-color:#032f70; width: 8%; height: 45px; border:none; border-radius: 10px;">
            <a class="text-decoration-none" style="color: white;" href="index.php?ctrl=forum&action=viewAddPost&id=<?=$topic->getId()?>">New Post</a>
        </button>
    </div>
    <?php } ?>
    <?php if(App\Session::getUser()||App\Session::isAdmin() ){?>
    <form action="index.php?ctrl=forum&action=addPostByTopic&id=<?=$topic->getId()?>" method="post">
        <label>New Post</label>
        <textarea id="post" name="post" rows="3" cols="50"></textarea>
        <input type="submit" name="submit" value="Valider">
    </form>
<?php } ?>
</div>


