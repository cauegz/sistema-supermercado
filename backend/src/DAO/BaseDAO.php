<?php

namespace App\DAO;

use App\Core\Conexao;
use PDO;

abstract class BaseDAO
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getConnection();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insert(object $model)
    {
        $this->validarModel($model);

        $sql = $this->getSQLInsert();
        $dados = $this->getDadosInsert($model);

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($dados);
        return $stmt->rowCount();
    }

    public function update(object $model, int $id)
    {
        $this->validarModel($model);

        $sql = $this->getSQLUpdate();
        $dados = $this->getDadosUpdate($model, $id);

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($dados);
        return $stmt->rowCount();
    }

    public function delete(int $id)
    {
        $sql = $this->getSQLDelete();

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([":id" => $id]);
        return $stmt->rowCount();
    }

    public function findById(int $id)
    {
        $tabela = $this->getTableName();
        $sql = "SELECT * FROM $tabela WHERE id_$tabela = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM " . $this->getTableName();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    abstract protected function getTableName(): string;
    abstract protected function getSQLInsert(): string;
    abstract protected function getSQLUpdate(): string;
    abstract protected function getSQLDelete(): string;
    abstract protected function getDadosInsert(object $model): array;
    abstract protected function getDadosUpdate(object $model, int $id): array;
    abstract protected function validarModel(object $model): void;
}
