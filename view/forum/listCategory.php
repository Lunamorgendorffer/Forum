<?php

$categories = $result["data"]['categories'];
    
?>

<h1>liste Categories</h1>



<h1 style="text-align: center; color: white; margin-bottom: 30px">Listes des catégories</h1>
<div class="container" style="display: flex;flex-wrap: wrap;">
    <?php foreach($categories as $category){ ?>
    <div class="card" style="background-image: url('https://i.pinimg.com/originals/c9/6d/09/c96d09dd9e2ac87f10301cb40f94e8d3.jpg'); width: 30%; margin: 25px; ">
    <img img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title" style ="text-align: center; color: white;">catégorie</h5>
        <h3 class="card-text" style="text-align: center; "><a style="color: white;" href="#"><?=$category -> getNameCategory()?></a><br></h3>
    </div>
</div>
<?php } ?>


  
