<?php 
class Funciones {

	public static function responder( $vector ){
		echo json_encode( $vector );
		exit();
	}


}
?>