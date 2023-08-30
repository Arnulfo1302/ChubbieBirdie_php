<?php
class Elemento {
    public $id;
    public $nombre;
    public $anho;
    public $descripcion;
    public $url;
    public $grupo;
    public $orden;

    public function __construct($id,$nombre, $ano, $descripcion, $url, $grupo, $orden) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->anho = $ano;
        $this->descripcion = $descripcion;
        $this->url = $url;
        $this->grupo = $grupo;
        $this->orden = $orden;
    }
}

