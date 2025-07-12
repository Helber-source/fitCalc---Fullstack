<?php

namespace Model;

use PDO;
use PDOException;
use Model\Connection;

class Imcs
{
    private $db;

    public function __construct() {
        $this->db = Connection::getInstance();
    }

    public function createImc($weight, $height, $userId) {
        try {
            $sql = "INSERT INTO imc (weight, height, user_id, created_at) VALUES (:weight, :height, :user_id, NOW())";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":weight", $weight, PDO::PARAM_STR);
            $stmt->bindParam(":height", $height, PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);

            $stmt->execute();

        } catch (PDOException $error) {
            echo "Erro ao criar IMC: " . $error->getMessage();
            return false;
        }
    }
}