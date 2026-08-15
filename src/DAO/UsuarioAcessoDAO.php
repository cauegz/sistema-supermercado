<?php

namespace App\DAO;

use App\Model\UsuarioAcesso;
use InvalidArgumentException;
use PDO;

class UsuarioAcessoDAO extends BaseDAO
{
    protected function getTableName(): string { return 'usuario_acesso'; }
    protected function getSQLInsert(): string
    {
        return 'INSERT INTO usuario_acesso (email, senha, id_funcionario, id_papel)
                VALUES (:email, :senha, :id_funcionario, :id_papel)';
    }
    protected function getSQLUpdate(): string
    {
        return 'UPDATE usuario_acesso SET email = :email, senha = :senha,
                id_funcionario = :id_funcionario, id_papel = :id_papel WHERE id_usuario_acesso = :id';
    }
    protected function getSQLDelete(): string
    {
        return 'DELETE FROM usuario_acesso WHERE id_usuario_acesso = :id';
    }

    protected function getDadosInsert(object $usuario): array { return $this->getDados($usuario); }
    protected function getDadosUpdate(object $usuario, int $id): array
    {
        return [':id' => $id, ...$this->getDados($usuario)];
    }

    protected function validarModel(object $usuario): void
    {
        if (!$usuario instanceof UsuarioAcesso) {
            throw new InvalidArgumentException('O objeto deve ser do tipo UsuarioAcesso');
        }
    }

    public function findByEmail(string $email): ?UsuarioAcesso
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuario_acesso WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados) return null;

        return (new UsuarioAcesso(
            $dados['email'],
            $dados['senha'],
            (int) $dados['id_funcionario'],
            (int) $dados['id_papel']
        ))->setId((int) $dados['id_usuario_acesso']);
    }

    public function findByIdFuncionario($id): ?UsuarioAcesso
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuario_acesso WHERE id_funcionario = :id_funcionario');
        $stmt->execute([':id_funcionario' => $id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados) return null;

        return (new UsuarioAcesso(
            $dados['email'],
            $dados['senha'],
            (int) $dados['id_funcionario'],
            (int) $dados['id_papel']
        ))->setId((int) $dados['id_usuario_acesso']);
    }

    private function getDados(UsuarioAcesso $usuario): array
    {
        return [
            ':email' => $usuario->getEmail(),
            ':senha' => $usuario->getSenha(),
            ':id_funcionario' => $usuario->getIdFuncionario(),
            ':id_papel' => $usuario->getIdPapel()
        ];
    }
}
