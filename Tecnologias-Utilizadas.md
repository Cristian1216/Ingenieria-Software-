# Tecnologías Utilizadas en el Sistema

## 1. Introducción

El desarrollo del sistema de control de accesos requiere la integración de diferentes tecnologías que permitan garantizar seguridad, escalabilidad y facilidad de mantenimiento.

Estas tecnologías fueron seleccionadas considerando criterios técnicos como estabilidad, compatibilidad y facilidad de integración.

---

# 2. Backend

El backend es responsable de procesar la lógica del sistema y gestionar la comunicación entre los dispositivos RFID y la base de datos.

Tecnologías utilizadas:

- Node.js / Python
- API REST
- Framework backend (Express / Flask)

### Justificación

Estas tecnologías permiten desarrollar servicios escalables, eficientes y fáciles de mantener.

---

# 3. Frontend

El frontend corresponde a la interfaz gráfica utilizada por los administradores del sistema.

Tecnologías utilizadas:

- HTML5
- CSS3
- JavaScript
- Framework de interfaz (React o similar)

### Justificación

Permiten desarrollar interfaces modernas, responsivas y fáciles de usar.

---

# 4. Base de Datos

El sistema utiliza una base de datos relacional para almacenar la información.

Tecnología utilizada:

MySQL / PostgreSQL

### Información almacenada

- Usuarios
- Tarjetas RFID
- Ubicaciones
- Eventos de acceso
- Logs del sistema

---

# 5. Integración de Hardware

El sistema se integra con dispositivos físicos como:

- Lectores RFID
- Microcontroladores
- Sistemas de apertura de puertas

Ejemplo de hardware:

- Arduino
- ESP32
- Módulos RFID

### Justificación

Estos dispositivos permiten capturar información del entorno físico y enviarla al sistema para su procesamiento.

---

# 6. Repositorio de Código

El código fuente del sistema se gestiona utilizando:

Git + GitHub

### Beneficios

- Control de versiones
- Trabajo colaborativo
- Historial de cambios
- Gestión de ramas de desarrollo

---

# 7. Gestión del Proyecto

Para la gestión del proyecto se utilizó:

Monday.com

### Funcionalidades

- Gestión de tareas
- Seguimiento de avances
- Asignación de responsables
- Control del cronograma

---

# 8. Modelado del Sistema

Para el diseño del sistema se utilizaron diagramas UML.

Herramientas posibles:

- Draw.io
- Lucidchart
- StarUML

Estos diagramas permiten representar:

- Casos de uso
- Arquitectura del sistema
- Interacción entre componentes

---

# 9. Seguridad

El sistema implementa diferentes mecanismos de seguridad:

- Autenticación de usuarios
- Control de permisos
- Registro de eventos
- Validación de accesos

Esto permite proteger la información y evitar accesos no autorizados.

---

# 10. Escalabilidad

El sistema fue diseñado considerando su posible crecimiento futuro.

Posibles extensiones:

- Integración biométrica
- Aplicación móvil
- Integración con sistemas empresariales
