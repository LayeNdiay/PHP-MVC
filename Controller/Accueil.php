<?php
require_once "Model\Article.php";
require_once "Model\Categorie.php";
require_once "Controller.php";
class Accueil extends Controller
{
    public function index()
    {
        $this->requiredAuth();
        $user = User::findById($_SESSION["user"]);
        $articles = Article::find();
        $categories = Categorie::find();
        $currentPage = "acceuil";
        $success = $this->flash("success");

        require_once "assets\index.php";
    }
    public function error404()
    {
        require_once "assets\\error.php";
    }
    public function error403()
    {
        require_once "assets\\error3.php";
    }
}
