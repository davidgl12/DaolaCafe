<?php
    require_once('model.php');

    $tienda = new Tienda();

    $sql = "SELECT * FROM productos";

    $arreglo = $tienda->ejecutarQuery($sql);
    
    for($i = 0; $i < count($arreglo); $i++){
        echo '<div class="producto">' . "\n";
        echo '<img src="'.$arreglo[$i]["imagen"].'" alt="">' . "\n";
        echo '<p class="descripcion">'.$arreglo[$i]["nombre"].'</p>';
        echo '<p class="precio">$'.$arreglo[$i]["costo"].'</p>';
        echo '<a class="link" href="producto.php?id='.$arreglo[$i]["id"].'"><div class="boton">COMPRAR</div></a>';
        echo '</div>';
    }
?>