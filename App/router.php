<?php

namespace App;

class Router{

protected $routes = [
    'GET'    => [],
    'POST'   => [],
    'ANY'    => [],
    'PUT'    => [],
    'PATCH'  => [],
    'DELETE' => [],   
];

public $patterns = [
    ':any'  => '.*',
    ':id'   => '[0-9]+',
    ':slug' => '[a-z\-]+',
    ':name' => '[a-zA-Z]+',
];

public function any($path, $handler){
    $this->addRoute('ANY', $path, $handler);
}

public function get($path, $handler){
    $this->addRoute('GET', $path, $handler);
}

public function post($path, $handler){
    $this->addRoute('POST', $path, $handler);
}

public function put($path, $handler){
    $this->addRoute('PUT', $path, $handler);
}

public function patch($path, $handler){
    $this->addRoute('PATCH', $path, $handler);
}


public function delete($path, $handler){
    $this->addRoute('DELETE', $path, $handler);
}

public function resource($path){

    $nestedRoutes = explode(".", $path);
    $routeCount = count($nestedRoutes);

    switch ($routeCount) {
        case 1:
            $this->get('/'.$path, $path.'Controller@index');
            $this->get('/'.$path.'/{:id}', $path.'Controller@get');
            $this->post('/'.$path, $path.'Controller@create');     
            $this->patch('/'.$path.'/{:id}', $path.'Controller@update');
            $this->delete('/'.$path.'/{:id}', $path.'Controller@delete');
        
            break;
        case 2:

            $seg1 = $nestedRoutes[0];
            $seg2 = $nestedRoutes[1];

            $this->get('/'.$seg1.'/{:id}/'.$seg2, $seg1.$seg2.'Controller@index');
            $this->get('/'.$seg1.'/{:id}/'.$seg2.'/{:slug}', $seg1.$seg2.'Controller@get');
            $this->post('/'.$seg1.'/{:id}/'.$seg2, $seg1.$seg2.'Controller@create');
            $this->patch('/'.$seg1.'/{:id}/'.$seg2.'/{:slug}', $seg1.$seg2.'Controller@update');
            $this->delete('/'.$seg1.'/{:id}/'.$seg2.'/{:slug}', $seg1.$seg2.'Controller@delete');

            break;
    }
}

protected function addRoute($method, $path, $handler){
    array_push($this->routes[$method], [$path => $handler]);
}

public function match(array $server = []){

    $method = $server['REQUEST_METHOD'];
    $uri = $server['REQUEST_URI'];

    $uri = trim($uri, '/');
    $uriArray= explode('/', $uri);

    $controllerArray = $paramArray = array();
    list($controllerArray[0], $paramArray[0],$controllerArray[1], $paramArray[1]) = $uriArray;
    $controllerArray = array_filter($controllerArray);
    $paramArray = array_filter($paramArray);

    foreach ($this->routes[$method]  as $resource) {

        $route   = key($resource); 
        $handler = reset($resource);

        $uriResource= explode('/',  trim($route, '/'));
        $uriParameters = $uriSegment = array();
        list($uriSegment[0], $uriParameters[0],$uriSegment[1], $uriParameters[1]) = $uriResource;
        $uriParameters = array_filter($uriParameters);
        $uriSegment = array_filter($uriSegment);

        if ( $uriSegment == $controllerArray) {
            if ( count($uriParameters) == count($paramArray)) {
                
                if(is_string($handler) && strpos($handler, '@')){
                    list($ctrl, $method) = explode('@', $handler); 
                }
                
                switch ($ctrl) {
                    case 'PatientsController':
                        $activeController = new Controllers\PatientsController();
                        break;
                    case 'PatientsMetricsController':
                        $activeController = new Controllers\PatientsMetricsController(); 
                        break;
                }
                call_user_func_array(array($activeController, $method ), array($paramArray));
            } 
        }
    }
}

}