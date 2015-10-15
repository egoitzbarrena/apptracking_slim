<?php

include 'userModel.php';
include 'userView.php';
require 'vendor/autoload.php';



Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->config('debug', false);

 
$app->post('/add', function () use ($app) {
	$nombre = $app->request->post('nombre'); 
	$correo= $app->request->post('correo'); 
	$latitud = $app->request->post('latitud'); 
	$longitud = $app->request->post('longitud');
	$tiempo = $app->request->post('tiempo');
	$userModel = new userModel($nombre,$correo,$longitud,$latitud,$tiempo);
	$userModel->add_user($nombre,$correo);
	$userModel->add_position($nombre,$longitud,$latitud,$tiempo);
});

$app->post('/mostrar', function () use ($app) {
	$nombre = $app->request->post('nombre'); 
	$correo= $app->request->post('correo'); 
	$userModel = new userModel($nombre,$correo,$longitud,$latitud,$tiempo);
	$userView = new userView($userModel);
    $userView->output();
});

$app->get('/insertar/:nombre/:correo/:latitud/:longitud/:tiempo', function ($nombre,$correo,$latitud,$longitud,$tiempo){
	$userModel = new userModel($nombre,$correo,$longitud,$latitud,$tiempo);
	$userModel->add_user($nombre,$correo);
	$userModel->add_position($nombre,$longitud,$latitud,$tiempo);
});

$app->get('/mostrar/:nombre/:correo', function ($nombre,$correo){
	$userModel = new userModel($nombre,$correo,$longitud,$latitud,$tiempo);
	$userView = new userView($userModel);
    $userView->output();
});

$app->run();

?>

