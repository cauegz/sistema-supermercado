<?php

namespace App\DAO;

use App\Model\Funcionario;
use InvalidArgumentException;

class FuncionarioDAO extends BaseDAO
{
    protected function getTableName(): string { return 'funcionario'; }

    protected function getSQLInsert(): string
    {
        return 'INSERT INTO funcionario (nome, salario, cpf) VALUES (:nome, :salario, :cpf)';
    }

    protected function getSQLUpdate(): string
    {
        return 'UPDATE funcionario SET nome = :nome, salario = :salario, cpf = :cpf
                WHERE id_funcionario = :id';
    }

    protected function getSQLDelete(): string
    {
        return 'DELETE FROM funcionario WHERE id_funcionario = :id';
    }

    protected function getDadosInsert(object $funcionario): array
    {
        return $this->getDados($funcionario);
    }

    protected function getDadosUpdate(object $funcionario, int $id): array
    {
        return [':id' => $id, ...$this->getDados($funcionario)];
    }

    protected function validarModel(object $funcionario): void
    {
        if (!$funcionario instanceof Funcionario) {
            throw new InvalidArgumentException('O objeto deve ser do tipo Funcionario');
        }
    }

    private function getDados(Funcionario $funcionario): array
    {
        return [
            ':nome' => $funcionario->getNome(),
            ':salario' => $funcionario->getSalario(),
            ':cpf' => $funcionario->getCpf()
        ];
    }
}
