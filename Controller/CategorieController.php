<?php
require_once ".\Model\Categorie.php";
require_once ".\Model\Article.php";
require_once ".\Model\User.php";
require_once "Controller.php";
class CategorieController extends Controller
{
    public function addCategorie()
    {
        $user = $this->requireAdminAuth();
        $categories = Categorie::find();
        $currentPage = "addCategorie";
        $error = $this->flash();
        $success = $this->flash("success");
        $page = "add";
        $old = $this->old();
        require "./assets/admin/addCategorie.php";
    }

    public function addCategoriePost()
    {
        $user = $this->requireAdminAuth();
        if (!isset($_POST["name"])) {
            $_SESSION["error"] =  "Le formulaire est mal remplit";
            $_SESSION["old"] = ["name" => $_POST["name"]];
            $this->redirect("/categories/add");
        } else {
            $cat = new Categorie(0, $_POST["name"]);
            if ($cat->create()) {
                $_SESSION["success"] =  "Catégorie créée avec succés";
                $this->redirect('/categories' . '/' . $cat->getLibelle());
            }
        }
    }
    public function edit(int $id)
    {
        $user = $this->requireAdminAuth();
        $categories = Categorie::find();
        $article = Article::findById($id);
        $currentPage = "addArticle";
        $error = $this->flash();
        $success = $this->flash("success");
        $page = "edit";
        $categorie = Categorie::findById($id);
        $old = ["name" => $categorie->getLibelle()];
        require "./assets/admin/addCategorie.php";
    }
    public function editPost(int $id)
    {
        $user = $this->requireAdminAuth();
        if (!isset($_POST["name"])) {
            $_SESSION["error"] =  "Le formulaire est mal remplit";
            $_SESSION["old"] = ["name" => $_POST["name"]];
            $this->redirect("/categories/edit/" . $id);
        } else {
            $cat = Categorie::findById($id);
            $cat->setLibelle($_POST["name"]);
            if ($cat->update()) {
                $_SESSION["success"] =  "Catégorie modifiée avec succés";
                $this->redirect('/categories' . '/' . $cat->getLibelle());
            }
        }
    }
    public function delete(int $id)
    {
        $user = $this->requireAdminAuth();
        $categorie = Categorie::findById($id);
        if ($categorie->delete()) {
            $_SESSION["success"] =  "Categorie supprimer avec succès";
            $this->redirect('/categories' . '/');
        }
    }

    public function view(int $id)
    {
        $this->requiredAuth();
        $user = User::findById($_SESSION["user"]);
        $categories = Categorie::find();
        try {
            $articles = Article::findByCategorieId($id);
        } catch (Exception $e) {
            $this->redirect("/error");
        }
        $currentPage = $id;
        require_once "assets\index.php";
    }
    public function viewByCategorieName(string $name)
    {
        $this->requiredAuth();
        $user = User::findById($_SESSION["user"]);
        try {
            $cat = Categorie::findByLibelle($name);
        } catch (Exception $e) {
            $this->redirect("/error");
        }

        $categories = Categorie::find();
        $articles = Article::findByCategorieId($cat->getId());
        $currentPage = $cat->getId();
        $success = $this->flash("success");

        require_once "assets\index.php";
    }
    public function getAllCategorie()
    {
        $categories = Categorie::find();
        $cats = [];
        foreach ($categories as $categorie) {
            $cats[] = $categorie->getLibelle();
        }
        header('Content-Type: application/json');
        echo json_encode($cats);
    }
}
