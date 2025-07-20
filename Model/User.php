<?php

namespace Model;
use Model\Connection;
use PDO;
use PDOException;

class User{
    private $db;
//metodo que ira ser executado toda ez q for criado um objeto de classe -> user
    public function __construct() {
        $this->db = Connection::getInstance();
    }
    
    //Funçao de criar usuario 
    public function registerUser($user_fullname, $password, $email){
        try {
            $sql = "INSERT INTO user (user_fullname, email, password, created_at) VALUES (:user_fullname, :email, :password, NOW())";
            $hasshedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt= $this->db->prepare($sql);

            $stmt->bindParam(":user_fullname", $user_fullname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hasshedPassword, PDO::PARAM_STR);

            $stmt->execute();

        } catch (PDOException $error) {
            echo "Erro ao executar o comando " . $error->getMessage();
        }
    }
    public function getUserByEmail($email) {
        try {
            $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

        }
    }

    public function getUserInfo($id, $user_fullname, $email) {
        try {
            $sql = "SELECT user_fullname, email FROM user WHERE id = :id AND user_fullname = :user_fullname AND email = :email";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":user_fullname", $user_fullname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            $stmt->execute();

            //fetch = queryselector ();
            //fetchAll = querySelectorAll();
            //FETCH_ASSOC:
            //$user ["user_fullname" => "teste", "email" => "teste@example.com"
            //]
            //COMO OBTER INFORMAÇOES:
            //$user ['user_fullname']

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            echo "Erro ao buscar informaçoes: ". $error->getMessage();
            return false;
        }
    }
}