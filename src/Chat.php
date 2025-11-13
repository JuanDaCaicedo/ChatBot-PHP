<?php

namespace App;

use App\ServicioIA;
use App\ServicioIaInterface;

/**
 * Clase Chat
 * ----------
 * Esta clase representa una implementación del chatbot para ejecutarse
 * directamente desde la consola (modo CLI).
 *
 * Aunque actualmente existe también una versión web mediante formulario,
 * esta clase se conserva porque:
 * - Permite realizar pruebas rápidas desde la terminal.
 * - Ayuda a verificar el funcionamiento del servicio de IA sin abrir un navegador.
 * - Sirve como ejemplo práctico de inyección de dependencias.
 * - Puede reutilizarse en el futuro para crear herramientas en línea de comandos.
 *
 * Funcionalidad principal (solo modo consola):
 * - Mostrar un mensaje inicial.
 * - Leer preguntas escritas por el usuario.
 * - Enviar cada pregunta al servicio de IA.
 * - Mostrar la respuesta generada.
 * - Finalizar cuando se ingrese la palabra "exit".
 *
 * Esta clase opera únicamente por consola y no interviene en la versión web del chatbot.
 */
class Chat
{
    /**
     * @var ServicioIA Servicio encargado de comunicarse con la IA.
     */
    private ServicioIA $servicioIA;

    /**
     * Constructor
     * -----------
     * Recibe un objeto que implementa ServicioIaInterface.
     * Esto permite usar diferentes implementaciones del servicio de IA
     * sin modificar la lógica del chat.
     *
     * @param ServicioIaInterface $servicioIA Instancia del servicio de IA a utilizar.
     */
    public function __construct(ServicioIaInterface $servicioIA)
    {
        $this->servicioIA = $servicioIA;
    }

    /**
     * start()
     * -------
     * Inicia el ciclo de interacción en consola.
     * Continúa solicitando preguntas hasta que el usuario escriba "exit".
     */
    public function start()
    {
        $this->bienvenido();

        while ($pregunta = $this->prompt()) {

            if ($this->salir($pregunta)) {
                echo "Saliendo del chat...\n";
                break;
            }

            $respuesta = $this->obtenerRespuesta($pregunta);

            $this->output($respuesta);
        }
    }

    /**
     * Muestra un mensaje de bienvenida.
     */
    private function bienvenido()
    {
        echo "Hazme una pregunta :" . PHP_EOL;
    }

    /**
     * prompt()
     * --------
     * Lee una línea escrita por el usuario en la terminal.
     *
     * @return string|null Pregunta ingresada por el usuario.
     */
    private function prompt()
    {
        return readline("> ");
    }

    /**
     * salir()
     * -------
     * Verifica si el usuario desea finalizar el chat.
     *
     * @param string $pregunta Texto ingresado por el usuario.
     * @return bool True si se debe cerrar el chat.
     */
    private function salir($pregunta)
    {
        return $pregunta === 'exit';
    }

    /**
     * output()
     * --------
     * Muestra la respuesta generada por la IA.
     *
     * @param string $respuesta Respuesta devuelta por el modelo.
     */
    private function output($respuesta)
    {
        echo "\n🤖 Respuesta:\n$respuesta\n\n";
    }

    /**
     * obtenerRespuesta()
     * ------------------
     * Envía la pregunta al servicio de IA y retorna la respuesta recibida.
     *
     * @param string $pregunta Pregunta escrita por el usuario.
     * @return string Respuesta producida por la IA.
     */
    public function obtenerRespuesta($pregunta)
    {
        return $this->servicioIA->obtenerRespuesta($pregunta);
    }
}
