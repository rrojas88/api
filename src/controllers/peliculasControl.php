<?php
require 'src/config.php';
require 'src/controllers/Funciones.php';
include_once 'src/models/BD.php';
include_once 'src/models/Peliculas.php';



if( ! isset($params) ){
	$error = array('error'=>true,
		'message' => 'No hay parametros' );
	Funciones::responder( $error );
}



$database = new BD();
$bd = $database->conectarme(DB_USUARIO,DB_PASSWORD,DB_HOST,DB_NAME);
$peliculas = new Peliculas($bd);

switch( $accion ){
	case 'consultar':
		Funciones::responder( $peliculas->consultar() );
		break;
	case 'consultarUno':
		/// Validaciones
		if( $params->id==NULL || trim($params->id)=='' ){
			$error = array('error'=>true,
				'message' => 'ID es obligatorio' );
			Funciones::responder( $error );
		}

		Funciones::responder( $peliculas->consultarUno( $params ) );
		break;
	case 'insertar':
		/// Validaciones
		if( $params->titulo==NULL || trim($params->titulo)=='' ){
			$error = array('error'=>true,
				'message' => 'Título es obligatorio' );
			Funciones::responder( $error );
		}
		if( $params->ano==NULL || trim($params->ano)=='' ){
			$error = array('error'=>true,
				'message' => 'Año es obligatorio' );
			Funciones::responder( $error );
		}

		Funciones::responder( $peliculas->insertar( $params ) );
		break;
	case 'actualizar':
		/// Validaciones
		if( $params->id==NULL || trim($params->id)=='' ){
			$error = array('error'=>true,
				'message' => 'ID es obligatorio' );
			Funciones::responder( $error );
		}
		if( $params->titulo==NULL || trim($params->titulo)=='' ){
			$error = array('error'=>true,
				'message' => 'Título es obligatorio' );
			Funciones::responder( $error );
		}
		if( $params->ano==NULL || trim($params->ano)=='' ){
			$error = array('error'=>true,
				'message' => 'Año es obligatorio' );
			Funciones::responder( $error );
		}

		Funciones::responder( $peliculas->actualizar( $params ) );
		break;
	case 'eliminar':
		/// Validaciones
		if( $params->id==NULL || trim($params->id)=='' ){
			$error = array('error'=>true,
				'message' => 'ID es obligatorio' );
			Funciones::responder( $error );
		}

		Funciones::responder( $peliculas->eliminar( $params ) );
		break;
}


?>