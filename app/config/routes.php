<?php

use app\controllers\ApiExampleController;
use app\controllers\WelcomeController;
use flight\Engine;
use flight\net\Router;
//use Flight;

/** 
 * @var Router $router 
 * @var Engine $app
 */
/*$router->get('/', function() use ($app) {
	$Welcome_Controller = new WelcomeController($app);
	$app->render('welcome', [ 'message' => 'It works!!' ]);
});*/

$Welcome_Controller = new WelcomeController();
$router->get('/', [ $Welcome_Controller, 'home' ]); 
$router->post('/sendMail', [ $Welcome_Controller, 'sendEmail' ]);

$router->get('/homedb', [ $Welcome_Controller, 'homedb' ]); 
$router->get('/testdb', [ $Welcome_Controller, 'testdb' ]); 
$router->get('/home-template', [ $Welcome_Controller, 'homeTemplate' ]); 
$router->get('/product-template', [ $Welcome_Controller, 'productTemplate' ]); 

