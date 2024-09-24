<?php

class TaskControllers{

  private $taskService;
 
  public function __construct(TaskServices $taskServices){
    $this->taskService = $taskServices;
  }

  public function getAllTasks(){
    $tasks = $this->taskService->getAllTasks();
    
    http_response_code(200);
    echo json_encode($tasks);
  }

  public function getTaskById($id){
    if(empty($id)){
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "O campo de id não pode ser vazio"]);
      exit;
    }

    $task = $this->taskService->getTaskById($id);

    if(!empty($task)) {
      http_response_code(200);
      echo json_encode($task);
    } else {
      http_response_code(404); 
      echo json_encode(["error" => "Task não foi encontrada"]);
    } 

  }

  public function addTask($form){
    if(empty($form['title']) && empty($form['user_id']
    && empty($form['category_id']) && empty($form['description']))){
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "Os campos title, user_id, category_id e description não podem vim vazio"]);
      exit;
    }

    $title = $form['title'];
    $descrip =  $form['description'];
    $categoryId = $form['category_id'];
    $userId = $form['user_id'];



    $task = $this->taskService->addTask($title, $descrip, $userId, $categoryId);
    
    http_response_code(201);
    echo json_encode(["message" => "tarefa criada"]);
  }

  public function startTask($form){
    if(empty($form["id"])){
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "O campo de id não pode ser vazip"]);
      exit;
    }

    $taskId = $form["id"];

    $task = $this->taskService->startTask($taskId);

    if(!empty($task)){
      http_response_code(200);
      echo json_encode(["message" => "a tarefa foi iniciada"]);
    }
    
    echo json_encode(["message" => "tarefa começou"]);
  }

  public function pauseTask($form){
    if(empty($form["id"])){
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "O campo de id não pode ser vazio"]);
      exit;
    }

    $taskId = $form["id"];

   $this->taskService->stopTask($taskId);


    echo json_encode(["message" => "tarefa pausada"]);
    
  }

  public function finalizeTask($form){
    if(empty($form["id"])){
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "O campo de id não pode ser vazio"]);
      exit;
    }

    $taskId = $form["id"];

    $this->taskService->finishTask($taskId);


    echo json_encode(["message" => "tarefa finalizada"]);
  }

  public function retumeTime($form){
    if(empty($form["id"])){
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "O campo de id não pode ser vazio"]);
      exit;
    }

    $taskId = $form["id"];

    $this->taskService->retumeStack($taskId);


    echo json_encode(["message" => "tarefa retomada"]);
  }
  

  public function finaltimeTask($form){
    if(empty($form["id"])){
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "O campo de id não pode ser vazio"]);
      exit;
    }

    $taskId = $form["id"];

    $task = $this->taskService->getTaskById($taskId);
    
    if(empty($task)){
      http_response_code(400);
      echo json_encode(["error"=> "essa task não existe"]);
    }

    $start = new DateTime($task['start_time']);
    $finish = new DateTime($task['finish_time']);
    
    $totalTime = $finish->getTimestamp() - $start->getTimestamp();

    if (!empty($task['pause_time']) && !empty($task['retume_time'])) {
        $pause = new DateTime($task['pause_time']);
        $resume = new DateTime($task['retume_time']);

        $pausedDuration = $resume->getTimestamp() - $pause->getTimestamp();
        $totalTime += $pausedDuration; 
    }

    $totalTimeFormatted = gmdate("H:i:s", $totalTime);

    $this->taskService->totalTimeTask($taskId, $totalTimeFormatted);
    
    echo json_encode(["sucess" => "data total calculada"]);
  }


}

