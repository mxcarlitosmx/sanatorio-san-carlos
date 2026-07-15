# Sanatorio San Carlos - Sistema de Gestión Hospitalaria

Sistema integral web diseñado para la administración operativa, clínica y financiera del "Sanatorio San Carlos". Este proyecto digitaliza el flujo completo de la unidad médica, garantizando la modularidad del código y una alta eficiencia en el procesamiento de transacciones.

---

## Arquitectura y Stack Tecnológico

El sistema se rige bajo una estricta Arquitectura Cliente-Servidor de Tres Capas (Presentación, Lógica de Negocio y Datos).  

* **Front-End (Capa de Presentación):** Construida con estándares web como HTML5, CSS3 y JavaScript. Utiliza el framework Bootstrap 5 para el diseño responsivo y el motor de plantillas Blade para el renderizado seguro desde el servidor.  
* **Back-End (Capa de Lógica):** Procesamiento central desarrollado en PHP 8.3 utilizando el framework Laravel 12. El patrón MVC y el ORM Eloquent automatizan transacciones complejas de manera segura.  
* **Base de Datos (Capa de Datos):** Soportada por MySQL 8.  
* **Despliegue Cloud (Producción):** Alojado en una máquina virtual de Microsoft Azure (Standard_B2ts_v2) sobre Ubuntu Server 24.04 LTS, operando con servidor web Nginx, dominio dinámico en DuckDNS y seguridad HTTPS mediante Let's Encrypt (Certbot).

---

## Control de Accesos Basado en Roles

La aplicación implementa un sistema de seguridad perimetral que restringe el acceso mediante roles específicos, cada uno con interfaces y módulos dedicados:

### 1. Pacientes
* Autoregistro en la plataforma con validación del formato oficial de la CURP.
* Panel médico personalizado para agendar y visualizar próximas citas.
* Acceso a resúmenes clínicos y visualización de recetas médicas digitales con folio de rastreo.

### 2. Recepción
* Gestión dinámica de agendas y apertura de espacios para consultas.
* Confirmación de asistencia, lo que transfiere automáticamente al paciente a la lista de espera del panel del médico.

### 3. Médicos Especialistas
* Panel de control clínico en tiempo real con la lista de espera del día.
* Hoja de valoración clínica para la captura de signos vitales (Triage), peso, estatura y diagnóstico.
* Emisión de recetas electrónicas con selección de medicamentos desde el catálogo y especificación de posología.

### 4. Cajas (Facturación)
* Ventanilla de pagos con recepción automática de las órdenes de cobro generadas en consultorio.
* Procesamiento transaccional de cobros que actualiza en tiempo real el estado financiero de los pases médicos.

### 5. Farmacia e Inventario
* Mostrador interactivo para consultar las recetas emitidas pendientes de entrega.
* Punto de venta (POS) para surtir medicamentos y procesar cobros.
