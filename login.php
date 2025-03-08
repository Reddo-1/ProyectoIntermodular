<?php
session_start();
include "conexion.php";

if (isset($_SESSION["id"])) {
    if ($_SESSION["es_admin"] == 1) {
        header("Location: PanelDeControl.php");
    } else {
        header("Location: index.php");
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST["email"]);
    $contrasenya = $conn->real_escape_string($_POST["contrasenya"]);

    // Consulta para obtener el usuario
    $stmt = $conn->prepare("SELECT id_cliente, nombre, es_admin FROM clientes WHERE email = ? AND contrasenya = ?");
    $stmt->bind_param("ss", $email, $contrasenya);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        // Guardamos los datos en la sesión
        $_SESSION["id"] = $usuario["id_cliente"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["es_admin"] = $usuario["es_admin"];

        // Redirigir según el tipo de usuario
        if ($usuario["es_admin"] == 1) {
            header("Location: PanelDeControl.php"); // Página de administrador
        } else {
            header("Location: index.php"); // Página de usuario normal
        }
        exit();
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <script src="scripts.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
               <a href="login.php">
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

            </div>

        </div>

        <nav class="barraNavegacion">
            
            <a href="index.php">HOME</a>
            <a href="skateboards.php">SKATEBOARDS</a>
            <a href="zapatillas.php">ZAPATILLAS</a>
            <a href="ropa.php">ROPA</a>
            
        </nav>

    </header>
    <div id="carrito-flotante" class="carrito-flotante oculto">
        <h2>Carrito de Compras</h2>
        <div id="carrito-items"></div>
        <button id="cerrar-carrito">Cerrar</button>
        <button id="comprar" onclick="location.href='cart.php?id=0'">
            Ir a Caja</button>
        <button id="vaciar-carrito">Vaciar Carrito</button>
    </div>

    <section class="login">
        <div class="mainDivIns">
            <h2>🔹 INICIAR SESIÓN 🔹</h2>
            
            <form method="POST">
                <div class="campo">
                    <label for="email">Correo Electrónico:</label>
                    <br>
                    <input type="email" id="email" name="email" placeholder="Escriba su correo aquí" required>
                </div>

                <div class="campo">
                    <label for="contrasenya">Contraseña:</label>
                    <br>
                    <input type="password" id="contrasenya" name="contrasenya" placeholder="Ingrese su contraseña" required>
                </div>
                <a href="crear_cuenta.php">Registrate!</a>
                
                <button type="submit">🚀 Iniciar Sesión</button>
            </form>
        </div>
    </section>
</body>
</html>

<?php
$conn->close();
?>
