<?php if (!isset($currentPage)) {
    $currentPage = -1;
} ?>
<header>
    <div class="site-name">
        <h1>Actualités Polytechniciennes</h1>
    </div>
    <nav class="nav">
        <ul>
            <li><a class="<?php if ($currentPage === "acceuil") : ?> active <?php endif ?>" href="http://localhost/DAO/"> Acceuil</a></li>
            <?php foreach ($categories as $categorie) : ?>
                <li>
                    <a class="<?php if ($categorie->getId() === $currentPage) : ?> active <?php endif ?>" href="http://localhost/DAO/categories/<?= $categorie->getLibelle() ?>"> <?= htmlentities($categorie->getLibelle()) ?></a>
                    <?php if ($user->getisAdmin()) : ?>

                        <div class="admin-privileges">
                            <a href="http://localhost/DAO/categories/edit/<?= $categorie->getId() ?>"><button><img src="http://localhost/DAO/assets/images/pencil-solid.svg" width="15px"></button></a>
                        </div>
                        <div class="admin-privileges">
                            <form class="form-delete" action="http://localhost/DAO/categories/delete/<?= $categorie->getId() ?>" method="post">
                                <button><img src="http://localhost/DAO/assets/images/trash-solid.svg" width="15px"></button>
                            </form>
                        </div>
                    <?php endif ?>
                </li>

            <?php endforeach ?>
            <?php if ($user->getisAdmin()) : ?>
                <li><a class="<?php if ($currentPage === "addCategorie") : ?> active <?php endif ?>" href="http://localhost/DAO/categories/add"> Ajouter catégorie</a></li>
                <li><a class="<?php if ($currentPage === "addArticle") : ?> active <?php endif ?>" href="http://localhost/DAO/articles/add"> Ajouter article</a></li>
            <?php endif ?>
            <form action="http://localhost/DAO/logout" method="post">
                <li> <button class="btn-submit" type="submit">Logout</button></li>

            </form>
        </ul>
    </nav>
</header>