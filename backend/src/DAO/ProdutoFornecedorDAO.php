<?php

namespace App\DAO;

use App\Model\ProdutoFornecedor;
use InvalidArgumentException;

class ProdutoFornecedorDAO extends BaseDAO
{
    protected function getTableName(): string { return 'produto_fornecedor'; }
    protected function getSQLInsert(): string
    {
        return 'INSERT INTO produto_fornecedor
                (codigo_fornecedor, ultimo_custo, id_fornecedor, id_produto)
                VALUES (:codigo_fornecedor, :ultimo_custo, :id_fornecedor, :id_produto)';
    }
    protected function getSQLUpdate(): string
    {
        return 'UPDATE produto_fornecedor SET codigo_fornecedor = :codigo_fornecedor,
                ultimo_custo = :ultimo_custo, id_fornecedor = :id_fornecedor,
                id_produto = :id_produto WHERE id_produto_fornecedor = :id';
    }
    protected function getSQLDelete(): string
    {
        return 'DELETE FROM produto_fornecedor WHERE id_produto_fornecedor = :id';
    }

    protected function getDadosInsert(object $produtoFornecedor): array
    {
        return $this->getDados($produtoFornecedor);
    }
    protected function getDadosUpdate(object $produtoFornecedor, int $id): array
    {
        return [':id' => $id, ...$this->getDados($produtoFornecedor)];
    }

    protected function validarModel(object $produtoFornecedor): void
    {
        if (!$produtoFornecedor instanceof ProdutoFornecedor) {
            throw new InvalidArgumentException('O objeto deve ser do tipo ProdutoFornecedor');
        }
    }

    private function getDados(ProdutoFornecedor $produtoFornecedor): array
    {
        return [
            ':codigo_fornecedor' => $produtoFornecedor->getCodigoFornecedor(),
            ':ultimo_custo' => $produtoFornecedor->getUltimoCusto(),
            ':id_fornecedor' => $produtoFornecedor->getIdFornecedor(),
            ':id_produto' => $produtoFornecedor->getIdProduto()
        ];
    }
}
