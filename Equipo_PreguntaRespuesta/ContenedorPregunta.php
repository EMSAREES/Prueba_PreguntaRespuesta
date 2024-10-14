<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pregunta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="/PreguntasRespuestas/css/contenedorpregunta.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<!-- Parte de Ricardo: Búsqueda de preguntas -->
<div class="search-container">
    <!-- Flecha hacia atrás -->
    <div class="d-flex align-items-center mb-3">
        <i class="back-button bi bi-arrow-left"></i>
        <h1 class="ms-3">Preguntas</h1>
    </div>

    <!-- Barra de búsqueda -->
    <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-list"></i></span>
        <input type="text" class="form-control search-input" id="tag-input" placeholder="Añadir nueva etiqueta">
        <span class="input-group-text" id="add-tag-btn"><i class="bi bi-search"></i></span>
    </div>

    <!-- Contenedor de etiquetas dinámicas -->
    <div class="tag-container" id="tag-container"></div>
</div>

<!-------------------------------------------Parte de Adan----------------------------------->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemajornada";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el filtro desde la URL
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$filterArray = explode(',', $filter);

// Base de la consulta
$sql = "SELECT Id_Pregunta, Id_autor, id_Tema, Pregunta, Contexto, Hora, Fecha, Estado FROM pregunta WHERE 1=1";

// Aplicar filtro si hay etiquetas
if (!empty($filterArray)) {
    foreach ($filterArray as $filtro) {
        $filtro = trim($filtro);
        if (!empty($filtro)) {
            $sql .= " AND (Pregunta LIKE '%$filtro%' OR Contexto LIKE '%$filtro%')";
        }
    }
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class= 'container mt-5'>";
            echo "<div class='card-body'>";
                echo "<div class='row justify-content-between'>";
                    echo "<p class='card-text col-5'>Autor: " . $row["Id_autor"] . "</p>";
                    echo "<p class='card-text col-5 text-end'>" . $row["Hora"] . "</p>";
                    echo "<hr>";
                echo "</div>";
                echo "<p class='card-text'  style='margin-top: -3%;'><h2><B>" . $row["Pregunta"] . "</B></h2></p>";
                echo "<div class='row justify-content-between'>";
                    echo "<p class='card-text col-8'>" . $row["Contexto"] . "</p>";
                    echo "<button type='button' class='btn col-3' style='margin-top: -10%;' onclick=\"window.open('pregunta_detalle.php', '_blank')\">";
                        echo "<img id='eyeimg' src='https://cdn-icons-png.flaticon.com/512/159/159604.png' alt='Ver Detalle'>";
                    echo "</button>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Script de Etiquetas / Ricardo -->
<script>
    // Función para agregar una nueva etiqueta
    function addTag(tagText) {
        const tagContainer = document.getElementById('tag-container');
        const tag = document.createElement('div');
        tag.classList.add('tag');
        tag.innerHTML = `${tagText} <i class="bi bi-x" onclick="removeTag(this)"></i>`;
        tagContainer.appendChild(tag);
        filterQuestions(); // Filtrar preguntas después de agregar la etiqueta
    }

    // Función para eliminar una etiqueta
    function removeTag(element) {
        element.parentElement.remove();
        filterQuestions(); // Filtrar preguntas después de eliminar la etiqueta
    }

    // Función para filtrar preguntas en base a etiquetas
    function filterQuestions() {
        const tags = Array.from(document.querySelectorAll('.tag')).map(tag => tag.textContent.trim());
        const tagString = tags.join(',');
        fetch(`ContenedorPregunta.php?filter=${encodeURIComponent(tagString)}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('question-results').innerHTML = data;
            });
    }

    // Evento para añadir la etiqueta cuando se hace clic en el botón de búsqueda
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('add-tag-btn').addEventListener('click', function () {
            const tagInput = document.getElementById('tag-input');
            if (tagInput.value.trim() !== '') {
                addTag(tagInput.value.trim());
                tagInput.value = ''; // Limpiar el input
            }
        });

        // Permitir añadir etiquetas presionando Enter
        document.getElementById('tag-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                const tagInput = document.getElementById('tag-input');
                if (tagInput.value.trim() !== '') {
                    addTag(tagInput.value.trim());
                    tagInput.value = ''; // Limpiar el input
                }
                e.preventDefault();
            }
        });
    });
</script>

</body>
</html>