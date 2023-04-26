<?php

$topic = $result["data"]['topic'];
$messages = $result["data"]["messages"];
// var_dump($topics)
 
?>

<a href="index.php?ctrl=forum&action=detailUser&id=<?= $topic->getUser()->getId() ?>"><?= $topic->getUser()->getPseudo()?></a>

<p><?= $topic->getTitle() ?></p>
<p><?= $messages->getMessage() ?></p>