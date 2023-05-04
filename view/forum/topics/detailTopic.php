<?php

$topic = $result["data"]['topic'];
$messages = $result["data"]["messages"];
var_dump($messages);

// var_dump($messages);
 
?>


<h1 style="text-align: center; margin-bottom: 30px">titre</h1>
<div class="container" style="display: flex;flex-direction: column;align-items: center;/* justify-content: center; */">
    <?php foreach ($messages as $message){ ?>
    <div class="card" style="background-image: url('https://i.pinimg.com/originals/c9/6d/09/c96d09dd9e2ac87f10301cb40f94e8d3.jpg'); width: 30%; margin: 25px; ">
    <img img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <p class="card-text" style="text-align: center; color: white; "><strong><?=$message->getMessage()?></strong></p>
        <p class= "card-text" style ="text-align: center; color: white;"></small><?=$message->getUser()->getPseudo()?></small></p>
    </div>
    <div class="button" style="display: flex;justify-content: center;">
        <button type="button" class="btn btn-secondary btn-sm">Edit</button>
    </div>
</div>
<?php } ?>

<div class="container" style="display: flex;justify-content: center;;">
    <a  class="btn btn-primary" href="index.php?ctrl=forum&action=viewAddPost&id=<?=$topic->getId()?>">Add</a>
</div>

<?php if(App\Session::getUser()){?>
    <form action="index.php?ctrl=forum&action=addPostByTopic&id=<?=$topic->getId()?>" method="post">
        <label>New Post</label>
        <textarea id="post" name="post" rows="4" cols="50"></textarea>
        <input type="submit" name="submit" value="Ajouter">
    </form>

<?php } ?>
