# Plan de Pruebas  
## Sistema de Control de Accesos Empresarial RFID

---

# 1. Introducción

El presente documento define el **plan de pruebas** para el sistema de **control de accesos empresarial basado en tecnología RFID**.

El objetivo de este plan es verificar que el sistema cumpla con los **requisitos funcionales y no funcionales** definidos durante la fase de diseño, garantizando su correcto funcionamiento antes de su implementación en producción.

Este documento establece:

- Estrategia de pruebas  
- Tipos de pruebas  
- Casos de prueba  
- Evidencias simuladas de resultados  

---

# 2. Objetivos del Plan de Pruebas

Los objetivos principales de las pruebas son:

- Validar el correcto funcionamiento del sistema.  
- Detectar errores antes de la implementación.  
- Garantizar seguridad en el control de accesos.  
- Verificar la correcta integración entre software y hardware RFID.  
- Evaluar el rendimiento del sistema ante múltiples accesos.  

---

# 3. Alcance de las Pruebas

Las pruebas se realizarán sobre los siguientes módulos del sistema:

- Registro de usuarios  
- Gestión de tarjetas RFID  
- Validación de accesos  
- Registro de eventos  
- Panel administrativo  
- Generación de reportes  
- Exportación de reportes  

---

# 4. Estrategia de Pruebas

La estrategia de pruebas combina varios niveles de validación para garantizar la calidad del sistema.

## 4.1 Pruebas Unitarias

Se validan componentes individuales del sistema, como:

- Funciones de validación de usuarios  
- Registro de eventos  
- Procesamiento de tarjetas RFID  

## 4.2 Pruebas de Integración

Se evalúa la interacción entre los diferentes componentes del sistema:

- Backend  
- Base de datos  
- Lectores RFID  
- Panel administrativo  

## 4.3 Pruebas Funcionales

Se verifica que cada módulo cumpla con los requisitos definidos en el sistema.

## 4.4 Pruebas de Seguridad

Se analizan posibles:

- Accesos no autorizados  
- Vulnerabilidades del sistema  
- Manipulación de tarjetas RFID  

## 4.5 Pruebas de Rendimiento

Se simulan **múltiples accesos simultáneos** al sistema para evaluar:

- Tiempo de respuesta  
- Estabilidad del sistema  
- Capacidad de procesamiento  

---

# 5. Entorno de Pruebas

El entorno de pruebas incluye los siguientes componentes:

| Componente | Tecnología |
|------------|------------|
| Servidor de aplicación | Node.js |
| Base de datos | PostgreSQL |
| Frontend | React |
| Dispositivo RFID | Lector compatible con protocolo serial |
| Sistema operativo | Linux Ubuntu Server |

---

# 6. Casos de Prueba

## Caso de Prueba 1

**ID:** CP-01  
**Nombre:** Registro de usuario  

**Descripción:**  
Validar que el sistema permita registrar un nuevo usuario.

**Pasos:**

1. Ingresar al panel administrativo  
2. Seleccionar la opción **"Crear usuario"**  
3. Ingresar los datos del usuario  
4. Guardar el registro  

**Resultado esperado:**

El usuario queda registrado correctamente en la base de datos.

---

## Caso de Prueba 2

**ID:** CP-02  
**Nombre:** Asociación tarjeta RFID  

**Pasos:**

1. Registrar usuario  
2. Escanear tarjeta RFID  
3. Asociar tarjeta al usuario  

**Resultado esperado:**

La tarjeta queda vinculada al usuario en el sistema.

---

## Caso de Prueba 3

**ID:** CP-03  
**Nombre:** Validación de acceso autorizado  

**Pasos:**

1. El usuario acerca la tarjeta al lector RFID  
2. El sistema valida el ID de la tarjeta  

**Resultado esperado:**

El sistema permite el acceso y registra el evento.

---

## Caso de Prueba 4

**ID:** CP-04  
**Nombre:** Acceso no autorizado  

**Pasos:**

1. Un usuario no registrado acerca una tarjeta al lector  
2. El sistema consulta la base de datos  

**Resultado esperado:**

El acceso es **denegado** y se registra un **intento fallido**.

---

## Caso de Prueba 5

**ID:** CP-05  
**Nombre:** Generación de reporte  

**Pasos:**

1. Acceder al panel administrativo  
2. Seleccionar un rango de fechas  
3. Generar el reporte  

**Resultado esperado:**

El sistema genera el reporte correctamente.

---

# 7. Evidencias Simuladas de Pruebas

Archivo sugerido:
