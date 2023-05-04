<?php 
$post = $result["data"]['messages'];
$postId = $_GET['id'];

 ?>
 <div class = "message-update">

    <h1 class = "titre-page"> UPDATE POST </h1>

    <form action="index.php?ctrl=forum&action=editPost&id=<?=$postId?>" method = "post" >
        <textarea  name = "post"  rows="4" cols="50"></textarea>
        <input type="submit" name="submit" value="Ajouter">
        
    </form>
</div>