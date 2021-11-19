<?php session_start(); 
if($_SESSION["usuario"] != 'administrador' || $_SESSION["contrasenia"] != 'Adminpassword911!'){
    header('Location: adminLogin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Daola</title>

    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet"> 

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
<body data-spy="scroll" data-target=".navbar" data-offset="100">
    
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
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Tiendas</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php#divContacto">Contacto</a>
                </li>

                <a class="nav-link" href="carrito.php" style="font-family: 'Material Icons';"><span class="material-icons-outlined">
                        shopping_cart
                        </span>
                </a> 
            </ul>
        </div>
      
      </nav>

    <main>
        <br><br><br>
            
        <div id="divProductos">
            
            <?php
                require_once('model.php');

                $tienda = new Tienda();
                /*CRUD: */
                if($_POST["tipo"] == "eliminar"){
                    $id = $_POST["id"];
                    $sql = "DELETE FROM productos WHERE id = '$id'";
                    $tienda->ejecutarQuery($sql);
                }else if($_POST["tipo"] == "nuevo"){
                    $nombre = $_POST["nombre"];
                    $imagensrc = "imagenes/" . basename($_FILES["imagen"]["name"]);
                    move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagensrc);
                    $costo = $_POST["costo"];
                    $descripcion = $_POST["descripcion"];
                    $inventario = $_POST["inventario"];

                    $sql = "INSERT INTO productos VALUES (NULL,'$nombre','$imagensrc','$costo','$descripcion','$inventario');";
                    $tienda->ejecutarQuery($sql);
                }
            
                $sql = "SELECT * FROM productos";
            
                $arreglo = $tienda->ejecutarQuery($sql);
                
                for($i = 0; $i < count($arreglo); $i++){
                    echo '<form action="" method="post">';
                    echo '<div class="producto">';
                    echo '<img src="'.$arreglo[$i]["imagen"].'" alt="">';
                    echo '<p class="descripcion">'.$arreglo[$i]["nombre"].'</p>';
                    echo '<p class="precio">$'.$arreglo[$i]["costo"].'</p>';
                    echo '<a class="link eliminar"><input type="submit" class="boton" value="ELIMINAR"></a>';
                    echo '</div>';
                    echo '<input type="hidden" name="tipo" value="eliminar">';
                    echo '<input type="hidden" name="id" value="'.$arreglo[$i]["id"].'">';
                    echo '</form>';
                }
            ?>
            
        </div>

        <div id="divMain" style="background-color:#f7ee7f">
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <div id="divContacto" style="border-radius:14px">
                <p style="color:red"><?php if($errorLogin) echo "Correo o contraseña incorrectos" ?></p>
                <table>
                    <tr><td colspan="2" style="text-align:center"><h1>Añadir producto:</h1></td></tr>
                    <tr><td>Nombre: </td></tr>
                    <tr><td><input type="text" name="nombre"></td></tr>

                    <tr><td>Imagen: </td></tr>
                    <tr><td><input type="file" name="imagen"></td></tr>

                    <tr><td>Costo: </td></tr>
                    <tr><td><input type="number" name="costo"></td></tr>

                    <tr><td>Descripción: </td></tr>
                    <tr><td><input type="text" name="descripcion"></td></tr>

                    <tr><td>Inventario: </td></tr>
                    <tr><td><input type="number" name="inventario"></td></tr>

                    <input type="hidden" name="tipo" value="nuevo">
                    <tr>
                        <td colspan="2">
                        <input type="submit" value="AÑADIR" class="boton" style=" width: 100%; margin-top: 3rem;" ></td>
                    </tr>
                </table>
                </div>
            </form>
        </div>
        
        <!-- <script>
            var matches = document.querySelectorAll("eliminar");
            matches.forEach((elemento) => elemento.addEventListener('click', (elemento) =>{
                alert("HOLAAAAA", elemento);
            }));
        </script> -->

    </main>

    <style>
        #divMain{
            display: flex;
            flex-wrap: wrap;
            /* background-color: cyan; */
            padding: 2rem;
            gap: 3rem;
            justify-content: space-around;
            justify-items: center;
        }
        #inicioSesion{
            border: 2px solid black;
            width: 45rem;
            padding: 1rem;
        }
        #nuevaCuenta{
            width: 30rem;
        }
        table{
            padding: 2rem;
            margin: auto;
        }

        

        table input[type="password"]{
            width: 16rem;
            background-color: rgba(255, 255, 255, 0.267);
            border: 2px solid white;
            border-radius: 15px;
            padding: .5rem;
        }        
    </style>
</body>
</html>
