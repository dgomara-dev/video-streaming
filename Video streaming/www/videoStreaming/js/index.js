/*jslint devel: true*/
/*eslint-disable*/

$(document).ready(function () {
    var elemento = $("aside li:first");
    elemento.addClass("active");
    elemento = $("aside img:first");
    elemento.attr("src", "./img/iconos/perfil_activo.png");
});

function cambiarClaseActiva() {
    var elemento = $(".active");
    elemento.removeClass("active");
    elemento.attr("src", "./img/iconos/perfil.png");
    //this.addClass("active");
    //this.attr("src", "./img/iconos/perfil_activo.png");
}

function mostrarMensaje(mensaje) {
    if (mensaje != "")
        alert(mensaje);
}

function toggleAside() {
    $(document).ready(function () {
        $("aside").slideToggle();
    });
}
