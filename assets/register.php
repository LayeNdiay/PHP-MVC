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
        <form class="form" action="register" method="POST">
            <h2>Inscription</h2>
            <?php if ($error !== "") : ?>
                <div class="error">
                    <p><?= $error ?></p>
                </div>
            <?php endif ?>
            <div class="error" hidden>
            </div>
            <div class="input-group">
                <label class="label" for="login">Login</label>
                <input required type="text" id="login" name="login" />
            </div>
            <div class="input-group">
                <label class="label" for="password">Password</label>
                <input required type="password" id="password" name="password" />
            </div>
            <div class="input-group">
                <label class="label" for="passwordConfirme">Password confirm</label>
                <input required type="password" id="passwordConfirm" />
            </div>
            <div class="submit">
                <input type="submit" id="submit" value="se connecter" />
            </div>
            <div class="login"> <a href="http://localhost/DAO/login">se connecter</a></div>
        </form>
    </main>

</body>
<script>
    pasword = document.querySelector("#password")
    error = document.querySelector(".error")
    passwordConfirm = document.querySelector("#passwordConfirm")
    form = document.querySelector("form")

    form.addEventListener("submit", function(e) {
        motDepasse = password.value;
        if (motDepasse.length < 4) {
            error.removeAttribute("hidden")
            error.innerHTML = "mots de passe non sécurisée"
            e.preventDefault()

        } else {
            if (motDepasse !== passwordConfirm.value) {
                error.removeAttribute("hidden")
                error.innerHTML = "les deux mots  de passe doivent être identiques"
                e.preventDefault()
            }
        }

    })
</script>

</html>