<?php
namespace App\db;

use PDOException;
use PDO;

class Connection {
    public static function make(): PDO {
        $host = 'localhost';
        $dbname = 'teste_php';
        $username = 'root';
        $password = '';

        try {
            return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        } catch (PDOException $e) {
            die("Erro ao conectar: " . $e->getMessage());
        }
    }
}
