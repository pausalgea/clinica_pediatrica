<?php //clase Factura que hereda de Conexión
namespace Clases;
use DateTime;
use PDO;
use PDOException;


class Factura extends Conexion
{

    private int $n_factura;
    private float $importe;
    private string $fecha;

    private int $id_consulta;

    public function datosFactura($id)
    {
        $consulta="select id_consulta,max(n_factura) as n_factura,importe,fecha from factura where id_consulta=?";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([$id]);
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;   
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function insertarFactura(Factura $fac)
    {
        $sentencia_asegurado="select * from asegurado where dni in (select dni from consulta where id_consulta=?)";

        $stmt = $this->conexion->prepare($sentencia_asegurado);
        try {
            $stmt->execute([$fac->getId_consulta()]);
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $filas=$stmt->rowCount();

        if($filas>0)
        {
    
    
            $this->setImporte(30.0);
        }
        else
        {
            $this->setImporte(80.0);
        }
  

        $consulta = "insert into factura(importe,fecha,id_consulta)
        values (?,?,?)";


        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute(array(
                $this->getImporte(),
                $fac->getFecha(),
                $fac->getId_consulta()


            ));
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;
        }





    /**
     * Get the value of n_factura
     */ 
    public function getN_factura()
    {
        return $this->n_factura;
    }

    /**
     * Set the value of n_factura
     *
     * @return  self
     */ 
    public function setN_factura($n_factura)
    {
        $this->n_factura = $n_factura;

        return $this;
    }

    /**
     * Get the value of importe
     */ 
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set the value of importe
     *
     * @return  self
     */ 
    public function setImporte($importe)
    {
        $this->importe = $importe;

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
     * Get the value of id_consulta
     */ 
    public function getId_consulta()
    {
        return $this->id_consulta;
    }

    /**
     * Set the value of id_consulta
     *
     * @return  self
     */ 
    public function setId_consulta($id_consulta)
    {
        $this->id_consulta = $id_consulta;

        return $this;
    }
}