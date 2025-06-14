<?php

namespace Core;

class Router
{
  private array $routes = [];

  public function loadRoutes(string $path): void
  {
    $this->routes = require $path;
  }

  public function dispatch(): void
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    foreach ($this->routes as [$routeMethod, $routeUri, $handler]) {
      if ($method === $routeMethod && $uri === $routeUri) {
        [$class, $function] = explode('@', $handler);
        $controller = new $class();
        call_user_func([$controller, $function]);
        return;
      }
    }

    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
  }
}
