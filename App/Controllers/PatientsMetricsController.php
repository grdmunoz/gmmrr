<?php
namespace App\Controllers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class PatientsMetricsController
{

    function index($params){
        $logger = new Logger('PatientMetricsController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('index',array($params)); 

    }
 
    function get($params){
        $logger = new Logger('PatientMetricsController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('get',array($params)); 

    }
    
    function create($params){
        $logger = new Logger('PatientMetricsController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('create',array($params)); 

    } 
    
    function update($params){
        $logger = new Logger('PatientMetricsController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('update',array($params)); 

    }

    function delete($params){
        $logger = new Logger('PatientMetricsController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('delete',array($params)); 

    }
       
}

?>