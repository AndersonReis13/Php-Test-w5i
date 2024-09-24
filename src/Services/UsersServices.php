<?php

class UsersServices{
    private $dbInstance;

    public function __construct(){
       $this->dbInstance = new DbConfigService();
    }


    public function singUp(string $email, string $hashpass){
        $sql = "INSERT INTO users (email, password) values ('{$email}', '{$hashpass}') ";
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
        $sql = "SELECT * FROM users WHERE email='{$email}'";
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