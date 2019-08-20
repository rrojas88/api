<?php
class BD{
    public $conexion;
 
    // get the database connection
    public function conectarme($db_usuario,$db_password,$db_host,$db_name){
 
        $this->conexion = null;
 
        try{
            $this->conexion = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_usuario, $db_password);
            $this->conexion->exec("set names utf8");
        }
        catch(PDOException $e){
            echo "Error conectando: " . $e->getMessage();
        }
 
        return $this->conexion;
    }
}
?>