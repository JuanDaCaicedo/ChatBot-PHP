<?php 

/**
 * bootstrap.php
 * --------------
 * Archivo encargado de inicializar los componentes principales del proyecto.
 *
 * Se ocupa de:
 * - Cargar automáticamente las clases mediante Composer.
 * - Importar las variables del archivo .env (API Key, modelo, etc.).
 * - Crear la instancia del servicio de IA que usará el chatbot.
 * - Retornar un objeto Chat listo para ejecutarse.
 *
 * Aquí puedes cambiar fácilmente entre la IA real (OpenRouter)
 * y la IA falsa (para pruebas locales).
 */

// Carga automática de clases usando Composer
require __DIR__ . '/vendor/autoload.php';

use App\ServicioIA;
use App\iaFalsa;
use Dotenv\Dotenv;

// Cargar archivo .env (API Key, modelo, etc.)
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * Seleccionar qué servicio usar:
 * 
 * IA REAL (OpenRouter):
 *     $servicioIA = new ServicioIA();
 * 
 * IA FALSA (para pruebas sin API):
 *     $servicioIA = new iaFalsa();
 */

// 👉 Cambia ESTA línea según lo que quieras probar:

$servicioIA = new ServicioIA();   // ← IA real
// $servicioIA = new iaFalsa();   // ← IA falsa (para pruebas)

// Retornar una instancia de Chat usando el servicio seleccionado
return new App\Chat($servicioIA);
