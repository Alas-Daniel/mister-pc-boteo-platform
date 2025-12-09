# Mister PC Boteo

Mister PC Boteo es una plataforma web en desarrollo diseñada para gestionar de forma eficiente los servicios de reparación, mantenimiento y venta de productos tecnológicos. El sistema cuenta con dos paneles principales: Administrador y Técnico.

---

## Sobre Mister PC Boteo

Mister PC Boteo es una empresa dedicada a la reparación, mantenimiento y venta de repuestos para computadoras. Este sistema fue desarrollado para optimizar y centralizar sus operaciones internas, mejorando la organización y experiencia de trabajo.

---

## Estructura del Proyecto

* `panel_admin/`: Panel principal para administración del sistema.
* `panel_tecnico/`: Panel exclusivo para técnicos registrados.

---

## Panel de Administrador

El panel de administrador es el centro de control del sistema. Sus funcionalidades principales incluyen:

### Gestión de Técnicos

* Registrar, editar o eliminar técnicos.
* Consultar estado y actividad de cada técnico.

### Gestión de Productos

* Registrar productos con información como: imagen, nombre, precio, categoría, tipo de presentación (unidad o caja), stock, etc.
* Editar o eliminar productos.
* Crear nuevas categorías.
* Filtrar productos por categoría o disponibilidad.

### Gestión de Equipos

* Registrar equipos enviados por clientes.
* Asignar equipos a técnicos.
* Ver historial de reparaciones y cambios de estado.
* Editar y actualizar información del equipo.

### Dashboard

* Resumen general del sistema: técnicos activos, productos disponibles, equipos en reparación, entre otros.

### Gestión de Usuarios

* Ver todos los usuarios registrados en el sistema.

---

## Panel de Técnico

El panel del técnico está orientado al trabajo operativo diario:

### Equipos Asignados

* Ver equipos que debe revisar o reparar.
* Añadir nuevos equipos.
* Consultar y actualizar los detalles de cada equipo.

### Actualización de Estado

* Cambiar el estado del equipo (no iniciado, en proceso, finalizado, entregado).
* Agregar observaciones o evidencia de reparación.

### Gestión de Clientes

* Ver lista de clientes.
* Registrar nuevos clientes.

---

## Roles y Seguridad

El sistema incluye roles con permisos específicos:

| Rol     | Acceso                                             | Restricciones                              |
| ------- | -------------------------------------------------- | ------------------------------------------ |
| Admin   | Acceso total a todo el sistema                     | Ninguna                                    |
| Técnico | Equipos asignados, dashboard, clientes y productos | No puede acceder a módulos administrativos |

---

## Tecnologías Utilizadas

* Frontend: HTML5, CSS3, Bootstrap 5, JavaScript
* Backend: PHP
* Base de Datos: MariaDB
* Hosting local: XAMPP
* Librerias: DOMPDF, PHPMailer

---

## Estado del Proyecto

Estado del Proyecto

El sistema se encuentra finalizado en su primera versión estable. Actualmente incluye todas las funcionalidades principales para la gestión de técnicos, productos, equipos y clientes.

---

## Desarrolladores V1.0

* Daniel Alas – Estudiante de Ingeniería en Sistemas y Computación.
* Cesar Ramírez – Estudiante de Técnico en Desarrollo de Software.

---

© 2025 Mister PC Boteo. Todos los derechos reservados.
