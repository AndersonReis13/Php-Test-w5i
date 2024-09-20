<?php

class UsersServices{
    private $dbInstance;

    public function __construct(){
       $this->dbInstance = new DbConfigService();
    }


    public function singUp(string $email, string $hashPass){
        $sql = "INSERT INTO users (email, password) values ('{$email}', '{$hashPass}') ";
        try{
            $result = $this->dbInstance->queryExecute($sql);
            $response = $result ->fetch(PDO::FETCH_ASSOC);

            return $response;
        }catch(PDOException $e){
            http_response_code(500);  
            echo json_encode(["error"=> $e->getMessage()]);
            exit;
        }
    }


    public function checkUserInDataBase(string $email){
        $sql = "SELECT * FROM users where email={$email}";
        try{
            $result = $this->dbInstance->queryExecute($sql);
            $response = $result ->fetch(PDO::FETCH_ASSOC);

            return $response;
        }catch(PDOException $e){
            http_response_code(500);  
            echo json_encode(["error"=> $e->getMessage()]);
            exit;
        }
    }
}