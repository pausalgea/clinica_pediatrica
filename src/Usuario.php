<?php //clase Usuario que hereda de Conexión realizada por Paula Salicio
namespace Clases;
use PDO;
use PDOException;


class Usuario extends Conexion
{
    private $login; //atributos
    private $password;
    private $tipo;

    private $nombre;
    private $apellidos;

    private $DNI;


    public function __construct() //constructor
    {
        parent::__construct();
    }

    

    //los métodos setters y getters están creados al final de la clase

    public function listadoUsuarios() //método para mostrar los usuarios, es un select a la bbdd
    {
        $consulta = "select * from usuario";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;   
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    

    public function comprobarLoginYPassword($login,$password) //método para comprobar el login y password si son correctos
    {
        $consulta = "select login,password from usuario where login=:l and password=:p";
        $stmt = $this->conexion->prepare($consulta);

        try {
            $stmt->execute([
                ':l' => $login,
                ':p' => $password]);
            
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

    public function tipoUsuario($login) //obtenemos el tipo de usuario
    {
        $consulta = "select tipo from usuario where login= ?";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([$login]);
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;   
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    public function comprobarLoginLibre($login) //método para comprobar si el login está disponible
    {
        $consulta = "select login from usuario where login= ?";
        $stmt = $this->conexion->prepare($consulta);

        try {
            $stmt->execute([$login]);
            
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

    public function insertarUsuario(Usuario $usuario) //método para realizar la inserción del objeto de clase Usuario en la bbdd
    {
        
        $consulta = "insert into usuario(login,password,tipo,nombre,apellidos,DNI)
        values (?,?,?,?,?,?)";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute(array(
                $usuario->getLogin(),
                $usuario->getPassword(),
                $usuario->getTipo(),
                $usuario->getNombre(),
                $usuario->getApellidos(),
                $usuario->getDNI()

            ));
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;
        

    }
    public function modificarUsuario($password,$tipo,$nombre,$apellidos,$DNI,$login) //metodo para modificar usuario update
    {

        $consulta="UPDATE `usuario` SET `password` = ?, `tipo` = ?, `nombre`=?, `apellidos`=?, `DNI`=? WHERE `login` = ?";
        
        try {
            $arrParams=array($password,$tipo,$nombre,$apellidos,$DNI,$login);
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute($arrParams);

            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;
    }

    public function eliminarUsuario($login) //metodo para eliminar un usuario
    {
        $consulta="DELETE from `usuario` WHERE `login` = ?";
        try{
            $arrayParams=array($login);
            $stmt=$this->conexion->prepare($consulta);
            $stmt->execute($arrayParams);
        }catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;

    }

    public function listadoMedicos() //listado de los usuario que son médicos
    {
        $consulta = "select * from usuario where tipo='médico'";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
            
        } catch (PDOException $ex) {
            die("Error al recuperar: " . $ex->getMessage());
        }
        $this->conexion = null;   
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }



    //a continuación métodos setters y getters generados automaticamente con visualstudio
    

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
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

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
?>