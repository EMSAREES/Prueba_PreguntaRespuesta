<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/PreguntasRespuestas/modelo/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clave = $_POST['clave'];
    $error = '';

    // Si el botón 'Alumno' fue presionado
    if (isset($_POST['alumno'])) {
        $sql = "SELECT Id_Usu, Nombre_Usu, Contrasena_Usu FROM Usuario WHERE Contrasena_Usu = ?";
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
            $error = "Contraseña incorrecta para alumno.";
        }
    }

    // Si el botón 'Expositor' fue presionado
    if (isset($_POST['expositor'])) {
        $sql = "SELECT Id_Tema, Nombre, Clave FROM Tema WHERE Clave = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $clave);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Login exitoso de Expositor
            $tema = $result->fetch_assoc();
            $_SESSION['tema_id'] = $tema['Id_Tema'];
            $_SESSION['user_type'] = 'expositor'; // Guardamos el tipo de usuario
            header("Location: /prueba_preguntarespuesta/Equipo_PreguntaRespuesta/ContenedorPregunta.php"); // Redirigir al formulario de expositor
            exit();
        } else {
            $error = "Clave incorrecta para expositor.";
        }
    }

    // Guardar el mensaje de error en la sesión
    $_SESSION['login_error'] = $error;
    header("Location: /PreguntasRespuestas/login.php");
    exit();
}
?>
