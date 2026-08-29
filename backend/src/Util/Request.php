<?php
namespace App\Util;

use InvalidArgumentException;

class Request{
    /**
     * Retorna o corpo da requisição
     */
    public static function body(): array
    {
        $body = json_decode(file_get_contents("php://input"), true) ?? [];
        if(empty($body)) throw new InvalidArgumentException("dados vazios");
        return $body;
    }
    /**
     * Retorna o tipo de requisição atual
     */
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}