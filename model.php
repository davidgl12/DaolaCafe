<?php
    class Tienda{
        protected $conn;
        protected $dataArr = array();
        //MODIFIQUE ESTO A UN USUARIO DE MYSQL QUE PUEDA MODIFICAR SU BASE DE DATOS CORRESPONDIENTE:
        //normalmente usuario = root y contrasenia = "", creo
        private $usuario = "administrador";
        private $contrasenia = "Adminpassword911!";

        function __construct(){
            /*Cambiar esto: */
            $this->conn = new mysqli('localhost', $this->usuario, $this->contrasenia, 'tablas');
            if ($this->conn->connect_error) {
                die("Falló la conexión: " . $this->conn->connect_error);
            }
        }
 
        function __destruct(){
            $this->conn->close();
        }

        function ejecutarQuery($sql){
            //$sql = "SELECT * FROM productos";

            if(!$result = $this->conn->query($sql)){
                return false;
            }
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) { //fetch_assoc() pone los resultados de la row en un arreglo asociativo
                    array_push($this->dataArr, $row);
                    //$this->dataArr = $row;
                    //return $row;
                }
                return $this->dataArr;
            } else {
                echo "0 resultados";
                return false;
            }
        } 

        function getUsuario(){
            return $this->usuario;
        }

        function getContrasenia(){
            return $this->contrasenia;
        }
    }

    // Función global usada para validar datos
    function validarDato($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }
?>