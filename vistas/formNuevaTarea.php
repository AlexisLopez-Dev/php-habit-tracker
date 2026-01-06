<?php
session_start();
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Hábito</title>
    <link rel="icon" type="image/svg+xml" href="../css/favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h1>Nuevo Hábito</h1>

    <div style="background: var(--card-bg); padding: 20px; border-radius: 16px;">
        <form action="../controladores/nuevaTarea.php" method="post" style="display: flex; flex-direction: column; gap: 15px;">

            <label for="nombre" style="font-weight: bold;">¿Qué quieres lograr?</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Ej: Leer 10 páginas" autofocus autocomplete="off">

            <label style="font-weight: bold;">Elige un icono:</label>

            <div class="icon-selector">

                <input type="radio" name="icono" id="ic1" value="fa-solid fa-list-check" class="icon-option-input" checked>
                <label for="ic1" class="icon-option-label"><i class="fa-solid fa-list-check"></i></label>

                <input type="radio" name="icono" id="ic2" value="fa-solid fa-person-running" class="icon-option-input">
                <label for="ic2" class="icon-option-label"><i class="fa-solid fa-person-running"></i></label>

                <input type="radio" name="icono" id="ic3" value="fa-solid fa-glass-water" class="icon-option-input">
                <label for="ic3" class="icon-option-label"><i class="fa-solid fa-glass-water"></i></label>

                <input type="radio" name="icono" id="ic4" value="fa-solid fa-apple-whole" class="icon-option-input">
                <label for="ic4" class="icon-option-label"><i class="fa-solid fa-apple-whole"></i></label>

                <input type="radio" name="icono" id="ic5" value="fa-solid fa-spa" class="icon-option-input">
                <label for="ic5" class="icon-option-label"><i class="fa-solid fa-spa"></i></label>

                <input type="radio" name="icono" id="ic6" value="fa-solid fa-guitar" class="icon-option-input">
                <label for="ic6" class="icon-option-label"><i class="fa-solid fa-guitar"></i></label>

                <input type="radio" name="icono" id="ic7" value="fa-solid fa-book-open" class="icon-option-input">
                <label for="ic7" class="icon-option-label"><i class="fa-solid fa-book-open"></i></label>

                <input type="radio" name="icono" id="ic8" value="fa-solid fa-pills" class="icon-option-input">
                <label for="ic8" class="icon-option-label"><i class="fa-solid fa-pills"></i></label>

                <input type="radio" name="icono" id="ic9" value="fa-solid fa-piggy-bank" class="icon-option-input">
                <label for="ic9" class="icon-option-label"><i class="fa-solid fa-piggy-bank"></i></label>

                <input type="radio" name="icono" id="ic10" value="fa-solid fa-code" class="icon-option-input">
                <label for="ic10" class="icon-option-label"><i class="fa-solid fa-code"></i></label>

            </div>

            <button type="submit" class="btn-action btn-primary" style="margin-top: 10px;">Crear Hábito</button>

            <div style="color: var(--danger); text-align: center; margin-top: 10px;">
                <?= $_SESSION["error"] ?? "" ?>
            </div>
        </form>
    </div>

    <a href="../index.php" class="btn-action">
        <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Volver
    </a>

</div>

</body>
</html>