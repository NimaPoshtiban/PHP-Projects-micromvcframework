<?php
namespace App\Core\Routing;

use App\Core\Request;
use Exception;

class Router
{
    private $request;
    private $routes;
    private $current_route;
    const BASE_CONTROLLER = "\App\Controllers\\";
    public function __construct()
    {
        $this->request = new Request();
        $this->routes = Route::routes();
        $this->current_route = $this->findRoute($this->request) ?? null;
    }

    public function findRoute(Request $request)
    {
        foreach ($this->routes as $route) {
            if (in_array($request->method(), $route['methods']) && $request->uri() == $route['uri']) {
                return $route;
            }
            return null;
        }
    }

    public function dispatch404()
    {
        header("HTTP/1.0 404 Not Found");
        view('errors.404');
        die();
    }

    public function run()
    {
        if (is_null($this->current_route)) {
            $this->dispatch404();
        }
        $this->dispatch($this->current_route);
    }

    private function dispatch($route)
    {
        $action = $route['action'];
        if (is_null($action) || empty($action)) {
            return;
        }

        if (is_callable($action)) {
            $action();
        }

        if (is_string($action)) {
            $action = explode("@", $action);
        }
        if (is_array($action)) {
            $class_name = self::BASE_CONTROLLER . $action[0];
            $method = $action[1];
            if (!class_exists($class_name)) {
                throw new Exception("Class $class_name Not Exist");
            }
            
            $controller = new $class_name();
            
            if (!method_exists($controller,$method)) {
                throw new Exception("Method $method Not Exist in $class_name");
            }
            $controller->{$method}();
        }
    }
}
