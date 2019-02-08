<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio - Nitflex</title>
    <meta charset="UTF-8" />
    <link rel="icon" href="./img/iconos/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./css/index.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="./js/utilidades.js"></script>
</head>

<body>
    <header>
        <input type="image" src="./img/iconos/menu.png" onclick="toggleAside()" class="slide-toggle" />
        <a href="./index.php"><img src="./img/logo.png" alt="Nitflex" /></a>
        <div id="sesion">
            <span>{$nombreUsuario}</span>
            <form action="./src/sesionCerrar.php">
                <button type="submit">CERRAR SESIÓN</button>
            </form>
        </div>
    </header>
    <aside>
        <ul>
            <li>
                <form action="#" onclick="proximamente()">
                    <button type="submit"><img src="./img/iconos/todos.png" height="18" />Todos los perfiles</button>
                </form>
            </li>
            {foreach from=$descripcionesPerfil item=descripcion}
            <li>
                <form action="#" onclick="proximamente()">
                    <button type="submit"><img src="./img/iconos/perfil.png" height="18" />{$descripcion}</button>
                </form>
            </li>
            {/foreach}
        </ul>
        <ul>
            <form action="#" onclick="proximamente()">
                <button type="submit"><img src="./img/iconos/ordenar.png" height="18" />Por temática</button>
            </form>
            <form action="#" onclick="proximamente()">
                <button type="submit"><img src="./img/iconos/ordenar.png" height="18" />Por orden alfabético</button>
            </form>
        </ul>
    </aside>
    <section>
        {foreach from=$titulosPeliculas item=titulo}
        {foreach from=$cartelesPeliculas item=cartel}
        <a href="#">
            <img src={$ruta} alt="Cartel" height="300" />
            <p>{$titulo}</p>
        </a>
        {/foreach}
        {/foreach}
    </section>
</body>

</html>
