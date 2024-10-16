<?php

/*// Comprobar si el usuario ha iniciado sesión
if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'alumno') {
    $user_id = $_SESSION['user_id'];
    // Aquí puedes usar $user_id como necesites en el formulario
    echo "Bienvenido, tu ID de usuario es: " . $user_id;
} else {
    // Si no está iniciada la sesión o no es alumno, redirigir al login
    header("Location: login.php");
    exit();
}*/

session_start(); // Asegúrate de iniciar la sesión al principio

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'alumno') {
    header("Location: login.php");
    exit();
}


//include '../modelo/conexion.php'; // Asegúrate de que la ruta es correcta
include($_SERVER['DOCUMENT_ROOT'] . '/prueba_preguntarespuesta/Equipo_PreguntaRespuesta/modelo/conexion.php');

// Simulación de inicio de sesión
//$_SESSION['user_id'] = 1; // Cambia esto según el usuario que haya iniciado sesión

// Obtener el ID del usuario que ha iniciado sesión
$user_id = $_SESSION['user_id'];

// Obtener el nombre del usuario que ha iniciado sesión
$sql = "SELECT Nombre_Usu FROM usuario WHERE Id_Usu = $user_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user_name = $result->fetch_assoc()['Nombre_Usu'];
} else {
    echo "Error: No se pudo obtener el nombre del usuario.";
    exit;
}

// Crear un array con "Anónimo" y el nombre del usuario logueado
$autores = ['Anonimo', $user_name];

// Obtener el nombre del usuario que ha iniciado sesión
$sql = "SELECT Tema_ponente FROM ponentes";
$result = $conn->query($sql);

$expositores = []; // Inicializamos el array

if ($result && $result->num_rows > 0) {
    //Rellenar el array con los nombres de los expositores
    while ($row = $result->fetch_assoc()) {
        $expositores[] = $row['Tema_ponente'];
    }
} else {
    echo "Error: No se pudieron obtener los temas.";
    exit;
}

// Verificar si el formulario fue enviado
if (isset($_POST['btnAceptar'])) {
    $autor = $_POST['autor'];
    $pregunta = $_POST['Preguntatext'];
    $expositor = $_POST['expositor'];
    $contexto = $_POST['textContexto'] ?? null; // Usar textarea para contexto

    // Validar que se seleccionó un expositor
    if (empty($expositor) || $expositor == "Elige un expositor") { // Asegurarse de que se seleccione un expositor válido
        echo "Error: Debes seleccionar un expositor válido.";
        exit();
    }

    // Obtener la fecha y hora actuales
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');

    // Insertar los datos en la tabla tbl_Pregunta
    $sql = "INSERT INTO pregunta (Id_Autor, id_Tema, Pregunta, Contexto, Hora, Fecha, Estado) 
            VALUES ((SELECT Id_Usu FROM usuario WHERE Nombre_Usu = ?), 
                    (SELECT id_ponente FROM ponentes WHERE Tema_ponente = ?),
                    ?, ?, ?, ?, 1)";

    $stmt = $conn->prepare($sql);

    // **Aquí está el problema:** falta el parámetro 'Fecha'
    // Debe ser incluido para hacer match con la cantidad de parámetros.
    $stmt->bind_param("ssssss", $autor, $expositor, $pregunta, $contexto, $hora, $fecha); // Ahora hay 6

    if ($stmt->execute()) {
        echo "Pregunta guardada correctamente.";
    } else {
        echo "Error al guardar la pregunta: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redirigir al usuario a la página principal o de confirmación
    header("Location: /PreguntasRespuestas/preguntas.php");
    exit();
}

// Manejar el botón de cancelar
if (isset($_POST['btnCancelar'])) {
    header("Location: login.php"); // Redirigir a login.php si se cancela
    exit();
}
// Cerrar la conexión
$conn->close();
?>
