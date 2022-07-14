<?php
namespace App;

use App\Core;
use ReflectionMethod;
use App\Exceptions\RouteException;
use Reflection;
use ReflectionClass;

class Route extends Core
{
    public const GET_REQUEST = 'GET';
    public const POST_REQUEST = 'POST';

    public static function get(string $routeName = '', array $controller = []) :void
    {
        if (empty($routeName)) {
            throw new RouteException('Route name is empty');
        }

        if (empty($controller)) {
            throw new RouteException('Controller is empty');
        }

        if(self::guardCall($routeName, self::GET_REQUEST)) {
            list($classController, $method) = $controller;
            self::execute($classController, $method);
        }
    }

    public static function post(string $routeName = '', array $controller = []) :void
    {
        if (empty($routeName)) {
            throw new RouteException('Route name is empty');
        }

        if (empty($controller)) {
            throw new RouteException('Controller is empty');
        }

        if(self::guardCall($routeName, self::POST_REQUEST)) {
            list($classController, $method) = $controller;
            self::execute($classController, $method, $_POST);
        }
    }

    private static function guardCall(string $routeName, string $requestMethod) :bool
    {
        return $routeName === parent::getRequestUri() && parent::getRequestMethod() === $requestMethod;
    }

    private static function execute(string $classController, string $method, array $params = []) :void
    {
        if(method_exists($classController, $method)) {
            $reflectionMethod = new ReflectionMethod($classController, $method);
            $reflectionMethod->invokeArgs(new $classController, [$params]);
        } else {
            throw new RouteException("Method {$method} does not exist in ${classController}");
        }
    }

}