<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once('model.php');
    $tienda = new Tienda();

    $usuarioId = $_SESSION["id"];
    $productoId = $_POST["id"];
    $cantidad = $_POST["cantidad"];
    $sql = "INSERT INTO `pedidos` (`id`, `idUsuario`, `idProducto`, `cantidad`) VALUES(NULL,'$usuarioId','$productoId','$cantidad');";
    echo $sql;
    $tienda->ejecutarQuery($sql);
    header("Location: carrito.php");
}else
    echo "no, te odio >:c";
?>