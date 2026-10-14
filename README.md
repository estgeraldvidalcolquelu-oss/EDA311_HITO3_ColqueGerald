# Proyecto EDA311 HITO 3 - Gerald Colque

Aplicacion web desarrollada en PHP nativo y MySQL, implementando una Lista Doblemente Enlazada y el algoritmo de ordenamiento Burbuja (Bubble Sort) desde cero, sin librerias externas.

---

## GUIA DE EJECUCION PASO A PASO

### Paso 1: Clonar el repositorio
Abre una terminal en tu computadora y ejecuta:

git clone https://github.com/estgeraldvidalcolquelu-oss/EDA311_HITO3_ColqueGerald.git
cd EDA311_HITO3_ColqueGerald

### Paso 2: Encender el servidor PHP
Dentro de la carpeta del proyecto en la terminal, ejecuta este comando para levantar el servidor:

C:\xampp\php\php.exe -S localhost:8000

Si tienes PHP en tus variables de entorno, tambien puedes poner:

php -S localhost:8000

### Paso 3: Entrar desde el navegador
Una vez ejecutado el comando anterior, abre tu navegador web e ingresa a la siguiente direccion:

http://localhost:8000/index.php

---

## CONFIGURACION DE BASE DE DATOS

El proyecto cuenta con conexion automatica en conexion.php para conectarse a la IP del laboratorio (10.0.40.85) y con respaldo local en XAMPP (127.0.0.1 en puerto 3308).

- Base de datos: tienda_colque
- Usuario: u_colque_gerald (o root en local)
- Contrasena: Rio#26B8kP4
- Tablas: clientes, productos, pedidos

---

## ESTRUCTURA DEL PROYECTO

- conexion.php: Gestion de conexion a MySQL con respaldo.
- ListaDoble.php: Clase Nodo y ListaDoble con algoritmo de ordenamiento Burbuja.
- index.php: Menu principal del sistema.
- clientes.php: Modulo CRUD de Clientes.
- productos.php: Modulo CRUD de Productos.
- pedidos.php: Modulo CRUD de Pedidos.