<?php 


?>

<div class="container mb-5">
    <div class="row g-0">
        <form action="index.php?ctrl=forum&action=addTopic" method="post">
            <div class="row d-flex justify-content-evenly">
                <div class="mb-5 col-4">
                    <label for="formGroupExampleInput" class="form-label">title</label>
                    <input class="form-control" type="text" name="title" id="titre">
                    <input type="hidden" name="category" value = "<?=$_GET['id']?>">
                </div>
            </div>
            <div class="d-flex justify-content-evenly">
                <button class="btn btn-primary mb-5 " name="submit" type="submit">Add</button>
            </div>
        </form>
    </div>
</div>
<?php var_dump($_POST);?>