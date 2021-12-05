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
            $errorLogin2 = false;

            $tienda = new Tienda();
            //Para cuentas existentes
            if($_POST["tipo"] == "existente"){
                $sql = "SELECT id, correo, contrasenia, nombre FROM usuarios where correo = '" . validarDato($_POST["correo"])."'";
                if(!($arreglo = $tienda->ejecutarQuery($sql))){
                    $errorLogin = true;
                }
                else{
                    $correo = validarDato($_POST["correo"]);
                    $contrasenia = validarDato($_POST["contrasenia"]);
                    $nombre = $arreglo[0]["nombre"];

                    if($contrasenia == trim($arreglo[0]["contrasenia"])){
                        $_SESSION["id"] = $arreglo[0]["id"];
                        $_SESSION["correo"] = $correo;
                        $_SESSION["contrasenia"] = $contrasenia;
                        $_SESSION["nombre"] = $nombre;
                        header('Location: index.php');
                    }else{
                        $errorLogin = true;
                    }
                }
                
                //Para nuevas cuentas
            }else if($_POST["tipo"] == "nueva"){
                $sql = "SELECT correo FROM usuarios where correo = '" . validarDato($_POST["correo"])."'";
                if($tienda->ejecutarQuery($sql)){
                    $nombre = validarDato($_POST["nombre"]);
                    $correo = validarDato($_POST["correo"]);
                    $contrasenia = validarDato($_POST["contrasenia"]);
                    $direccion = validarDato($_POST["direccion"]);
                    $ciudad = validarDato($_POST["ciudad"]);
                    $pais = validarDato($_POST["pais"]);

                    $sql = "INSERT INTO usuarios VALUES (NULL,'$nombre','$correo','$contrasenia','$direccion','$ciudad','$pais');";
                    $arreglo = $tienda->ejecutarQuery($sql);

                    $_SESSION["nombre"] = $nombre;
                    $_SESSION["correo"] = $correo;
                    $_SESSION["contrasenia"] = $contrasenia;
                    header('Location: index.php');
                }
                else{
                    $errorLogin2 = true;
                }
            }

        ?>
        <br><br><br>

        <div id="divMain">
            <!-- Cuentas existentes -->
            <form id="formExistente" action="login.php" method="post">
                <div id="divContacto" style="border-radius:14px">
                <p style="color:red"><?php if($errorLogin) echo "Correo o contraseña incorrectos" ?></p>
                <table>
                    <tr><td colspan="2" style="text-align:center"><h1>Iniciar sesión</h1></td></tr>
                    <tr><td>Correo: </td></tr>
                    <tr><td><input id="eCorreo" type="text" name="correo"></td></tr>

                    <tr><td>Contraseña: </td></tr>
                    <tr><td><input id="ePassword" type="password" name="contrasenia"></td></tr>
                    <input type="hidden" name="tipo" value="existente">
                    <tr>
                        <td colspan="2">
                        <input id="botonExistente" type="submit" value="ENTRAR" class="boton" style=" width: 100%; margin-top: 3rem;" ></td>
                    </tr>
                </table>
                </div>
            </form>

            <!-- Cuentas no existentes -->
            <form id="formNuevo" action="login.php" method="post">
                <div id="divContacto" style="border-radius:14px; background-color: #3bceac">
                <table>
                    <tr><td colspan="2" style="text-align:center"><h1>Crear cuenta</h1></td></tr>
                    <p style="color:red"><?php if($errorLogin2) echo "Datos faltantes o cuenta ya existente" ?></p>
                    
                    <tr><td>Nombre: </td>
                    <td><input type="text" name="nombre"></td></tr>

                    <tr><td>Correo: </td>
                    <td><input id="nCorreo" type="text" name="correo"></td></tr>

                    <tr><td>Contraseña: </td>
                    <td><input id="nPassword" type="password" name="contrasenia"></td></tr>

                    <tr><td>Dirección: </td>
                    <td><input type="text" name="direccion"></td></tr>

                    <tr><td>País: </td>
                    <td><input type="text" name="pais"></td></tr>

                    <tr><td>Ciudad: </td>
                    <td><input type="text" name="ciudad"></td></tr>

                    <input type="hidden" name="tipo" value="nueva">
                    <tr>
                        <td colspan="2">
                        <input id="botonNuevo" type="submit" value="CREAR" class="boton" style=" width: 100%; margin-top: 3rem;" ></td>
                    </tr>
                </table>
                </div>
            </form>

        </div>
        <a href="adminLogin.php">Iniciar sesión como administrador</a>
    </main>


    <script>
        const regexCorreo = /.{3,}@.{3,}\..{1,}/;
        const regexContra = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/;

        // Valida la contraseña y el correo de las existentes 
        const existente = document.querySelector("#botonExistente");
        existente.addEventListener("click", () => {
            const correo = document.querySelector('#eCorreo').value.trim();
            const contra = document.querySelector('#ePassword').value.trim();

            if(!regexCorreo.test(correo)){
                alert("Inserte un correo válido");
                <?php $_POST["tipo"] = "error" ?>
            }
            if(!regexContra.test(contra)){
                alert("Inserte contraseña válida: "+ 
                "8 caracteres mínimo, al menos un número, un caracter especial"+
                "y una letra mayúscula");
                <?php $_POST["tipo"] = "error" ?>
            }
        });

        // Valida la contraseña y el correo de las nuevas
        const nuevo = document.querySelector("#botonNuevo");
        nuevo.addEventListener("click", () => {
            const correo = document.querySelector('#nCorreo').value.trim();
            const contra = document.querySelector('#nPassword').value.trim();

            if(!regexCorreo.test(correo)){
                alert("Inserte un correo válido");
                <?php $_POST["tipo"] = "error" ?>
            }
            if(!regexContra.test(contra)){
                alert("Inserte contraseña válida: "+ 
                "8 caracteres mínimo, al menos un número, un caracter especial"+
                "y una letra mayúscula");
                <?php $_POST["tipo"] = "error" ?>
            }
        });
    </script>


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