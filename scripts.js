function mostrarCampos() {
    const tipoProd = document.getElementById("tipoProd");
    if (tipoProd) {
        console.log("Elemento tipoProd encontrado");
        const valorSeleccionado = tipoProd.value;
        const tabla = document.getElementById("tabla");
        const eje = document.getElementById("eje");
        const zapatilla = document.getElementById("zapatilla");
        const pantalon = document.getElementById("pantalon");
        const camiseta = document.getElementById("camiseta");
        const sudadera = document.getElementById("sudadera");

        tabla.classList.add("oculto");
        eje.classList.add("oculto");
        zapatilla.classList.add("oculto");
        pantalon.classList.add("oculto");
        camiseta.classList.add("oculto");
        sudadera.classList.add("oculto");
        
        if (valorSeleccionado === "tablas") {
            tabla.classList.remove("oculto");
        } else if (valorSeleccionado === "ejes") {
            eje.classList.remove("oculto");
        } else if (valorSeleccionado === "zapatillas") {
            zapatilla.classList.remove("oculto");
        }else if (valorSeleccionado === "camisetas") {
            camiseta.classList.remove("oculto");
        }else if (valorSeleccionado === "pantalones") {
            pantalon.classList.remove("oculto");
        }else if (valorSeleccionado === "sudaderas") {
            sudadera.classList.remove("oculto");
        }      
    } 
}
    

    document.addEventListener("DOMContentLoaded", () => {
        const carritoIcon = document.getElementById("carrito-icon");
        const carritoFlotante = document.getElementById("carrito-flotante");
        const cerrarCarrito = document.getElementById("cerrar-carrito");
        const vaciarCarrito = document.getElementById("vaciar-carrito");
        const carritoItems = document.getElementById("carrito-items");
    
        // Cargar carrito desde localStorage o inicializarlo vacío
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    
        // Función para actualizar la vista del carrito
        function actualizarCarrito() {
            carritoItems.innerHTML = "";
            if (carrito.length === 0) {
                carritoItems.innerHTML = "<p>El carrito está vacío.</p>";
            } else {
                carrito.forEach((item, index) => {
                    const itemDiv = document.createElement("div");
                    itemDiv.className = "item-carrito";
                    itemDiv.innerHTML = `
                        <img src="${item.imagen}" alt="${item.nombre}" class="imagen-carrito">
                        <div class="info-carrito">
                            <p>${item.nombre}</p>
                            <p>${item.precio}€</p>
                        </div>
                        <div class="cantidad-carrito">
                            <button class="incrementar-cantidad" data-id="${item.id}">+</button>
                            <span>Cantidad: ${item.cantidad}</span>
                            <button class="decrementar-cantidad" data-id="${item.id}">-</button>
                        </div>
                        <button class="eliminar-item" data-id="${item.id}">

                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill ="currentColor" viewBox="0 0 24 24">
                        <path d="M 10 2 L 9 3 L 4 3 L 4 5 L 5 5 L 5 20 C 5 20.522222 5.1913289 21.05461 5.5683594 21.431641 
                        C 5.9453899 21.808671 6.4777778 22 7 22 L 17 22 C 17.522222 22 18.05461 21.808671 18.431641 21.431641 
                        C 18.808671 21.05461 19 20.522222 19 20 L 19 5 L 20 5 L 20 3 L 15 3 L 14 2 L 10 2 z M 7 5 L 17 5 L 17 20 L 7 
                        20 L 7 5 z M 9 7 L 9 18 L 11 18 L 11 7 L 9 7 z M 13 7 L 13 18 L 15 18 L 15 7 L 13 7 z"></path>

                        </svg></button>
                    `;
                    carritoItems.appendChild(itemDiv);
                });
            }
            localStorage.setItem("carrito", JSON.stringify(carrito)); // Guardar en localStorage
        }
    
        // Agregar al carrito
        document.querySelectorAll(".agregar-carrito").forEach((btn) => {
            btn.addEventListener("click", () => {
                const imagen = btn.closest(".mainDiv") 
                    ? btn.closest(".mainDiv").querySelector("img").src 
                    : btn.closest(".producto-detalle").querySelector("img").src;
                    
                const producto = {
                    id: btn.getAttribute("data-id"),
                    nombre: btn.getAttribute("data-nombre"),
                    precio: btn.getAttribute("data-precio"),
                    imagen: imagen
                };
                const productoExistente = carrito.find(item => item.id === producto.id);
    
                    if (productoExistente) {
                        
                        productoExistente.cantidad += 1;
                    } else {
                        const item = {
                            id: producto.id,
                            nombre: producto.nombre,
                            precio: producto.precio,
                            imagen: producto.imagen,
                            cantidad: 1 
                        };
                        if(carrito.push(item))alert("¡Producto añadido correctamente!");
                    }
                actualizarCarrito();
            });
        });
    
        // Mostrar y ocultar el carrito flotante
        carritoIcon.addEventListener("click", () => {
            carritoFlotante.classList.toggle("oculto");
        });
    
        cerrarCarrito.addEventListener("click", () => {
            carritoFlotante.classList.add("oculto");
        });
    
        // Vaciar el carrito
        vaciarCarrito.addEventListener("click", () => {
            carrito = [];
            actualizarCarrito();
        });
    
        // Eliminar un solo producto
        carritoItems.addEventListener("click", (e) => {
            const botonEliminar = e.target.closest(".eliminar-item");
            if (botonEliminar) {
                const id = botonEliminar.getAttribute("data-id");
                carrito = carrito.filter(item => item.id !== id); // Eliminar el producto por ID
                actualizarCarrito();
            }
        });

        // Incrementar y decrementar cantidades
        carritoItems.addEventListener("click", (e) => {
            const id = e.target.getAttribute("data-id");
            if (id) {
            const producto = carrito.find(item => item.id === id);

            if (e.target.classList.contains("incrementar-cantidad")) {
            producto.cantidad += 1;
            } else if (e.target.classList.contains("decrementar-cantidad")) {
            producto.cantidad -= 1;
            if (producto.cantidad <= 0) {
                carrito = carrito.filter(item => item.id !== id); // Eliminar producto si la cantidad es 0
                }
            }
            actualizarCarrito();
        }
        });
    
        // Cargar carrito al iniciar
        actualizarCarrito();
    });
    
    /*document.addEventListener("DOMContentLoaded", function () {
        const carritoIcon = document.getElementById("carrito-icon");
        const carritoFlotante = document.getElementById("carrito-flotante");
        const cerrarCarrito = document.getElementById("cerrar-carrito");
        const carritoItems = document.getElementById("carrito-items");
        const agregarCarritoBtns = document.querySelectorAll(".agregar-carrito");
        const btnVaciarCarrito = document.getElementById("vaciar-carrito");
        const btnComprar = document.getElementById("comprar");
    
        let carrito = [];
    
        if (carritoIcon && carritoFlotante && cerrarCarrito && carritoItems) {
            carritoIcon.addEventListener("click", function (event) {
                event.preventDefault();
                carritoFlotante.classList.remove("oculto");
                carritoFlotante.style.right = "0";
            });
    
            cerrarCarrito.addEventListener("click", function () {
                carritoFlotante.style.right = "-400px";
                setTimeout(() => {
                    carritoFlotante.classList.add("oculto");
                }, 300);
            });
    
            agregarCarritoBtns.forEach(btn => {
                btn.addEventListener("click", function () {
                    const id = btn.getAttribute("data-id");
                    const nombre = btn.getAttribute("data-nombre");
                    const precio = btn.getAttribute("data-precio");
                    const imagen = btn.closest(".mainDiv").querySelector("img").src;
    
                    // Verificar si el producto ya está en el carrito
                    const productoExistente = carrito.find(item => item.id === id);
    
                    if (productoExistente) {
                        
                        productoExistente.cantidad += 1;
                    } else {
                        const item = {
                            id: id,
                            nombre: nombre,
                            precio: precio,
                            imagen: imagen,
                            cantidad: 1 
                        };
                        if(carrito.push(item))alert("¡Producto añadido correctamente!");
                    }
    
                    actualizarCarrito();
                });
            });

            //vaciar carrito
            btnVaciarCarrito.addEventListener("click", function () {
                carrito = [];
                actualizarCarrito();
            });
    
            function actualizarCarrito() {
                carritoItems.innerHTML = "";
                carrito.forEach(item => {
                    const itemElement = document.createElement("div");
                    itemElement.classList.add("item-carrito"); // Clase para estilos
                    itemElement.innerHTML = `
                        <img src="${item.imagen}" alt="${item.nombre}" class="imagen-carrito">
                        <div class="info-carrito">
                            <p>${item.nombre}</p>
                            <p>${item.precio}€</p>
                        </div>
                        <div class="cantidad-carrito">
                            <span>Cantidad: ${item.cantidad}</span>
                        </div>
                    `;
                    carritoItems.appendChild(itemElement);
                });
            }
        } else {
            console.error("Elementos del carrito no encontrados");
        }
    });*/

// Ejecutar la función cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", function () {
    mostrarCampos(); // Llama a la función para mostrar/ocultar campos
});

// Ejecutar la función cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", function () {

    var logoutLink = document.querySelector("a[href='logout.php']");
    
    if (!isLoggedIn && logoutLink) {  // Ahora trata 'false' como un valor falso
        logoutLink.classList.add("oculto");
    }

    const searchInput = document.getElementById("search");
    const searchResults = document.getElementById("search-results");

    searchInput.addEventListener("input", function () {
        let query = searchInput.value.trim();

        if (query.length > 2) {
            fetch(`buscar.php?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = ""; // Limpiar resultados previos
                    searchResults.classList.remove("oculto"); // Mostrar resultados

                    if (data.length > 0) {
                        data.forEach(producto => {
                            let item = document.createElement("a"); // Usamos <a> como contenedor principal
                            item.href = `producto.php?id=${producto.id_producto}&tipo=${producto.tipo_producto}`; // Enlace en el contenedor
                            item.classList.add("resultado-item"); // Clase para estilos
                            item.innerHTML = `
                                    <img src="${producto.imagen}" alt="${producto.nombre}" class="imagen-producto">
                                    <div class="info-producto">
                                    <h2 class="nombre-producto"> ${producto.nombre} <br>Marca: ${producto.nombreMarca}</h2>
                                    <p class="precio-producto">$${producto.precio}</p>
                                    </div>
                            `;
                            searchResults.appendChild(item);
                        });
                    } else {
                        searchResults.innerHTML = "<p class='mensaje error'>No se encontraron resultados</p>";
                    }
                });
        } else {
            searchResults.innerHTML = ""; 
            searchResults.classList.add("oculto"); // Ocultar cuando no haya búsqueda
        }
    });

    // Cerrar resultados si se hace clic fuera
    document.addEventListener("click", function (event) {
        if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.classList.add("oculto");
        }
    });
});