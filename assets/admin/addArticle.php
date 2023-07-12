<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie</title>
</head>
<link rel="stylesheet" href="../assets/styles/style.css">
<link rel="stylesheet" href="../assets/styles/auth.css">
<link rel="stylesheet" href="http://localhost/DAO/assets/styles/boite.css">


<body>

    <?php require_once "./assets/header.php";
    $link = $page === "add" ? "http://localhost/DAO/articles/add" : "http://localhost/DAO/articles/edit/" . $article->getId();
    ?>
    <main>
        <form class="form-categorie" action=<?= $link ?> method="POST">
            <h2 style="margin-bottom: 20px;">Ajouter un arcticle</h2>
            <?php if (isset($error) && $error !== "") : ?>
                <div class="error">
                    <?= $error ?>
                </div>
            <?php endif ?>

            <div class="input-group">
                <label for="name" class="label">Titre</label>
                <input required type="text" id="name" name="name" value="<?php if (isset($old["name"])) echo $old["name"] ?>" autofocus />
            </div>
            <div class="input-group">
                <label for="content" class="label">Contenu</label>
                <textarea required type="text" id="content" name="content"><?php if (isset($old["content"])) echo $old["content"] ?></textarea>
            </div>
            <div class="input-group" style="margin-top: 20px;">
                <label for="categorie" class="label">Categorie</label>
                <select class="custom-select" name="categorie" id="categorie" required>
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie->getId() ?>" <?php if (isset($old["categorie"]) && $old["categorie"] == $categorie->getId()) echo "selected"  ?>> <?= $categorie->getLibelle() ?></option>
                    <?php endforeach ?>
                </select>
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

</html>