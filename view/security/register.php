<h1>form connexion</h1>

<form action="index.php?ctrl=security&action=register" method="post" enctype ="multipart">
    
    <input type="text" name="pseudo" placeholder="pseudo" required>
    
    <input type="email" name="email" placeholder="email" required>
    
    <input type="password" name="password" placeholder="password" required>
    
    <input type="password" name="confirmPassword" placeholder="confirmPassword" required>
    
    <button type="submit">Valider</button>

</form>