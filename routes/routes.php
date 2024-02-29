<?php

use FastRoute\RouteCollector;
use Src\Controllers\AddressController;
use Src\Controllers\CityController;
use Src\Controllers\HomeController;
use Src\Controllers\StateController;
use Src\Controllers\UserController;
use Src\Helpers\HttpRequest;
use function FastRoute\simpleDispatcher;

$dispatcher = simpleDispatcher(function(RouteCollector $request) {
    $prefix = '/api';

    $request->addRoute('GET', "{$prefix}/", function() {
        $controller = new HomeController();

        echo HttpRequest::response(
            $controller->home()
        );
    });

    /**
     * User routes
     */
    $request->addGroup("{$prefix}/users", function () use ($request) {

        $request->get('', function() {
            $controller = new UserController();

            echo HttpRequest::response(
                $controller->index()
            );
        });

        $request->get('/{id}', function($query) {
            $controller = new UserController();
            $id = $query['id'];

            echo HttpRequest::response(
                $controller->show(id: $id)
            );
        });

        $request->post('', function() {
            $controller = new UserController();
            $data = HttpRequest::getRequestBody();

            echo HttpRequest::response(
                $controller->store(data: $data)
            );
        });

        $request->put('/{id}', function($query) {
            $controller = new UserController();
            $id = $query['id'];
            $data = HttpRequest::getRequestBody();

            echo HttpRequest::response(
                $controller->update(id: $id, data: $data)
            );
        });

        $request->delete('/{id}', function($query) {
            $controller = new UserController();
            $id = $query['id'];

            echo HttpRequest::response(
                $controller->destroy(id: $id)
            );
        });

        /**
         * Addresses routes
         */
        $request->get('/{userid}/addresses', function() {
            $controller = new AddressController();

            echo HttpRequest::response(
                $controller->index()
            );
        });

        $request->get('/{userid}/addresses/{id}', function($query) {
            $controller = new AddressController();
            $id = $query['id'];

            echo HttpRequest::response(
                $controller->show(id: $id)
            );
        });

        $request->post('/{userid}/addresses', function($query) {
            $controller = new AddressController();
            $data = HttpRequest::getRequestBody();
            $data['user_id'] = $query['userid'];

            echo HttpRequest::response(
                $controller->store(data: $data)
            );
        });

        $request->put('/{userid}/addresses/{id}', function($query) {
            $controller = new AddressController();
            $id = $query['id'];
            $data = HttpRequest::getRequestBody();

            echo HttpRequest::response(
                $controller->update(id: $id, data: $data)
            );
        });

        $request->delete('/{userid}/addresses/{id}', function($query) {
            $controller = new AddressController();
            $id = $query['id'];

            echo HttpRequest::response(
                $controller->destroy(id: $id)
            );
        });

    });

    /**
     * States routes
     */
    $request->addGroup("{$prefix}/states", function () use ($request) {

        $request->get('', function() {
            $controller = new StateController();

            echo HttpRequest::response(
                $controller->index()
            );
        });

        $request->get('/{id}', function($query) {
            $controller = new StateController();
            $id = $query['id'];

            echo HttpRequest::response(
                $controller->show(id: $id)
            );
        });
    });

    /**
     * Cities routes
     */
    $request->addGroup("{$prefix}/cities", function () use ($request) {

        $request->get('', function() {
            $controller = new CityController();

            echo HttpRequest::response(
                $controller->index()
            );
        });

        $request->get('/{id}', function($query) {
            $controller = new CityController();
            $id = $query['id'];

            echo HttpRequest::response(
                $controller->show(id: $id)
            );
        });
    });

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

// Route dispatch
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo HttpRequest::response([
            'error' => 'Not found'
        ]);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo HttpRequest::response([
            'error' => 'Not Allowed'
        ]);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        call_user_func($handler, $vars);
        break;
}
