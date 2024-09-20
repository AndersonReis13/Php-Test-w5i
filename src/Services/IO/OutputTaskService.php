<?php


//Essa classe serve como um controle de "tasks", registrando todo o ocorrido dela
class OutputTaskService{
  private $dbIntance;

  public function __construct(){
    $this->dbIntance = new DbConfigService();
  }

  public function insertTaskMovements($taskId){
    $sql = "INSERT INTO task_mocements 
    (task_id, action, timestamp) 
    VALUES ('{$taskId}', 'start', NOW())";

    try{
      $result = $this->dbIntance->queryExecute($sql);
      $response = $result->fetch(PDO::FETCH_ASSOC);

      return $response;
    }catch(PDOException $e){
      http_response_code(500);  
      echo json_encode(["error"=> $e->getMessage()]);
      exit;
    }
  }

  public function pauseTaskMovements($taskId){
    $sql = "INSERT INTO task_mocements 
    (task_id, action, timestamp) 
    VALUES ('{$taskId}', 'pause', NOW())";

    try{
      $result = $this->dbIntance->queryExecute($sql);
      $response = $result->fetch(PDO::FETCH_ASSOC);

      return $response;
    }catch(PDOException $e){
      http_response_code(500);  
      echo json_encode(["error"=> $e->getMessage()]);
      exit;
    }
  }


  public function finishTaskMovements($taskId){
    $sql = "INSERT INTO task_mocements 
    (task_id, action, timestamp) 
    VALUES ('{$taskId}', 'finish', NOW())";

    try{
      $result = $this->dbIntance->queryExecute($sql);
      $response = $result->fetch(PDO::FETCH_ASSOC);

      return $response;
    }catch(PDOException $e){
      http_response_code(500);  
      echo json_encode(["error"=> $e->getMessage()]);
      exit;
    }
  }
}