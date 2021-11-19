<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Daola</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css532 950 05142?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="style.css">

     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    
</head>
<body>
    
    <nav class="navbar navbar-expand-sm bg-light fixed-top">
        <a class="navbar-brand" href="index.php">
            <img src="logo.svg" alt="Logo" style="width:5rem">
          </a>


        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#colapsar">
            <span class="navbar-toggler-icon navbar-light"></span>
        </button>
        <!-- Links -->
        <div class="collapse navbar-collapse justify-content-end" id="colapsar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php#divNosotros">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#productosTitulo"">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#divContacto">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="background-color:#4992fd; border-radius:14px; font-size:1rem; margin-top:8px">
                    <?php if(isset($_SESSION["correo"])) echo "Cambiar Cuenta"; else echo "Iniciar Sesión";?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="carrito.php" style="font-family: 'Material Icons';"><span class="material-icons-outlined">
                        shopping_cart
                    </span></a> 
                </li>
            </ul>
        </div>
      
      </nav>
    <br>
    <br>
    <br>
    <br>
    <main>
        <?php
            require_once('model.php');

            $tienda = new Tienda();
        
            $sql = "SELECT * FROM productos where id = " . $_GET["id"];
        
            $arreglo = $tienda->ejecutarQuery($sql);

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $usuarioId = $_SESSION["id"];
                $productoId = $_POST["id"];
                $cantidad = $_POST["cantidad"];
                $sql = "INSERT INTO `pedidos` (`id`, `idUsuario`, `idProducto`, `cantidad`) VALUES(NULL,'$usuarioId','$productoId','$cantidad');";
                $tienda->ejecutarQuery($sql);
                header("Location: carrito.php");
            }
        ?>

        <div id="divProdMain">
            <div id="imagenProd">
                <img src="<?=$arreglo[0]["imagen"]?>" alt="imagen del producto">
            </div>
            <div id="datosProd">
                <h1><?=$arreglo[0]["nombre"]?></h1>
                <br>
                <p><?=$arreglo[0]["descripcion"]?></p>
                <br><br>
                <h3 style="color: rgb(4, 158, 50);">$<?=$arreglo[0]["costo"]?></h3>
                <br><br>
                <form action="" method="POST">
                    <label for="cantidad">Cantidad: </label> <br>
                    <input type="number" name="cantidad" value="1" minlength="1">
                    <span>Quedan: <?=$arreglo[0]["inventario"]?></span>
                    <input type="hidden" name="id" value="<?=$arreglo[0]["id"]?>">
                    <input type="submit" value="AÑADIR AL CARRITO" class="boton" style="float: right;" >
                </form>
            </div>
        </div>

        <div id="productosTitulo">
            <h1>Otros productos:</h1>
        
            <div id="divProductos">
                <?php require_once("fetchProductos.php");?>
                
            </div>
        </div>

        <div id="divContacto">
            <h1>Contáctanos:</h1>
    
            <form action="">
                <table>
                    <tr><td>Nombre: </td></tr>
                    <tr><td><input type="text" name="nombre"></td></tr>
    
                    <tr><td>Correo: </td></tr>
                    <tr><td><input type="text" name="correo"></td></tr>
    
                    <tr><td>Comentarios: </td></tr>
                    <tr><td><textarea name="comentarios" cols="30" rows="10"></textarea></td></tr>
                    
                    <tr>
                        <td colspan="2">
                        <input type="submit" value="ENVIAR" class="boton" style=" width: 100%; margin-top: 3rem;" ></td>
                    </tr>
                </table>
            </form>
        </div>
    </main>


    <style>
        #divProdMain{
            display: flex;
            flex-wrap: wrap;
            /* background-color: cyan; */
            padding: 2rem;
            gap: 3rem;
            justify-content: space-around;
            justify-items: center;
        }

        #imagenProd{
            /* background-color: brown; */
            /* flex-grow: 1; */
            /* flex-shrink: 2; */
            width: 30rem;
            
            
        }

        #imagenProd img{
            border: 2px solid black;
            width: 100%;
            height: 30rem;
            object-fit: scale-down;
        }

        #datosProd{
            /* background-color: cyan; */
            /* width: 45%; */
            /* flex-grow: 2; */
            /* flex-shrink: 2; */
            width: 45rem;
        }

        input[type="number"]{
            padding: 1rem;
            border: 2px solid black;
            width: 6rem;
        }

        

        @media screen and (min-width: 980px){

        }
    </style>
</body>
</html>
