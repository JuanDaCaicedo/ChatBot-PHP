<?php 
$app = require __DIR__ . '/../bootstrap.php';

$question = $_POST['question'] ?? null;
$answer = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $question) {
    $answer = $app->obtenerRespuesta($question);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <form method="post" class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">

        <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">🤖 ChatBot</h1>

        <label for="question" class="block font-medium text-gray-700 mb-1">Pregunta</label>
        <input 
            type="text" 
            name="question" 
            value="<?= htmlspecialchars($question) ?>" 
            required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
        >

        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
        >
            Enviar pregunta
        </button>

        <div class="mt-6">
            <label class="block font-medium text-gray-700 mb-1">Respuesta</label>
            <textarea 
                cols="60" 
                rows="6"
                class="w-full px-4 py-2 border rounded-lg bg-gray-50 focus:outline-none resize-none"
            ><?= htmlspecialchars($answer) ?></textarea>
        </div>

    </form>

</body>
</html>
