<?php

namespace App\DAO;

use App\Model\Cliente;
use InvalidArgumentException;

class ClienteDAO extends BaseDAO
{
    protected function getTableName(): string { return 'cliente'; }
    protected function getSQLInsert(): string
    {
        return 'INSERT INTO cliente (nome, email, cpf) VALUES (:nome, :email, :cpf)';
    }
    protected function getSQLUpdate(): string
    {
        return 'UPDATE cliente SET nome = :nome, email = :email, cpf = :cpf WHERE id_cliente = :id';
    }
    protected function getSQLDelete(): string { return 'DELETE FROM cliente WHERE id_cliente = :id'; }

    protected function getDadosInsert(object $cliente): array { return $this->getDados($cliente); }
    protected function getDadosUpdate(object $cliente, int $id): array
    {
        return [':id' => $id, ...$this->getDados($cliente)];
    }

    protected function validarModel(object $cliente): void
    {
        if (!$cliente instanceof Cliente) {
            throw new InvalidArgumentException('O objeto deve ser do tipo Cliente');
        }
    }

    private function getDados(Cliente $cliente): array
    {
        return [
            ':nome' => $cliente->getNome(),
            ':email' => $cliente->getEmail(),
            ':cpf' => $cliente->getCpf()
        ];
    }
}
