<?php

namespace App\Core;

use App\Interfaces\IRequest;

class Router
{
    private $request;
    private $supportedHttpMethods = ["GET", "POST", "DELETE", "PUT", "PATCH"];

    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    public function __call($method, $args)
    {
        list($path, $controller) = $args;

        if (!in_array(strtoupper($method), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }

        $this->{strtolower($method)}[$path] = $controller;
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
        $pathDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->request->requestUri;

        foreach ($pathDictionary as $path => $controller) {
            if (preg_match($path, $formatedRoute, $params)) {
                echo call_user_func_array($controller, [$this->request]);
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
