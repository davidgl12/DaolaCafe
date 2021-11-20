# DaolaCafe
Tienda de café en línea, usa bootstrap, php y mysql

## Puntos importantes:
- Se asume que se tiene instalado un interpretador de PHP y que cuenta con MySQL instalado
- También se debe de tener una base de datos `tablas` que cuente con las siguientes tablas:
`pedidos(id INT, idUsuario INT,	idProducto INT,	cantidad, INT)`
`productos(id INT, nombre VARCHAR,	imagen VARCHAR,	costo INT,	descripcion VARCHAR,	inventario INT)`
`usuarios(id INT,	nombre VARCHAR,	correo VARCHAR,	contrasenia VARCHAR,	direccion VARCHAR,	ciudad VARCHAR,	pais VARCHAR)`
- **Importante:** en el archivo modelo.php en la clase Tienda, se deben modificar las variables $usuario y $contrasenia a los valores de acceso correspondientes para acceder a mysql
