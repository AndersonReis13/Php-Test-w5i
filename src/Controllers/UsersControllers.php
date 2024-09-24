<?php

class UserControllers{

  private $userService;

  public function __construct(UsersServices $userservices){
    $this->userService = $userservices;
  }


  public function getUserByEmail($email){

    if(empty($email)){
      http_response_code(400); //Bad Request
      echo json_encode(["error" => "O email não pode vim vazio"]);
      exit;
    }

    $user = $this->userService->checkUserInDataBase($email);

    if(!empty($user)){
      http_response_code(200);
      echo json_encode($user);
    }else{
      http_response_code(400);
      echo json_encode(["error"=> "nenhum usuario foi encontrado"]);
    }

  }

  public function singIn($form){
    if(empty($form["email"]) && empty($form["password"])){
      http_response_code(400);
      echo json_encode(["error"=> "Email ou a senha não pode vim vazio."]);
      exit;
    }

    $email = $form["email"];
    $password = $form["password"];

    $entityUser = $this->userService->checkUserInDataBase($email);

    if(empty($entityUser)){
      http_response_code(401);
      echo json_encode(["Usuario não cadastrado"]);  
      exit;
    }


   $userId = $entityUser["id"];
   $email = $entityUser["email"];
   $passwordDB = $entityUser["password"]; 

   $passwordValid = password_verify($password, $passwordDB);

   if(!$passwordValid){
    http_response_code(401);
    echo json_encode(["error"=> "email ou senha invalido"]);
    exit;
   }

   $token = TokenService::encodeToken(array("email" => $email));

   $_SESSION["userId"] = $userId;
   $_SESSION["email"] = $email;

   http_response_code(200);
   echo json_encode([
     "access_token"=> $token, 
     "message" => "Login feito com sucesso."
   ]);

  }

  public function singUp($form){
    
    if(empty($form["email"]) && empty($form["password"]) ){
      http_response_code(400);
      echo json_encode(["error"=> "O email ou a senha não pode vim vazio."]);
      exit;
    }

    $email = $form["email"];
    $password = $form["password"];

    $checkUserInDatabase = $this->userService->checkUserInDataBase($email);
    
    if(!empty($checkUserInDatabase)){
      http_response_code(401);
      echo json_encode(["error"=> "já existe um usuario com esse email"]);
      exit;
    }

    $hashpass = password_hash($password, PASSWORD_DEFAULT);

    $userCreated = $this->userService->singUp($email, $hashpass);

    http_response_code(201);
    echo json_encode("Usuario criado!");

  }


}