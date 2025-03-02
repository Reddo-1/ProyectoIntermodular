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
    <script>
    var isLoggedIn = <?php echo $isLoggedIn; ?>;
    </script>
    <script src="scripts.js"></script>

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

               <a href="#" id="carrito-icon">
                    <svg fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    width="16" height="16" viewBox="0 0 184.979 184.979" xml:space="preserve">
                    <g> <path d="M179.2,48.051c-48-2.877-95.319,10.319-143.511,8.179c-0.368-0.016-0.701,0.019-1.015,0.08 c-2.479-10.772-5.096-21.509-8.742-31.943c-0.543-1.555-1.806-2.661-3.513-2.674c-6.645-0.052-13.258-0.784-19.904-0.566 c-2.749,0.09-3.629,4.607-0.678,5.008c4.065,0.553,8.08,1.426,12.143,1.963c6.887,0.909,6.443,2.759,8.263,9.15 c3.169,11.124,5.472,22.507,8.046,33.777c3.334,14.601,6.38,36.451,16.571,49.158c-0.686,1.313-0.292,3.332,1.434,3.768 c34.473,8.712,70.204,0.127,105.163-0.31c1.66-0.021,2.737-0.924,3.262-2.09c0.303-0.267,0.562-0.59,0.684-1.039 c6.583-24.089,21.122-45.512,27.457-69.411C185.764,47.688,181.318,45.578,179.2,48.051z M42.63,64.435 c-0.473,0.402-0.782,0.89-0.972,1.432c-0.385,0.317-0.7,0.697-0.915,1.146c-0.033,0.017-0.062,0.04-0.094,0.058 c-0.074-0.138-0.147-0.274-0.221-0.412c-0.914-1.715-2.423-2.086-3.758-1.659c-0.066-0.286-0.138-0.571-0.203-0.857 C38.521,64.275,40.576,64.355,42.63,64.435z M53.899,117.406c1.874,1.179,3.995,1.997,6.284,2.453 c-1.804-0.088-3.609-0.188-5.415-0.321C54.477,118.817,54.191,118.123,53.899,117.406z M126.397,117.312 c0.229-0.294,0.38-0.636,0.513-0.984c0.469,0.256,1.005,0.436,1.667,0.435h7.29C132.709,116.934,129.551,117.102,126.397,117.312z"/>
	                    <path d="M70.624,143.223c-1.369-8.567-11.15-10.37-18.347-10.017c-0.626,0.031-1.128,0.232-1.567,0.501 c-2.295,0.58-4.404,1.791-6.585,3.822c-3.854,3.59-5.445,9.484-3.145,14.336c3.812,8.043,13.545,10.729,21.234,6.838 C67.694,155.932,71.606,149.377,70.624,143.223z M51.158,139.545c0.157,0.05,0.348,0.051,0.516,0.083 c0.102,0.948,0.206,1.897,0.298,2.847c-0.379,0.063-0.757,0.132-1.119,0.229c-0.478-0.515-1.053-1.094-1.465-1.465 C49.934,140.646,50.526,140.074,51.158,139.545z M60.454,151.982c-1.939,1.68-4.381,2.18-6.752,1.828 c0.194-0.122,0.39-0.237,0.566-0.425c0.096-0.103,0.194-0.224,0.291-0.337c0.935-0.088,1.841-0.361,2.694-0.807 c1.298,0.4,2.524,0.086,3.615-0.649C60.729,151.724,60.593,151.862,60.454,151.982z"/>
	                    <path d="M143.351,133.743c-0.314-0.169-0.632-0.323-0.954-0.389c-0.262-0.053-0.528-0.076-0.794-0.105 c-0.164-0.041-0.331-0.09-0.493-0.128c-0.733-0.173-1.388-0.114-1.962,0.087c-0.581,0.036-1.158,0.084-1.725,0.143 c-3.323,0.335-6.644,1.679-9.398,3.537c-5.371,3.622-7.258,9.863-6.719,16.106c0.764,8.846,8.339,12.213,16.321,10.444 c7.056-1.564,14.831-6.798,17.463-13.743C158.343,141.105,150.543,135.983,143.351,133.743z M128.466,148.21 c0.048,0.359,0.115,0.71,0.197,1.064c0.03,1,0.125,1.994,0.258,2.938c0.057,0.408,0.229,0.735,0.445,1.023 c-0.133,0.573-0.269,1.128-0.407,1.665c-0.297-0.528-0.538-1.13-0.641-1.909C128.104,151.351,128.149,149.735,128.466,148.21z"/></g>
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
        <div id="search-results" class="resultados-busqueda"></div>

    </header>

    <div id="carrito-flotante" class="carrito-flotante oculto">
        <h2>Carrito de Compras</h2>
        <div id="carrito-items"></div>
        <button id="cerrar-carrito">Cerrar</button>
        <button id="comprar"onclick="location.href='cart.php'">Ir a Caja</button>
        <button id="vaciar-carrito">Vaciar Carrito</button>
    </div>

    <h2 class="tipoProducto">TABLAS DE SKATE</h2>
    <?php
    $sql = "SELECT * from mostrar_tablas";
    $resultSet = $conn->query($sql);
    ?>
    <section class="productoMostrar">
        <?php
        if($resultSet->num_rows > 0){
            while ($row = $resultSet->fetch_assoc()){
        ?>
        
        <div class="mainDiv">
        <a href="producto.php?id=<?php echo $row['idProd']?>&tipo=<?php echo $row['tipoProd']?>">
            <h3><?php echo $row['nombreProd'];?></h3>
            <p class="marca">marca: <?php echo $row['nombreMarca'];?></p>
            <div class="imagenTabla">
                <img src="<?php echo $row['imagenProd'];?>" alt="Imagen no encontrada">
            </div>
            <div class="infoTabla">
                
                <p class="descripcion"><?php echo $row['descripcionProd'];?></p>
                <p class="stock">Stock: <?php echo $row['stockProd'];?>   Tamaño: <?php echo $row['tamañoTabla'];?></p>
        </a>
                <div class="precio-boton">
                    <h3><?php echo $row['precioProd'];?>€</h3>
                    <button class="agregar-carrito" 
                    data-id="<?php echo $row['idProd']; ?>" 
                    data-nombre="<?php echo $row['nombreProd']; ?>" 
                    data-precio="<?php echo $row['precioProd']; ?>">Agregar al carrito</button>
                </div>
            </div>
        
        </div><?php }} else{
            echo "Tablas no encontradas";
        }
        ?>
        
    </section>
    

    
    
</body>
</html>
<?php
$conn->close();
?>