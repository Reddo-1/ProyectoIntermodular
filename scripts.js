function mostrarCampos(){
    let tipoProd = document.getElementById("tipoProd").value;
        document.getElementById("tabla").classList.add("oculto");
        
        if(tipoProd === "tablas"){
            document.getElementById("tabla").classList.remove("oculto");
        }
        else if (rol === "pinche"){
            document.getElementById("pincheDiv").classList.remove("hidden");
        }
}

document.addEventListener("DOMContentLoaded", function () {
    var logoutLink = document.querySelector("a[href='logout.php']");
    
    if (!isLoggedIn && logoutLink) {  // Ahora trata 'false' como un valor falso
        logoutLink.classList.add("oculto");
    }
});

document.addEventListener("DOMContentLoaded", function () {
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