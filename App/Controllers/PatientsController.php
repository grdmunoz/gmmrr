<?php

namespace App\Controllers;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class PatientsController {


    function index(){
        $logger = new Logger('PatientController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('index'); 

    }

    function get($params){
        $logger = new Logger('PatientController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('get',array($params)); 

    }   
    function create($params){
        $logger = new Logger('PatientController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('create',array($params)); 

    } 
    
    function update($params){
        $logger = new Logger('PatientController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('update',array($params)); 

    }

    function delete($params){
        $logger = new Logger('PatientController');
        $logger->pushHandler(new StreamHandler('./app.log', Logger::DEBUG));
        $logger->addInfo('delete',array($params)); 

    }
       
}

?>