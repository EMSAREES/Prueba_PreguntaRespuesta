<?php

include 'controlador/procesar_pregunta.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href="/PreguntasRespuestas/css/pregunta.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>

    <div class="form-container">

        <header class="d-flex align-items-center mb-4">
            <button class="btn btn-light me-2" aria-label="Regresar" onclick="logout();">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l14 0" />
                    <path d="M5 12l4 4" />
                    <path d="M5 12l4 -4" />
                </svg>
            </button>
            <h1 class="h3 m-0">¿Cuál es tu pregunta?</h1>
        </header>

        <form method="POST" action="./controlador/procesar_pregunta.php">
            <main>

                <div class="mb-3">
                    <label class="form-label">Autor:</label>
                    <select class="orm-select" name="autor">
                        <?php foreach ($autores as $autor): ?>
                            <option value="<?php echo htmlspecialchars($autor); ?>" <?php echo ($autor == $user_name) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($autor); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" placeholder="¿Cuál es tu pregunta?" id="username" name="Preguntatext" maxlength="50" oninput="updateCounter('username', 'charCounter1')" required>
                    <div id="charCounter1" class="char-counter">0 / 50</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Elige el Expositor</label>
                    <select class="form-select" name="expositor" id="expositor" required>
                        <option value="" disabled selected>Elige un expositor</option> <!-- valor en blanco y deshabilitado para evitar selección -->
                        <?php foreach ($expositores as $expositor): ?>
                            <option value="<?php echo htmlspecialchars($expositor); ?>">
                                <?php echo htmlspecialchars($expositor); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="expositor-error" class="text-danger" style="display: none;">Por favor, selecciona un expositor.</div>
                </div>

                <div class="mb-3 position-relative">
                    <label class="form-label" for="textarea">Contexto</label>
                    <textarea id="textarea" class="form-control" name="textContexto" maxlength="250" placeholder="Texto..." oninput="updateCounter('textarea', 'charCounter2')"></textarea>
                    <div id="charCounter2" class="char-counter">0 / 250</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-success" type="submit" name="btnAceptar">Aceptar</button>
                    <button class="btn btn-danger" type="reset"  name="btnCncelar" onclick="cancelarFormulario()">Cancelar</button>
                </div>

            </main>
        </form> 

    </div>

    <script>
        function updateCounter(inputId, counterId) {
            const input = document.getElementById(inputId);
            const counter = document.getElementById(counterId);
            const maxLength = input.getAttribute('maxlength');
            const currentLength = input.value.length;
            counter.textContent = `${currentLength} / ${maxLength}`;
        }


        document.querySelector('form').addEventListener('submit', function(event) {
        const expositorSelect = document.getElementById('expositor');
        const expositorError = document.getElementById('expositor-error');

        // Si la opción seleccionada es la predeterminada (value es "")
        if (expositorSelect.value === "") {
            event.preventDefault(); // Evitar el envío del formulario
            expositorError.style.display = 'block'; // Mostrar mensaje de error
        } else {
            expositorError.style.display = 'none'; // Ocultar mensaje de error si es correcto
        }
        });

        function logout() {
            // Redirigir a un script PHP que destruye la sesión
            window.location.href = "./controlador/logout.php"; // Cambia esto a la ruta donde está tu script de logout
        }

     
   
    </script>
    
</body>
</html>
