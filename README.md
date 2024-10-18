# TUDAI - E-commerce vivero.

# Integrantes:
- Ramirez Virginia
- Quiroga Paula

# Descripcion
Con el objetivo de crear un sistema de e-commerce para un Vivero, desarrollamos una base de datos que almacena informacion sobre Pedidos y Planta, permitiendo a los usuarios modificarla mediante funcialidades de alta, baja y modificacion(ABM).

# Der

![Diagrama Entidad Relacion](/DER.png)

## Requisitos para desplegar el sitio
- PHP >= 7.4
- MySQL
- Apache

## Despliegue en un servidor con Apache y MySQL

### 1. Clonar el repositorio
Clona el repositorio desde GitHub (o el servicio que estés utilizando):
```bash
git clone <URL_DEL_REPOSITORIO>
cd TPE-1-WEB-II
```
### 2. Configurar la base de datos
  1. Crear la base de datos
  2. Importar el esquema de la base de datos:
        Selecciona el archivo database/vivero.sql que se encuentra en el proyecto y ejecutalo en la base de datos.
  3. Configurar las credenciales de la base de datos:
        Creando un archivo de configuracion 'config.php'
 ### 3. Configurar Apache:
      Copiar el contenido del repositorio clonado en la carpeta C:\xampp\htdocs\TPE-1-WEB-II.
      Abre el panel de control de XAMPP y asegúrate de que tanto Apache como MySQL estén iniciados.
  4. Usuarios y contraseñas:
      Usuario administrador:
          Usuario: webadmin
          Contraseña: admin

### Contribuciones
Las contribuciones son bienvenidas. Por favor, abre un issue o un pull request para mejorar el proyecto.

