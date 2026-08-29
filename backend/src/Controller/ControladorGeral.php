<?php
namespace App\Controller;

abstract class ControladorGeral{
    public function responseJSON(mixed $response)
    {
        if(!(is_array($response)) && !(is_object($response))) return json_encode(["erro" => true, "mensagem" => "não retornou um JSON válido"]);

        http_response_code(200);
        return json_encode($response);
    }
    public function responseError(string $mensagem, int $codigoHttp){
        http_response_code($codigoHttp);
        return json_encode(["erro" => true, "mensagem" => $mensagem]);
    }
}