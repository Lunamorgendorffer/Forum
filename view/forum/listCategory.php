<?php

$categories = $result["data"]['categories'];
$title="List of category"; 
// var_dump($categories)
    
?>

<h1 style="text-align: center; margin-bottom: 30px"></h1>
<div class="container">
    <div class="flex"style="display: flex;flex-wrap: wrap; justify-content: center;">
    <?php foreach($categories as $category){
         ?>
    <div class="card rounded" style="background-image: url('https://i.pinimg.com/originals/c9/6d/09/c96d09dd9e2ac87f10301cb40f94e8d3.jpg'); width: 30%; margin: 25px; ">
    <div class="card-body">
        <!-- <h5 class="card-title" style ="text-align: center; color: white;">category</h5> -->
        <h3 class="card-text" style="text-align: center; "><a class="text-decoration-none" style="color: white;" href="index.php?ctrl=forum&action=findTopicsByCat&id=<?= $category->getId()?>"><?=$category -> getNameCategory()?></a><br></h3>
    </div>
    <?php if(App\Session::isAdmin()){ ?>
        <div class="button" style="display: flex;justify-content: center; gap:10px">
        <a  class="btn btn-secondary" href="">Edit</a>
        <a  class="btn btn-danger" href=""> Delete</a>
   <?php }?> 
    </div>
    <?php } ?>

    <?php if(App\Session::getUser()|| App\Session::isAdmin()){?>
    <div class="container" style="display: flex;justify-content: center;;">
        <button style="background-color:#032f70; width: 8%; height: 45px; border:none; border-radius: 10px;"><a  class="text-decoration-none"  style="color: white;" href="index.php?ctrl=forum&action=viewAddCat">New Category</a></button>
    </div>
<?php } ?> 
</div>  
