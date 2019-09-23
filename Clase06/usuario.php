<?php
class usuario
{
    public $id;
    public $nombre;
    public $apellido;
    public $clave;
    public $perfil;
    public $estado;
    public $correo;

    public function MostrarDatos()
    {
        return $this->id." - ".$this->nombre." - ".$this->apellido." - ".$this->clave." - ".$this->perfil." - ".$this->estado." - ".$this->correo;
    }

    public static function TraerTodosLosUsuarios()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT `id`, `nombre`, `apellido`, `clave`, `perfil`, `estado`, `correo` FROM `usuarios` WHERE 1");        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new usuario);                                                

        return $consulta; 
    }

    public function ExisteEnBD($correo,$clave)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM `usuarios` WHERE `clave` = :clave && `correo` = :correo");        
        $consulta->bindValue(":clave",$clave,PDO::PARAM_STR);
        $consulta->bindValue(":correo",$correo,PDO::PARAM_STR);
        $consulta->execute();
        if($consulta->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}