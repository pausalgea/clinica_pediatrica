<?php //clase Asegurado que hereda de Paciente
namespace Clases;
use PDO;
use PDOException;


class Asegurado extends Paciente
{
    private string $DNI;
    private string $N_Seguro;

    
    public function insertarAsegurado(Asegurado $aseg)
    {
        $consulta = "insert into asegurado(N_Seguro,DNI)
        values (?,?)";
    $stmt = $this->conexion->prepare($consulta);
    try {
        $stmt->execute(array(
            $aseg->getN_Seguro(),
            $aseg->getDNI(),


        ));
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
     * Get the value of N_Seguro
     */ 
    public function getN_Seguro()
    {
        return $this->N_Seguro;
    }

    /**
     * Set the value of N_Seguro
     *
     * @return  self
     */ 
    public function setN_Seguro($N_Seguro)
    {
        $this->N_Seguro = $N_Seguro;

        return $this;
    }
}