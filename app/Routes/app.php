<?php
//Routes Employees//
$app->get('/employees', 'App\Controllers\EmployeesController:index');
$app->post('/employees', 'App\Controllers\EmployeesController:index');
$app->get('/employe/{id}', 'App\Controllers\EmployeesController:employeDetail');

//Api Rest XML
$app->get('/employees/api/{min_max}', 'App\Controllers\EmployeesController:xmlApi');


// Example Routes //
// require 'example.php';
