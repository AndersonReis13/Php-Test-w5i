<?php


//classe de configuração do banco de dados

class DbConfigService{

  private $PDO;
  public function __construct(){
    $username = "root";
    $password = "1234567";
    $dbname = "taskcontrol";
    $host = "localhost";

    try{
      $this->PDO = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
      $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      die("Houve um erro na conexão do banco de dados". $e->getMessage());
    }
  }

  public function queryExecute($sql){
    $result = $this->PDO->prepare($sql);
    $result->execute();

    return $result;

  }

  public function lastInsertId() {
    return $this->PDO->lastInsertId();
}
}