<?php

require_once __DIR__ . '/../../../vendor/autoload.php';// Coleta a depencia do JWT do composer
require_once __DIR__ . '/../../Config/RoutesDefault.php'; 



use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenService extends RouteDefaults{
  private $object;
  public static $secretKey = "my-secret-key";

  public function __construct($object){
    $this->object = $object;
  }

  public static function encodeToken($payload){
    try{
      $token = JWT::encode($payload, self::$secretKey, "HS256");
      return $token;
    }catch(Exception $e){
      echo json_encode(["error" => $e->getMessage()]);
      exit;
    }
  }

  public function validateToken(){
    if($this->object->auth){
      $authToken = explode(" ", $this->object->auth)[1];
    }else{
      echo json_encode(["error"=> "JWT não foi repassado"]);
      exit;
    }try{
      $decodedToken = JWT::decode($authToken, new Key(self::$secretKey, "HS256"));
      return $decodedToken;
    }catch(Exception $e){
      echo json_encode(['error'=> $e->getMessage()]);
      exit;
    }
  }
}