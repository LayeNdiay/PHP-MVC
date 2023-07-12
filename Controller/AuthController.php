<?php
require_once "./Model/User.php";
require_once "./Model/Categorie.php";
require_once "Controller.php";
class AuthController extends Controller
{
    public function login()
    {
        if ($this->isConnected()) {
            $this->redirect();
        }
        $categories = Categorie::find();
        $currentPage = -1;
        $error = $this->flash();
        require "assets/auth.php";
    }
    public function loginPost()
    {
        if (!isset($_POST["login"]) || !isset($_POST["password"])) {
            $this->redirect("/login");
        }
        $user = User::connexion($_POST['login'], $_POST["password"]);
        if ($user === false) {
            $_SESSION["error"] = "Login ou mot de passe incorrect.";
            $this->login();
        } else {
            $_SESSION["user"] = $user;
            $this->redirect();
        }
    }
    public function register()
    {
        if ($this->isConnected()) {
            $this->redirect();
        }
        $categories = Categorie::find();
        $error = $this->flash();
        require "./assets/register.php";
    }
    public function registerPost()
    {
        if (!isset($_POST["login"]) || !isset($_POST["password"])) {
            $_SESSION["error"] = "Les champs login et password sont obligatoires";
            $this->redirect("/login");
        }
        $login = $_POST["login"];
        $password = $_POST["password"];
        $user = new User(-1, $login);
        if (!$user->create($password)) {
            $_SESSION["error"] = "Login existe déjà.";
            $this->register();
        }
        $_SESSION["user"] = $user;
        $this->redirect();
    }
    public function logout()
    {
        $this->requiredAuth();
        unset($_SESSION["user"]);
        $this->redirect("/login");
    }
}
