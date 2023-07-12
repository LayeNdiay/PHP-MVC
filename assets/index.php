<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités politechniciennes</title>
</head>
<link rel="stylesheet" href="http://localhost/DAO/assets/styles/style.css">
<link rel="stylesheet" href="http://localhost/DAO/assets/styles/boite.css">


<body>

    <?php
    require_once "./assets/header.php" ?>
    <main>
        <?php if (isset($success) && $success !== "") : ?>
            <div class="alert-success">
                <?= $success ?>
            </div>
        <?php endif ?>
        <?php if (is_array($articles)) : ?>
            <?php if (empty($articles)) : ?>
                <div class="news">

                    <div class="news-title" style="justify-content: center;">
                        <h2> Aucune publication trouvée</h2>
                    </div>
                </div>
            <?php endif ?>

            <?php foreach ($articles as $article) : ?>

                <div class="news">
                    <?php if ($user->getisAdmin()) : ?>

                        <div class="admin-privileges">
                            <a href="http://localhost/DAO/articles/edit/<?= $article->getId() ?>"><button><img src="http://localhost/DAO/assets/images/pencil-solid.svg" width="15px"></button></a>
                        </div>
                        <div class="admin-privileges">
                            <form class="form-delete" action="http://localhost/DAO/articles/delete/<?= $article->getId() ?>" method="post">
                                <button><img src="http://localhost/DAO/assets/images/trash-solid.svg" width="15px"></button>
                            </form>
                        </div>
                    <?php endif ?>
                    <div class="news-title">
                        <h2> <?= htmlentities($article->getTitre()) ?></h2>
                    </div>
                    <div class="news-content">
                        <?= htmlentities($article->getContenu()) ?>
                    </div>

                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="news">
                <?php if ($user->getisAdmin()) : ?>

                    <div class="admin-privileges">
                        <a href="http://localhost/DAO/articles/edit/<?= $articles->getId() ?>"><button><img src="http://localhost/DAO/assets/images/pencil-solid.svg" width="15px"></button></a>
                    </div>
                    <div class="admin-privileges">
                        <form class="form-delete" action="http://localhost/DAO/articles/delete/<?= $articles->getId() ?>" method="post">
                            <button><img src="http://localhost/DAO/assets/images/trash-solid.svg" width="15px"></button>
                        </form>
                    </div>
                <?php endif ?>
                <div class="news-title">
                    <h2> <?= htmlentities($articles->getTitre()) ?></h2>
                </div>
                <div class="news-content">
                    <?= htmlentities($articles->getContenu()) ?>
                </div>
            </div>
        <?php endif ?>
        <?php if ($user->getisAdmin()) : ?>
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
        <?php endif ?>



    </main>

</body>
<script src="http://localhost/DAO/assets/script/modal.js"></script>

</html>