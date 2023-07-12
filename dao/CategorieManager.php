<?php
require_once "DataManager.php";
class CategorieManager extends DataManager
{
    private static $class;
    public function __construct(string $class)
    {
        self::$class = $class;
    }

    public function findById(int $id)
    {
        $query = $this->prepare("SELECT * FROM categorie WHERE id = :id");
        $query->execute(["id" => $id]);
        $categorie = $query->fetch(PDO::FETCH_ASSOC);
        if ($categorie) {
            return new self::$class($categorie['id'], $categorie['libelle']);
        }
        throw new Exception("Nom de libellé inexistant");
    }
    public function find(): array
    {
        $query = $this->prepare("SELECT * FROM categorie");
        $query->execute();
        $results = array();
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $categorie) {
            $results[] = new self::$class($categorie['id'], $categorie['libelle']);
        }
        return $results;
    }
    public function findByLibelle(string $libelle)
    {
        $query = $this->prepare("SELECT * FROM categorie where libelle = :libelle");
        $query->execute(["libelle" => $libelle]);
        $categorie = $query->fetch(PDO::FETCH_ASSOC);
        if ($categorie) {
            return new self::$class($categorie['id'], $categorie['libelle']);
        }
        throw new Exception("Nom de libellé inexistant");
    }
    public function create(string $libelle): bool
    {
        $query = $this->prepare("INSERT INTO categorie(libelle) values(:libelle)");
        return  $query->execute(["libelle" => $libelle]);
    }
    public function update($categorie): bool
    {
        $query = $this->prepare("UPDATE categorie SET libelle = :libelle WHERE id = :id");
        return  $query->execute(["libelle" => $categorie->getLibelle(), "id" => $categorie->getId()]);
    }

    public function delete(int $id): bool
    {
        return parent::deleteById("categorie", $id);
    }
}
