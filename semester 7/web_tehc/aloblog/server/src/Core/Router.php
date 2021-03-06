<?php

namespace App\Core;

use App\Interfaces\IRequest;
use App\Interfaces\IResponse;

class Router
{
    private $request;
    private $response;
    private $supportedHttpMethods = ["GET", "POST", "DELETE", "PUT", "PATCH"];

    public function __construct(IRequest $request, IResponse $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function __call($method, $args)
    {
        list($route, $controllerClass, $controllerMethod) = $args;

        if (!in_array(strtoupper($method), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }

        $this->{strtolower($method)}[$route] = [$controllerClass, $controllerMethod];

        return $this;
    }

    // TODO: refactor routes with resource entry
    public function resource(
        $route,
        $controllerClass,
        $include = ['index', 'show', 'create', 'delete']
    ) {
    }

    private function invalidMethodHandler()
    {
        http_response_code(405);
    }

    private function defaultRequestHandler()
    {
        http_response_code(404);
    }

    public function resolve()
    {
        $method = strtolower($this->request->requestMethod);
        $routeDictionary = $this->{$method};
        $path = parse_url($this->request->requestUri, PHP_URL_PATH);

        foreach ($routeDictionary as $route => list(
            $controllerClass,
            $controllerMethod
        )) {
            if (preg_match($route, $path, $params)) {
                $controller = new $controllerClass();

                foreach ($params as $key => $value) {
                    $this->request->params[$key] = $value;
                }
                call_user_func_array(
                    array($controller, $controllerMethod),
                    [$this->request, $this->response]
                );
                return;
            }
        }

        $this->defaultRequestHandler();
    }

    public function __destruct()
    {
        $this->resolve();
    }
}
