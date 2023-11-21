<?php //clase paciente que hereda de Conexión
namespace Clases;
use PDO;
use PDOException;


class Paciente extends Conexion
{

    private string $DNI;
    private string $nombre;
    private string $apellidos;
    private string $fecha_nacimiento;
    private string $telefono;

    

    public function listarPacientes()
    {
        $consulta="select * from paciente";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;   
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function datosPaciente($DNI)
    {
        $consulta="select * from paciente where DNI=?";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([$DNI]);
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;   
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function comprobarDNILibre($DNI) //método para comprobar si el dni está disponible
    {
        $consulta = "select DNI from paciente where DNI= ?";
        $stmt = $this->conexion->prepare($consulta);

        try {
            $stmt->execute([$DNI]);
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;

        if ($stmt->fetchAll(PDO::FETCH_OBJ)) {
            return false;
        } else {
            return true;
        }
    }

    public function insertarPaciente(Paciente $paciente)
    {
    $consulta = "insert into paciente(DNI,nombre,apellidos,fecha_nacimiento,telefono)
        values (?,?,?,?,?)";
    $stmt = $this->conexion->prepare($consulta);
    try {
        $stmt->execute(array(
            $paciente->getDNI(),
            $paciente->getNombre(),
            $paciente->getApellidos(),
            $paciente->getFecha_nacimiento(),
            $paciente->getTelefono(),

        ));
    } catch (PDOException $ex) {
        die("Error al recuperar: " . $ex->getMessage());
    }
    $this->conexion = null;

    }

    public function modificarPaciente($nombre, $apellidos, $fecha_nacimiento, $telefono, $DNI)
    {

        $consulta = "UPDATE `paciente` SET `nombre` = ?,`apellidos` = ?,`fecha_nacimiento` = ?,`telefono` = ? WHERE `DNI` = ?";
        try {
            $arrParams = array($nombre, $apellidos, $fecha_nacimiento, $telefono, $DNI);
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute($arrParams);
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;
    }


    public function eliminarPaciente($DNI)
    {
        $consulta = "DELETE from `paciente` WHERE `DNI` = ?";
        try {
            $arrayParams = array($DNI);
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute($arrayParams);
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;

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

    /**
     * Get the value of fecha_nacimiento
     */ 
    public function getFecha_nacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * Set the value of fecha_nacimiento
     *
     * @return  self
     */ 
    public function setFecha_nacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }
}