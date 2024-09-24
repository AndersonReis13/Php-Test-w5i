<?php

class TaskRoutes extends RouteDefaults{

  private $taskControllers;

  public function __construct($object){
    parent::__construct($object);
    $taskServices = new TaskServices();
    $this->taskControllers = new TaskControllers($taskServices);
  }


  public function initialTaskRoutes(){
    $path_explode = explode("/", $this->path);

    switch($this->path){
      case $this->path == "tasks/view" && $this->method == "GET":
        $this->taskControllers->getAllTasks();
        break;

      case $this->path == "tasks/add":
        if($this->method == "POST"){
         $this->taskControllers->addTask($this->post_form);
        }  
        break;

         // Rota para buscar por nome (categories/view/{id})
      case $path_explode[0] == "tasks" && $path_explode[1] == "view" && !empty($path_explode[2]):
          if ($this->method == "GET") {
              $this->taskControllers->getTaskById($path_explode[2]);
          }
          break;    
      case $this->path == "tasks/start":
            if($this->method == "POST"){
             $this->taskControllers->startTask($this->post_form);
          }  
            break;
      case $this->path == "tasks/pause":
            if($this->method == "POST"){
            $this->taskControllers->pauseTask($this->post_form);
          }  
          break;
      case $this->path == "tasks/finish":
            if($this->method == "POST"){
              $this->taskControllers->finalizeTask($this->post_form);
          }  
          break;   
      case $this->path == "tasks/retume":
            if($this->method == "POST"){
              $this->taskControllers->retumeTime($this->post_form);
          }  
          break;    
      case $this->path == "tasks/final":
            if($this->method == "POST"){
              $this->taskControllers->finaltimeTask($this->post_form);
          }  
          break;      

        default:
        http_response_code(404);
        echo json_encode(["error" => "Rota não encontrada"]);
    }

  }
} 