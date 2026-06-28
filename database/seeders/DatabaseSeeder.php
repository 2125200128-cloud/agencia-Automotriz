<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Marca;
use App\Models\Tipo;
use App\Models\Color;
use App\Models\Proveedor;
use App\Models\Administrador;
use App\Models\Cliente;
use App\Models\ModeloVehiculo;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $bmw = Marca::create(['nombre' => 'BMW', 'imagen' => 'bmw.png']);
        $toyota = Marca::create(['nombre' => 'Toyota', 'imagen' => 'toyota.png']);
        $ford = Marca::create(['nombre' => 'Ford', 'imagen' => 'ford.png']);
        $chevrolet = Marca::create(['nombre' => 'Chevrolet', 'imagen' => 'chevrolet.png']);
        $mercedes = Marca::create(['nombre' => 'Mercedes-Benz', 'imagen' => 'mercedes.png']);

        $sedan = Tipo::create(['nombre' => 'Sedán', 'imagen' => 'sedan.png']);
        $suv = Tipo::create(['nombre' => 'SUV', 'imagen' => 'suv.png']);
        $deportivo = Tipo::create(['nombre' => 'Deportivo', 'imagen' => 'deportivo.png']);
        $pickup = Tipo::create(['nombre' => 'Pick-up', 'imagen' => 'pickup.png']);
        $hatchback = Tipo::create(['nombre' => 'Hatchback', 'imagen' => 'hatchback.png']);

        $rojo = Color::create(['nombre' => 'Rojo', 'imagen' => 'rojo.png']);
        $azul = Color::create(['nombre' => 'Azul Metálico', 'imagen' => 'azul.png']);
        $negro = Color::create(['nombre' => 'Negro Obsidiana', 'imagen' => 'negro.png']);
        $blanco = Color::create(['nombre' => 'Blanco Perlado', 'imagen' => 'blanco.png']);
        $gris = Color::create(['nombre' => 'Gris Grafito', 'imagen' => 'gris.png']);

        $prov1 = Proveedor::create([
            'nombre' => 'AutoDistribuidora Global',
            'contacto' => 'Ing. Roberto Silva',
            'telefono' => '555-0199',
            'correo' => 'ventas@autodistribuidora.com',
            'direccion' => 'Zona Industrial 45, CDMX',
            'estado' => 'activo'
        ]);
        $prov2 = Proveedor::create([
            'nombre' => 'Importadora del Norte',
            'contacto' => 'Lic. Laura Garza',
            'telefono' => '818-2030',
            'correo' => 'contacto@importadoranorte.com',
            'direccion' => 'Av. Constitución 800, Monterrey, NL',
            'estado' => 'activo'
        ]);
        $prov3 = Proveedor::create([
            'nombre' => 'Logística Automotriz Express',
            'contacto' => 'Carlos Ramos',
            'telefono' => '333-4050',
            'correo' => 'cramos@logisticaexpress.com',
            'direccion' => 'Calzada Federalismo 102, Guadalajara, Jal',
            'estado' => 'activo'
        ]);
        $prov4 = Proveedor::create([
            'nombre' => 'Motores del Pacífico S.A.',
            'contacto' => 'Elena Ríos',
            'telefono' => '664-7788',
            'correo' => 'abastos@motorespacifico.com',
            'direccion' => 'Blvd. Agua Caliente 12, Tijuana, BC',
            'estado' => 'activo'
        ]);
        $prov5 = Proveedor::create([
            'nombre' => 'Proveedora Vehicular Central',
            'contacto' => 'Mariano Pérez',
            'telefono' => '442-9900',
            'correo' => 'ventas@provcentral.com',
            'direccion' => 'Paseo de la República km 15, Querétaro, Qro',
            'estado' => 'activo'
        ]);

        Administrador::create([
            'nombres' => 'Carlos',
            'apellidos' => 'Gómez',
            'correo' => 'carlos@agencia.com',
            'usuario' => 'carlos.gomez',
            'contrasena' => Hash::make('secret'),
            'imagen' => 'admin1.png',
            'rol' => Administrador::ROL_MASTER,
            'estado' => 'activo'
        ]);
        Administrador::create([
            'nombres' => 'Ana',
            'apellidos' => 'Martínez',
            'correo' => 'ana@agencia.com',
            'usuario' => 'ana.martinez',
            'contrasena' => Hash::make('secret'),
            'imagen' => 'admin2.png',
            'rol' => Administrador::ROL_VENDEDOR,
            'estado' => 'activo'
        ]);
        Administrador::create([
            'nombres' => 'David',
            'apellidos' => 'Ruiz',
            'correo' => 'david@agencia.com',
            'usuario' => 'david.ruiz',
            'contrasena' => Hash::make('secret'),
            'imagen' => 'admin3.png',
            'rol' => Administrador::ROL_ALMACENISTA,
            'estado' => 'activo'
        ]);
        Administrador::create([
            'nombres' => 'Beatriz',
            'apellidos' => 'Base',
            'correo' => 'base@agencia.com',
            'usuario' => 'base.agencia',
            'contrasena' => Hash::make('secret'),
            'imagen' => 'admin4.png',
            'rol' => Administrador::ROL_BASE,
            'estado' => 'activo'
        ]);

        Cliente::create([
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'correo' => 'juan@gmail.com',
            'telefono' => '555-1234',
            'contrasena' => Hash::make('secret'),
            'direccion' => 'Av. Reforma 123, CDMX',
            'imagen' => 'cliente1.png',
            'estado' => 'activo'
        ]);
        Cliente::create([
            'nombres' => 'María',
            'apellidos' => 'López',
            'correo' => 'maria@gmail.com',
            'telefono' => '555-5678',
            'contrasena' => Hash::make('secret'),
            'direccion' => 'Calle Juárez 456, Guadalajara, Jal',
            'imagen' => 'cliente2.png',
            'estado' => 'activo'
        ]);
        Cliente::create([
            'nombres' => 'Sofía',
            'apellidos' => 'Rodríguez',
            'correo' => 'sofia@gmail.com',
            'telefono' => '555-9012',
            'contrasena' => Hash::make('secret'),
            'direccion' => 'Blvd. Colosio 789, Monterrey, NL',
            'imagen' => 'cliente3.png',
            'estado' => 'activo'
        ]);
        Cliente::create([
            'nombres' => 'Luis',
            'apellidos' => 'Hernández',
            'correo' => 'luis@gmail.com',
            'telefono' => '555-3456',
            'contrasena' => Hash::make('secret'),
            'direccion' => 'Privada Encino 10, Querétaro, Qro',
            'imagen' => 'cliente4.png',
            'estado' => 'activo'
        ]);
        Cliente::create([
            'nombres' => 'Andrea',
            'apellidos' => 'Flores',
            'correo' => 'andrea@gmail.com',
            'telefono' => '555-7890',
            'contrasena' => Hash::make('secret'),
            'direccion' => 'Paseo del Prado 25, Puebla, Pue',
            'imagen' => 'cliente5.png',
            'estado' => 'activo'
        ]);

        $m5 = ModeloVehiculo::create(['marca_id' => $bmw->id, 'nombre' => 'M5', 'imagen' => 'm5.png']);
        $x5 = ModeloVehiculo::create(['marca_id' => $bmw->id, 'nombre' => 'X5', 'imagen' => 'x5.png']);
        
        $corolla = ModeloVehiculo::create(['marca_id' => $toyota->id, 'nombre' => 'Corolla', 'imagen' => 'corolla.png']);
        $rav4 = ModeloVehiculo::create(['marca_id' => $toyota->id, 'nombre' => 'RAV4', 'imagen' => 'rav4.png']);
        
        $mustang = ModeloVehiculo::create(['marca_id' => $ford->id, 'nombre' => 'Mustang', 'imagen' => 'mustang.png']);
        $f150 = ModeloVehiculo::create(['marca_id' => $ford->id, 'nombre' => 'F-150', 'imagen' => 'f150.png']);
        
        $camaro = ModeloVehiculo::create(['marca_id' => $chevrolet->id, 'nombre' => 'Camaro', 'imagen' => 'camaro.png']);
        $silverado = ModeloVehiculo::create(['marca_id' => $chevrolet->id, 'nombre' => 'Silverado', 'imagen' => 'silverado.png']);
        
        $cclass = ModeloVehiculo::create(['marca_id' => $mercedes->id, 'nombre' => 'C-Class', 'imagen' => 'cclass.png']);
        $gle = ModeloVehiculo::create(['marca_id' => $mercedes->id, 'nombre' => 'GLE', 'imagen' => 'gle.png']);

        Producto::create([
            'nombre' => 'Ford Mustang GT Fastback',
            'descripcion' => 'Deportivo icónico americano con motor V8 de 5.0L.',
            'numero_serie' => 'FT1GR45B82026',
            'anio' => 2024,
            'detalles' => 'Transmisión manual, asientos de piel, suspensión deportiva.',
            'precio' => 950000.00,
            'marca_id' => $ford->id,
            'modelo_id' => $mustang->id,
            'tipo_id' => $deportivo->id,
            'color_id' => $rojo->id,
            'proveedor_id' => $prov2->id,
            'existencia' => 3,
            'descuento' => 5.00,
            'imagen_principal' => 'mustang1.jpg',
            'estado' => 'activo'
        ]);

        Producto::create([
            'nombre' => 'Toyota Corolla SE',
            'descripcion' => 'Sedán confiable y eficiente con excelente rendimiento de combustible.',
            'numero_serie' => 'TYTCO88SE2023',
            'anio' => 2023,
            'detalles' => 'Transmisión automática CVT, pantalla táctil, asistente de mantenimiento de carril.',
            'precio' => 380000.00,
            'marca_id' => $toyota->id,
            'modelo_id' => $corolla->id,
            'tipo_id' => $sedan->id,
            'color_id' => $blanco->id,
            'proveedor_id' => $prov1->id,
            'existencia' => 10,
            'descuento' => 0.00,
            'imagen_principal' => 'corolla1.jpg',
            'estado' => 'activo'
        ]);

        Producto::create([
            'nombre' => 'BMW X5 xDrive40i',
            'descripcion' => 'SUV premium que combina lujo, espacio y gran dinamismo de manejo.',
            'numero_serie' => 'BMWX5XD40I2024',
            'anio' => 2024,
            'detalles' => 'Tracción integral xDrive, motor TwinPower Turbo de 6 cilindros.',
            'precio' => 1450000.00,
            'marca_id' => $bmw->id,
            'modelo_id' => $x5->id,
            'tipo_id' => $suv->id,
            'color_id' => $negro->id,
            'proveedor_id' => $prov4->id,
            'existencia' => 2,
            'descuento' => 2.50,
            'imagen_principal' => 'x5_1.jpg',
            'estado' => 'activo'
        ]);

        Producto::create([
            'nombre' => 'Chevrolet Silverado RST',
            'descripcion' => 'Camioneta pick-up de gran capacidad para el trabajo y uso diario.',
            'numero_serie' => 'CHEVSI88RST2023',
            'anio' => 2023,
            'detalles' => 'Cabina doble, motor 5.3L V8, tracción 4x4, conectividad integrada.',
            'precio' => 820000.00,
            'marca_id' => $chevrolet->id,
            'modelo_id' => $silverado->id,
            'tipo_id' => $pickup->id,
            'color_id' => $gris->id,
            'proveedor_id' => $prov5->id,
            'existencia' => 5,
            'descuento' => 4.00,
            'imagen_principal' => 'silverado1.jpg',
            'estado' => 'activo'
        ]);

        Producto::create([
            'nombre' => 'Mercedes-Benz C-Class C200',
            'descripcion' => 'Elegante sedán ejecutivo con lo último en tecnología de seguridad.',
            'numero_serie' => 'MBZCC2002024',
            'anio' => 2024,
            'detalles' => 'Sistema MBUX, iluminación ambiental adaptativa, motor Mild Hybrid.',
            'precio' => 1100000.00,
            'marca_id' => $mercedes->id,
            'modelo_id' => $cclass->id,
            'tipo_id' => $sedan->id,
            'color_id' => $azul->id,
            'proveedor_id' => $prov3->id,
            'existencia' => 4,
            'descuento' => 0.00,
            'imagen_principal' => 'cclass1.jpg',
            'estado' => 'activo'
        ]);
    }
}
