<?php

//serviço que vai interligar com o banco de dados e pega os dados do controllers que contem a regra de negocio
class CategoriesServices
{
  private $dbinstance;

  public function __construct(){
    $this->dbinstance = new DbConfigService();
  }

  public function getAllCategory(){
    $sql = "SELECT * FROM categories";
    try{
      $result = $this->dbinstance->queryExecute($sql);
      $response = $result->fetch(PDO::FETCH_ASSOC);

      return $response;
    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function getCategoryByName($name){
    $sql = "SELECT * FROM categories WHERE {$name}";
    try{
      $result = $this->dbinstance->queryExecute($sql);
      $response = $result->fetch(PDO::FETCH_ASSOC);

      return $response;
    }catch(PDOException $e){
      return $e->getMessage();
    }
  }


  public function createCategory($name){
    $sql = "INSERT INTO Categories (name) values ('{$name}')";
    try{
      $result = $this->dbinstance->queryExecute($sql);
      $response = $result->fetch(PDO::FETCH_ASSOC);
      
      return $response;
    }catch(PDOException $e){
      return $e->getMessage();
    }
  }






}