# Sistema de Autogestión Institucional (SAI) 

## Descripción
Este proyecto surge de la necesidad de optimizar la gestión académica del **Instituto Tecnológico N°3**. El sistema centraliza la inscripción a mesas de examen, reduciendo la sobrecarga administrativa y evitando errores en los registros manuales. Fue desarrollado como parte del "Seminario de Aplicación", integrando un análisis profundo de requerimientos y una arquitectura de software escalable.

##Pantalla de acceso al sistema 
![LOGIN](img/login%20-%20validacion%20de%20usuario.png)

## Características Principales
El sistema cuenta con una gestión basada en roles (RBAC) para garantizar la integridad de la información:

- **Rol Alumnado:**
  - Visualización de mesas de examen disponibles según carrera y año.
  - Inscripción autónoma a exámenes finales (primer y segundo llamado).
  - Gestión de inscripciones activas (visualización y cancelación).
  - Control de condiciones académicas (Regular, Libre, Promocionado).

**Panel de alumnado - Visualización de mesas de examen**
![PANEL ALUMNADO](img/visualizar%20mesas%20filtradas%20al%20alumno%20para%20inscribirse.png)

- **Rol Secretaría Académica:**
  - Registro y administración de mesas de examen.
  - Modificación y edición de registros existentes con validación de integridad.
  - Generación de reportes y control de mesas de examen por carrera.

**Panel administrativo - Visualización de mesas de examen cargadas y editables**
![PANEL ADM](img/visualizacion$20de$20mesas%20de%20examen$20cargadas%20y%20modificables$20para$20adm.png)

## Tecnologías Utilizadas
- **Backend:** PHP (Arquitectura MVC).
- **Frontend:** HTML5, CSS3 (Bootstrap 5), JavaScript.
- **Base de Datos:** MySQL.
- **Seguridad:** Gestión de credenciales mediante variables de entorno (.env) y Composer.

## Documentación del Proyecto
En la carpeta `/documentacion` se puede encontrar el material técnico y de usuario completo:
- **Manual del Analista:** Detalle de las fases de relevamiento, diagramas de contexto (Nivel 0), diccionario de datos y estudio de factibilidad.
- **Manuales de Usuario:** Guías paso a paso con ilustraciones para los roles de Alumnado y Secretaría.

## Instalación
1. Clonar el repositorio.
2. Configurar el archivo `.env` tomando como base el archivo `.env.example`.
3. Importar el script SQL ubicado en la carpeta `/sql`.
4. Asegurarse de contar con las dependencias de Composer ejecutando `php composer.phar install` (si el entorno lo permite).

---

## Estado del Proyecto e Implementaciones Futuras
Actualmente, el sistema se encuentra en su **Fase 1**, cumpliendo con los objetivos críticos de inscripción autónoma y gestión de mesas. Como parte de la hoja de ruta para futuras versiones, se planea:

* **Módulo de Reportes Avanzados:** Generación de archivos PDF para actas de examen.
* **Notificaciones:** Sistema de alertas por correo electrónico para confirmar inscripciones.
* **Interfaz de Administrador:** Panel para la gestión de usuarios y roles de forma dinámica.

---
**Desarrollado por Luz Bonazeski** *Ciclo Lectivo 2025 - Seminario de Aplicación*
