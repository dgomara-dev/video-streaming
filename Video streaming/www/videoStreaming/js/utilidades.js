/*jslint devel: true*/
/*eslint-disable*/

function mostrarMensaje(mensaje) {
    if (mensaje != "")
        alert(mensaje);
}

function toggleAside() {
    $(document).ready(function () {
        $("aside").slideToggle();
    });
}

function proximamente() {
    alert("Función no disponible.");
}
