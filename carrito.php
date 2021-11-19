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
        <div id="divProdMain">
            <?php
                require_once('model.php');

                $tienda = new Tienda();
            
                //obtiene los productos correspondientes a los pedidos que hizo el usuario
                $sql = "SELECT * FROM productos INNER JOIN pedidos ON productos.id = pedidos.idProducto WHERE pedidos.idUsuario = " . $_SESSION["id"];
                $arreglo = $tienda->ejecutarQuery($sql);
                $total = 0;

                for($i = 0; $i < count($arreglo); $i++){
                    $imagen = $arreglo[$i]["imagen"];
                    $nombre = $arreglo[$i]["nombre"];
                    $cantidad = $arreglo[$i]["cantidad"];
                    $costo = $arreglo[$i]["costo"];
                    $total += $costo;

                    echo "<div class='datos'>";
                    echo "<img src='$imagen'>";
                    echo "<span>$nombre</span>";
                    echo "<span>$cantidad</span>";
                    echo "<span style='color:green'>$costo</span>";
                    echo "</div>";
                }

                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["listo"] == "si"){
                    for($i = 0; $i < count($arreglo); $i++){
                        $cantidad = $arreglo[$i]["cantidad"];
                        $inventario = $arreglo[$i]["inventario"];
                        $sql = "UPDATE productos SET inventario = ".($inventario - $cantidad). " WHERE id = ".$arreglo[$i]["idProducto"];
                        $tienda->ejecutarQuery($sql);
                    }

                    $sql = "DELETE FROM pedidos WHERE idUsuario = " .$_SESSION["id"];
                    $tienda->ejecutarQuery($sql);
                    header("Location: index.php");
                }
            ?>            
        </div>
        <hr>
        <div style="padding:2rem;">
            <p>Total = <?=$total?></p>
            <form action="" method="POST">
                <input type="hidden" name="listo" value="si">
                <input type="submit" value="Comprar" class="boton">
            </form>
            <br> <br>
            <a href="index.php#divProductos" class="boton">Volver</a>
        </div>

<br><br>
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
        a:hover{
            text-decoration:none;
            color:black;
        }

        #divProdMain{
            display: flex;
            flex-wrap: wrap;
            /* background-color: cyan; */
            padding: 2rem;
            gap: 3rem;
            justify-items: center;
        }

        .datos{
            width: 25rem;
            border: 2px solid black;
            padding: .5rem;
        }

        .datos span{
            padding: .5rem;
        }

        .datos img{
            width: 30px;
            heigth: 30px;
            object-fit: scale-down; 
            float: left;
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
