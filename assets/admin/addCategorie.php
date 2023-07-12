<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie</title>
</head>
<link rel="stylesheet" href="http://localhost/DAO/assets/styles/style.css">
<link rel="stylesheet" href="http://localhost/DAO/assets/styles/auth.css">
<link rel="stylesheet" href="http://localhost/DAO/assets/styles/boite.css">



<body>

    <?php require_once "./assets/header.php";
    $link = $page === "add" ? "http://localhost/DAO/categories/add" : "http://localhost/DAO/categories/edit/" . $id;
    ?>
    <main>
        <form class="form-categorie" action=<?= $link ?> method="POST">
            <h2 style="margin-bottom: 20px;">Ajouter une catégorie</h2>
            <?php if (isset($error) && $error !== "") : ?>
                <div class="error">
                    <?= $error ?>
                </div>
            <?php endif ?>
            <div class="error" hidden>
            </div>
            <div class="input-group">
                <label for="name" class="label">Libelle de la categorie</label>
                <input required type="text" value="<?php if (isset($old["name"])) echo $old["name"] ?>" id="name" name="name" autofocus />
            </div>
            <div class="submit">
                <input type="submit" id="submit" value="soumettre" />
            </div>
        </form>
    </main>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <h2>Êtes-vous sûr de vouloir supprimer ?</h2>
            <p>Cette action sera irréversible!</p>
            <div class="modal-buttons">
                <button onclick="deleteItem()">Oui</button>
                <button onclick="closeModal()">Non</button>
            </div>
        </div>
    </div>



    </main>

</body>
<script src="http://localhost/DAO/assets/script/modal.js"></script>
<script>
    let categories = []
    let formCategorie = document.querySelector(".form-categorie")
    let error = document.querySelector(".error")
    let name = document.querySelector("#name")
    fetch('http://localhost/DAO/api/categories')
        .then(function(response) {
            if (response.ok) {
                return response.json()
            } else {
                throw new Error('Erreur lors de la requête : ' + response.status)
            }
        })
        .then(function(data) {
            categories = data
        })
        .catch(function(error) {
            console.error(error)
        })

    formCategorie.addEventListener("submit", function(e) {
        if (categories.includes(name.value)) {
            error.innerHTML = "Ce libellé existe déjà veuillez en choisir un autre"
            error.removeAttribute("hidden")
            e.preventDefault()
        }
    })
</script>

</html>