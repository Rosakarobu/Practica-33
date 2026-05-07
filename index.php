<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ejercicio 33 - Rosa Karina Rosas Burgueño</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Georgia, serif; background-color: #fff0f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
    .tarjeta { background-color: #fbeaf0; border: 1px solid #f4c0d1; border-radius: 16px; padding: 2.5rem 2rem; width: 100%; max-width: 420px; }
    h1 { font-size: 22px; color: #72243e; margin-bottom: 0.25rem; }
    p.subtitulo { font-size: 13px; color: #993556; margin-bottom: 1.75rem; }
    label { display: block; font-size: 13px; font-weight: bold; color: #72243e; margin-bottom: 6px; }
    input[type="text"] { width: 100%; padding: 10px 14px; font-size: 16px; border: 1px solid #f4c0d1; border-radius: 8px; background-color: #fff6f9; color: #4b1528; outline: none; margin-bottom: 1.25rem; }
    input[type="text"]:focus { border-color: #d4537e; }
    button { width: 100%; padding: 11px; font-size: 15px; font-weight: bold; background-color: #f4c0d1; color: #4b1528; border: none; border-radius: 8px; cursor: pointer; }
    button:hover { background-color: #ed93b1; }
    .resultado { margin-top: 1.5rem; background-color: #fff0f5; border: 1px solid #f4c0d1; border-radius: 10px; padding: 1rem 1.25rem; }
    .resultado p.etiqueta { font-size: 12px; color: #993556; margin-bottom: 4px; }
    .resultado p.valor { font-size: 32px; font-weight: bold; color: #72243e; margin-bottom: 6px; }
    .resultado p.explicacion { font-size: 12px; color: #993556; }
  </style>
</head>
<body>
  <div class="tarjeta">
    <h1>Verificador de anagramas</h1>
    <p class="subtitulo">Ingresa dos palabras para comprobar si son anagramas</p>

    <!-- Aquí está mi formulario principal -->
    <form method="POST" action="">
      <label for="palabra1">Primera palabra</label>
      <input type="text" id="palabra1" name="palabra1"
             placeholder="Ej: amor"
             value="<?php echo isset($_POST['palabra1']) ? htmlspecialchars($_POST['palabra1']) : ''; ?>" />

      <label for="palabra2">Segunda palabra</label>
      <input type="text" id="palabra2" name="palabra2"
             placeholder="Ej: roma"
             value="<?php echo isset($_POST['palabra2']) ? htmlspecialchars($_POST['palabra2']) : ''; ?>" />

      <button type="submit">Verificar</button>
    </form>

    <!-- Aquí muestro el resultado que calcula PHP -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $palabra1 = strtolower(trim($_POST["palabra1"]));
      $palabra2 = strtolower(trim($_POST["palabra2"]));

      if ($palabra1 === "" || $palabra2 === "") {
        echo '<div class="resultado"><p class="etiqueta">Error</p><p class="valor" style="font-size:16px;">Por favor ingresa ambas palabras.</p></div>';
      } else {
        $letras1 = str_split($palabra1);
        $letras2 = str_split($palabra2);
        sort($letras1);
        sort($letras2);

        $ordenada1 = implode("", $letras1);
        $ordenada2 = implode("", $letras2);

        if ($ordenada1 === $ordenada2) {
          $respuesta   = "Sí";
          $explicacion = '"' . $palabra1 . '" y "' . $palabra2 . '" contienen las mismas letras: ' . implode(", ", $letras1);
        } else {
          $respuesta   = "No";
          $explicacion = '"' . $palabra1 . '" y "' . $palabra2 . '" no contienen las mismas letras.';
        }

        echo '<div class="resultado"><p class="etiqueta">Resultado</p><p class="valor">' . $respuesta . '</p><p class="explicacion">' . $explicacion . '</p></div>';
      }
    }
    ?>
  </div>
</body>
</html>
