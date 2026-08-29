<?php
namespace App\Util;

use InvalidArgumentException;

class Validator{
    public static function validaProduto(array $produto){
        $nome = trim($produto['nome']) ?? '';
        $preco = str_replace(",", ".", $produto['preco']) ?? null;
        $descricao = trim($produto['descricao']) ?? '';

        if(empty($nome) || !is_numeric($preco) || empty($descricao)) return false;

        return true;
    }

    public static function validaRegistro(array $usuario){
        $email = filter_var(trim($usuario['email']), FILTER_SANITIZE_EMAIL) ?? '';
        $senha = trim($usuario['senha']) ?? '';

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($senha)) return false;

        return true;
    }

    public static function validaLogin(array $login){
        $email = filter_var(trim($login['email']), FILTER_SANITIZE_EMAIL) ?? '';
        $senha = trim($login['senha']) ?? '';

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($senha)) return false;

        return true;
    }

    public static function validaInt($num){
        $num = filter_var($num, FILTER_VALIDATE_INT);

        if($num === false){
            throw new InvalidArgumentException("id inválido", 400);
        }

        return $num;
    }
}