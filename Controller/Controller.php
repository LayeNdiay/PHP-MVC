<?php
require_once "./Model/User.php";
class Controller
{
    public function __construct()
    {
        $this->verifySession();
    }
    public function verifySession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function isConnected()
    {
        if (isset($_SESSION["user"])) {
            try {
                $user = User::findById($_SESSION["user"]);
                if ($user) {
                    return true;
                }
            } catch (Exception $e) {
                unset($user);
            }
        }
        return false;
    }
    public function flash(string $message = "error"): string
    {
        $error = "";
        if (isset($_SESSION[$message])) {
            $error = $_SESSION[$message];
            unset($_SESSION[$message]);
        }
        return $error;
    }
    public function old()
    {
        $old = array();
        if (isset($_SESSION["old"])) {
            $old = $_SESSION["old"];
            unset($_SESSION["old"]);
        }
        return $old;
    }
    public function redirect(string $path = "/")
    {
        header("location: http://localhost/DAO" . $path);
    }
    public function requiredAuth()
    {
        if (!$this->isConnected()) {
            $this->redirect("/login");
        }
    }

    public function requireAdminAuth()
    {
        $this->requiredAuth();
        $user = User::findById($_SESSION["user"]);
        if (!$user->getIsAdmin()) {
            $this->redirect("/forbidden");
            return;
        }
        return $user;
    }
}
