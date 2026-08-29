<?php

namespace App\DAO;

use App\Model\Marca;
use InvalidArgumentException;

class MarcaDAO extends BaseDAO
{
    protected function getTableName(): string { return 'marca'; }
    protected function getSQLInsert(): string { return 'INSERT INTO marca (nome) VALUES (:nome)'; }
    protected function getSQLUpdate(): string { return 'UPDATE marca SET nome = :nome WHERE id_marca = :id'; }
    protected function getSQLDelete(): string { return 'DELETE FROM marca WHERE id_marca = :id'; }

    protected function getDadosInsert(object $marca): array { return [':nome' => $marca->getNome()]; }
    protected function getDadosUpdate(object $marca, int $id): array
    {
        return [':id' => $id, ':nome' => $marca->getNome()];
    }

    protected function validarModel(object $marca): void
    {
        if (!$marca instanceof Marca) {
            throw new InvalidArgumentException('O objeto deve ser do tipo Marca');
        }
    }
}
