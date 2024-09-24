<?php



class CategoriesController{
  private $categoriesService;

  public function __construct(CategoriesServices $categoriesService){
    $this->categoriesService = $categoriesService;
  }

  public function getCategories(){
    $categories = $this->categoriesService->getAllCategory();

    http_response_code(200);
    echo json_encode($categories);
  }

  public function getCategoryByName($name) {

    if(empty($name)) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "A categoria não pode vir vazia."]);
        exit;
    }

    $category = $this->categoriesService->getCategoryByName($name);

    if(!empty($category)) {
        http_response_code(200);
        echo json_encode($category);
    } else {
        http_response_code(404); 
        echo json_encode(["error" => "Categoria não foi encontrada"]);
    }
}

  public function createCategory($form){
   
    if(empty($form["name"])){
      http_response_code(400);
      echo json_encode(["error"=> "O nome não pode vim vazio."]);
      exit;
    }

     $name = $form["name"];

    $categoryAlreadyCreated = $this->categoriesService->getCategoryByName($name);

    echo json_encode($categoryAlreadyCreated);

    if(!empty($categoryAlreadyCreated)){
      http_response_code(401);
      echo json_encode(["error"=> "Já existe uma categoria com esse nome."]);
      exit;
    }

    $categoryCreated = $this->categoriesService->createCategory($name);
    http_response_code(201);
    echo json_encode("categoria criada");
  }

}