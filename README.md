ChatBot en PHP

Este es un ChatBot construido en PHP que permite enviar preguntas a un modelo de inteligencia artificial usando OpenRouter.
El proyecto muestra cómo consumir una API externa, cómo separar la lógica de la vista y cómo manejar un flujo completo entre una interfaz web y un servicio backend.

El sistema puede ejecutarse desde un formulario web o desde la consola, y también incluye una IA falsa para hacer pruebas sin depender de servicios externos.

Características

Interfaz web para enviar preguntas.

Comunicación real con la API de OpenRouter.

Respuestas cortas, claras y directas.

Permite cambiar el modelo mediante variables de entorno.

Incluye una IA falsa para pruebas locales.

Compatible con modo web y modo consola.

Tecnologías utilizadas

PHP 8+

Composer

GuzzleHttp

Dotenv

TailwindCSS

OpenRouter API

Estructura del proyecto
├── bin/
│   └── ai               # ChatBot en modo consola
├── public/
│   └── index.php        # Entrada del modo web
├── src/
│   ├── Chat.php         # Lógica del chatbot para consola
│   ├── ServicioIA.php   # Servicio que llama a OpenRouter
│   ├── iaFalsa.php      # IA falsa para pruebas sin internet
│   └── ServicioIaInterface.php
├── views/
│   └── chat.php         # Vista del formulario web
├── bootstrap.php        # Configuración del proyecto
├── composer.json
└── .env                 # Variables de entorno

Instalación
1. Clonar el repositorio
git clone https://github.com/tuusuario/turepo.git

2. Instalar dependencias
composer install

3. Crear el archivo .env
OPENROUTER_API_KEY="tu_api_key"
OPENROUTER_MODEL="mistralai/mixtral-8x7b-instruct"

4. Iniciar el servidor local
php -S localhost:8000 -t public

Uso en modo web

Abrir en el navegador:

http://localhost:8000

Uso en modo consola
php bin/ai

Cambiar entre IA real y IA falsa

En bootstrap.php cambia esta línea:

$servicioIA = new ServicioIA();   // IA real
// $servicioIA = new iaFalsa();   // IA falsa para pruebas

Nota final

Este proyecto nació como parte de un proceso de aprendizaje mientras realizaba un curso de PHP.
La idea fue aplicar los conceptos del curso en un caso real, integrando buenas prácticas, separación por capas y consumo de APIs externas.
El resultado es un proyecto sencillo, organizado y útil para continuar aprendiendo y ampliando funcionalidades en el futuro.