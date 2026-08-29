<?php

namespace App\DAO;

use App\Model\ItemVenda;
use InvalidArgumentException;

class ItemVendaDAO extends BaseDAO
{
    protected function getTableName(): string { return 'item_venda'; }

    protected function getSQLInsert(): string
    {
        return 'INSERT INTO item_venda (preco_unitario, quantidade, id_produto, id_venda)
                VALUES (:preco_unitario, :quantidade, :id_produto, :id_venda)';
    }

    protected function getSQLUpdate(): string
    {
        return 'UPDATE item_venda SET preco_unitario = :preco_unitario,
                quantidade = :quantidade, id_produto = :id_produto, id_venda = :id_venda
                WHERE id_item_venda = :id';
    }

    protected function getSQLDelete(): string
    {
        return 'DELETE FROM item_venda WHERE id_item_venda = :id';
    }

    protected function getDadosInsert(object $itemVenda): array
    {
        return $this->getDados($itemVenda);
    }

    protected function getDadosUpdate(object $itemVenda, int $id): array
    {
        return [':id' => $id, ...$this->getDados($itemVenda)];
    }

    protected function validarModel(object $itemVenda): void
    {
        if (!$itemVenda instanceof ItemVenda) {
            throw new InvalidArgumentException('O objeto deve ser do tipo ItemVenda');
        }
    }

    private function getDados(ItemVenda $itemVenda): array
    {
        return [
            ':preco_unitario' => $itemVenda->getPrecoUnitario(),
            ':quantidade' => $itemVenda->getQuantidade(),
            ':id_produto' => $itemVenda->getIdProduto(),
            ':id_venda' => $itemVenda->getIdVenda()
        ];
    }
}
