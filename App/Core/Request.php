<?php
namespace App\Core;

class Request
{
    private $params;
    private $agent;
    private $ip;
    private $method;

    public function __constructor()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->ip =  $_SERVER['REMOTE_ADDR'];
        $this->agent =  $_SERVER['HTTP_USER_AGENT'];
        $this->params = $_REQUEST;
    }

    public function method()
    {
        return $this->method;
    }

    public function params()
    {
        return $this->params;
    }

    public function ip()
    {
        return $this->ip;
    }

    public function agent()
    {
        return $this->agent;
    }

    public function input($key)
    {
        return $this->params[$key] ??null;
    }

    public function isset($key)
    {
        return isset($this->params[$key]);
    }

    public function redirect($route)
    {
        header("Location: " . site_url($route));
        die();
    }
}
