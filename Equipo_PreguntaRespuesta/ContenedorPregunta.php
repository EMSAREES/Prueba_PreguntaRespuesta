<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pregunta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="/PreguntasRespuestas/css/contenedorpregunta.css" rel="stylesheet">
</head>
<body>

<!--------------------------------------Parte de Ricardo--------------------------------->

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
    <div class="tag-container" id="tag-container">
        <div class="tag">
            Negocio <i class="bi bi-x" onclick="removeTag(this)"></i>
        </div>
        <div class="tag">
            Pytho <i class="bi bi-x" onclick="removeTag(this)"></i>
        </div>
        <button class="filter-btn">Reciente</button>
    </div>
</div>

<!-------------------------------------------Parte de Adan----------------------------------->
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <p class="card-text col-5">Autor: Anónimo</p>
                    <p class="card-text col-5 text-end">1:25 pm</p>
                    <hr>
                </div>
                <p class="card-text"  style="margin-top: -3%;"><h2><B>¿Qué es una base de datos?</B></h2></p>
                <div class="row justify-content-between">
                    <p class="card-text col-8">Tengo la duda que en si que es una base de datos como NoSQL y SQL cual serian sus diferencias...</p>
                    <button type="image" class="btn col-3" style="margin-top: -10%;" onclick="window.open('pregunta_detalle.php', '_blank')">
                        <img class="w-75" src="https://cdn-icons-png.flaticon.com/512/159/159604.png" alt="" >
                    </button> 
                </div>
                
                
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- Archivo JavaScript -->
<script src="script.js"></script>

</body>
</html>
    </div>
</body>
</html>