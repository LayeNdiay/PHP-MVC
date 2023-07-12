<?php
require_once ".\dao\UserManager.php";
class User
{
    private int $id;
    private string $name;
    private bool $isAdmin;
    private static UserManager $userManager;
    public static function initialize()
    {
        self::$userManager = new UserManager(__CLASS__);
    }

    public function __construct(int $id, string $name, int $isAdmin = 0)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setsAdmin($isAdmin);
        self::initialize();
    }

    public static function connexion(string $name, string $password)
    {
        self::initialize();
        return self::$userManager->connexion($name, $password);
    }

    public function create(string $password)
    {
        return self::$userManager->create($this, $password);
    }
    public static function findById(int $id)
    {
        self::initialize();
        return self::$userManager->findById($id);
    }





    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of isAdmin
     */
    public function getisAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */
    public function setsAdmin($isAdmin)
    {

        $this->isAdmin = $isAdmin === 1 ? true : false;

        return $this;
    }
}
