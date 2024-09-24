<?php


//configuração das rotas para o servidor;
class RouteDefaults {
  protected $path;
  protected $method;
  protected $post_form;

  protected $auth;

  public function __construct($object) {
    if($object) {
      $this->path = $object->path ?? null;
      $this->method = $object->method ?? null ;
      $this->post_form = $object->post_form ?? null;
      $this->auth = $object->auth ?? null;
    }
  }
}