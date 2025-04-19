# API REST – Evaluación Unidad 1 Backend
Este proyecto consiste en el desarrollo de una API RESTful en PHP para una empresa ficticia de consultoría llamada Coningenio. La API permite gestionar servicios y simula el consumo de datos como si provinieran de una base de datos real.

## Estructura del proyecto
api-ev1 ├── config │   └── database.php ├── controllers │   ├── NosotrosController.php │   └── ServicioController.php ├── index.php ├── models │   ├── Nosotros.php │   └── Servicio.php └── web-coningenio ├── img │   ├── hero-image.png │   ├── logo2darkmode.png │   └── logo2.png ├── index.html ├── prototipo.png ├── README.md ├── script.js └── styles.css

## Tecnologías
- PHP 8.2
- MySQL
- HTML5, CSS3, JS
- Servidor local con XAMPP

## Instalación
1.  Clonar o copiar el proyecto en la carpeta “htdocs” de tu entorno local.
2. Verificar la conexión a la base de datos en “config/database.php”.
3. Si no tienes una base real, puedes simular los datos dentro del modelo Servicio.php.
4. Acceder a la API desde:  
   http://localhost/api-ev1/index.php
5. Acceder al frontend desde:  
   http://localhost/api-ev1/web-coningenio/index.html

## Lógica de la arquitectura
- index.php actúa como enrutador, responde según el método http (GET, POST, PUT, DELETE)
- ServicioController.php y NosotrosController.php: Controladores que reciben solicitudes y llaman al modelo
- Servicio.php y Nosotros.php: Contienen la lógica de acceso a los datos (consultas SQL o datos simulados)
- database.php: gestiona la conexión a la base de datos MySQL (opcional si se simula).
- web-coningenio/: carpeta que contiene el sitio web estático conectado a la API.

## Pruebas realizadas con Thunder Client
Se probaron los siguientes métodos:
| Método | Endpoint                             | Descripción                     | Estado |
|--------|--------------------------------------|---------------------------------|--------|
| GET    | /index.php?action=servicios          | Obtener lista de servicios      | OK  |
| POST   | /index.php?action=servicios          | Crear un nuevo servicio         | OK  |
| PUT    | /index.php?action=servicios&id=5     | Actualizar servicio con ID 5    | OK  |
| DELETE | /index.php?action=servicios&id=5     | Eliminar servicio con ID 5      | OK  |

### Ejemplo de JSON para POST
POST PUT            /index.php?action=servicios
{
    "nombre": "Nuevo Servicio",
    "descripcion": "Creación de nuevo servicio."
}

### Ejemplo de JSON para PUT
PUT            /index.php?action=servicios&id=5  Actualizar servicio con ID 5
{
    "nombre": "Nuevo Servicio 2.0",
    "descripcion": "Actualización del nuevo servicio."
}

### Ejemplo de JSON para DELETE
DELETE    /index.php?action=servicios&id=5   Eliminar servicio con ID 5   


## Creación de la base de datos
Base de datos: ‘consultoria’
```sql
-- Tabla servicios
CREATE TABLE IF NOT EXISTS servicios ( 
	id INT AUTO_INCREMENT PRIMARY KEY, 
	nombre VARCHAR(255) NOT NULL, 
	descripcion TEXT NOT NULL 
);
INSERT INTO servicios (nombre, descripcion) VALUES 
(‘Consultoría digital’, ‘Identificamos las fallas y conectamos los puntos entre tu negocio y tu estrategia digital. Nuestro equipo experto cuenta con años de experiencia en la definición de estrategias y hojas de ruta en función de tus objetivos específicos.’), 
(‘Soluciones multiexperiencia’, ‘Deleitamos a las personas usuarias con experiencias interconectadas a través de aplicaciones web, móviles, interfaces conversacionales, digital twin, IoT y AR. Su arquitectura puede adaptarse y evolucionar para adaptarse a los cambios de tu organización.’), 
(‘Evolución de ecosistemas’, ‘Ayudamos a las empresas a evolucionar y ejecutar sus aplicaciones de forma eficiente, desplegando equipos especializados en la modernización y el mantenimiento de ecosistemas técnicos. Creando soluciones robustas en tecnologías de vanguardia.’), 
(‘Soluciones Low-Code’, ‘Traemos el poder de las soluciones low-code y no-code para ayudar a nuestros clientes a acelerar su salida al mercado y añadir valor. Aumentamos la productividad y la calidad, reduciendo los requisitos de cualificación de los desarrolladores.’);

-- Tabla nosotros
CREATE TABLE IF NOT EXISTS nosotros ( 
	id INT AUTO_INCREMENT PRIMARY KEY, 
	titulo VARCHAR(255) NOT NULL, 
	descripcion TEXT NOT NULL );
INSERT INTO nosotros (titulo, descripcion) VALUES 
('Servicios de soporte, gestión y diseño de TI altamente personalizados.', 'Acelere la innovación con equipos tecnológicos de clase mundial. Lo conectaremos con un equipo remoto completo de increíbles talentos independientes para todas sus necesidades de desarrollo de software.'), 
('Misión', 'Nuestra misión es ofrecer soluciones digitales innovadoras y de alta calidad que impulsen el éxito de nuestros clientes, ayudándolos a alcanzar sus objetivos empresariales a través de la tecnología y la creatividad.'), 
('Visión', 'Nos visualizamos como líderes en el campo de la consultoría y desarrollo de software, reconocidos por nuestra excelencia en el servicio al cliente, nuestra capacidad para adaptarnos a las necesidades cambiantes del mercado y nuestra contribución al crecimiento y la transformación digital de las empresas.');

¡Gracias por visitar este repositorio!
