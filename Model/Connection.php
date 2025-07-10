<?php
//CONFIGURAÇAO DE USO

namespace Model;

use PDO;
use PDOException;

require_once __DIR__ . '/../Config/configuration.php';

class Connection {
    //ATRIBUTO ESTATICO QUE IRA PERMITIR A CONEXAO ABAIXO
    private static $stmt;

    public static function getInstance() {
        //CRIAR UMA NOVA CONEXAO SOMENTE SE ELA NAO EXISTIR
        try {
            if (empty(self::$stmt)) {
            self::$stmt = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . "", DB_USER, DB_PASSWORD);
            }
        } catch (PDOException $error) {
            die("Erro ao estabelecer conexão: " . $error->getMessage());
        }
        return self::$stmt;
    }
}

?>