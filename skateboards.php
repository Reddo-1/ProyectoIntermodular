<?php
include "conexion.php";
session_start();
$destinoLogin = "login.php";

$isLoggedIn = isset($_SESSION["id"]) ? 'true' : 'false';

if (isset($_SESSION["id"])) {
    if ($_SESSION["es_admin"] == 1) {
        $destinoLogin = "PanelDeControl.php";
    } else {
        $destinoLogin = "index.php";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PI.css">
    <title>Skateboards</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="titulo">
            <div class="logo">
                <h1>XanaX skateboards</h1>
            </div>

            <div class="iconos">
               <a href="<?= $destinoLogin ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                  </svg>
               </a>

                <a href="Carrito">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                      </svg>
                </a>

                <a href="logout.php">
                    <svg fill="currentColor" height="16" width="16" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 384.971 384.971" xml:space="preserve">
                        
	                <g id="Sign_Out">
		                <path d="M180.455,360.91H24.061V24.061h156.394c6.641,0,12.03-5.39,12.03-12.03s-5.39-12.03-12.03-12.03H12.03 C5.39,0.001,0,5.39,0,12.031V372.94c0,6.641,5.39,12.03,12.03,12.03h168.424c6.641,0,12.03-5.39,12.03-12.03 C192.485,366.299,187.095,360.91,180.455,360.91z"/>
		                <path d="M381.481,184.088l-83.009-84.2c-4.704-4.752-12.319-4.74-17.011,0c-4.704,4.74-4.704,12.439,0,17.179l62.558,63.46H96.279 c-6.641,0-12.03,5.438-12.03,12.151c0,6.713,5.39,12.151,12.03,12.151h247.74l-62.558,63.46c-4.704,4.752-4.704,12.439,0,17.179 c4.704,4.752,12.319,4.752,17.011,0l82.997-84.2C386.113,196.588,386.161,188.756,381.481,184.088z"/>
                    </g>

                    </svg>
                </a>
            </div>

        </div>

        <nav class="barraNavegacion">

            <a href="index.php">HOME</a>
            <a href="zapatillas">ZAPATILLAS</a>
            <a href="ropa">ROPA</a>
            <a href="accesorios">ACCESORIOS</a>
        </nav>

        <div class="search-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="iconoSearch" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
              </svg>
            <input type="text" class="search-input" id="search"  placeholder="Buscar...">
        </div>

    </header>

    <h2 class="tipoProducto">TABLAS DE SKATE</h2>
    <?php
    $sql = "SELECT p.imagen as imagenProd , p.nombre as nombreProd , 
    p.descripcion as descripcionProd , p.precio as precioProd , p.stock_disponible as stockProd , 
    m.nombre as nombreMarca, t.tamanyo as tamañoTabla,t.color_hex as colorTabla
        FROM productos p , marcas m , tablas t where (p.id_marca_producto = m.id_marca and p.id_producto = t.id_tabla);";
    $resultSet = $conn->query($sql);
    ?>
    <section class="tablas">
        <?php
        if($resultSet->num_rows > 0){
            while ($row = $resultSet->fetch_assoc()){
        ?>
        <div class="mainDiv">
            <h3><?php echo $row['nombreProd'];?></h3>
            <p class="marca">marca: <?php echo $row['nombreMarca'];?></p>
            <div class="imagenTabla">
                <img src="<?php echo $row['imagenProd'];?>" alt="Imagen no encontrada">
            </div>
            <div class="infoTabla">
                
                <p class="descripcion"><?php echo $row['descripcionProd'];?></p>
                <p class="stock">Stock: <?php echo $row['stockProd'];?>   Tamaño: <?php echo $row['tamañoTabla'];?></p>
                <div class="precio-boton">
                    <h3><?php echo $row['precioProd'];?>€</h3>
                    <button>Agregar al carrito</button>
                </div>
            </div>
        </div><?php }} else{
            echo "Tablas no encontradas";
        }
        ?>
        
    </section>
    

    
    
    <script>
    var isLoggedIn = <?php echo $isLoggedIn; ?>;
    </script>

    <script src="scripts.js"></script>
</body>
</html>
<?php
$conn->close();
?>