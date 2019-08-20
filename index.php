<?php
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");


require 'src/Slim-2/Slim/Slim.php';
\Slim\Slim::registerAutoloader(); 
$app = new \Slim\Slim();


$app->get('/', function () {
    echo "OK";
});

$app->post('/login', function( ) {
	$app = \Slim\Slim::getInstance();
	$params_ = $app->request()->getBody();
	$params = json_decode($params_);
	
	//sleep(3);
	$accion = 'logar';

	require 'src/controllers/usuariosControl.php';
});


$app->get('/usuarios', function( ) {
	$app = \Slim\Slim::getInstance();
	$params_ = $app->request()->getBody();
	$params = json_decode($params_);
	
	$params = new stdClass();

	$token_ok = true;
	if( $token_ok ){
		$accion = 'consultar';

		require 'src/controllers/usuariosControl.php';
	}
});

$app->post('/nuevo-usuario', function( ) {
	$app = \Slim\Slim::getInstance();
	$params_ = $app->request()->getBody();
	$params = json_decode($params_);
	//echo '<pre>';print_r( $params );echo '</pre>';exit();
	
	$token_ok = true;
	if( $token_ok ){
		$accion = 'insertar';

		require 'src/controllers/usuariosControl.php';
	}
});


$app->get('/usuarios/:id', function( $id ) {
	
	$params = new stdClass();
	$params->id = $id;

	$token_ok = true;
	if( $token_ok ){
		$accion = 'consultarUno';

		require 'src/controllers/usuariosControl.php';
	}
});

$app->post('/editar-usuario', function( ) {
	$app = \Slim\Slim::getInstance();
	$params_ = $app->request()->getBody();
	$params = json_decode($params_);
	
	$token_ok = true;
	if( $token_ok ){
		$accion = 'actualizar';

		require 'src/controllers/usuariosControl.php';
	}
});

$app->post('/eliminar-usuario', function( ) {
	$app = \Slim\Slim::getInstance();
	$params_ = $app->request()->getBody();
	$params = json_decode($params_);
	
	$token_ok = true;
	if( $token_ok ){
		$accion = 'eliminar';

		require 'src/controllers/usuariosControl.php';
	}
});




/* =============================
PELICULAS
*/


$app->get('/peliculas', function() {
	
	$params = new stdClass();

	$token_ok = true;
	if( $token_ok ){
		$accion = 'consultar';

		require 'src/controllers/peliculasControl.php';
	}
});
$app->get('/peliculas/:id', function( $id ) {
	
	$params = new stdClass();
	$params->id = $id;

	$token_ok = true;
	if( $token_ok ){
		$accion = 'consultarUno';

		require 'src/controllers/peliculasControl.php';
	}
});

$app->post('/nueva-pelicula', function( ) {
	$app = \Slim\Slim::getInstance();
	$params_ = $app->request()->getBody();
	$params = json_decode($params_);
	//echo '<pre>';print_r( $params );echo '</pre>';exit();
	
	$token_ok = true;
	if( $token_ok ){
		$accion = 'insertar';

		require 'src/controllers/peliculasControl.php';
	}
});

$app->post('/editar-pelicula', function( ) {
	$app = \Slim\Slim::getInstance();
	$params_ = $app->request()->getBody();
	$params = json_decode($params_);
	
	$token_ok = true;
	if( $token_ok ){
		$accion = 'actualizar';

		require 'src/controllers/peliculasControl.php';
	}
});

$app->post('/eliminar-pelicula', function( ) {
	$app = \Slim\Slim::getInstance();
	$params_ = $app->request()->getBody();
	$params = json_decode($params_);
	
	$token_ok = true;
	if( $token_ok ){
		$accion = 'eliminar';

		require 'src/controllers/peliculasControl.php';
	}
});

$app->run();





?>