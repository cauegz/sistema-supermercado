<?php

namespace App\DAO;

use App\Model\Categoria;
use InvalidArgumentException;

class CategoriaDAO extends BaseDAO
{
    protected function getTableName(): string { return 'categoria'; }
    protected function getSQLInsert(): string { return 'INSERT INTO categoria (nome) VALUES (:nome)'; }
    protected function getSQLUpdate(): string { return 'UPDATE categoria SET nome = :nome WHERE id_categoria = :id'; }
    protected function getSQLDelete(): string { return 'DELETE FROM categoria WHERE id_categoria = :id'; }

    protected function getDadosInsert(object $categoria): array
    {
        return [':nome' => $categoria->getNome()];
    }

    protected function getDadosUpdate(object $categoria, int $id): array
    {
        return [':id' => $id, ':nome' => $categoria->getNome()];
    }

    protected function validarModel(object $categoria): void
    {
        if (!$categoria instanceof Categoria) {
            throw new InvalidArgumentException('O objeto deve ser do tipo Categoria');
        }
    }
}
