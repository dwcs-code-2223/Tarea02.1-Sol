<html>
    <head>
        <title>Tarea02</title>
        <link href="estilos.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <h1>Tarea02</h1>
        <form method="post">
            <div> <label>Filas, columnas: 

                    <input name="size"></label>
            </div>
            <input type="submit" value="Consultar">
        </form>
        <?php
        require_once 'funciones.php';

        if (isset($_POST["size"])) {
            $entrada = $_POST["size"];
            if ($entrada === '') {
                printArrayBi(crearArrayRandomDNI());
            } else {
                $sizeArray = explode(',', str_replace(" ", "", $entrada));
                $size = count($sizeArray);

                if ($size == 1 && isValidNumber($sizeArray[0])) {
                    printArrayBi(crearArrayRandomDNI($sizeArray[0], $sizeArray[0]));
                } else if ($size == 2 && isValidNumber($sizeArray[0]) && isValidNumber($sizeArray[1])) {
                    printArrayBi(crearArrayRandomDNI($sizeArray[0], $sizeArray[1]));
                } else {
                    exit("ERROR: Entrada no válida. Se esperan números enteros positivos.<br/>"
                            . "Se aceptan los siguientes formatos: <ul> "
                            . "<li> 3,4 (filas, columnas)</li>"
                            . "<li>4 (igual nº de filas que de columnas)</li>"
                            . " <li>'' (cadena vacía): " . FILAS_POR_DEFECTO . " filas x " . COLUMNAS_POR_DEFECTO . " columnas</li></ul>");
                }
            }
        }
        ?>

    </body>

</html>