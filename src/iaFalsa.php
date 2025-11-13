<?php

namespace App;

/**
 * Clase iaFalsa
 *
 * Implementa ServicioIaInterface para poder intercambiarla fácilmente
 * con la clase ServicioIA real. Esto permite hacer pruebas completas
 * sin consumir una API externa.
 *
 * Esta clase es ideal para:
 * - Probar el flujo entre vista (consola o web) y lógica.
 * - Validar que Chat.php funciona correctamente.
 * - Hacer tests sin conexión a Internet.
 *
 * Su comportamiento es simple y predecible:
 *  - Si la pregunta contiene "PHP", devuelve la misma frase como eco.
 *  - Si contiene "Hola", responde con un saludo.
 *  - En cualquier otro caso, indica que solo responde sobre PHP.
 */
class iaFalsa implements ServicioIaInterface
{
    /**
     * Genera una respuesta falsa para pruebas.
     *
     * @param string $pregunta Pregunta ingresada por el usuario.
     * @return string Respuesta simulada.
     */
    public function obtenerRespuesta(string $pregunta): string
    {
        // Simula un pequeño tiempo de procesamiento
        sleep(1);

        // Respuestas básicas
        if (stripos($pregunta, 'PHP') !== false) {
            return 'IA (Prueba): ' . $pregunta;

        } elseif (stripos($pregunta, 'Hola') !== false) {
            return 'IA (Prueba): ¿Cómo estás?';

        } else {
            return 'IA (Prueba): Solo puedo responder preguntas relacionadas con PHP.';
        }
    }
}

?>
