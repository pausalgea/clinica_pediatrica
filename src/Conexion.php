<?php
//Clase Conexión.php realizada por Paula Salicio
//con esta clase nos vamos a conectar a la base de datos todas las demas clases del modelo heredarán de ella
//si quisieramos cambiar la configuración de la base de datos lo haremos en este fichero
namespace Clases;
use PDO;
use PDOException;

class Conexion
{
    private $host; //atributos de conexion
    private $db;
    private $user;
    private $pass;
    private $dsn;
    protected $conexion;

    public function __construct() //constructor
    {
        $this->host = "localhost";
        $this->db = "clinica";
        $this->user = "root";
        $this->pass = "paula";
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        $this->conexion=$this->crearConexion();
    }

    public function crearConexion() //funcion crearConexion
    {
        try {
            $conexion = new PDO($this->dsn, $this->user, $this->pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
        
        return $conexion;
    }
    function cerrar(&$con){ //funcion cerrar conexion
        $con = null;
        }
    /**
     * Summary of cerrarTodo
     * @param mixed $con
     * @param mixed $st
     * @return void
     */
    function cerrarTodo(&$con, &$st){
        $st = null;
        $con = null;
        }
}



