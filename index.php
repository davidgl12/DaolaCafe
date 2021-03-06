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
        <a class="navbar-brand" href="#">
            <img src="logo.svg" alt="Logo" style="width:5rem">
          </a>


        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#colapsar">
            <span class="navbar-toggler-icon navbar-light"></span>
        </button>
        <!-- Links -->
        <div class="collapse navbar-collapse justify-content-end" id="colapsar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#divNosotros">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#productosTitulo"">Productos</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Tiendas</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="#divContacto">Contacto</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="background-color:#4992fd; border-radius:14px; font-size:1rem; margin-top:8px">
                    <?php if(isset($_SESSION["correo"])) echo "Cambiar Cuenta"; else echo "Iniciar Sesión";?>
                    </a>
                </li>

                <a class="nav-link" href="carrito.php" style="font-family: 'Material Icons';"><span class="material-icons-outlined">
                        shopping_cart
                        </span>
                </a> 
            </ul>
        </div>
      
      </nav>

    <main>
        <div id="divHero">
            <h3>Café con ❤️</h3>
            <p><?php if(isset($_SESSION["nombre"])) echo "Hola, ".$_SESSION["nombre"]."! "?>Empieza a elegir tu café, nosotros nos encargamos del resto</p>
            <a class="link" id="botondivHeroa" href="#divProductos"><div id="botondivHero" class="boton">COMPRAR CAFÉ</div></a>
        </div>
        
        <div id="divNosotros">
            <h1>Nosotros:</h1>
            <p>Somos una compañía joven formada desde 2018 establecida en Torreón Coahuila
                , nos encanta el café, pero nos encanta más el brindarle al mundo su café de las mañanas.</p>
        </div> 

        <div id="productosTitulo">
            <h1>Productos:</h1>
        
            <div id="divProductos">
                <!-- <div class="producto">
                    <img src="imagenes/producto1.jpg" alt=""> 
                    <p class="descripcion">Cafe Etzal, café tipo Honey de Especialidad, cafe artesanal, cafe altas montañas (320 gr) </p>
                    <p class="precio">$300</p>
                    <a class="link" href="#"><div class="boton">COMPRAR</div></a>
                </div>
                <div class="producto">
                    <img src="imagenes/producto2.jpg" alt=""> 
                    <p class="descripcion">Café Doce Doce Premium Grano Honey (250 grs)</p>
                    <p class="precio">$240</p>
                    <a class="link" href="#"><div class="boton">COMPRAR</div></a>
                </div>
                <div class="producto">
                    <img src="imagenes/producto3.jpg" alt=""> 
                    <p class="descripcion">Adore Coffee The Mastro Blend Coffee Bean (1kg)</p>
                    <p class="precio">$350</p>
                    <a class="link" href="#"><div class="boton">COMPRAR</div></a>
                </div>
                <div class="producto">
                    <img src="imagenes/producto4.png" alt=""> 
                    <p class="descripcion">Beraldo Premium Blend Coffee Beans (1kg)</p>
                    <p class="precio">$450</p>
                    <a class="link" href="#"><div class="boton">COMPRAR</div></a>
                </div>
                <div class="producto">
                    <img src="imagenes/producto5.jpg" alt=""> 
                    <p class="descripcion">Campos Roma Espresso Blend coffee beans (1kg)</p>
                    <p class="precio">$500</p>
                    <a class="link" href="#"><div class="boton">COMPRAR</div></a>
                </div>
                <div class="producto">
                    <img src="imagenes/producto6.jpg" alt=""> 
                    <p class="descripcion">Coffex SuperBar coffee beans (1kg)</p>
                    <p class="precio">$300</p>
                    <a class="link" href="#"><div class="boton">COMPRAR</div></a>
                </div> -->
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
                        <input type="submit" value="ENVIAR" class="boton" style=" width: 100%; margin-top: 3rem;"></td>
                    </tr>
                </table>
            </form>
        </div>
    
        
    </main>

    <script>

    </script>
</body>
</html>
