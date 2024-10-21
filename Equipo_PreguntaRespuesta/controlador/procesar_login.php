<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/PreguntasRespuestas/modelo/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clave = $_POST['clave'];
    $error = '';

    // Si el botón 'Alumno' fue presionado La contraseña es la Matricula
    if (isset($_POST['alumno'])) {
        $sql = "SELECT Id_Usu, Nombre_Usu, Matricula_Usu FROM Usuario WHERE Matricula_Usu = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $clave);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Login exitoso de Alumno
            $usuario = $result->fetch_assoc();
            $_SESSION['user_id'] = $usuario['Id_Usu'];
            $_SESSION['user_type'] = 'alumno'; // Guardamos el tipo de usuario
            header("Location: /prueba_preguntarespuesta/Equipo_PreguntaRespuesta/preguntas.php"); // Redirigir al formulario de alumno
            exit();
        } else {
            $error = "Matricula es incorrecta para alumno.";
        }
    }

    // Si el botón 'Expositor' fue presionado La contraseña es la 2 primera letras del nombre y la dos primeras letra del tema
if (isset($_POST['expositor'])) {
    // Obtener las primeras 2 letras de Nombre_ponente y Tema_ponente
    $nombre_prefix = substr($clave, 0, 2); // Primeras 2 letras de Nombre_ponente
    $tema_prefix = substr($clave, 2, 2); // Segunda parte de 2 letras para Tema_ponente

    // Consulta para verificar el expositor
    $sql = "SELECT id_ponente, Nombre_ponente, Tema_ponente 
            FROM ponentes 
            WHERE Nombre_ponente LIKE CONCAT(?, '%') 
              AND Tema_ponente LIKE CONCAT(?, '%')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre_prefix, $tema_prefix);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Login exitoso de Expositor
        $tema = $result->fetch_assoc();
        $_SESSION['id_ponente'] = $tema['id_ponente']; // Guardar el ID del ponente
        $_SESSION['tema_ponente'] = $tema['Tema_ponente'];
        $_SESSION['user_type'] = 'expositor'; // Guardamos el tipo de usuari
        header("Location: /prueba_preguntarespuesta/Equipo_PreguntaRespuesta/ContenedorPregunta.php"); // Redirigir al formulario de expositor
        exit();
    } else {
        $error = "No se encontró un expositor con las letras ingresadas.";
    }
}


    // Guardar el mensaje de error en la sesión
    $_SESSION['login_error'] = $error;
    header("Location: /prueba_preguntarespuesta/Equipo_PreguntaRespuesta/login.php");
    exit();
}
?>
