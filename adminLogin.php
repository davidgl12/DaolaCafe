<?php session_start(); ?>

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

        <?php
            require_once('model.php');

            $errorLogin = false;

            $tienda = new Tienda();
                
            if($_POST["tipo"] == "existente"){
                $usuario = $_POST["usuario"];
                $contrasenia = $_POST["contrasenia"];
                if($usuario == $tienda->getUsuario() && $contrasenia == $tienda->getContrasenia()){
                    $_SESSION["usuario"] = $usuario;
                    $_SESSION["contrasenia"] = $contrasenia;
                    header('Location: admin.php');
                }else{
                    $errorLogin = true;
                }
            }

        ?>
        <br><br><br>

        <div id="divMain">
            <form action="adminLogin.php" method="post">
                <div id="divContacto" style="border-radius:14px;background-color:#f7ee7f;  color: black">
                <p style="color:red"><?php if($errorLogin) echo "Correo o contraseña incorrectos" ?></p>
                <table>
                    <tr><td colspan="2" style="text-align:center"><h1>Iniciar sesión ADMIN</h1></td></tr>
                    <tr><td>Usuario: </td></tr>
                    <tr><td><input type="text" name="usuario"></td></tr>

                    <tr><td>Contraseña: </td></tr>
                    <tr><td><input type="password" name="contrasenia"></td></tr>
                    <input type="hidden" name="tipo" value="existente">
                    <tr>
                        <td colspan="2">
                        <input type="submit" value="ENTRAR" class="boton" style=" width: 100%; margin-top: 3rem;" ></td>
                    </tr>
                </table>
                </div>
            </form>
        </div>

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
