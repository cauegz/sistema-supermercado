<?php

namespace App\DAO;

use App\Model\Avaliacao;
use InvalidArgumentException;

class AvaliacaoDAO extends BaseDAO
{
    protected function getTableName(): string { return 'avaliacao'; }

    protected function getSQLInsert(): string
    {
        return 'INSERT INTO avaliacao (nota, comentario, id_funcionario, id_cliente)
                VALUES (:nota, :comentario, :id_funcionario, :id_cliente)';
    }

    protected function getSQLUpdate(): string
    {
        return 'UPDATE avaliacao SET nota = :nota, comentario = :comentario,
                id_funcionario = :id_funcionario, id_cliente = :id_cliente
                WHERE id_avaliacao = :id';
    }

    protected function getSQLDelete(): string
    {
        return 'DELETE FROM avaliacao WHERE id_avaliacao = :id';
    }

    protected function getDadosInsert(object $avaliacao): array
    {
        return $this->getDados($avaliacao);
    }

    protected function getDadosUpdate(object $avaliacao, int $id): array
    {
        return [':id' => $id, ...$this->getDados($avaliacao)];
    }

    protected function validarModel(object $avaliacao): void
    {
        if (!$avaliacao instanceof Avaliacao) {
            throw new InvalidArgumentException('O objeto deve ser do tipo Avaliacao');
        }
    }

    private function getDados(Avaliacao $avaliacao): array
    {
        return [
            ':nota' => $avaliacao->getNota(),
            ':comentario' => $avaliacao->getComentario(),
            ':id_funcionario' => $avaliacao->getIdFuncionario(),
            ':id_cliente' => $avaliacao->getIdCliente()
        ];
    }
}
