<?php
namespace App\Middleware;

/**
 * Verifica se um usuário está logado
 */
class AuthMiddleware{
    public static function executar()
    {
        if(empty($_SESSION['id_usuario']) || empty($_SESSION['id_funcionario']) || empty($_SESSION['id_papel'])){
            http_response_code(404);
            exit(json_encode([
                "mensagem" => "rota não encontrada"
            ]));
        }
    }
}