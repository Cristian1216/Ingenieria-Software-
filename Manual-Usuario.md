# Manual Básico de Usuario
## Sistema de Control de Accesos RFID

### 1. Introducción

El Sistema de Control de Accesos RFID es una solución tecnológica diseñada para gestionar y monitorear el ingreso de personas a diferentes áreas dentro de una organización. 

El sistema utiliza tarjetas RFID para autenticar usuarios y registrar en tiempo real los eventos de acceso, permitiendo mejorar la seguridad, el control de personal y la trazabilidad de los movimientos dentro de la empresa.

Este manual tiene como objetivo guiar a los usuarios en el uso básico del sistema, especialmente en las funciones administrativas relacionadas con la gestión de usuarios, tarjetas, accesos y reportes.

---

# 2. Acceso al Sistema

Para acceder al sistema, el usuario debe:

1. Abrir el navegador web.
2. Ingresar la dirección del sistema (URL del servidor).
3. Introducir las credenciales asignadas:
   - Usuario
   - Contraseña
4. Presionar el botón **Iniciar sesión**.

Si las credenciales son correctas, el sistema mostrará el **Panel Administrativo**.

---

# 3. Panel Administrativo

El panel administrativo es la interfaz principal del sistema desde donde se gestionan todas las funcionalidades.

Las principales secciones del panel son:

- Gestión de usuarios
- Gestión de tarjetas RFID
- Gestión de ubicaciones
- Registro de accesos
- Reportes
- Exportación de información

---

# 4. Registro de Usuarios

Esta funcionalidad permite registrar las personas que tendrán acceso a las instalaciones.

### Pasos para registrar un usuario:

1. Ingresar al menú **Usuarios**.
2. Seleccionar **Registrar nuevo usuario**.
3. Completar los siguientes campos:

- Nombre completo
- Documento de identificación
- Cargo
- Área o departamento
- Estado (activo/inactivo)

4. Guardar la información.

Una vez registrado el usuario, se podrá asociar una tarjeta RFID.

---

# 5. Asignación de Tarjetas RFID

Cada usuario puede tener una tarjeta RFID única que permitirá su identificación en los lectores de acceso.

### Procedimiento:

1. Ir al módulo **Tarjetas RFID**.
2. Seleccionar **Asignar tarjeta**.
3. Escanear o ingresar el código de la tarjeta.
4. Seleccionar el usuario al cual se asignará.
5. Guardar la asignación.

El sistema validará que la tarjeta no esté previamente asignada.

---

# 6. Gestión de Ubicaciones

El sistema permite definir las diferentes áreas o puertas controladas.

Ejemplos:

- Entrada principal
- Sala de servidores
- Oficinas administrativas
- Bodega

### Crear una ubicación:

1. Ir al módulo **Ubicaciones**.
2. Seleccionar **Agregar ubicación**.
3. Ingresar:
   - Nombre de la ubicación
   - Descripción
   - Nivel de acceso

---

# 7. Validación de Acceso

Cuando un usuario acerca su tarjeta RFID al lector:

1. El lector captura el identificador de la tarjeta.
2. El sistema consulta la base de datos.
3. Se verifica:
   - Si la tarjeta está registrada
   - Si el usuario está activo
   - Si tiene permiso para esa ubicación

Si todo es correcto:

✔ Acceso permitido  
❌ Acceso denegado en caso contrario.

---

# 8. Registro de Eventos

Cada intento de acceso genera un evento en el sistema, que incluye:

- Usuario
- Fecha
- Hora
- Ubicación
- Resultado del acceso (permitido / denegado)

Estos registros permiten auditoría y análisis posterior.

---

# 9. Generación de Reportes

El sistema permite generar reportes sobre:

- Accesos por usuario
- Accesos por ubicación
- Accesos por fecha
- Intentos fallidos de acceso

### Generar un reporte

1. Ir al módulo **Reportes**.
2. Seleccionar el tipo de reporte.
3. Definir filtros (fecha, usuario, ubicación).
4. Generar reporte.

---

# 10. Exportación de Reportes

Los reportes generados pueden exportarse en formatos:

- Excel (.xlsx)
- CSV

Esto permite realizar análisis adicionales o compartir información con otras áreas de la organización.

---

# 11. Cierre de Sesión

Para cerrar sesión de manera segura:

1. Ir al menú superior.
2. Seleccionar **Cerrar sesión**.

Esto evitará accesos no autorizados al sistema.
