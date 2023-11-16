<?php //clase Consulta que hereda de Conexión
namespace Clases;
use DateTime;
use PDO;
use PDOException;


class Consulta extends Conexion
{
    private int $id;
    private string $fecha;
    private string $hora;
    private string $login_medico;
    private string $DNI;

    public function __construct() //constructor
    {
        parent::__construct();
    }

    public function listadoConsultas() //método para mostrar los consultas, es un select a la bbdd
    {
        $ahora=new DateTime();
        $unaSemanaMas = date('Y-m-d'  , strtotime("+1 week"));
        $sentencia = "select * from consulta where fecha between '".date_format($ahora, 'Y-m-d')."' and '".$unaSemanaMas."' order by fecha,hora";

        $stmt = $this->conexion->prepare($sentencia);
        try {
            $stmt->execute();
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;   
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function listadoConsultasMedico($login_medico) //método para mostrar los consultas, es un select a la bbdd
    {
        $ahora = new DateTime();
        $unaSemanaMas = date('Y-m-d', strtotime("+1 week"));
        $sentencia = "select * from consulta where fecha between '" . date_format($ahora, 'Y-m-d') . "' and '" . $unaSemanaMas . "' and login_medico=:l order by fecha,hora";
        $stmt = $this->conexion->prepare($sentencia);
        try {
            $stmt->execute([
                ':l'=>$login_medico
            ]);
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    

    public function comprobarConsultaLibre($fecha,$hora) //método para comprobar si el login está disponible
    {
        $consulta = "select fecha,hora from consulta where fecha=:f and hora= :h";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':f' => $fecha,
                ':h' => $hora]);
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;
        
        if($stmt->fetchAll(PDO::FETCH_OBJ))
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    public function insertarConsulta(Consulta $consulta) //método para realizar la inserción del objeto de clase consulta en la bbdd
    {
        
        $sentencia = "insert into consulta(fecha,hora,login_medico,DNI)
        values (?,?,?,?)";


        $stmt = $this->conexion->prepare($sentencia);
        try {
            $stmt->execute(array(
                $consulta->getFecha(),
                $consulta->getHora(),
                $consulta->getLogin_medico(),
                $consulta->getDNI(),

            ));

        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;
        

    }
    public function modificarConsulta($fecha,$hora,$login_medico,$DNI,$id)
    {

        $consulta="UPDATE `consulta` SET `fecha` = ?,`hora` = ?,`login_medico` = ?,`DNI` = ? WHERE `id_consulta` = ?";
        try {
            $arrParams=array($fecha,$hora,$login_medico,$DNI,$id);
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute($arrParams);

            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;
    }

    public function eliminarConsulta($id)
    {
        $consulta="DELETE from `consulta` WHERE `id_consulta` = ?";
        try{
            $arrayParams=array($id);
            $stmt=$this->conexion->prepare($consulta);
            $stmt->execute($arrayParams);
        }catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;

    }
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Get the value of login_medico
     */ 
    public function getLogin_medico()
    {
        return $this->login_medico;
    }

    /**
     * Set the value of login_medico
     *
     * @return  self
     */ 
    public function setLogin_medico($login_medico)
    {
        $this->login_medico = $login_medico;

        return $this;
    }





    /**
     * Get the value of hora
     */ 
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */ 
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

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
}