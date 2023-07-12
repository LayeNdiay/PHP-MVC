<?php
require_once "Model\Article.php";
require_once "Model\Categorie.php";
require_once "Controller.php";

class ArticleController extends Controller
{

    public function viewOne(int $id)
    {
        $this->requiredAuth();
        $user = User::findById($_SESSION["user"]);
        try {
            $articles = Article::findById($id);
        } catch (Exception $e) {
            $this->redirect("/error");
        }
        $categories = Categorie::find();
        $currentPage = $articles->getCategorie();
        $success = $this->flash("success");
        require_once "assets\index.php";
    }
    public function addArticle()
    {
        $user = $this->requireAdminAuth();
        $categories = Categorie::find();
        $currentPage = "addArticle";
        $error = $this->flash();
        $success = $this->flash("success");
        $page = "add";
        $old = $this->old();
        require "./assets/admin/addArticle.php";
    }
    public function addArticlePost()
    {
        $user = $this->requireAdminAuth();
        if (!isset($_POST["name"]) || !isset($_POST["content"])  || !isset($_POST["categorie"])) {
            $_SESSION["error"] =  "Le formulaire est mal rempli.";
            $_SESSION["old"] = ["name" => $_POST["name"], "content" => $_POST["content"], "categorie" => $_POST["categorie"]];
            $this->redirect("/articles/add");
        } else {

            $article = new Article(0, $_POST["name"], $_POST["content"], new DateTime(), new DateTime(), $_POST["categorie"]);
            if ($article->create()) {
                $_SESSION["success"] =  "article créé sans problème.";
                $this->redirect('/articles' . '/'  . $article->getId());
            }
        }
    }
    public function editArticle(int $id)
    {
        $user = $this->requireAdminAuth();
        $categories = Categorie::find();
        $currentPage = "addArticle";
        $error = $this->flash();
        $success = $this->flash("success");
        $article = Article::findById($id);
        $page = "edit";
        $old = ["name" => $article->getTitre(), "content" => $article->getContenu(), "categorie" => $article->getCategorie()];
        require "./assets/admin/addArticle.php";
    }

    public function editArticlePost($id)
    {
        $user = $this->requireAdminAuth();
        if (!isset($_POST["name"]) || !isset($_POST["content"])  || !isset($_POST["categorie"])) {
            $_SESSION["error"] =  "Le formulaire est mal rempli.";
            $this->redirect("/articles/edit/" . $id);
        } else {
            $article = Article::findById($id);
            $article->setTitre($_POST["name"]);
            $article->setContenu($_POST["content"]);
            $article->setCategorie($_POST["categorie"]);
            $article->setDateModification(new DateTime());
            $article = new Article($id, $_POST["name"], $_POST["content"], new DateTime(), new DateTime(), $_POST["categorie"]);
            if ($article->update()) {
                $_SESSION["success"] =  "article modifié avec succès";
                $this->redirect('/articles' . '/'  . $article->getId());
            }
        }
    }
    public function delete(int $id)
    {
        $user = $this->requireAdminAuth();
        $article = Article::findById($id);
        if ($article->delete()) {
            $_SESSION["success"] =  "article supprimer avec succès";
            $this->redirect('/articles' . '/');
        }
    }
}
