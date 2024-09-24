<?php

class TaskServices
{ 
    private $dbInstance;

    public function __construct(){
        $this->dbInstance = new DbConfigService();
    }

    public function getAllTasks(){
        $sql = "SELECT * FROM tasks";
        try{
            $result = $this->dbInstance->queryExecute($sql);
            $response = $result ->fetchAll(PDO::FETCH_ASSOC);

            return $response;
        }catch(PDOException $e){
            http_response_code(500);  
            echo json_encode(["error"=> $e->getMessage()]);
            exit;
        }
    }

    public function getTaskById($id){
        $sql = "SELECT * FROM tasks WHERE id='{$id}'";
        try{
            $result = $this->dbInstance->queryExecute($sql);
            $response = $result ->fetch(PDO::FETCH_ASSOC);

            return $response;
        }catch(PDOException $e){
            http_response_code(500);  
            echo json_encode(["error"=> $e->getMessage()]);
            exit;
        }
    }

    // todos os cadastro feito inicialmente tem como obrigatoriedade começar como pendente
    public function addTask($title, $description, int $userId, int $categoryId){
        $sql = "INSERT INTO tasks 
        (title, description, user_id, category_id, status) 
        VALUES ('{$title}', '{$description}', {$userId}, {$categoryId}, 'pending')";

        try{
            $result = $this->dbInstance->queryExecute($sql);
            $response = $result ->fetchAll(PDO::FETCH_ASSOC);

            return $response;
        }catch(PDOException $e){
            http_response_code(500);  
            echo json_encode(["error"=> $e->getMessage()]);
            exit;
        }
    }


    public function startTask($taskId){
        $task = $this->getTaskById($taskId);

        if($task['status'] === 'started'){
            http_response_code(400);
            echo json_encode(["error"=> "Não é possivel iniciar uma tarefa que já começou" ]);
            exit;
        }

        if($task['status'] === 'finished'){
            http_response_code(400);
            echo json_encode(["error"=> "Não é possivel iniciar uma tarefa que já está finalizada" ]);
            exit;
        }
        
        //atualiza o status da task e coleta o horario
        $sql = "UPDATE tasks SET status = 'started', start_time = NOW() WHERE id={$taskId}";
        
        try{
            $result = $this->dbInstance->queryExecute($sql);
            $response = $result->fetch(PDO::FETCH_ASSOC);
      
            return $response;
        }catch(PDOException $e){
            http_response_code(500);  
            echo json_encode(["error"=> $e->getMessage()]);
            exit;
        }
    }
    
    public function stopTask($taskId){
        $task = $this->getTaskById($taskId);

        if($task['status'] === 'pending'){
            http_response_code(400);
            echo json_encode(["error"=> "Não é possivel pausar uma tarefa que nem começou" ]);
            exit;
        }

        if($task['status'] === 'paused'){
            http_response_code(400);
            echo json_encode(["error"=> "Não é possivel pausar uma tarefa que está pausada" ]);
            exit;
        }

        if($task['status'] == 'started'){
            $sql = "UPDATE tasks SET status = 'paused', pause_time = NOW() WHERE id = {$taskId}";
        }


        try{
            $result = $this->dbInstance->queryExecute($sql);
            $response = $result ->fetch(PDO::FETCH_ASSOC);

            return $response;
        }catch(PDOException $e){
            http_response_code(500);
            echo json_encode(["error"=> $e->getMessage()]);
            exit;
        }
    }

    public function finishTask($taskId){
        $task = $this->getTaskById($taskId);

        if($task['status'] == 'pending'){
            http_response_code(400);
            echo json_encode(["error"=> "a tarefa não foi inciada"]);
            exit;
        }

        if($task['status'] == 'finished'){
            http_response_code(400);
            echo json_encode(["error"=> "a tarefa ja foi finalizada"]);
            exit;
        }

        $sql = "UPDATE tasks SET status = 'finished', finish_time = NOW() WHERE id = {$taskId}";

        try{
            $result = $this->dbInstance->queryExecute($sql);
            $response = $result ->fetchAll(PDO::FETCH_ASSOC);

            return $response;
        }catch(PDOException $e){
            http_response_code(500);
            echo json_encode(["error"=> $e->getMessage()]);
            exit;
        }
    }

    public function retumeStack($taskId){
        $task = $this->getTaskById($taskId);

        if($task["status"] == "started" && $task["status"] == "pending" &&  $task["status"] == "finished" ){
            http_response_code(400);
            echo json_encode(["error"=> "a tarefa não pode ser retomada"]);
            exit;
        }

       $sql = "UPDATE tasks SET status = 'started', retume_time = NOW() WHERE id = {$taskId}";

       try{
        $result = $this->dbInstance->queryExecute($sql);
        $response = $result ->fetchAll(PDO::FETCH_ASSOC);

        return $response;
    }catch(PDOException $e){
        http_response_code(500);
        echo json_encode(["error"=> $e->getMessage()]);
        exit;
    }
      
    }

    public function totalTimeTask($taskId, $totaltime){
        $task = $this->getTaskById($taskId);

        if($task["status"] != "finished"){
            http_response_code(400);
            echo json_encode(["error"=> "Não pode pegar o tempo total de uma tarefa que não foi finalizada"]);
        }

        $sql = "UPDATE tasks SET total_time = '{$totaltime}' WHERE id = {$taskId}";

        try{
            $result = $this->dbInstance->queryExecute($sql);
            $response = $result ->fetchAll(PDO::FETCH_ASSOC);

            return $response;
        }catch(PDOException $e){
            http_response_code(500);
            echo json_encode(["error"=> $e->getMessage()]);
            exit;
        }
    }


}