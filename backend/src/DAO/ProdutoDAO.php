<?php

namespace App\DAO;

use App\Model\Produto;
use InvalidArgumentException;

class ProdutoDAO extends BaseDAO
{
    protected function getTableName(): string { return 'produto'; }

    protected function getSQLInsert(): string
    {
        return 'INSERT INTO produto
                (nome, preco, descricao, codigo_barras, estoque_minimo, id_marca, id_categoria)
                VALUES
                (:nome, :preco, :descricao, :codigo_barras, :estoque_minimo, :id_marca, :id_categoria)';
    }

    protected function getSQLUpdate(): string
    {
        return 'UPDATE produto SET nome = :nome, preco = :preco, descricao = :descricao,
                codigo_barras = :codigo_barras, estoque_minimo = :estoque_minimo,
                id_marca = :id_marca, id_categoria = :id_categoria
                WHERE id_produto = :id';
    }

    protected function getSQLDelete(): string
    {
        return 'DELETE FROM produto WHERE id_produto = :id';
    }

    protected function getDadosInsert(object $produto): array
    {
        return $this->getDados($produto);
    }

    protected function getDadosUpdate(object $produto, int $id): array
    {
        return [':id' => $id, ...$this->getDados($produto)];
    }

    protected function validarModel(object $produto): void
    {
        if (!$produto instanceof Produto) {
            throw new InvalidArgumentException('O objeto deve ser do tipo Produto');
        }
    }

    private function getDados(Produto $produto): array
    {
        return [
            ':nome' => $produto->getNome(),
            ':preco' => $produto->getPreco(),
            ':descricao' => $produto->getDescricao(),
            ':codigo_barras' => $produto->getCodigoBarras(),
            ':estoque_minimo' => $produto->getEstoqueMinimo(),
            ':id_marca' => $produto->getIdMarca(),
            ':id_categoria' => $produto->getIdCategoria()
        ];
    }
}
