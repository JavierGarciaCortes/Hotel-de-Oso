<?php
session_start();
include 'objetos.php';
error_reporting(0);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Solicitud de reserva | Hotel del Oso</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        img {
            width: 100%;
            vertical-align: bottom;
        }

    </style>
</head>

<body>
    <header>
        <div class="container-fluid border bg-light">
            <div class="container">
                <div class="row align-items-center no-gutters">
                    <div class="col-7 col-md-3"><a href="index.html"><img src="img/logo-oso.png" alt="Logo Hotel del Oso" style="max-width: 120px"></a></div>
                    <div class="col">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-end">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            HOTEL
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item disabled" href="#">LAS HABITACIONES</a>
                                            <a class="dropdown-item disabled" href="#">LOS ESPACIOS</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            RESTAURANTE
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item disabled" href="#">ESPECIALIDADES</a>
                                            <a class="dropdown-item disabled" href="#">RECETAS</a>
                                            <a class="dropdown-item" href="http://clubcalidadcantabriainfinita.es/es/" target="_blank">EL CLUB DE CALIDAD</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            TARIFAS
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="promociones.html">PROMOCIONES</a>
                                            <a class="dropdown-item" href="solicitudReserva.php">SOLICITUD RESERVA</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#">DONDE ESTAMOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="picos_de_europa.html">PICOS DE EUROPA</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#">RUTAS</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Barra negra -->
    <div class="container-fluid p-0" style="background-color: black">
        <div class="container">
            <nav class="row" aria-label="breadcrumb">
                <ol class="breadcrumb m-0" style="background-color: black">
                    <li class="breadcrumb-item"><a href="index.html">HOME</a></li>
                    <li class="breadcrumb-item active" aria-current="page">SOLICITUD DE RESERVA</li>
                </ol>
            </nav>
            <div class="row pl-3">
                <h3 style="color: white;">SOLICITUD DE RESERVA</h3>
            </div>
        </div>
    </div>

    <main class="container">
        <!-- Intro  -->
        <div class="row m-4">
            <p>Rellene el siguiente formulario para solicitar su reserva.</p>
            <p>La cumplimentación de este formulario no supone la realización de la reserva. El hotel se pondrá en contacto con usted para gestionar su solicitud.</p>
        </div>





        <!-- Tabla precios  -->
        <table class="table table-borderless" style="background-image: url(img/imgn-tarifas.jpg);">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">T.Baja</th>
                    <th scope="col">T.Media</th>
                    <th scope="col">T.Alta</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Doble</th>
                    <td>72,60€</td>
                    <td>79,50€</td>
                    <td>91,80€</td>
                </tr>
                <tr>
                    <th scope="row">Individual</th>
                    <td>60,50€</td>
                    <td>64,00€</td>
                    <td>73,00€</td>
                </tr>
                <tr>
                    <th scope="row">Familiar</th>
                    <td>109,00€</td>
                    <td>117,70€</td>
                    <td>132,00€</td>
                </tr>
                <tr>
                    <th scope="row">Habitaciones comunicadas</th>
                    <td>120,00€</td>
                    <td>128,70€</td>
                    <td>141,00€</td>
                </tr>
                <tr>
                    <th scope="row">Cama supletoria</th>
                    <td colspan="2">A partir de 11 años</td>
                    <td>15€</td>
                </tr>
                <tr>
                    <th scope="row">Cuna</th>
                    <td colspan="3">Bajo peticion</td>
                </tr>
                <tr>
                    <th scope="row">Desayuno bufet (hasta 10 años)</th>
                    <td>5,50€</td>
                    <td>5,50€</td>
                    <td>5,50€</td>
                </tr>
                <tr>
                    <th scope="row">Desayuno bufet (a partir de 10 años)</th>
                    <td>11,00€</td>
                    <td>11,00€</td>
                    <td>11,00€</td>
                </tr>
                <tr>
                    <th scope="row">Mini-desayuno (en el bar)</th>
                    <td>4,50€</td>
                    <td>4,50€</td>
                    <td>4,50€</td>
                </tr>
                <tr>
                    <th scope="row">10% IVA incluido en todos los precios</th>
                </tr>
            </tbody>
        </table>

    </main>
    <footer>
        <div class="container-fluid border bg-light">
            <div class="container">
                <div class="row align-items-center no-gutters">
                    <div class="d-flex justify-content-center col-md-4"><a href="http://clubcalidadcantabriainfinita.es/es/" target="_blank"><img src="img/logoclubdecalidad.jpg" alt="Logo Club Caldad Cantabria Infinita"></a></div>
                    <div class="col">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center"><a href="https://www.facebook.com/Hoteldeloso/" target="_blank"><img src="https://img.icons8.com/color/48/000000/facebook.png"></a></div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">Cosgaya (Cantabria) Spain. Tel. +34 942 733 018 info@hoteldeloso.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
