<?php
include "conexion.php";

// Variable para mostrar mensajes
$mensaje = "";

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{

        $conn->begin_transaction();

    

    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $precio = isset($_POST["precio"]) ? floatval($_POST["precio"]) : 0.0;
    $stock = isset($_POST["stock"]) ? intval($_POST["stock"]) : 0;
    $novedad = isset($_POST["novedad"]) ? 1 : 0;
    $oferta = isset($_POST["oferta"]) ? 1 : 0;
    $idMarca = isset($_POST["marca"]) ? intval($_POST["marca"]) : 0;
    $idProveedor = isset($_POST["proveedor"]) ? intval($_POST["proveedor"]) : 0;
    $descripcion = $conn->real_escape_string($_POST["descripcion"]);
    $tipoProd = $conn->real_escape_string($_POST["tipoProd"]);
    

    $imagen = NULL;
    $rutaImagen = "img/"; 

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
        $imagen_nombre = basename($_FILES["imagen"]["name"]);
        $imagen = $rutaImagen . $imagen_nombre;

    // Mueve la imagen al directorio destino
        if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen)) {
            throw new Exception("Error al subir la imagen al servidor.");
        }
    } else {
    throw new Exception("La imagen es obligatoria o hubo un error al subirla.");
    }


    $stmt = $conn->prepare("INSERT INTO productos (es_novedad, es_oferta, descripcion, nombre, precio, stock_disponible, id_marca_producto,id_proveedor, imagen) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissdisss", $novedad, $oferta, $descripcion, $nombre, $precio, $stock, $idMarca,$idProveedor, $imagen);
    $stmt->execute();

    $producto_id = $conn->insert_id;

    if ($tipoProd == "tablas") {
        $size = isset($_POST["size"]) ? floatval($_POST["size"]) : 0.0;
        $color = $conn->real_escape_string($_POST["colorTabla"]);

        $stmt_tablas = $conn->prepare("INSERT INTO tablas (id_tabla, tamanyo, color_hex) VALUES (?, ?, ?)");
        $stmt_tablas->bind_param("ids", $producto_id, $size, $color);
        $stmt_tablas->execute();
    }

    $conn->commit();
    $mensaje = "Producto registrado exitosamente.";

    } catch (Exception $e) {
        $conn->rollback();
        $mensaje = "Error: " . $e->getMessage();
    }

    
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Producto</title>
    <link rel="stylesheet" href="PI.css">
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
               <a href="Cuenta">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                  </svg>
               </a>

                <a href="Carrito">
                    <svg fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    width="16" height="16" viewBox="0 0 184.979 184.979" xml:space="preserve">
                    <g> <path d="M179.2,48.051c-48-2.877-95.319,10.319-143.511,8.179c-0.368-0.016-0.701,0.019-1.015,0.08 c-2.479-10.772-5.096-21.509-8.742-31.943c-0.543-1.555-1.806-2.661-3.513-2.674c-6.645-0.052-13.258-0.784-19.904-0.566 c-2.749,0.09-3.629,4.607-0.678,5.008c4.065,0.553,8.08,1.426,12.143,1.963c6.887,0.909,6.443,2.759,8.263,9.15 c3.169,11.124,5.472,22.507,8.046,33.777c3.334,14.601,6.38,36.451,16.571,49.158c-0.686,1.313-0.292,3.332,1.434,3.768 c34.473,8.712,70.204,0.127,105.163-0.31c1.66-0.021,2.737-0.924,3.262-2.09c0.303-0.267,0.562-0.59,0.684-1.039 c6.583-24.089,21.122-45.512,27.457-69.411C185.764,47.688,181.318,45.578,179.2,48.051z M42.63,64.435 c-0.473,0.402-0.782,0.89-0.972,1.432c-0.385,0.317-0.7,0.697-0.915,1.146c-0.033,0.017-0.062,0.04-0.094,0.058 c-0.074-0.138-0.147-0.274-0.221-0.412c-0.914-1.715-2.423-2.086-3.758-1.659c-0.066-0.286-0.138-0.571-0.203-0.857 C38.521,64.275,40.576,64.355,42.63,64.435z M53.899,117.406c1.874,1.179,3.995,1.997,6.284,2.453 c-1.804-0.088-3.609-0.188-5.415-0.321C54.477,118.817,54.191,118.123,53.899,117.406z M126.397,117.312 c0.229-0.294,0.38-0.636,0.513-0.984c0.469,0.256,1.005,0.436,1.667,0.435h7.29C132.709,116.934,129.551,117.102,126.397,117.312z"/>
	                    <path d="M70.624,143.223c-1.369-8.567-11.15-10.37-18.347-10.017c-0.626,0.031-1.128,0.232-1.567,0.501 c-2.295,0.58-4.404,1.791-6.585,3.822c-3.854,3.59-5.445,9.484-3.145,14.336c3.812,8.043,13.545,10.729,21.234,6.838 C67.694,155.932,71.606,149.377,70.624,143.223z M51.158,139.545c0.157,0.05,0.348,0.051,0.516,0.083 c0.102,0.948,0.206,1.897,0.298,2.847c-0.379,0.063-0.757,0.132-1.119,0.229c-0.478-0.515-1.053-1.094-1.465-1.465 C49.934,140.646,50.526,140.074,51.158,139.545z M60.454,151.982c-1.939,1.68-4.381,2.18-6.752,1.828 c0.194-0.122,0.39-0.237,0.566-0.425c0.096-0.103,0.194-0.224,0.291-0.337c0.935-0.088,1.841-0.361,2.694-0.807 c1.298,0.4,2.524,0.086,3.615-0.649C60.729,151.724,60.593,151.862,60.454,151.982z"/>
	                    <path d="M143.351,133.743c-0.314-0.169-0.632-0.323-0.954-0.389c-0.262-0.053-0.528-0.076-0.794-0.105 c-0.164-0.041-0.331-0.09-0.493-0.128c-0.733-0.173-1.388-0.114-1.962,0.087c-0.581,0.036-1.158,0.084-1.725,0.143 c-3.323,0.335-6.644,1.679-9.398,3.537c-5.371,3.622-7.258,9.863-6.719,16.106c0.764,8.846,8.339,12.213,16.321,10.444 c7.056-1.564,14.831-6.798,17.463-13.743C158.343,141.105,150.543,135.983,143.351,133.743z M128.466,148.21 c0.048,0.359,0.115,0.71,0.197,1.064c0.03,1,0.125,1.994,0.258,2.938c0.057,0.408,0.229,0.735,0.445,1.023 c-0.133,0.573-0.269,1.128-0.407,1.665c-0.297-0.528-0.538-1.13-0.641-1.909C128.104,151.351,128.149,149.735,128.466,148.21z"/></g>
                    </svg>
                </a>

                <a href="" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 48 48">
                        <path fill="#73a1b2" d="M25.457,7.504c-6.171-0.17-11.438,0.347-17.579,0.978c-0.611,0.063-1.244,0.136-1.77,0.453 c-1.354,0.815-1.381,2.156-1.244,3.731c0.045,0.522,0.163,1.146,0.65,1.338c0.135,0.053,0.283,0.064,0.429,0.074 c11.101,0.736,23.465,0.383,34.557-0.468c1.366-0.105,1.708-0.247,2.437-1.407c0.825-1.312,0.618-3.068-0.707-3.871 c-1.326-0.802-1.721-0.872-3.271-0.875C34.773,7.45,29.641,7.62,25.457,7.504z"></path><path fill="#010101" d="M18.881,14.979c-4.255,0-8.643-0.115-12.972-0.402c-0.152-0.01-0.364-0.022-0.58-0.107 c-0.84-0.332-0.93-1.369-0.963-1.76C4.228,11.119,4.229,9.483,5.85,8.508c0.639-0.385,1.381-0.461,1.977-0.521 c5.787-0.595,11.256-1.161,17.644-0.981l0,0C28.058,7.078,31.02,7.038,33.883,7c1.76-0.023,3.487-0.043,5.076-0.042 c1.623,0.004,2.104,0.086,3.528,0.947c0.684,0.414,1.163,1.076,1.35,1.865c0.212,0.896,0.038,1.879-0.478,2.7 c-0.83,1.318-1.318,1.523-2.822,1.639C34.74,14.554,27.059,14.979,18.881,14.979z M23.075,7.972 c-5.341,0-10.122,0.492-15.146,1.009C7.297,9.046,6.781,9.115,6.366,9.364c-1.034,0.622-1.149,1.586-1.004,3.26 c0.046,0.538,0.159,0.847,0.335,0.916c0.067,0.026,0.183,0.033,0.275,0.039c12.594,0.833,25.706,0.207,34.489-0.467 c1.224-0.094,1.417-0.165,2.051-1.175c0.374-0.595,0.502-1.301,0.352-1.936c-0.088-0.373-0.315-0.891-0.895-1.241 c-1.239-0.749-1.533-0.799-3.013-0.803C37.371,7.953,35.651,7.977,33.896,8c-2.874,0.038-5.845,0.077-8.453,0.005l0,0 C24.64,7.982,23.852,7.972,23.075,7.972z"></path><path fill="#73a1b2" d="M24.805,21.407c-5.722,0.191-11.388,0.051-17.111,0.228c-1.011,0.031-2.189,0.153-2.727,1.009 c-0.53,0.844-0.354,2.297-0.215,3.315c0.124,0.906,0.713,1.324,1.623,1.415c1.055,0.106,2.48,0.064,3.542,0.083 c9.226,0.17,19.083-0.229,28.12-0.008c1.239,0.03,2.573-0.209,3.492-1.04c0.753-0.681,1.083-1.731,1.122-2.746 c0.033-0.861-0.162-1.803-0.827-2.351c-0.651-0.537-1.571-0.559-2.415-0.554C34.351,20.788,29.861,21.239,24.805,21.407z"></path><path fill="#010101" d="M15.117,28.002c-1.754,0-3.497-0.013-5.209-0.044c-1.052-0.021-2.492,0.023-3.582-0.086 c-1.521-0.151-1.965-1.087-2.069-1.845c-0.173-1.268-0.308-2.7,0.288-3.648c0.735-1.17,2.356-1.22,3.135-1.244 c2.804-0.086,5.637-0.097,8.376-0.107c2.859-0.011,5.815-0.022,8.733-0.12l0,0c2.062-0.068,4.057-0.187,5.986-0.3 c2.768-0.163,5.63-0.331,8.632-0.349c0.767,0,1.911-0.011,2.735,0.669c0.697,0.572,1.055,1.552,1.008,2.756 c-0.05,1.293-0.507,2.393-1.286,3.098c-1.124,1.017-2.714,1.195-3.84,1.169c-4.692-0.114-9.705-0.061-14.55-0.009 C20.718,27.972,17.904,28.002,15.117,28.002z M24.822,21.907c-2.933,0.098-5.897,0.109-8.763,0.12 c-2.733,0.011-5.56,0.021-8.349,0.107c-0.97,0.029-1.923,0.145-2.319,0.775c-0.452,0.721-0.251,2.191-0.143,2.982 c0.06,0.435,0.246,0.892,1.177,0.985c1.035,0.104,2.465,0.062,3.501,0.08c4.418,0.082,9.054,0.032,13.538-0.017 c4.855-0.052,9.875-0.105,14.585,0.009c0.95,0.026,2.266-0.116,3.145-0.911c0.78-0.705,0.935-1.803,0.958-2.395 c0.02-0.512-0.038-1.445-0.645-1.945c-0.504-0.414-1.284-0.442-2.094-0.44c-2.976,0.018-5.698,0.178-8.58,0.347 C28.898,21.72,26.896,21.838,24.822,21.907L24.822,21.907z"></path><path fill="#73a1b2" d="M23.814,33.916c-5.881,0.053-11.022-0.458-16.907-0.229c-0.386,0.015-0.795,0.112-1.069,0.385 c-0.377,0.376-0.343,0.985-0.283,1.514l0.133,1.173c0.114,1.008,1.017,2.776,2.032,2.782c8.718,0.05,16.994,0.025,25.712-0.074 c1.72-0.02,3.444-0.042,5.154-0.226c1.07-0.115,2.134-0.292,3.184-0.532c0.394-0.09,0.813-0.205,1.074-0.513 c0.214-0.254,0.285-0.597,0.33-0.926c0.08-0.579,0.105-1.165,0.077-1.748c-0.05-1.034-0.899-1.865-1.933-1.895 C35.427,33.455,29.755,33.863,23.814,33.916z"></path><path fill="#010101" d="M16.402,40.067c-2.868,0-5.748-0.008-8.687-0.025c-1.398-0.008-2.402-2.136-2.525-3.226 l-0.133-1.173c-0.053-0.471-0.152-1.347,0.427-1.926c0.326-0.324,0.811-0.508,1.403-0.53c3.345-0.128,6.51-0.021,9.571,0.085 c2.362,0.082,4.802,0.169,7.351,0.144l0,0c2.266-0.021,4.527-0.093,6.714-0.164c3.518-0.114,7.154-0.23,10.808-0.124 c1.293,0.038,2.355,1.079,2.418,2.371c0.03,0.614,0.003,1.233-0.081,1.841c-0.055,0.405-0.147,0.83-0.443,1.18 c-0.359,0.425-0.883,0.572-1.346,0.678c-1.064,0.243-2.155,0.425-3.241,0.542c-1.765,0.189-3.591,0.21-5.202,0.229 C27.573,40.035,22.011,40.067,16.402,40.067z M10.118,34.127c-1.043,0-2.101,0.018-3.192,0.061 C6.594,34.2,6.333,34.285,6.19,34.427C5.981,34.635,6,35.08,6.051,35.53l0.133,1.173c0.106,0.942,0.935,2.335,1.538,2.339 c8.681,0.052,16.849,0.027,25.703-0.074c1.667-0.019,3.39-0.038,5.107-0.223c1.047-0.113,2.099-0.289,3.125-0.522 c0.319-0.073,0.645-0.16,0.804-0.349c0.13-0.154,0.181-0.413,0.216-0.67c0.076-0.547,0.1-1.104,0.073-1.656 c-0.038-0.773-0.674-1.397-1.448-1.42c-3.623-0.106-7.244,0.01-10.747,0.124c-2.192,0.07-4.459,0.144-6.737,0.164l0,0 c-2.565,0.028-5.021-0.062-7.394-0.144C14.291,34.198,12.237,34.127,10.118,34.127z"></path>
                        </svg>
                </a>
            </div>

        </div>

        <nav class="barraNavegacion">

            <a href="index.html">HOME</a>
            <a href="skateboards.php">SKATEBOARDS</a>
            <a href="zapatillas">ZAPATILLAS</a>
            <a href="ropa">ROPA</a>
            <a href="accesorios">ACCESORIOS</a>
            <a href="PanelDeControl.php">PANEL DE CONTROL</a>
        </nav>

    </header>


    <section class="insertarProductos">
    <div class="mainDivIns" id="insertarProductos">
        <h2>🔹 INSERTAR PRODUCTO 🔹</h2>
        
        <form method="POST" enctype="multipart/form-data">
        <div class="colIzq">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <br>
                <input type="text" id="nombre" name="nombre" placeholder="Escriba el nombre aqui" required>
            </div>

            <div class="campo">
                <label for="precio">Precio:</label>
                <br>
                <input type="number" id="precio" name="precio" placeholder="Indique el precio" required step="any">
            </div>

            <div class="campo">
                <label for="stock">Stock:</label>
                <br>
                <input type="number" id="stock" name="stock" placeholder="Indique el stock" required>
            </div>

            <div class="campo">
                <label for="novedad">Es una novedad? --</label>
                <input type="checkbox" id="novedad" name="novedad" placeholder="novedad">
            </div>

            <div class="campo">
                <label for="oferta">Le damos una oferta? --</label>
                <input type="checkbox" id="oferta" name="oferta" placeholder="oferta">
            </div>

            <div class="campo">
                <label for="Marca">Marca:</label>
                <br>
                <select name="marca" id="marca" required>
                    <option value="default">Selecciona una Marca</option>
                        <?php
                        $sql2 = "SELECT id_marca, nombre FROM marcas";
                        $result = $conn->query($sql2);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["id_marca"] . '">' . htmlspecialchars($row["nombre"]) . '</option>';
                            }
                        }
                        ?>
                </select>
            </div>
        
            <div class="campo">
                <label for="imagen">imagen:</label>
                <br>
                <input type="file" id="imagen" name="imagen" accept="image/" required>
            </div>

        </div>
        <div class="colDer">
            <div class="campo">
                <label for="proveedor">Proveedor:</label>
                <br>
                <select name="proveedor" id="proveedor" required>
                    <option value="default">Selecciona un proveedor</option>
                        <?php
                        $sql2 = "SELECT id_proveedor, nombre FROM proveedores";
                        $result = $conn->query($sql2);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["id_proveedor"] . '">' . htmlspecialchars($row["nombre"]) . '</option>';
                            }
                        }
                        ?>
                </select>
            </div>

            <div class="campo">
                <label for="tipo de producto">Tipo de producto:</label>
                <br>
                <select name="tipoProd" id="tipoProd" required onchange="mostrarCampos()">
                    <option value="default">Selecciona un tipo de producto</option>
                    <option value="tablas">Tablas de skate</option>
                </select>
            </div>

            <div id="tabla" class="oculto">
                <div class="campo">
                <label for="size">Tamaño:</label>
                <br>
                <select name="size" id="size" required step="any">
                    <option value="default">Selecciona un tamaño</option>
                    <option value="7.75">7.75"</option>
                    <option value="8.0">8"</option>
                    <option value="8.25">8.25"</option>
                    <option value="8.5">8.5"</option>
                    <option value="9.0">9"</option>
                </select>
                </div> 
                <div class="campo">
                <label for="colorTabla">color:</label>
                <br>
                <input type="color" id="colorTabla" name="colorTabla" required>
                </div> 
            </div>

            <div class="campo">
                <label for="descripcion">Descripción:</label>
                <br>
                <textarea type="textarea" id="descripcion" name="descripcion" placeholder="descripcion" required></textarea> 
            </div>
        </div>
            
            <button type="submit">🚀 Registrar</button>
        </form>

        <?php if (!empty($mensaje)): ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
        <?php endif; ?>
        
    </div>

    </section>

<script src="scripts.js"></script>
</body>
</html>
<?php
$conn->close();
?>