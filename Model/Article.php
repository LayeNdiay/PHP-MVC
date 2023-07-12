<?php
require_once "dao\ArticleManager.php";
class Article
{
    private int $id;
    private string $titre;
    private string $contenu;
    private DateTime  $dateCreation;
    private DateTime $dateModification;
    private int $categorie;
    private static  $articleManager;

    public static function initialise()
    {
        self::$articleManager = new ArticleManager(__CLASS__);
    }

    public function __construct(int $id, string $titre, string $contenu, DateTime $dateCreation, DateTime $dateModification, int $categorie)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->dateCreation = $dateCreation;
        $this->dateModification = $dateModification;
        $this->categorie = $categorie;
        self::initialise();
    }

    public static function find(): array
    {
        self::initialise();
        return self::$articleManager->find();
    }
    public static function findById(int $id): self
    {
        self::initialise();
        return self::$articleManager->findById($id);
    }
    public static function findByCategorieId(int $idCategorie): array
    {
        self::initialise();
        return self::$articleManager->findByCategorieId($idCategorie);
    }
    public function create()
    {
        return self::$articleManager->create($this);
    }
    public function update(): bool
    {
        return  self::$articleManager->update($this);
    }
    public function updateTitle(): bool
    {
        return self::$articleManager->updateTitle($this);
    }
    public function updateContent(): bool
    {
        return self::$articleManager->updateContent($this);
    }

    public function updateCategorie(): bool
    {
        return self::$articleManager->updateCategorie($this);
    }
    public function delete(): bool
    {
        return self::$articleManager->delete($this);
    }



    /**
     * Get the value of titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of contenu
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return  self
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set the value of dateCreation
     *
     * @return  self
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get the value of dateModification
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set the value of dateModification
     *
     * @return  self
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get the value of categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @return  self
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
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
}
