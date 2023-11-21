<?php //clase Asegurado que hereda de Paciente
namespace Clases;
use PDO;
use PDOException;


class No_Asegurado extends Paciente
{
    private string $DNI;
    private string $N_Seguridad_Social;



    public function insertarNoAsegurado(No_Asegurado $no_aseg)
    {
        $consulta = "insert into no_asegurado(N_Seguridad_Social,DNI)
        values (?,?)";
    $stmt = $this->conexion->prepare($consulta);
    try {
        $stmt->execute(array(
            $no_aseg->getN_Seguridad_Social(),
            $no_aseg->getDNI(),


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
     * Get the value of N_Seguridad_Social
     */ 
    public function getN_Seguridad_Social()
    {
        return $this->N_Seguridad_Social;
    }

    /**
     * Set the value of N_Seguridad_Social
     *
     * @return  self
     */ 
    public function setN_Seguridad_Social($N_Seguridad_Social)
    {
        $this->N_Seguridad_Social = $N_Seguridad_Social;

        return $this;
    }
}