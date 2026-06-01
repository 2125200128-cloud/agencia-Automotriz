# Informe para disenar la base de datos del proyecto

## 1. Resumen del proyecto

El proyecto es una aplicacion Laravel para una agencia/catalogo de vehiculos. La interfaz incluye vistas para inicio, clientes, administradores, productos/vehiculos, proveedores, pedidos, pagos y catalogos auxiliares como marcas, modelos, colores y tipos de vehiculo.

La configuracion actual apunta a MariaDB:

- Base de datos: `agencia_vehiculos`
- Usuario: `root`
- Host: `127.0.0.1`
- Puerto: `3306`

Existe tambien un archivo `database/database.sqlite`, pero solo contiene tablas base de Laravel (`users`, `sessions`, `cache`, `jobs`, etc.). Las tablas reales del negocio todavia no estan creadas en migraciones, salvo una migracion que intenta agregar `numero_serie`, `anio` y `detalles` a la tabla `productos`.

## 2. Modulos principales detectados

### Administradores

Gestiona usuarios internos de la agencia. El modelo `Administrador` espera una tabla `administradores`.

Campos necesarios:

- `id`
- `nombres`
- `apellidos`
- `correo`
- `usuario`
- `contrasena`
- `imagen`
- `rol`
- `estado`

Uso esperado:

- Acceso interno.
- Diferenciacion por rol: por ejemplo `admin` o `vendedor`.
- Control de estado: `activo` o `inactivo`.

### Clientes

Gestiona usuarios compradores o interesados. El modelo `Cliente` espera una tabla `clientes`.

Campos necesarios segun modelo:

- `id`
- `nombres`
- `apellidos`
- `correo`
- `contrasena`
- `direccion`
- `imagen`
- `estado`

Campos sugeridos por formularios:

- `telefono`

Observacion importante: el formulario de registro de cliente usa `nombre`, `email`, `telefono`, `password` y `foto`, mientras que el modelo usa `nombres`, `correo`, `contrasena` e `imagen`. Conviene unificar nombres antes de programar los controladores.

### Proveedores

Gestiona empresas o contactos que proveen vehiculos. El modelo `Proveedor` espera una tabla `proveedores`.

Campos necesarios segun modelo:

- `id`
- `nombre`
- `contacto`
- `telefono`
- `correo`
- `direccion`
- `estado`

Campos sugeridos por formulario:

- `nombre_empresa`
- `nombre_representante`
- `cargo_representante`
- `email`

Recomendacion: usar `nombre` para empresa, `contacto` para representante, agregar `cargo_contacto` si se desea guardar el cargo, y usar `correo` en lugar de `email` para que coincida con el modelo.

### Marcas

Catalogo de marcas de vehiculos. El modelo `Marca` espera una tabla `marcas`.

Campos:

- `id`
- `nombre`
- `imagen`

Relaciones:

- Una marca tiene muchos modelos.
- Una marca tiene muchos productos/vehiculos.

### Modelos de vehiculo

Catalogo de modelos relacionados con una marca. El modelo `ModeloVehiculo` espera una tabla `modelos`.

Campos:

- `id`
- `marca_id`
- `nombre`
- `imagen`

Relaciones:

- Un modelo pertenece a una marca.
- Un modelo puede estar asociado a muchos productos/vehiculos.

### Tipos de vehiculo

Catalogo para clasificar vehiculos: sedan, SUV, deportivo, pickup, etc. El modelo `Tipo` espera una tabla `tipos`.

Campos:

- `id`
- `nombre`
- `imagen`

Relaciones:

- Un tipo tiene muchos productos/vehiculos.

### Colores

Catalogo de colores exteriores. El modelo `Color` espera una tabla `colores`.

Campos:

- `id`
- `nombre`
- `imagen`

Relaciones:

- Un color tiene muchos productos/vehiculos.

### Productos / Vehiculos

Es la entidad central del inventario. El modelo `Producto` espera una tabla `productos`.

Campos necesarios:

- `id`
- `nombre`
- `descripcion`
- `numero_serie`
- `anio`
- `detalles`
- `precio`
- `marca_id`
- `modelo_id`
- `tipo_id`
- `color_id`
- `proveedor_id`
- `existencia`
- `descuento`
- `imagen_uno`
- `imagen_dos`
- `imagen_tres`
- `estado`

Relaciones:

- Un producto pertenece a una marca.
- Un producto pertenece a un modelo.
- Un producto pertenece a un tipo.
- Un producto pertenece a un color.
- Un producto pertenece a un proveedor.
- Un producto puede estar en muchos pedidos mediante `productos_pedido`.

Recomendaciones:

- `numero_serie` deberia ser unico si representa el VIN.
- `precio` debe ser decimal, no entero.
- `existencia` puede ser booleano para vehiculos unicos o entero si la agencia vendera varias unidades iguales.
- `estado` puede manejar valores como `activo`, `inactivo`, `vendido`, `reservado`.

### Pedidos

Representa una compra, solicitud o apartado hecho por un cliente. El modelo `Pedido` espera una tabla `pedidos`.

Campos:

- `id`
- `cliente_id`
- `fecha`
- `descuento`
- `iva`
- `total`
- `estado`

Relaciones:

- Un pedido pertenece a un cliente.
- Un pedido tiene muchos productos mediante `productos_pedido`.
- Un pedido tiene muchos pagos.

Estados sugeridos:

- `pendiente`
- `pagado`
- `en_proceso`
- `entregado`
- `cancelado`

### Productos por pedido

Tabla pivote entre pedidos y productos. El modelo `ProductoPedido` espera una tabla `productos_pedido`.

Campos:

- `id`
- `pedido_id`
- `producto_id`
- `cantidad`
- `precio`
- `descuento`

Uso:

- Guarda el detalle del pedido.
- Conserva el precio y descuento al momento de comprar, aunque luego cambie el precio del vehiculo.

### Pagos

Registra pagos asociados a pedidos. El modelo `Pago` espera una tabla `pagos`.

Campos:

- `id`
- `pedido_id`
- `metodo_pago`
- `monto`
- `fecha_pago`
- `estado`

Campos sugeridos por vista de compra:

- `enganche`

Recomendacion: si el enganche es un pago parcial, guardarlo como un registro en `pagos` con `monto = enganche` y `metodo_pago` segun el formulario.

### Imagenes

Existe un modelo `Imagen` con tabla `imagenes`, aunque los productos actualmente manejan `imagen_uno`, `imagen_dos` e `imagen_tres`.

Campos:

- `id`
- `nombre`
- `ruta`
- `descripcion`

Recomendacion: si se quiere una galeria flexible, crear una relacion `producto_imagenes` o agregar `producto_id` a `imagenes`. Si solo se usaran 3 imagenes fijas por vehiculo, se puede conservar el diseno actual en `productos`.

## 3. Relaciones principales

- `clientes.id` -> `pedidos.cliente_id`
- `pedidos.id` -> `productos_pedido.pedido_id`
- `productos.id` -> `productos_pedido.producto_id`
- `pedidos.id` -> `pagos.pedido_id`
- `marcas.id` -> `modelos.marca_id`
- `marcas.id` -> `productos.marca_id`
- `modelos.id` -> `productos.modelo_id`
- `tipos.id` -> `productos.tipo_id`
- `colores.id` -> `productos.color_id`
- `proveedores.id` -> `productos.proveedor_id`

## 4. Orden recomendado para crear migraciones

1. `administradores`
2. `clientes`
3. `proveedores`
4. `marcas`
5. `modelos`
6. `tipos`
7. `colores`
8. `productos`
9. `pedidos`
10. `productos_pedido`
11. `pagos`
12. `imagenes` o tabla de imagenes por producto, si se decide usar galeria flexible.

## 5. Tipos de datos recomendados

| Campo | Tipo recomendado |
| --- | --- |
| Nombres, usuario, estado, rol | `string` |
| Correos | `string` con indice unico cuando aplique |
| Contrasenas | `string`, guardadas con hash |
| Descripciones y detalles largos | `text` |
| Precios, descuentos, IVA, totales, pagos | `decimal(12,2)` |
| Fechas | `date` o `dateTime` |
| Existencia | `unsignedInteger` o `boolean` |
| Llaves foraneas | `foreignId` |
| Imagenes/rutas | `string` |

## 6. Esquema SQL sugerido para MariaDB

```sql
CREATE TABLE administradores (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombres VARCHAR(100) NOT NULL,
  apellidos VARCHAR(100) NOT NULL,
  correo VARCHAR(150) NOT NULL UNIQUE,
  usuario VARCHAR(80) NOT NULL UNIQUE,
  contrasena VARCHAR(255) NOT NULL,
  imagen VARCHAR(255) NULL,
  rol VARCHAR(30) NOT NULL DEFAULT 'vendedor',
  estado VARCHAR(20) NOT NULL DEFAULT 'activo'
);

CREATE TABLE clientes (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombres VARCHAR(100) NOT NULL,
  apellidos VARCHAR(100) NULL,
  correo VARCHAR(150) NOT NULL UNIQUE,
  telefono VARCHAR(30) NULL,
  contrasena VARCHAR(255) NOT NULL,
  direccion VARCHAR(255) NULL,
  imagen VARCHAR(255) NULL,
  estado VARCHAR(20) NOT NULL DEFAULT 'activo'
);

CREATE TABLE proveedores (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  contacto VARCHAR(150) NULL,
  cargo_contacto VARCHAR(100) NULL,
  telefono VARCHAR(30) NULL,
  correo VARCHAR(150) NULL,
  direccion VARCHAR(255) NULL,
  estado VARCHAR(20) NOT NULL DEFAULT 'activo'
);

CREATE TABLE marcas (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL UNIQUE,
  imagen VARCHAR(255) NULL
);

CREATE TABLE modelos (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  marca_id BIGINT UNSIGNED NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  imagen VARCHAR(255) NULL,
  FOREIGN KEY (marca_id) REFERENCES marcas(id)
);

CREATE TABLE tipos (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL UNIQUE,
  imagen VARCHAR(255) NULL
);

CREATE TABLE colores (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL UNIQUE,
  imagen VARCHAR(255) NULL
);

CREATE TABLE productos (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(180) NOT NULL,
  descripcion TEXT NULL,
  numero_serie VARCHAR(80) NULL UNIQUE,
  anio INT NULL,
  detalles TEXT NULL,
  precio DECIMAL(12,2) NOT NULL DEFAULT 0,
  marca_id BIGINT UNSIGNED NULL,
  modelo_id BIGINT UNSIGNED NULL,
  tipo_id BIGINT UNSIGNED NULL,
  color_id BIGINT UNSIGNED NULL,
  proveedor_id BIGINT UNSIGNED NULL,
  existencia INT UNSIGNED NOT NULL DEFAULT 1,
  descuento DECIMAL(12,2) NOT NULL DEFAULT 0,
  imagen_uno VARCHAR(255) NULL,
  imagen_dos VARCHAR(255) NULL,
  imagen_tres VARCHAR(255) NULL,
  estado VARCHAR(20) NOT NULL DEFAULT 'activo',
  FOREIGN KEY (marca_id) REFERENCES marcas(id),
  FOREIGN KEY (modelo_id) REFERENCES modelos(id),
  FOREIGN KEY (tipo_id) REFERENCES tipos(id),
  FOREIGN KEY (color_id) REFERENCES colores(id),
  FOREIGN KEY (proveedor_id) REFERENCES proveedores(id)
);

CREATE TABLE pedidos (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  cliente_id BIGINT UNSIGNED NOT NULL,
  fecha DATE NOT NULL,
  descuento DECIMAL(12,2) NOT NULL DEFAULT 0,
  iva DECIMAL(12,2) NOT NULL DEFAULT 0,
  total DECIMAL(12,2) NOT NULL DEFAULT 0,
  estado VARCHAR(30) NOT NULL DEFAULT 'pendiente',
  FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE productos_pedido (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  pedido_id BIGINT UNSIGNED NOT NULL,
  producto_id BIGINT UNSIGNED NOT NULL,
  cantidad INT UNSIGNED NOT NULL DEFAULT 1,
  precio DECIMAL(12,2) NOT NULL DEFAULT 0,
  descuento DECIMAL(12,2) NOT NULL DEFAULT 0,
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
  FOREIGN KEY (producto_id) REFERENCES productos(id)
);

CREATE TABLE pagos (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  pedido_id BIGINT UNSIGNED NOT NULL,
  metodo_pago VARCHAR(50) NOT NULL,
  monto DECIMAL(12,2) NOT NULL DEFAULT 0,
  fecha_pago DATE NULL,
  estado VARCHAR(30) NOT NULL DEFAULT 'pendiente',
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id)
);
```

## 7. Inconsistencias que se deben resolver antes de programar CRUD

1. El archivo `.env` usa MariaDB, pero la base SQLite del proyecto solo tiene tablas de Laravel.
2. Hay modelos de negocio, pero faltan migraciones para casi todas sus tablas.
3. La migracion `add_serie_anio_detalles_to_productos_table` fallara si `productos` no existe antes.
4. Hay diferencias entre nombres de campos en formularios y modelos:
   - Cliente: `email` vs `correo`, `password` vs `contrasena`, `foto` vs `imagen`.
   - Proveedor: `nombre_empresa` vs `nombre`, `email` vs `correo`, `nombre_representante` vs `contacto`.
5. Las rutas actuales muestran vistas, pero casi no hay controladores para guardar datos.
6. Los modelos tienen `$timestamps = false`; por eso las tablas propuestas no incluyen `created_at` ni `updated_at`. Si se quiere auditoria, conviene activar timestamps y agregarlos.

## 8. Recomendacion final

La base de datos debe construirse primero con migraciones Laravel, no manualmente solo en phpMyAdmin. El orden ideal es crear primero los catalogos y entidades independientes, despues `productos`, luego `pedidos`, `productos_pedido` y `pagos`.

La estructura minima funcional para que el proyecto avance es:

- `clientes`
- `proveedores`
- `marcas`
- `modelos`
- `tipos`
- `colores`
- `productos`
- `pedidos`
- `productos_pedido`
- `pagos`
- `administradores`

Con esas tablas se cubre el inventario, los compradores, proveedores, ventas/pedidos y pagos.
