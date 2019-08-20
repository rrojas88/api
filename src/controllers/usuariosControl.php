<?php
require 'src/config.php';
require 'src/controllers/Funciones.php';
include_once 'src/models/BD.php';
include_once 'src/models/Usuarios.php';


if( ! isset($params) ){
	$error = array('error'=>true,
		'message' => 'No hay parametros' );
	Funciones::responder( $error );
}


$database = new BD();
$bd = $database->conectarme(DB_USUARIO,DB_PASSWORD,DB_HOST,DB_NAME);
$usuarios = new Usuarios($bd);

switch( $accion ){
	case 'logar':
		/// Validaciones
		if( $params->nickname==NULL || trim($params->nickname)=='' ){
			$error = array('error'=>true,
				'message' => 'ID es obligatorio' );
			Funciones::responder( $error );
		}
		if( $params->contrasena==NULL || trim($params->contrasena)=='' ){
			$error = array('error'=>true,
				'message' => 'ID es obligatorio' );
			Funciones::responder( $error );
		}

		Funciones::responder( $usuarios->logar( $params ) );
		break;
	case 'consultar':
		Funciones::responder( $usuarios->consultar() );
		break;
	case 'consultarUno':
		/// Validaciones
		if( $params->id==NULL || trim($params->id)=='' ){
			$error = array('error'=>true,
				'message' => 'ID es obligatorio' );
			Funciones::responder( $error );
		}

		Funciones::responder( $usuarios->consultarUno( $params ) );
		break;
	case 'insertar':
		/// Validaciones
		if( $params->nombre==NULL || trim($params->nombre)=='' ){
			$error = array('error'=>true,
				'message' => 'Nombre es obligatorio' );
			Funciones::responder( $error );
		}
		if( $params->nickname==NULL || trim($params->nickname)=='' ){
			$error = array('error'=>true,
				'message' => 'Nickname es obligatorio' );
			Funciones::responder( $error );
		}
		if( $params->contrasena==NULL || trim($params->contrasena)=='' ){
			$error = array('error'=>true,
				'message' => 'Contraseña es obligatoria' );
			Funciones::responder( $error );
		}

		if( strlen($params->nombre) < 5 ){
			$error = array('error'=>true,
				'message' => 'El nombre debe ser de mínimo 5 caracteres' );
			Funciones::responder( $error );
		}
		if( ! preg_match("/^[A-Za-z\d\_]+$/", $params->nickname) ){
			$error = array('error'=>true,
				'message' => 'El nickname solo puede contener letras, números y \_' );
			Funciones::responder( $error );
		}
		/// Valido NICK
		$encontradoNick = $usuarios->consultarPorColumna( $params, 'nickname' );
		if( $encontradoNick['registro'] ){
			$error = array('error'=>true,
				'message' => 'El Nick ya está en uso' );
			Funciones::responder( $error );
		}
		/// Valido PASS
		if( ! preg_match("/[\d]+/", $params->contrasena) ){
			$error = array('error'=>true,
				'message' => 'La contraseña debe tener al menos un número' );
			Funciones::responder( $error );
		}
		if( ! preg_match("/[A-Z]+/", $params->contrasena) ){
			$error = array('error'=>true,
				'message' => 'La contraseña debe tener al menos una letra mayúscula' );
			Funciones::responder( $error );
		}

		Funciones::responder( $usuarios->insertar( $params ) );
		break;
	case 'actualizar':
		/// Validaciones
		if( $params->nombre==NULL || trim($params->nombre)=='' ){
			$error = array('error'=>true,
				'message' => 'Nombre es obligatorio' );
			Funciones::responder( $error );
		}
		if( $params->nickname==NULL || trim($params->nickname)=='' ){
			$error = array('error'=>true,
				'message' => 'Nickname es obligatorio' );
			Funciones::responder( $error );
		}
		if( $params->contrasena==NULL || trim($params->contrasena)=='' ){
			$error = array('error'=>true,
				'message' => 'Contraseña es obligatoria' );
			Funciones::responder( $error );
		}

		if( strlen($params->nombre) < 5 ){
			$error = array('error'=>true,
				'message' => 'El nombre debe ser de mínimo 5 caracteres' );
			Funciones::responder( $error );
		}
		if( ! preg_match("/^[A-Za-z\d\_]+$/", $params->nickname) ){
			$error = array('error'=>true,
				'message' => 'El nickname solo puede contener letras, números y \_' );
			Funciones::responder( $error );
		}

		/// Valido PASS
		if( ! preg_match("/[\d]+/", $params->contrasena) ){
			$error = array('error'=>true,
				'message' => 'La contraseña debe tener al menos un número' );
			Funciones::responder( $error );
		}
		if( ! preg_match("/[A-Z]+/", $params->contrasena) ){
			$error = array('error'=>true,
				'message' => 'La contraseña debe tener al menos una letra mayúscula' );
			Funciones::responder( $error );
		}
		

		Funciones::responder( $usuarios->actualizar( $params ) );
		break;
	case 'eliminar':
		/// Validaciones
		if( $params->id==NULL || trim($params->id)=='' ){
			$error = array('error'=>true,
				'message' => 'ID es obligatorio' );
			Funciones::responder( $error );
		}

		Funciones::responder( $usuarios->eliminar( $params ) );
		break;
}


?>