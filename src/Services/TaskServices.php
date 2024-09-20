<?php

class TaskServices
{
    private $dbInstance;
    private $outputTaksMovimentsService;

    public function __construct(){
        $this->dbInstance = new DbConfigService();
        $this->outputTaksMovimentsService = new OutputTaskService();
    }

    public function getTaskById($id){
        $sql = "SELECT * FROM tasks WHERE {$id}";
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
    public function addTask($title, $description, $userId, $categoryId){
        $sql = "INSERT INTO tasks 
        (title, description, user_id, category_id, status) 
         VALUES ('{$title}', '{$description}', '{$userId}',
          '{$categoryId}', '{'pending'}') ";

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


    public function startTask($taskId){
        $task = $this->getTaskById($taskId);

        if($task['status'] === 'finished'){
            http_response_code(400);
            echo json_encode(["error"=> "Não é possivel iniciar uma tarefa que já está finalizada" ]);
            exit;
        }
        
        //atualiza o status da task e coleta o horario
        $sql = "UPDATE tasks SET status = 'started', start_time = NOW() WHERE id={$taskId}";
        $outputSql = $this->outputTaksMovimentsService->insertTaskMovements($taskId);
        
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

        if($task['status'] == 'started'){
            $sql = "UPDATE tasks SET status = 'paused', pause_time = NOW() WHERE id = {'$taskId'}";
        }else{
            http_response_code(400);
            echo json_encode(["error"=> "A task já foi finalizada ou já está pausada"]);
        }

        $outputsql = $this->outputTaksMovimentsService->pauseTaskMovements($taskId);

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

        $outpuTask = $this->outputTaksMovimentsService->finishTaskMovements($taskId); 
    }


}