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
