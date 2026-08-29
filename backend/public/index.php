<?php

use App\Core\Router;
use App\Middleware\AuthMiddleware;
use App\Middleware\PermissaoMiddleware;
use Dotenv\Dotenv;

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$router = new Router();

//rotas fixas sempre antes de dinamicas
$router->addRoute("POST", "/api/register", "Auth@register");
$router->addRoute("POST", "/api/login", "Auth@login");
$router->addRoute("POST", "/api/logout", "Auth@logout");
$router->addRoute("GET", "/api/produtos", "Produto@getProdutos", [[AuthMiddleware::class, 'executar']]);
$router->addRoute("POST", "/api/produto", "Produto@criarProduto", 
    [[AuthMiddleware::class, 'executar'], fn() => PermissaoMiddleware::executar(1)]);
$router->addRoute("GET", "/api/produto/{id}", "Produto@getProdutoById");
$router->addRoute("DELETE", "/api/produto/{id}", "Produto@excluirProduto");
$router->addRoute("PUT", "/api/produto/{id}", "Produto@editarProduto");


try {
    $router->execute(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
} catch (InvalidArgumentException $th) {
    http_response_code(400);
    echo json_encode(["mensagem" => $th->getMessage()]);
} catch (LogicException $th) {
    http_response_code(409);
    echo json_encode(["mensagem" => $th->getMessage()]);
} catch (PDOException $th){
    http_response_code(500);
    echo json_encode(["mensagem" => $th->getMessage()]);
} catch (\Throwable $th){
    http_response_code(500);
    echo json_encode(["mensagem" => "erro interno"]);
} 
