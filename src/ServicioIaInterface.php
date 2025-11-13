<?php 

    namespace App;

    interface ServicioIaInterface{
        public function obtenerRespuesta (string $pregunta):string;
    }