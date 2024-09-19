<?php

class CategoriesServices
{
  private $dbinstance;

  public function __construct(){
    $this->dbinstance = new DbConfigService();
  }

  public function getCategoryByName(String $name){
    $sql = "SELECT * FROM categories WHERE {$name}";
   
    

  }
}