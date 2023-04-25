<?php

$users = $result["data"]['users'];
    
?>

<h1>liste Users</h1>

<?php
foreach($users as $user){

    ?>
    <p><?=$user->getPseudo()." ".$user->getMail()." ".$user->getRegisterDate()."<br>" ?></p>
    <?php
}
