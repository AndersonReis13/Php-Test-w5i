<?php

//serviço que vai interligar com o banco de dados e pega os dados do controllers que contem a regra de negocio
class CategoriesServices
{
  private $dbinstance;

  public function __construct(){
    $this->dbinstance = new DbConfigService();
  }

  public function getAllCategory(){
    $sql = "SELECT * FROM categories ORDER BY id ASC";
    try{
      $result = $this->dbinstance->queryExecute($sql);
      $response = $result->fetchAll(PDO::FETCH_ASSOC);

      return $response;
    }catch(Exception $e){
      http_response_code(500);
      json_encode(["error"=> $e->getMessage()]);
      exit;
    }
  }

  public function getCategoryByName($name){
    $sql = "SELECT * FROM categories WHERE name='{$name}'";
    try{
      $result = $this->dbinstance->queryExecute($sql);
      $response = $result->fetchAll(PDO::FETCH_ASSOC);

      return $response;
    }catch(Exception $e){
      http_response_code(500);
      json_encode(["error"=> $e->getMessage()]);
      exit;
    }
  }


  public function createCategory($name){
    $sql = "INSERT INTO categories (name) values ('{$name}')";
    try{
      $result = $this->dbinstance->queryExecute($sql);
      $response = $result->fetchAll(PDO::FETCH_ASSOC);
      
      return $response;
    }catch(PDOException $e){
      exit;
    }
  }

}