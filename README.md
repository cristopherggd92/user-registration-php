# Registro de Usuario con PHP

Proyecto web sencillo desarrollado con HTML5, CSS3 y PHP para capturar datos de un usuario mediante un formulario y procesarlos del lado del servidor.

## Descripción

La aplicación permite registrar nombre, edad, correo electrónico y país. Al enviar el formulario, PHP valida la información recibida por método `POST`, muestra los datos capturados y genera mensajes personalizados según la edad y el país seleccionado.

## Tecnologías utilizadas

- HTML5
- CSS3
- PHP
- Git y GitHub
- XAMPP como entorno local

## Estructura del proyecto

```text
actividad1/
├── index.html
├── procesar.php
├── styles.css
└── README.md
```

## Archivos principales

- `index.html`: contiene el formulario de registro.
- `procesar.php`: recibe, valida y procesa los datos enviados.
- `styles.css`: define el diseño visual y la adaptación responsiva.

## Cómo ejecutar el proyecto

1. Coloca la carpeta del proyecto dentro de `htdocs` de XAMPP.
2. Inicia Apache desde el panel de control de XAMPP.
3. Abre el navegador en:

```text
http://localhost/actividad1/
```

## Funcionalidades

- Formulario con campos obligatorios.
- Validación básica desde HTML y validación del lado del servidor con PHP.
- Protección de salida con `htmlspecialchars`.
- Redirección al formulario si `procesar.php` se abre directamente por `GET`.
- Mensajes dinámicos según los datos ingresados.
- Diseño responsivo para pantallas pequeñas.

## Autor

Cristopher G. Díaz
