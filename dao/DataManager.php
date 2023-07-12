<?php
class DataManager
{

    public function prepare(string $sql): PDOStatement
    {
        return $this->getPdo()->prepare($sql);
    }
    public function deleteById(string $table, int $id)
    {
        $query = $this->prepare("DELETE FROM $table WHERE id = :id");
        return $query->execute(["id" => $id]);
    }
    protected function getPdo()
    {
        return new PDO('mysql:host=localhost;dbname=mglsi_news;charset=utf8', 'root', "");
    }
}
