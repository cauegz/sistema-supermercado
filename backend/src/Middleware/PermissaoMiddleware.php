<?php
namespace App\Middleware;

use App\DAO\UsuarioAcessoDAO;

/**
 * Verifica se o papel do usuário é o indicado no parâmetro
 */
class PermissaoMiddleware{
    private const ADMINISTRADOR = 1;
    private const FUNCIONARIO = 2;
    public static function executar($idPapel)
    {
        $idPapelUsuario = (int) ($_SESSION['id_papel'] ?? 0);

        $autorizado =
            $idPapelUsuario === self::ADMINISTRADOR ||
            $idPapelUsuario === $idPapel;

        if (!$autorizado) {
            http_response_code(403);

            exit(json_encode([
                'mensagem' => 'usuário não autorizado'
            ]));
        }
    }
}