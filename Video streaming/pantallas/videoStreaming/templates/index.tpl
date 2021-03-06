<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio - Nitflex</title>
    <meta charset="UTF-8" />
    <link rel="icon" href="./img/iconos/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
    <link rel="stylesheet" type="text/css" href="./css/index.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
            <form method="post" action="./src/ordenCarteles.php">
                <button type="submit" name="ordenarTematica"><img src="./img/iconos/ordenar.png" height="18" />Por temática</button>
            </form>
            <form method="post" action="./src/ordenCarteles.php">
                <button type="submit" name="ordenarAlfabetico"><img src="./img/iconos/ordenar.png" height="18" />Por orden alfabético</button>
            </form>
        </ul>
    </aside>
    <section>
        {foreach from=$videos item=video}
        {$codigo = $video -> codigo}
        {$titulo = $video -> titulo}
        {$ruta = $video -> ruta}
        <form method="post" action="./info.php">
            <button type="submit" name="codigo" value={$codigo}>
                <div style="position: relative;">
                    <img src={$ruta} alt={$titulo} height="300" />
                    <p>{$titulo}</p>
                    {foreach from=$videos_v item=codigo}
                    {if $video -> codigo == $codigo}
                    <div class="visto">
                        <p>✔</p>
                    </div>
                    {/if}
                    {/foreach}
                </div>
            </button>
        </form>
        {/foreach}
    </section>
</body>

</html>
