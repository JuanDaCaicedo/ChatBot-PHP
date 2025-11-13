<?php

namespace App;

use GuzzleHttp\Client;

/**
 * Clase ServicioIA
 * -----------------
 * Este servicio es el encargado de comunicarse con la API de OpenRouter
 * para enviar la pregunta del usuario y recibir la respuesta del modelo.
 *
 * La idea es mantener aquí TODA la lógica relacionada con la IA,
 * de forma que el resto del proyecto (chat, controladores, vistas)
 * no tenga que preocuparse por peticiones HTTP ni configuraciones.
 */
class ServicioIA implements ServicioIaInterface
{
    /**
     * @var Client Cliente HTTP usado para hacer las peticiones a OpenRouter.
     */
    protected $cliente;

    /**
     * Constructor
     * -----------
     * Configura el cliente HTTP usando Guzzle y carga los headers necesarios.
     * La API Key y el modelo se sacan del archivo .env para evitar subirlas al repositorio.
     */
    public function __construct()
    {
        $this->cliente = new Client([
            'base_uri' => 'https://openrouter.ai/api/v1/',
            'headers' => [
                // La API Key viene del archivo .env (segura, no se sube a GitHub)
                'Authorization' => 'Bearer ' . $_ENV['OPENROUTER_API_KEY'],

                'Content-Type' => 'application/json',

                // OpenRouter exige ambos headers para identificar desde dónde se hace la llamada
                'HTTP-Referer' => 'http://localhost',
                'X-Title'     => 'ChatBot PHP',
            ],
        ]);
    }

    /**
     * obtenerRespuesta
     * ----------------
     * Envía la pregunta escrita por el usuario al modelo de IA seleccionado
     * (o usa un modelo por defecto si no se especifica en el .env).
     *
     * @param string $pregunta Texto que escribió el usuario.
     * @return string Respuesta generada por la IA.
     */
    public function obtenerRespuesta(string $pregunta): string
    {
        // El modelo también se guarda en .env para poder cambiarlo fácilmente
        $modelo = $_ENV['OPENROUTER_MODEL'] ?? 'mistralai/mixtral-8x7b-instruct';

        // Realizamos la petición POST al endpoint de OpenRouter
        $resultado = $this->cliente->post('chat/completions', [
            'json' => [
                'model' => $modelo,

                // Conversación enviada al modelo
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => <<<EOT
                        Eres un asistente que responde de forma breve, clara y directa.
                        - Evita rodeos, explicaciones largas o información innecesaria.
                        - Resume siempre lo más importante.
                        - Si el usuario necesita pasos, dales de manera corta y precisa.
                        - Si la pregunta es muy amplia, pide que la especifique.
EOT
                    ],

                    [
                        'role' => 'user',
                        'content' => $pregunta,
                    ],
                ],
            ],
        ]);

        // Convertimos la respuesta JSON en un arreglo asociativo
        $body = json_decode($resultado->getBody(), true);

        // Retornamos el mensaje del modelo o un mensaje de error si no llega nada
        return $body['choices'][0]['message']['content']
            ?? 'No se recibió respuesta del modelo.';
    }
}
