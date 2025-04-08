<?php

class loginclientemodel
{
    private static $instancia = null;
    private $idCliente;

    private function __construct()
    {
        // Private constructor to prevent direct instantiation
    }

    public static function getInstancia()
    {
        if (self::$instancia === null) {
            self::$instancia = new loginclientemodel();
        }
        return self::$instancia;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }
}
?>