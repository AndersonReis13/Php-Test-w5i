<?php

class Bootstrap extends RouteDefaults{
  public $object;

  public function __construct($path, $requestMethod, $post, $auth){
    $this->object = (object) [
      "path"=> $path,
      "method"=> $requestMethod,
      "post_form" => $post,
      "auth"=> $auth
    ];

    parent::__construct($this->object);
  }

  public function load(){
   $api_segment = explode("/", $this->path);
    $authVerification = new TokenService($this->object);

   switch($api_segment[0]){
    case "categories":
      $authVerification->validateToken();
      $categoriesRoutes = new CategoriesRoutes($this->object);
      $categoriesRoutes->initialCategoriesRoutes();
      break;
    case "users":
      $userRoutes = new UserRoutes($this->object);
      $userRoutes->initialUserRoutes();
      break;
    case "tasks":
      $authVerification->validateToken();
      $taksRoutes = new TaskRoutes($this->object);
      $taksRoutes->initialTaskRoutes();  
    }
  }
  
}