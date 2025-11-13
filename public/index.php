<?php

/**
 * index.php
 * ---------
 * Este archivo actúa como un punto de entrada sencillo para la versión web del chatbot.
 *
 * Su función principal es:
 * - Cargar la configuración y dependencias del proyecto.
 * - Recibir la pregunta enviada desde el formulario.
 * - Enviar esa pregunta al servicio de IA para obtener una respuesta.
 * - Pasar los datos a la vista encargada de mostrar el formulario y la respuesta.
 *
 * Aquí no se incluye HTML; solo se maneja el flujo entre la vista y la lógica.
 */

// Carga la aplicación y obtiene una instancia del servicio configurado
$app = require __DIR__ . '/../bootstrap.php';

// Variables que se enviarán a la vista
$question = $_POST['question'] ?? '';
$answer = '';

// Si el formulario fue enviado y contiene una pregunta, se consulta a la IA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($question)) {
    $answer = $app->obtenerRespuesta($question);
}

// Cargar la vista del chatbot (formulario + respuesta)
require __DIR__ . '/../views/chat.php';
