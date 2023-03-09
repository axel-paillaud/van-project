<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'GET'
        ];
    }

    public function post($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'POST'
        ];
    }

    public function delete($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'DELETE'
        ];
    }

    public function put($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'PUT'
        ];
    }

    public function route($uri, $method)
    {
        foreach($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return base_path($route['controller']);
            }
        }
        return $this->abort();
    }

    // add a catch error for all error code here
    protected function abort($code = 404) {
        http_response_code($code);
        return base_path('src/controllers/homepage.php');
    }
}