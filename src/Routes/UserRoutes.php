<?php

class UserRoutes extends RouteDefaults{
  private $userControllers;

  public function __construct($object){
    parent::__construct($object);
    $userServices = new UsersServices();
    $this->userControllers = new UserControllers($userServices);
  }

  public function initialUserRoutes(){
    $path_explode = explode("/", $this->path);

    switch($this->path){
      // (users/view/{email})
      case $path_explode[0] == "users" && $path_explode[1] == "view" && !empty($path_explode[2]):
        if ($this->method == "GET") {
          $this->userControllers->getUserByEmail($path_explode[2]);
        }
        break;
      case "users/singup":
        if($this->method == "POST"){
          $this->userControllers->singUp($this->post_form);
        }
        break; 
      case "users/singin":
         if($this->method == "POST"){
          $this->userControllers->singIn( $this->post_form);
         }
         break;
      default:
      http_response_code(404);
      json_encode(["error" => "Rota não encontrada"]);   
    }
  }
}