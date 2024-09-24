<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="/register" method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <br><label for="password">Mot de passe</label>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <br><button type="submit">S'inscrire</button>
    </form>
</body>
</html>