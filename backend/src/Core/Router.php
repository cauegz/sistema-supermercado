<?php

namespace App\Core;

use App\Util\Request;
use LogicException;

class Router
{
    private array $routes = [];

    public function addRoute(
        string $metodo,
        string $url,
        string $acao,
        array $middlewares = []
    ): void {
        $this->routes[$metodo][$url] = [
            'acao' => $acao,
            'middlewares' => $middlewares
        ];
    }

    public function execute(string $url): void
    {
        $metodo = Request::method();
        $rotasMetodo = $this->routes[$metodo] ?? [];
        foreach ($rotasMetodo as $rota => $configuracao) {
            $parametros = [];

            //procura parâmetros da rota e substitui cada um por um grupo de captura da regex.
            $regex = preg_replace_callback(
                '/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/',
                function (array $matches) use (&$parametros): string {
                    $parametros[] = $matches[1];

                    return '([^/]+)';
                },
                $rota
            );

            //adiciona que é inicio da string e final com barra opcional
            $regex = '#^' . $regex . '/?$#';

            //se o regex nao bater com a url retorna
            if (!preg_match($regex, $url, $valores)) {
                continue;
            }

            //remove a url e deixa só os parâmetros no array valores
            array_shift($valores);

            $this->executarMiddlewares($configuracao['middlewares']);
            $this->executarControlador($configuracao['acao'], $valores);

            return;
        }

        http_response_code(404);
        exit(json_encode(["mensagem" => "rota não encontrada"]));
    }

    private function executarMiddlewares(array $middlewares): void
    {
        foreach ($middlewares as $middleware) {
            if (!is_callable($middleware)) {
                throw new LogicException("middleware inválido");
            }

            $middleware();
        }
    }

    private function executarControlador(string $acao, array $parametros): void
    {
        [$nomeControlador, $funcao] = explode("@", $acao, 2);

        $controlador = "App\\Controller\\Controlador"
            . $nomeControlador;

        if (!class_exists($controlador)) {
            http_response_code(404);
            exit(json_encode(["mensagem" => "controlador não encontrado"]));
        }

        $instance = new $controlador();

        if (!is_callable([$instance, $funcao])) {
            http_response_code(404);
            exit(json_encode(["mensagem" => "método do controlador não encontrado"]));
        }

        $resultado = $instance->$funcao(...$parametros);

        if ($resultado !== null) {
            echo $resultado;
        }
    }
}
