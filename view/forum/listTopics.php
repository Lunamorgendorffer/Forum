<?php

$topics = $result["data"]['topics'];
var_dump($topics)

    
?>

<h1>liste topics</h1>
<div class="container">
    <div class="row">
        <table class="table table-striped mt-4 display">
            <thead>
                <tr class="bg-secondary">
                    <th scope="col">Topics</th>
                    <th scope="col">Publié le</th>
                    <th scope="col">Ecrit par</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($topics as $topic ) {?>
                <td scope="row"><a href="#"><?=$topic->getTitle()?></td>
                <td scope="row"><?=$topic->getCreationdate()?></a></td>
                <td scope="row"><?=$topic->getUser()->getPseudo()?></a></td>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>






  
