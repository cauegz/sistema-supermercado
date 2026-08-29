<?php

namespace App\Core;

use PDO;
use PDOException;

class Conexao
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $dbname = $_ENV['POSTGRES_DBNAME'];
            $usuario = $_ENV['POSTGRES_USER'];
            $senha = $_ENV['POSTGRES_PASS'];
            $host = $_ENV['POSTGRES_HOST'] ?? 'db';
            $porta = $_ENV['POSTGRES_PORT'] ?? '5432';

            $dsn = "pgsql:host=$host;port=$porta;dbname=$dbname";

            try {
                self::$pdo = new PDO(
                    $dsn,
                    $usuario,
                    $senha
                );

                self::$pdo->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                self::$pdo->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {
                die("Erro de conexão com o banco: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
