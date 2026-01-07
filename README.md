# Ferremas

Ferremas es un proyecto de **e-commerce desarrollado para la asignatura “Integración de Plataformas”**, con integración de **API de pasarela de pagos** y un sistema CRUD básico para la gestión de productos y pedidos. El código fuente incluye tanto frontend como lógica de negocio de un ecommerce tradicional.

---

## Descripción

Ferremas corresponde a una **tienda en línea (e-commerce)** funcional a nivel básico, desarrollada como parte de una evaluación académica. La aplicación implementa un sistema de catálogo de productos, carrito de compras y proceso de checkout con integración de pasarela de pagos, aplicando conceptos de integración entre plataformas web y servicios externos.

La solución incorpora interacción con APIs externas, persistencia de datos para productos y pedidos, y lógica básica de usuario y sesión.

---

## Funcionalidades principales

- Navegación por catálogo de productos.
- Carrito de compras con operaciones CRUD.
- Checkout con integración de API de pasarela de pagos.
- Conversión de precios a USD mediante integración con la API del Banco Central.
- Gestión básica de pedidos.
- Interfaces desarrolladas con HTML, CSS y lógica en PHP.

---

## Tecnologías utilizadas

- **PHP** — lógica del ecommerce y control de sesión.
- **MySQL / SQL** — almacenamiento de productos y pedidos.
- **HTML / CSS / JavaScript** — interfaz de usuario.
- **API de pasarela de pagos** — procesamiento de pagos.
- **API del Banco Central** — obtención del tipo de cambio CLP/USD para conversión de precios.

---

## Instalación

Estas instrucciones permiten ejecutar el proyecto en un entorno local para desarrollo y pruebas.

### Requisitos previos

- Servidor local con PHP (XAMPP, WAMP u otro).
- Servidor de base de datos MySQL.
- Credenciales de una pasarela de pago (modo prueba).

---

### Pasos de instalación

1. **Clonar el repositorio**

   ```bash
   git clone https://github.com/AAMoralesC/Ferremas.git
   cd Ferremas
2. **Configurar la base de datos**

   - Crear una base de datos en MySQL.
   - Importar el script SQL incluido en el proyecto (carpeta SQL/).
   - Configurar las credenciales en el archivo de conexión (config.php o similar).

3. **Levantar el servidor local**
   - Copiar el proyecto al directorio htdocs (XAMPP) o equivalente.
   - Iniciar Apache y MySQL.
   - CAcceder desde el navegador a:
   ```bash
    http://localhost/Ferremas

## Despliegue

Este proyecto fue desarrollado con fines académicos y no cuenta con un entorno de producción.
La aplicación se ejecuta en un entorno local (localhost), suficiente para demostrar la correcta integración de plataformas, APIs y la lógica de negocio requerida por la asignatura.

## Estado del proyecto

Proyecto académico finalizado para evaluación. No se encuentra en desarrollo activo ni desplegado en producción.
