<?php

namespace App\DAO;

use App\Model\Fornecedor;
use InvalidArgumentException;

class FornecedorDAO extends BaseDAO
{
    protected function getTableName(): string { return 'fornecedor'; }
    protected function getSQLInsert(): string
    {
        return 'INSERT INTO fornecedor (razao_social, cnpj, telefone, email)
                VALUES (:razao_social, :cnpj, :telefone, :email)';
    }
    protected function getSQLUpdate(): string
    {
        return 'UPDATE fornecedor SET razao_social = :razao_social, cnpj = :cnpj,
                telefone = :telefone, email = :email WHERE id_fornecedor = :id';
    }
    protected function getSQLDelete(): string { return 'DELETE FROM fornecedor WHERE id_fornecedor = :id'; }

    protected function getDadosInsert(object $fornecedor): array { return $this->getDados($fornecedor); }
    protected function getDadosUpdate(object $fornecedor, int $id): array
    {
        return [':id' => $id, ...$this->getDados($fornecedor)];
    }

    protected function validarModel(object $fornecedor): void
    {
        if (!$fornecedor instanceof Fornecedor) {
            throw new InvalidArgumentException('O objeto deve ser do tipo Fornecedor');
        }
    }

    private function getDados(Fornecedor $fornecedor): array
    {
        return [
            ':razao_social' => $fornecedor->getRazaoSocial(),
            ':cnpj' => $fornecedor->getCnpj(),
            ':telefone' => $fornecedor->getTelefone(),
            ':email' => $fornecedor->getEmail()
        ];
    }
}
