<?php

class Peliculas {
	private $con;

	public function __construct( $bd ){
		$this->con = $bd;
	}


	public function consultar(){
		$stmt = $this->con->query("SELECT * FROM peliculas");
		$registros = $stmt->fetchAll(PDO::FETCH_OBJ);
		return array(
			'error'=>false,
			'listado' => $registros
		);
	}



	public function consultarUno( $data ){
		try{
			$sql = "SELECT * FROM peliculas WHERE id=:id ";                              
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id', $data->id, PDO::PARAM_INT);
			if( $stmt->execute() ){
				$registro = $stmt->fetch(PDO::FETCH_ASSOC);
				return array( 'error'=>false,
					'registro' => $registro );
			}
			else{
				$vErrores = $stmt->errorInfo();
				return array(
					'error'=>true,
					'message' => $vErrores[0].'|'.$vErrores[1].'|'.$vErrores[2]
				);
			}
		}
		catch(PDOException $e){
            return array('error'=>true,
				'message' => $e->getMessage() );
        }
	}


	public function insertar( $data ){
		try{
			$sql = "INSERT INTO peliculas (titulo, sipnosis, ano) 
			VALUES (:titulo, :sipnosis, :ano)";
	                                          
			$stmt = $this->con->prepare($sql);                        
			$stmt->bindParam(':titulo', $data->titulo, PDO::PARAM_STR); 
			$stmt->bindParam(':sipnosis', $data->sipnosis, PDO::PARAM_STR); 
			$stmt->bindParam(':ano', $data->ano, PDO::PARAM_INT);
			if( $stmt->execute() ){
				return array( 'error'=>false,
					'ID' => $this->con->lastInsertId() );
			}
			else{
				$vErrores = $stmt->errorInfo();
				return array(
					'error'=>true,
					'message' => $vErrores[0].'|'.$vErrores[1].'|'.$vErrores[2]
				);
			}
		}
		catch(PDOException $e){
            return array('error'=>true,
				'message' => $e->getMessage() );
        }
	}


	public function actualizar( $data ){
		try{
			$sql = "UPDATE peliculas SET titulo=:titulo, sipnosis=:sipnosis, ano=:ano WHERE id=:id ";
	                                          
			$stmt = $this->con->prepare($sql);                        
			$stmt->bindParam(':titulo', $data->titulo, PDO::PARAM_STR); 
			$stmt->bindParam(':sipnosis', $data->sipnosis, PDO::PARAM_STR); 
			$stmt->bindParam(':ano', $data->ano, PDO::PARAM_INT);
			$stmt->bindParam(':id', $data->id, PDO::PARAM_INT);
			if( $stmt->execute() ){
				return array( 'error'=>false,
					'ID' => $data->id );
			}
			else{
				$vErrores = $stmt->errorInfo();
				return array(
					'error'=>true,
					'message' => $vErrores[0].'|'.$vErrores[1].'|'.$vErrores[2]
				);
			}
		}
		catch(PDOException $e){
            return array('error'=>true,
				'message' => $e->getMessage() );
        }
	}



	public function eliminar( $data ){
		try{
			$sql = "DELETE FROM peliculas WHERE id=:id ";                              
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id', $data->id, PDO::PARAM_INT);
			if( $stmt->execute() ){
				return array( 'error'=>false,
					'ID' => $data->id );
			}
			else{
				$vErrores = $stmt->errorInfo();
				return array(
					'error'=>true,
					'message' => $vErrores[0].'|'.$vErrores[1].'|'.$vErrores[2]
				);
			}
		}
		catch(PDOException $e){
            return array('error'=>true,
				'message' => $e->getMessage() );
        }
	}

}
?>