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
        list($route, $controller) = $args;

        if (!in_array(strtoupper($method), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }

        $this->{strtolower($method)}[$route] = $controller;
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

        foreach ($routeDictionary as $route => $controller) {
            if (preg_match($route, $path, $params)) {
                foreach ($params as $key => $value) {
                    $this->request->params[$key] = $value;
                }
                call_user_func_array(
                    array($controller, $method),
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
