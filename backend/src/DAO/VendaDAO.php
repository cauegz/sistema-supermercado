<?php

namespace App\DAO;

use App\Model\Venda;
use InvalidArgumentException;

class VendaDAO extends BaseDAO
{
    protected function getTableName(): string { return 'venda'; }

    protected function getSQLInsert(): string
    {
        return 'INSERT INTO venda (data, valor, id_funcionario, id_cliente)
                VALUES (:data, :valor, :id_funcionario, :id_cliente)';
    }

    protected function getSQLUpdate(): string
    {
        return 'UPDATE venda SET data = :data, valor = :valor,
                id_funcionario = :id_funcionario, id_cliente = :id_cliente
                WHERE id_venda = :id';
    }

    protected function getSQLDelete(): string
    {
        return 'DELETE FROM venda WHERE id_venda = :id';
    }

    protected function getDadosInsert(object $venda): array
    {
        return $this->getDados($venda);
    }

    protected function getDadosUpdate(object $venda, int $id): array
    {
        return [':id' => $id, ...$this->getDados($venda)];
    }

    protected function validarModel(object $venda): void
    {
        if (!$venda instanceof Venda) {
            throw new InvalidArgumentException('O objeto deve ser do tipo Venda');
        }
    }

    private function getDados(Venda $venda): array
    {
        return [
            ':data' => $venda->getData()->format('Y-m-d H:i:s'),
            ':valor' => $venda->getValor(),
            ':id_funcionario' => $venda->getIdFuncionario(),
            ':id_cliente' => $venda->getIdCliente()
        ];
    }
}
