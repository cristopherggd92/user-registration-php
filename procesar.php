<?php

// Evita que el archivo procese información cuando se abre directamente por GET.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

// Captura de datos con valores predeterminados para evitar índices inexistentes.
$nombre = trim($_POST["nombre"] ?? "");
$edad = trim($_POST["edad"] ?? "");
$correo = trim($_POST["correo"] ?? "");
$pais = trim($_POST["pais"] ?? "");

$errores = [];

// Validaciones del lado del servidor.
if (empty($nombre)) {
    $errores[] = "El nombre es obligatorio.";
}

if (empty($edad)) {
    $errores[] = "La edad es obligatoria.";
} elseif (filter_var($edad, FILTER_VALIDATE_INT) === false || $edad < 1 || $edad > 120) {
    $errores[] = "La edad debe ser un número entero entre 1 y 120.";
}

if (empty($correo)) {
    $errores[] = "El correo electrónico es obligatorio.";
} elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El formato del correo electrónico no es válido.";
}

$informacionPaises = [
    "mexico" => [
        "nombre" => "México",
        "mensaje" => "¡Saludos desde México! Su capital es Ciudad de México."
    ],
    "canada" => [
        "nombre" => "Canadá",
        "mensaje" => "Seleccionaste Canadá. Su capital es Ottawa."
    ],
    "colombia" => [
        "nombre" => "Colombia",
        "mensaje" => "Seleccionaste Colombia. Su capital es Bogotá."
    ],
    "espana" => [
        "nombre" => "España",
        "mensaje" => "Seleccionaste España. Su capital es Madrid."
    ],
    "estados_unidos" => [
        "nombre" => "Estados Unidos",
        "mensaje" => "Seleccionaste Estados Unidos. Su capital es Washington D. C."
    ]
];

if (empty($pais)) {
    $errores[] = "Debes seleccionar un país.";
} elseif (!array_key_exists($pais, $informacionPaises)) {
    $errores[] = "El país seleccionado no es válido.";
}

// Convierte contenido externo en texto seguro antes de mostrarlo en HTML.
function escapar($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}

// Función solicitada: recibe el nombre y devuelve una respuesta personalizada.
function generarMensajePersonalizado($nombre)
{
    return "Hola, " . $nombre . ". Tus datos fueron procesados correctamente.";
}

$mensajes = [];

if (empty($errores)) {
    $edad = (int) $edad;

    $mensajes[] = generarMensajePersonalizado($nombre);
    $mensajes[] = $edad >= 18
        ? "Validación de edad: eres una persona adulta."
        : "Validación de edad: eres una persona menor de edad.";
    $mensajes[] = $informacionPaises[$pais]["mensaje"];
    $mensajes[] = "El correo registrado es " . $correo . ".";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="contenedor">
        <section class="tarjeta" aria-labelledby="titulo-resultado">
            <p class="etiqueta-superior">Actividad 1 · Resultado dinámico</p>
            <h1 id="titulo-resultado">Resultado del procesamiento</h1>

            <?php if (!empty($errores)): ?>
                <p class="introduccion">No fue posible procesar el formulario.</p>

                <h2>Errores encontrados</h2>
                <ul class="errores">
                    <?php foreach ($errores as $error): ?>
                        <li><?php echo escapar($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="introduccion">
                    La solicitud POST fue recibida y procesada por el servidor.
                </p>

                <h2>Información capturada</h2>
                <table class="datos">
                    <tbody>
                        <tr>
                            <th scope="row">Nombre</th>
                            <td><?php echo escapar($nombre); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Edad</th>
                            <td><?php echo escapar($edad); ?> años</td>
                        </tr>
                        <tr>
                            <th scope="row">Correo</th>
                            <td><?php echo escapar($correo); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">País</th>
                            <td><?php echo escapar($informacionPaises[$pais]["nombre"]); ?></td>
                        </tr>
                    </tbody>
                </table>

                <h2>Mensajes generados dinámicamente</h2>
                <ul class="mensajes">
                    <?php foreach ($mensajes as $mensaje): ?>
                        <li><?php echo escapar($mensaje); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <a class="boton-secundario" href="index.html">Volver al formulario</a>
        </section>
    </main>
</body>
</html>
