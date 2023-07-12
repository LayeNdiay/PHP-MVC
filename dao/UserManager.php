<?php
require_once "DataManager.php";
class UserManager extends  DataManager
{
    public static $class;
    public function __construct(string $class)
    {
        self::$class = $class;
    }
    public function findById(int $id)
    {
        $query = $this->prepare("SELECT * FROM user WHERE id = :id");
        $query->execute(["id" => $id]);
        $user = $query->fetchObject();
        if ($user) {
            return new self::$class($user->id, $user->name, intval($user->isAdmin));
        }
        throw new Exception("Utilisateur inexistant");
    }
    public function connexion(string $name, string $password)
    {
        $query = $this->prepare("SELECT * FROM user WHERE name = :name");
        $query->execute(["name" => $name]);
        $users = $query->fetchAll(PDO::FETCH_CLASS);
        $userConnected = false;
        foreach ($users as $user) {
            if (password_verify($password, $user->password)) {
                $userConnected = $user->id;
                break;
            }
        }
        return $userConnected;
    }
    public function create($user, $password)
    {
        $query = $this->prepare("INSERT INTO user(name,password)  values(:name,:password)");
        return $query->execute(["name" => $user->getName(), "password" => password_hash($password, PASSWORD_BCRYPT)]);
    }
}
