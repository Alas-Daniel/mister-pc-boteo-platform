# Mister PC Boteo 

Mister PC Boteo es una plataforma web  en desarrollo diseñada para gestionar eficientemente los servicios de reparación, mantenimiento y venta de productos tecnológicos. El sistema cuenta con dos paneles principales: **Administrador** y **Técnico**.

---

## Sobre Mister PC Boteo

Mister PC Boteo es una empresa dedicada a la reparación, mantenimiento y venta de repuestos para computadoras, comprometida con ofrecer un servicio de calidad y confianza a sus clientes.

Este proyecto fue desarrollado para apoyar y optimizar las operaciones de Mister PC Boteo.

---

## Estructura del Proyecto

- `panel_admin/`: Panel para el administrador del sistema.
- `panel_tecnico/`: Panel para técnicos registrados.

---

## Panel de Administrador

El panel de administrador es el núcleo de control de todo el sistema. Las funcionalidades principales incluyen:

-   **Gestión de Técnicos**:
  - Registrar, editar o eliminar técnicos.
  - Ver estado y actividad de cada técnico.
  
-   **Gestión de Productos**:
  - Agregar productos nuevos con información como: imagen, nombre, precio, categoría, tipo de presentación (unidad o caja), cantidad en stock, etc.
  - Editar o eliminar productos existentes.
  - Añadir nuevas categorias.
  - Visualizar productos por categoría o disponibilidad.
  
-   **Gestión de Equipos Asignados**:
  - Asignar dispositivos (laptops, PCs, etc.) a los técnicos para reparación.
  - Ver historial de dispositivos, reparaciones y cambios de estado.
  - Agregar equipo, llevar seguimiento, editar y ver información del equipo.

-   **Dashboard**:
  - Visualización general del sistema: número de productos, técnicos activos, equipos en reparación, etc.

-   **Gestión de Usuarios**:
  - Ver todos los usuarios registrados.

---

##   Panel de Técnico

El técnico inicia sesión en su panel personalizado, donde puede:

-   **Ver Equipos Asignados**:
  - Acceso a la lista de dispositivos que debe revisar o reparar.
  - Ver detalles del equipo, asi como poder añadir un nuevo equipo y actualizar información.

-   **Actualizar Estado del Equipo**:
  - Cambiar el estado (en reparación, reparado, entregado, etc.).
  - Subir observaciones o adjuntar evidencia de reparación.

-   **Ver clientes**:
  - Ver clientes, agregar un nuevo cliente.

---

##   Seguridad y Roles

El sistema gestiona tres tipos de roles con permisos específicos:

| Rol         | Acceso a                           | Restricciones                        |
|-------------|------------------------------------|--------------------------------------|
| Admin       | Todo el sistema                    | Ninguna                              |
| Técnico     | Solo equipos asignados, dashboard, clientes y productos | No puede acceder a otros módulos    |

---

##   Tecnologías Utilizadas

- **Frontend**: HTML5, Bootstrap 5, CSS3, JavaScript 
- **Backend**: PHP 
- **Base de Datos**: MariaDB 
- **Hosting**: XAMPP
- **Automatización**: n8n (en proceso)

---

##   Estado del Proyecto

En desarrollo. Se están incorporando mejoras como:

- Soporte para productos por unidad y por caja.
- Implementación de funcionalidad backend.
- Mejora de la interfaz móvil.

---

##   Autor

Desarrollado por Daniel Alas – Estudiante de Ingeniería en Sistemas y Computación.

© 2025 Mister PC Boteo. Todos los derechos reservados.

