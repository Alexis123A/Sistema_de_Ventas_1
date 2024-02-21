<?php
$id_usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pagina Principal</title>
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />

    <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>

    <link href="<?php echo base_url; ?>Assets/DataTables/datatables.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Stilos/permisos.css" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Stilos/error.css">
    <style>
        .mayusculas {
            text-transform: uppercase;
        }

        #nombreusuario {

            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

        }

        #b-perfil {

            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;

        }

        .spanperfil {
            color: rgb(0, 123, 255);
            margin: 50px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .spanperfil:hover {
            color: rgb(0, 123, 200);
            margin: 50px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }


        .linea-divisoria {
            border: 0.5px solid grey;
            /* Define el color y grosor de la línea */
            margin: 20px 0;
            /* Añade un espacio alrededor de la línea */
            width: 460px;
        }

        /* Cambiar el color de fondo de la barra lateral izquierda a tu elección */
        /* Cambiar el color de fondo de la barra lateral izquierda a negro */

        /* Cambiar el color del texto en la barra de navegación a negro */
        .mi_hr {
            color: white;
        }

        .mi_hr2 {
            color: black;
        }

        #modalApartado {
            width: 80%;
            /* Puedes ajustar este valor según tu preferencia */
            max-width: 1200px;
            /* Opcional: Establecer un ancho máximo */
            /* Otros estilos para el modal */
        }

        #a,
        #b,
        #c,
        #d,
        #e,
        #f,
        #g,
        #h {
            text-decoration: none;
            /* Quita la línea subrayada */
            color: inherit;
            /* Hereda el color del texto del elemento padre (generalmente negro) */
        }

        .text-container {
            display: flex;
            flex-direction: column;
        }

        .text-perfil {
            display: flex;
            flex-direction: column;
        }

        #a:hover {
            text-decoration: none;
            /* Quita la línea subrayada al pasar el ratón */
            color: rgb(23, 162, 184);
            font-size: 20px;
            /* Mantiene el color del texto al pasar el ratón */
        }

        #d:hover {
            text-decoration: none;
            /* Quita la línea subrayada al pasar el ratón */
            color: rgb(220, 53, 69);
            font-size: 20px;
            /* Mantiene el color del texto al pasar el ratón */
        }

        #b:hover {
            text-decoration: none;
            /* Quita la línea subrayada al pasar el ratón */
            color: rgb(40, 167, 69);
            font-size: 20px;
            /* Mantiene el color del texto al pasar el ratón */
        }

        #f:hover {
            text-decoration: none;
            /* Quita la línea subrayada al pasar el ratón */
            color: rgb(108, 117, 125);
            font-size: 20px;
            /* Mantiene el color del texto al pasar el ratón */
        }

        #c:hover {
            text-decoration: none;
            /* Quita la línea subrayada al pasar el ratón */
            color: rgb(255, 193, 7);
            font-size: 20px;
            /* Mantiene el color del texto al pasar el ratón */
        }

        #e:hover {
            text-decoration: none;
            /* Quita la línea subrayada al pasar el ratón */
            color: rgb(0, 123, 255);
            font-size: 20px;
            /* Mantiene el color del texto al pasar el ratón */
        }

        #g:hover {
            text-decoration: none;
            /* Quita la línea subrayada al pasar el ratón */
            color: rgb(31, 45, 61);
            font-size: 20px;
            /* Mantiene el color del texto al pasar el ratón */
        }

        #h:hover {
            text-decoration: none;
            /* Quita la línea subrayada al pasar el ratón */
            color: rgb(111, 66, 193);
            font-size: 20px;
            /* Mantiene el color del texto al pasar el ratón */
        }

        #body {
            align-items: left;
        }

        #perfilBody {
            align-items: center;
        }

        #cardUsuarios {
            height: 100px;
            width: 300px;
            display: flex;
            align-items: left;
        }

        #cardPerfil {
            height: 400px;
            width: 500px;
            display: flex;
            align-items: left;
        }



        #iconoUser {
            background-color: rgb(23, 162, 184);
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: #ffffff;
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoPro {
            background-color: rgb(111, 66, 193);
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: #ffffff;
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoPro:hover {
            background-color: white;
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: rgb(111, 66, 193);
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCo {
            background-color: rgb(248, 249, 250);
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: rgb(31, 45, 61);
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCo {
            background-color: white;
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: rgb(31, 45, 61);
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCate {
            background-color: rgb(108, 117, 125);
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: #ffffff;
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCate:hover {
            background-color: white;
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: rgb(108, 117, 125);
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoV {
            background-color: rgb(0, 123, 255);
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: #ffffff;
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoV:hover {
            background-color: White;
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: rgb(0, 123, 255);
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCaj {
            background-color: rgb(220, 53, 69);
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: #ffffff;
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCaj:hover {
            background-color: white;
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: rgb(220, 53, 69);
            ;
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoPerfil {
            background-color: rgb(23, 162, 184);
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 60px;
            width: 65px;
            /* Puntas curvas del fondo cuadrado */
            color: #ffffff;
            /* Color blanco para el icono */
            margin-bottom: 10px;
        }

        #iconoUser:hover {
            background-color: white;
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: rgb(23, 162, 184);
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCli {
            background-color: rgb(40, 167, 69);
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: #ffffff;
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCli:hover {
            background-color: white;
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: rgb(40, 167, 69);
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCa {
            background-color: rgb(255, 193, 7);
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: #ffffff;
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #iconoCa:hover {
            background-color: white;
            /* Fondo negro */
            padding: 11px;
            /* Espaciado interno ajustable según tus preferencias */
            border-radius: 6px;
            height: 50px;
            width: 55px;
            /* Puntas curvas del fondo cuadrado */
            color: rgb(255, 193, 7);
            /* Color blanco para el icono */
            margin-right: 10px;
        }

        #body {

            align-items: center;
            /* Centra verticalmente los elementos */



            /* Ajusta los valores según sea necesario */
        }

        #cardUsuarios {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        /* ----------------------------------------------------------------------- */
        /* Estilos personalizados para la tabla */
        #tblClientes,
        #tblUsuarios,
        #tblCaja,
        #tblMedidas,
        #tblcompra,
        #tblCategorias,
        #tblProductos,
        #tblDetalleVenta {
            background-color: #fff;
            /* Fondo blanco */

        }

        #tblClientes th,
        #tblUsuarios th,
        #tblCaja th,
        #tblMedidas th,
        #tblcompra th,
        #tblCategorias th,
        #tblProductos th,
        #tblDetalleVenta th {
            color: #000;
            /* Color de texto negro */
        }

        .icono-mas-grande {
            font-size: 22px;
            /* Tamaño del icono (ajusta según sea necesario) */
            margin-right: 2px;
            /* Espaciado a la derecha del icono (opcional) */
            color: rgb(194, 199, 208);
        }

        .icono-mas-peque {
            font-size: 19px;
            /* Tamaño del icono (ajusta según sea necesario) */
            margin-right: 2px;
            /* Espaciado a la derecha del icono (opcional) */
            color: rgb(194, 199, 208);
        }

        .fas {
            font-size: 26px;
            /* Tamaño del icono (ajusta según sea necesario) */
            margin-right: 5px;
            /* Espaciado a la derecha del icono (opcional) */
        }

        /* Estilo base del botón */
        #botonact {
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #3498db;
            /* Color del borde original */
            color: #3498db;
            /* Color del texto original */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            /* Cambia el cursor al pasar el ratón sobre el botón */
        }

        /* Estilo al pasar el ratón sobre el botón */
        #botonact:hover {
            background-color: #3498db;
            /* Nuevo color del fondo al pasar el ratón */
            color: white;
            /* Nuevo color del texto al pasar el ratón */
        }

        #barcode {
            display: inline-block;
            padding: 5px 10px;
            border: 2px solid rgb(51, 61, 70);
            /* Color del borde original */
            color: rgb(51, 61, 70);
            /* Color del texto original */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            /* Cambia el cursor al pasar el ratón sobre el botón */
        }

        /* Estilo al pasar el ratón sobre el botón */
        #barcode:hover {
            background-color: rgb(51, 61, 70);
            /* Nuevo color del fondo al pasar el ratón */
            color: white;
            /* Nuevo color del texto al pasar el ratón */
        }

        #Generarbarcode {
            display: inline-block;
            padding: 5px 10px;
            border: 2px solid rgb(27, 32, 37);
            /* Color del borde original */
            color: rgb(27, 32, 37);
            /* Color del texto original */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            /* Cambia el cursor al pasar el ratón sobre el botón */
        }

        /* Estilo al pasar el ratón sobre el botón */
        #Generarbarcode:hover {
            background-color: rgb(27, 32, 37);
            /* Nuevo color del fondo al pasar el ratón */
            color: white;
            /* Nuevo color del texto al pasar el ratón */
        }

        #nuevo {
            display: inline-block;
            padding: 5px 10px;
            border: 2px solid #3498db;
            /* Color del borde original */
            color: #3498db;
            /* Color del texto original */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            /* Cambia el cursor al pasar el ratón sobre el botón */
        }

        /* Estilo al pasar el ratón sobre el botón */
        #nuevo:hover {
            background-color: #3498db;
            /* Nuevo color del fondo al pasar el ratón */
            color: white;
            /* Nuevo color del texto al pasar el ratón */
        }

        #btnAcion,
        #icon-img,
        #btnAcione {
            display: inline-block;
            padding: 5px 20px;
            border: 2px solid #3498db;
            /* Color del borde original */
            color: #3498db;
            /* Color del texto original */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            /* Cambia el cursor al pasar el ratón sobre el botón */
        }

        #btnAcione2 {
            display: inline-block;
            padding: 5px 20px;
            border: 2px solid green;
            /* Color del borde original */
            color: green;
            /* Color del texto original */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            /* Cambia el cursor al pasar el ratón sobre el botón */
        }

        #btnAcione3 {
            display: inline-block;
            padding: 5px 20px;
            border: 2px solid orange;
            /* Color del borde original */
            color: orange;
            /* Color del texto original */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            /* Cambia el cursor al pasar el ratón sobre el botón */
        }

        #btnAcione3:hover {
            background-color: orange;
            /* Nuevo color del fondo al pasar el ratón */
            color: white;
            /* Nuevo color del texto al pasar el ratón */
        }

        /* Estilo al pasar el ratón sobre el botón */
        #btnAcion:hover,
        #icon-img:hover,
        #btnAcione:hover {
            background-color: #3498db;
            /* Nuevo color del fondo al pasar el ratón */
            color: white;
            /* Nuevo color del texto al pasar el ratón */
        }

        /* Estilo al pasar el ratón sobre el botón */
        #btnAcione2:hover {
            background-color: green;
            /* Nuevo color del fondo al pasar el ratón */
            color: white;
            /* Nuevo color del texto al pasar el ratón */
        }

        form {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Ajusta los valores según tus preferencias */
            padding: 20px;
            /* Ajusta el espaciado interno según tus necesidades */
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Ajusta los valores según tus preferencias */
            padding: 20px;
            /* Ajusta el espaciado interno según tus necesidades */
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        .card-body {
            width: 100%;
            height: 100%;
        }

        form {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Ajusta los valores según tus preferencias */
            padding: 20px;
            /* Ajusta el espaciado interno según tus necesidades */
        }

        #nav li a {
            text-decoration: none;
            /* Elimina la línea subrayada al pasar el ratón */
        }

        #nav .reloj {
            background-color: #28a745;
            /* Color de fondo verde */
            color: white;
            /* Color del texto */
            border-radius: 10px;
            /* Curvas redondeadas */
            padding: 2px 4px;
            /* Espaciado interno */
            margin-bottom: 0;/
        }

        #nav .secion span {
            font-size: 13px;
            /* Ajusta el tamaño de la fuente según tus necesidades */
        }

        #nav .reloj .fecha {
            font-size: 13px;
            /* Ajusta el ancho del contenedor según tus necesidades */
        }

        #nav .reloj {
            width: 148px;
            /* Ajusta el ancho del contenedor según tus necesidades */
        }

        #nav .secion {
            width: 110px;
            /* Ajusta el ancho del contenedor según tus necesidades */
        }

        #nav .secion {
            background-color: rgb(0, 123, 255);
            /* Color de fondo verde */
            color: white;
            /* Color del texto */
            border-radius: 10px;
            /* Curvas redondeadas */
            padding: 0px 0, 1px;
            /* Espaciado interno */
            margin-bottom: 0;/
        }

        #nav .reloj p {
            margin-bottom: 0;
            /* Elimina el margen inferior del párrafo para evitar espacio adicional */
        }

        #nav .secion p {
            margin-bottom: 0;
            /* Elimina el margen inferior del párrafo para evitar espacio adicional */
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        .card-body {
            height: 100%;
            width: 100%;
        }

        label {
            font-weight: bold;
            color: black;
        }

        .obligatorio::after {
            content: " *";
            color: red;
            /* Puedes ajustar el color según tus preferencias */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 8px 8px rgba(0, 0, 0, 0.1);
            /* Ajusta los valores según tus preferencias */
            background-color: rgb(255, 255, 255);
        }

        /* Estilo para las celdas de la tabla (opcional) */
        td,
        th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        body {
            background-color: rgb(244, 246, 249);
            /* Color de fondo (gris claro en este caso) */
            margin: 0;
            /* Elimina el margen predeterminado del cuerpo */
            padding: 0;
            /* Elimina el relleno predeterminado del cuerpo */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* Estilo para las celdas de encabezado (th) */
        th {
            background-color: #ffffff;
            /* Fondo blanco */
            border: 1px solid #ddd;
            /* Borde del encabezado */
            padding: 10px;
            /* Espaciado interno */
            text-align: left;
            /* Alineación del texto */
        }

        /* Estilo para las celdas de datos (td) */
        td {
            border: 1px solid #ddd;
            /* Borde de las celdas de datos */
            padding: 10px;
            /* Espaciado interno */
            text-align: left;
            /* Alineación del texto */
        }


        /* Estilo para los botones en la barra de herramientas */
        .dt-buttons button {
            margin-right: 5px;
            /* Espaciado entre botones (opcional) */
        }

        /* Eliminar fondo gris de los botones en DataTables */
        .dt-buttons button {
            background-color: transparent !important;
            /* Fondo transparente y !important para anular otros estilos */
            border: none !important;
            /* Eliminar el borde y !important para anular otros estilos de borde */
            color: #333 !important;
            /* Establecer el color del texto, puedes ajustarlo según tus preferencias */
        }

        /* Estilo adicional para resaltar el botón cuando se pasa el mouse sobre él (opcional) */
        .dt-buttons button:hover {
            background-color: #efefef;
            /* Color de fondo cuando se pasa el mouse (puedes ajustarlo según tus preferencias) */
        }

        /* Estilo para la barra de herramientas de DataTables */
        .dataTables_wrapper {
            background-color: #ffffff;
            /* Fondo blanco */
            border-radius: 5px;
            /* Bordes redondeados (opcional) */
            padding: 10px;
            /* Espaciado interno (opcional) */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra (opcional) */
        }

        /* Estilo adicional para resaltar el área de búsqueda al pasar el mouse (opcional) */
        .dataTables_wrapper .dataTables_filter:hover {
            background-color: #efefef;
            /* Color de fondo cuando se pasa el mouse (puedes ajustarlo según tus preferencias) */
        }

        /* Estilo para el contenedor general de DataTables */
        .dataTables_wrapper {
            margin-bottom: 20px;
            /* Márgenes en la parte inferior para alejar del contenido siguiente */
        }

        /* Estilo adicional para resaltar el área de búsqueda al pasar el mouse (opcional) */
        .dataTables_wrapper .dataTables_filter:hover {
            background-color: #efefef;
            /* Color de fondo cuando se pasa el mouse (puedes ajustarlo según tus preferencias) */
        }

        footer {
            background-color: blue;
            /* Fondo blanco */
            padding: 10px;
            /* Espaciado interno (ajusta según tus necesidades) */
            text-align: center;
            /* Alinea el contenido al centro (ajusta según tus necesidades) */
        }

        .nav {
            background-color: rgb(52, 58, 64);
            /* Color de fondo de la barra lateral (ajusta según tus necesidades) */
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            /* Sombra en el lado derecho */
            /* Otros estilos según tus necesidades */
        }

        /* Estilo para la barra de desplazamiento */
        ::-webkit-scrollbar {
            width: 12px;
            /* Ancho de la barra de desplazamiento */
        }

        /* Estilo para el "pulgar" (thumb) de la barra de desplazamiento */
        ::-webkit-scrollbar-thumb {
            background-color: rgb(233, 236, 239);
            /* Color del pulgar */
            border-radius: 6px;
            /* Bordes redondeados del pulgar */
        }

        /* Estilo para el fondo de la barra de desplazamiento */
        ::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            /* Color del fondo de la barra de desplazamiento */
        }
    </style>
</head>

<body class="sb-nav-fixed" style="color: white">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" id="nav" style="color: white">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?php echo base_url; ?>Empresa/home  ">Sistema de Venta</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <!-- Tiempo        *************************************** -->
        <div class="reloj ml-3">
            <p style="color: white" class="fecha" id="fecha"></p>

        </div>
        <li>
            <a href="<?php echo base_url; ?>Clientes/salir" class="secion"><span class="secion"><strong>Cerrar
                        Secion</strong></span></a>
        </li>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-users fa-fw"></i></a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#chamgePass"><i
                                class="fas fa-user me-2"></i>Perfil</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav" style="color: white">
        <hr>
        <div id="layoutSidenav_nav" style="color: white">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="color: white">
                <div class="sb-sidenav-menu" style="color: white">
                    <div class="nav" style="color: white">

                        <hr class="linea-divisoria">
                        <a class="nav-link" href="<?php echo base_url; ?>Perfil">
                            <div class="sb-nav-link-icon">
                                <!--<i class="fas fa-user - icono-mas-grande"></i> -->
                                <img src="Img/Perfil.png" height="40px">

                            </div>
                            <!----------->
                            <b class="mayusculas"> <span>
                                    <?php echo $id_usuario ?>
                                </span></b>


                        </a>
                        <hr class="linea-divisoria">

                        <!--Administracion-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon" style="color: white;"><i
                                    class="fas fa-cogs  icono-mas-grande"></i></div>
                            <i></i><strong>Administración</strong>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><i
                                        class="fas fa-user me-2 text icono-mas-peque"></i>Usuario</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Empresa"><i
                                        class="fas fa-tools me-2 text icono-mas-peque"></i>Configuracion</a>
                            </nav>
                        </div>

                        <!--Cajas-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCajas"
                            aria-expanded="false" aria-controls="collapseCajas">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools icono-mas-grande"></i>
                            </div>
                            <i></i><strong>Administrar Cajas</strong>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCajas" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Caja"><i
                                        class="fas fa-box me-2 icono-mas-peque"></i>Cajas</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Caja/arqueo"><i
                                        class="fas fa-money-check-alt me-2 icono-mas-peque"></i>Arqueo</a>
                        </div>
                        <!--********-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseAlmacen" aria-expanded="false" aria-controls="collapseAlmacen">
                            <div class="sb-nav-link-icon"><i class="fas fa-warehouse - icono-mas-grande"></i>
                            </div>
                            <i></i><strong>Almacen</strong>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAlmacen" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>Categorias">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tag - icono-mas-grande"></i></div>
                                    Categorias
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>Medidas">
                                    <div class="sb-nav-link-icon"><i class="fas fa-ruler - icono-mas-grande"></i>
                                    </div>
                                    Medidas
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>Productos">
                                    <div class="sb-nav-link-icon"><i class="fab fa-product-hunt - icono-mas-grande"></i>
                                    </div>
                                    Productos
                                </a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseCotizaciones" aria-expanded="false"
                            aria-controls="collapseCotizaciones">
                            <div class="sb-nav-link-icon"><i class="fas fa-warehouse - icono-mas-grande"></i>
                            </div>
                            <i></i><strong>Cotizaciones</strong>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCotizaciones" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>Cotizacion">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tag - icono-mas-grande"></i></div>
                                    Nueva Cotizacion
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>Cotizacion/historial">
                                    <div class="sb-nav-link-icon"><i class="fas fa-ruler - icono-mas-grande"></i>
                                    </div>
                                    Administrar
                                </a>
                            </nav>
                        </div>
                        <!--********-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseApartados" aria-expanded="false" aria-controls="collapseApartados">
                            <div class="sb-nav-link-icon"><i class="fas fa-warehouse - icono-mas-grande"></i>
                            </div>
                            <i></i><strong>Apartados</strong>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseApartados" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>Apartados">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tag - icono-mas-grande"></i></div>
                                    Apartar Productos
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>Apartados/historial">
                                    <div class="sb-nav-link-icon"><i class="fas fa-ruler - icono-mas-grande"></i>
                                    </div>
                                    Historial Apartados
                                </a>
                            </nav>
                        </div>

                        <!--Entradas-->

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt - icono-mas-grande"></i>
                            </div>
                            <i></i><strong>Entradas</strong>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCompras" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Compras"><i
                                        class="fas fa-shopping-cart - icono-mas-peque"></i>Nueva Compra</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Proveedor"><i
                                        class="fas fa-history me-2 - icono-mas-peque"></i>Proveedores</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Compras/Historial"><i
                                        class="fas fa-history me-2 - icono-mas-peque"></i>Historial</a>
                                <!-------------------->

                            </nav>
                        </div>

                        <!--Salidas-->

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseSalidas" aria-expanded="false" aria-controls="collapseSalidas">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt - icono-mas-grande"></i>
                            </div>
                            <i></i><strong>Salidas</strong>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseSalidas" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Ventas"><i
                                        class="fas fa-cart-plus me-2 - icono-mas-peque"></i>Nueva Venta</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Clientes"><i
                                        class="fas fa-users me-2 - icono-mas-peque"></i>Clientes</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Ventas/Historial"><i
                                        class="fas fa-history me-2 - icono-mas-peque"></i>Historial</a>
                                <!-------------------->

                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseVCredito" aria-expanded="false" aria-controls="collapseVCredito">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt - icono-mas-grande"></i>
                            </div>
                            <i></i><strong>Ventas a Credito</strong>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseVCredito" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Ventas/credito"><i
                                        class="fas fa-cart-plus me-2 - icono-mas-peque"></i>Administrar Credito</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Ventas/historial_credito"><i
                                        class="fas fa-users me-2 - icono-mas-peque"></i>Historial Abonos</a>


                            </nav>
                        </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-2">