<?php

require('vendor/autoload.php');

$router = new App\Router();

$router->resource('Patients');
$router->resource('Patients.Metrics'); 
$router->match($_SERVER);

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

echo '<p>path  '.$path.'</p>';

