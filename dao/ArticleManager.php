<?php
require_once "DataManager.php";
class ArticleManager extends DataManager
{
    private static $class;
    public function __construct(string $class)
    {
        self::$class = $class;
    }

    public function findById(int $id)
    {
        $query = $this->prepare("SELECT * FROM article WHERE id = :id");
        $query->execute(["id" => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new self::$class($row['id'], $row['titre'], $row['contenu'], new DateTime($row['dateCreation']), new DateTime($row['dateModification']), $row['categorie']);
        }
        throw new Exception("Article inexistant");
    }
    public function find(): array
    {
        $query = $this->prepare("SELECT * FROM article");
        $query->execute();
        $results = array();
        $articles = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($articles as $article) {
            $results[] = new self::$class($article['id'], $article['titre'], $article['contenu'], new DateTime($article['dateCreation']),  new DateTime($article['dateModification']), $article['categorie']);
        }
        return $results;
    }
    public function findByCategorieId(int $idCategorie): array
    {
        $query = $this->prepare("SELECT * FROM article WHERE categorie = :idCategorie");
        $query->execute(["idCategorie" => $idCategorie]);
        $results = array();
        $articles = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($articles as $article) {
            $results[] = new self::$class($article['id'], $article['titre'], $article['contenu'], new DateTime($article['dateCreation']),  new DateTime($article['dateModification']), $article['categorie']);
        }
        return $results;
    }

    public function create($article): bool
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare("INSERT INTO article(titre,contenu,dateCreation,dateModification,categorie) values(:titre,:contenu,:dateCreation,:dateModification,:categorie)");
        $result =  $query->execute([
            "titre" => $article->getTitre(),
            "contenu" => $article->getContenu(),
            "dateCreation" => $article->getDateCreation()->format('Y-m-d H:i:s'),
            "dateModification" => $article->getDateModification()->format('Y-m-d H:i:s'),
            "categorie" => $article->getCategorie()
        ]);
        $article->setId($pdo->lastInsertId());
        return $result;
    }
    public function update($article): bool
    {
        $query = $this->prepare("UPDATE article SET titre = :titre,contenu = :contenu,dateCreation = :dateCreation,dateModification = :dateModification,categorie = :categorie WHERE id = :id ");
        return  $query->execute([
            "titre" => $article->getTitre(),
            "contenu" => $article->getContenu(),
            "dateCreation" => $article->getDateCreation()->format('Y-m-d H:i:s'),
            "dateModification" => $article->getDateModification()->format('Y-m-d H:i:s'),
            "categorie" => $article->getCategorie(),
            "id" => $article->getId()
        ]);
    }
    public function updateTitle($article): bool
    {
        $query = $this->prepare("UPDATE article SET titre = :titre ,dateModification = now() WHERE id = :id");
        return  $query->execute(["titre" => $article->titre, "id" => $article->id]);
    }
    public function updateContent($article): bool
    {
        $query = $this->prepare("UPDATE article SET contenu = :contenu ,dateModification = now() WHERE id = :id");
        return  $query->execute(["contenu" => $article->contenu, "id" => $article->id]);
    }
    public function updateCategorie($article): bool
    {
        $query = $this->prepare("UPDATE article SET categorie = :categorie ,dateModification = now() WHERE id = :id");
        return  $query->execute(["categorie" => $article->categorie, "id" => $article->id]);
    }
    public function delete($article): bool
    {
        return parent::deleteById("article", $article->getId());
    }
}
