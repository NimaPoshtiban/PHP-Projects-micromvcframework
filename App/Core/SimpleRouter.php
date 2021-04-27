<?php

namespace App\Core;

use App\Utilities\Url;

class SimpleRouter
{
    private $routes;
    public function __construct()
    {
        $this->routes = [
      "/colors/blue"=>'colors/blue.php',
      "/colors/green"=>'colors/green.php',
      "/colors/red"=>'colors/red.php'
    ];
    }

    private function includeAndDie($viewPath)
    {
        include $viewPath;
        die();
    }

    public function run():void
    {
        $current_route = Url::current_route();

        foreach ($this->routes as $route=>$view) {
            if ($current_route==$route) {
                $this->includeAndDie(BASE_PATH . "views/$view");
            }
            # 404 error
            header("HTTP/1.0 404 Not Found");
            $this->includeAndDie(BASE_PATH . "views/errors/404.php");
        }
    }
}
