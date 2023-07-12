<?php
require_once ".\Controller\ArticleController.php";
require_once ".\Controller\Accueil.php";
require_once ".\Controller\CategorieController.php";
require_once ".\Controller\AuthController.php";
$articleController = new ArticleController();
$accueil = new Accueil();
$categorieController = new CategorieController();
$authController = new AuthController();
$action = $_GET["action"] ?? "accueil";
if ($action ===  "articles") {
    if (isset($_GET["id"]) && $_GET["id"] !== "") {
        $articleController->viewOne($_GET["id"]);
    } else {
        $accueil->index();
    }
} else if ($action === "categories") {
    if (isset($_GET["id"]) && $_GET["id"] !== "") {
        $categorieController->view($_GET["id"]);
    }
} elseif ($action === "categoriesCat") {
    if (isset($_GET["name"]) && $_GET["name"] !== "") {
        $categorieController->viewByCategorieName($_GET["name"]);
    } else {
        $accueil->index();
    }
} else if ($action === "accueil") {
    $accueil->index();
} else if ($action === "erreur") {
    $accueil->error404();
} elseif ($action === "login") {
    $authController->login();
} elseif ($action === "loginPost") {
    $authController->loginPost();
} elseif ($action === "register") {
    $authController->register();
} elseif ($action === "registerPost") {
    $authController->registerPost();
} elseif ($action === "logout") {
    $authController->logout();
} elseif ($action == "error403") {
    $accueil->error403();
} elseif ($action === "addCategorie") {
    $categorieController->addCategorie();
} elseif ($action === "addArticle") {
    $articleController->addArticle();
} elseif ($action === "addCategoriePost") {
    $categorieController->addCategoriePost();
} elseif ($action === "categorieApi") {
    $categorieController->getAllCategorie();
} elseif ($action === "addArticlePost") {
    $articleController->addArticlePost();
} elseif ($action === "editArticle") {
    $articleController->editArticle($_GET["id"]);
} elseif ($action === "editArticlePost") {
    $articleController->editArticlePost($_GET["id"]);
} elseif ($action === "delteArticlePost") {
    $articleController->delete($_GET["id"]);
} elseif ($action === "editCategorie") {
    $categorieController->edit($_GET["id"]);
} elseif ($action === "editCategoriePost") {
    $categorieController->editPost($_GET["id"]);
} elseif ($action === "deleteCategoriePost") {
    $categorieController->delete($_GET["id"]);
}
