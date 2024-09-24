<?php

class CategoriesRoutes extends RouteDefaults{

  private $categoriesControllers;

  public function __construct($object){
    parent::__construct($object);
    $categoriesServices = new CategoriesServices(); 
    $this->categoriesControllers = new CategoriesController($categoriesServices);
  }


  public function initialCategoriesRoutes(){
    $path_explode = explode("/", $this->path);

    switch ($this->path) {
      case $this->path == "categories/view" && $this->method == "GET":
          $this->categoriesControllers->getCategories();
          break;

      case $this->path == "categories/create":
          if($this->method == "POST") {
            $this->categoriesControllers->createCategory($this->post_form);
          }

          break;

      // Rota para buscar por nome (categories/view/{nome})
      case $path_explode[0] == "categories" && $path_explode[1] == "view" && !empty($path_explode[2]):
          if ($this->method == "GET") {
              $this->categoriesControllers->getCategoryByName($path_explode[2]);
          }
          break;

      default:
          http_response_code(404);
          echo json_encode(["error" => "Rota não encontrada"]);
    } 
  }
}