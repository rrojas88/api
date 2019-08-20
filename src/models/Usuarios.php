<?php

class Usuarios {
	private $con;

	public function __construct( $bd ){
		$this->con = $bd;
	}


	public function consultar(){
		$stmt = $this->con->query("SELECT * FROM usuarios");
		$registros = $stmt->fetchAll(PDO::FETCH_OBJ);
		return array(
			'error'=>false,
			'listado' => $registros
		);
	}


	public function consultarUno( $data ){
		try{
			$sql = "SELECT * FROM usuarios WHERE id=:id ";                              
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
			$sql = "INSERT INTO usuarios (nombre, nickname, contrasena) 
			VALUES (:nombre, :nickname, :contrasena)";
	                                          
			$stmt = $this->con->prepare($sql);                        
			$stmt->bindParam(':nombre', $data->nombre, PDO::PARAM_STR); 
			$stmt->bindParam(':nickname', $data->nickname, PDO::PARAM_STR); 
			$stmt->bindParam(':contrasena', $data->contrasena, PDO::PARAM_STR);
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


	public function consultarPorColumna( $data, $columna ){
		try{
			$sql = "SELECT * FROM usuarios WHERE ".$columna."=:".$columna." ";
			$stmt = $this->con->prepare($sql);
			if( $columna == 'nickname' )
				$stmt->bindParam(':nickname', $data->nickname, PDO::PARAM_STR);
			else // token
				$stmt->bindParam(':token', $data->token, PDO::PARAM_STR);

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


	public function actualizar( $data ){
		try{
			$sql = "UPDATE usuarios SET nombre=:nombre, nickname=:nickname, contrasena=:contrasena WHERE id=:id ";
			//echo '<pre>'; print_r($data); echo '</pre>';exit();
	                                          
			$stmt = $this->con->prepare($sql);                        
			$stmt->bindParam(':nombre', $data->nombre, PDO::PARAM_STR); 
			$stmt->bindParam(':nickname', $data->nickname, PDO::PARAM_STR); 
			$stmt->bindParam(':contrasena', $data->contrasena, PDO::PARAM_STR);
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
			$sql = "DELETE FROM usuarios WHERE id=:id ";                              
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





	


	public function logar( $data ){
		try{
			$sql = "SELECT * FROM usuarios WHERE nickname=:nickname 
				AND contrasena=:contrasena ";                              
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':nickname', $data->nickname, PDO::PARAM_STR);
			$stmt->bindParam(':contrasena', $data->contrasena, PDO::PARAM_STR);
			if( $stmt->execute() ){
				$registro = $stmt->fetch(PDO::FETCH_OBJ);
				if( $registro && $registro != NULL )
					return $this->actualizarToken( $registro );
				else
					return array( 'error'=>false,'registro' => false );
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


	public function actualizarToken( $data ){
		try{
			$token = sha1(time());

			$sql = "UPDATE usuarios SET token=:token WHERE id=:id ";         
			$stmt = $this->con->prepare($sql);                        
			$stmt->bindParam(':token', $token, PDO::PARAM_STR); 
			$stmt->bindParam(':id', $data->id, PDO::PARAM_INT);
			if( $stmt->execute() ){
				$data->token = $token;
				return array( 'error'=>false,
					'registro' => $data );
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