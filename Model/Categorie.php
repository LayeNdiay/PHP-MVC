<?php
require_once "dao\CategorieManager.php";
class categorie
{
    private int $id;
    private string $libelle;
    private static CategorieManager $categorieManager;

    public static function initialise()
    {
        self::$categorieManager = new CategorieManager(__CLASS__);
    }
    public function __construct(int $id, string $libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        self::initialise();
    }
    public static function findById(int $id): self
    {
        self::initialise();
        return self::$categorieManager->findById($id);
    }
    public static function findByLibelle(string $libelle)
    {
        self::initialise();
        return self::$categorieManager->findByLibelle($libelle);
    }
    public static function find(): array
    {
        self::initialise();
        return self::$categorieManager->find();
    }
    public function create(): bool
    {
        return self::$categorieManager->create($this->libelle);
    }
    public function update(): bool
    {
        return self::$categorieManager->update($this);
    }
    public function delete(): bool
    {
        return self::$categorieManager->delete($this->id);
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
     * Get the value of libelle
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }
}
