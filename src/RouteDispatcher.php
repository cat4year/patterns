<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\Patterns\Creational\AbstractFactoryController;
use App\Controllers\Patterns\Creational\BuilderController;
use App\Controllers\Patterns\Creational\FactoryMethodController;
use App\Controllers\Patterns\Creational\PrototypeController;
use App\Controllers\Patterns\Creational\SingletonController;
use App\Controllers\Patterns\Structural\AdapterController;
use App\Controllers\Patterns\Structural\BridgeController;
use App\Controllers\Patterns\Structural\CompositeController;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Invoker\InvokerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use function FastRoute\simpleDispatcher;

readonly class RouteDispatcher
{
    public function __construct(
        private Request          $request,
        private Response         $response,
        private InvokerInterface $invoker,
    ) {
    }

    public function fastRoute(): void
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {
            $r->get('/', [HomeController::class, 'show']);
            $r->addGroup('/creational', function (RouteCollector $r) {
                $r->get('/factory-method', [FactoryMethodController::class, 'show']);
                $r->get('/abstract-factory', [AbstractFactoryController::class, 'show']);
                $r->get('/builder', [BuilderController::class, 'show']);
                $r->get('/prototype', [PrototypeController::class, 'show']);
                $r->get('/singleton', [SingletonController::class, 'show']);
            });
            $r->addGroup('/structural', function (RouteCollector $r) {
                $r->get('/adapter', [AdapterController::class, 'show']);
                $r->get('/bridge', [BridgeController::class, 'show']);
                $r->get('/composite', [CompositeController::class, 'show']);
            });
        });

        $httpMethod = $this->request->getMethod();
        $uri = $this->request->getRequestUri();

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                $this->routeNotFound();
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $this->routeNotAllowed($routeInfo[1]);
                break;
            case Dispatcher::FOUND:
                $this->routeFound($routeInfo[1], $routeInfo[2]);
                break;
        }

        $this->response->send();
    }

    protected function routeNotFound(): void
    {
        $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    protected function routeNotAllowed($allowedMethods): void
    {
        $this->response->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
        $this->response->headers->add(['Allow' => implode(', ', $allowedMethods)]);
    }

    protected function routeFound($handler, $vars): void
    {
        [$class, $method] = $handler;

        $data = $this->invoker->call([$class, $method], $vars);

        $this->response->setContent((string) $data);
    }
}
