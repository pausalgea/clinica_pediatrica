<?php //clase Medico que hereda de Conexión realizada por Paula Salicio
namespace Clases;
use DateTime;
use PDO;
use PDOException;


class Medico extends Conexion
{
    private string $login; //atributos médicos
    private ?string $DNI="";
    private string $nombre;
    private string $apellidos;

    public function __construct() //constructor
    {
        parent::__construct();
    }

    public function insertarMedico(Medico $medico) //insert
    {
        $sentencia = "insert into medico(login,DNI,nombre,apellidos)
        values (?,?,?,?)";

        $stmt = $this->conexion->prepare($sentencia);
        try {
            $stmt->execute(array(
                $medico->getLogin(),
                $medico->getDNI(),
                $medico->getNombre(),
                $medico->getApellidos(),

            ));

        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;
    }

    public function datosMedico($login_medico) //select datos medico a partir del login
    {
        $consulta="select * from medico where login=?";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([$login_medico]);
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;   
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    

    //getters y setters de atributos
    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of DNI
     */ 
    public function getDNI()
    {
        return $this->DNI;
    }

    /**
     * Set the value of DNI
     *
     * @return  self
     */ 
    public function setDNI($DNI)
    {
        $this->DNI = $DNI;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }
}
