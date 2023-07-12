<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/styles/auth.css">


</head>

<body>



    <main class="main-auth">

        <form class="form" action="http://localhost/DAO/login" method="POST">
            <h2>Connexion</h2>
            <?php if ($error !== "") : ?>
                <div class="error">
                    <p><?= $error ?></p>
                </div>
            <?php endif ?>
            <div class="input-group">
                <label class="label" for="login">Login</label>
                <input required type="text" id="login" name="login" />
            </div>
            <div class="input-group">
                <label class="label" for="password">Password</label>
                <input required type="password" id="password" name="password" />
            </div>
            <div class="submit">
                <input type="submit" value="se connecter" />
            </div>
            <div class="register"> <a href="http://localhost/DAO/register">s'inscrire</a></div>
        </form>
    </main>

</body>

</html>