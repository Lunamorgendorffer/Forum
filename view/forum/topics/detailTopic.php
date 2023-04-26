<?php

$topic = $result["data"]['topic'];
$messages = $result["data"]["messages"];
// var_dump($topics)
 
?>

<div class="infos">
        <h4>posted by : <a href="index.php?ctrl=forum&action=detailUser&id=<?= $topic->getUser()->getId() ?>"><?= $topic->getUser()->getPseudo() . "</a> - " . $topic->getCreationdate() ?></h4>
</div>

<div class="preview">
        <div class="title">
            <strong>Title:</strong>
            <p><?= $topic->getTitle() ?></p>
        </div>

        <div class="msg">
            <strong>Message:</strong>
            <p><?= $message->getMessage() ?></p>
        </div>
</div>