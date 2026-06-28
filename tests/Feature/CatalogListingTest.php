<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Color;
use App\Models\Administrador;
use App\Models\Marca;
use App\Models\ModeloVehiculo;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tipo;
use App\Support\PublicImage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CatalogListingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->actingAs(Administrador::first(), 'admin');
    }
    public function test_it_lists_administradores(): void
    {
        $response = $this->get('/administrador');
        $response->assertStatus(200);
        $response->assertSee('Administradores');
        $response->assertSee('Carlos');
        $response->assertSee('Gómez');
    }

    public function test_it_lists_proveedores(): void
    {
        $response = $this->get('/proveedor');
        $response->assertStatus(200);
        $response->assertSee('Proveedores');
        $response->assertSee('AutoDistribuidora Global');
        $response->assertSee('Roberto Silva');
    }

    public function test_it_lists_marcas(): void
    {
        $response = $this->get('/marcas');
        $response->assertStatus(200);
        $response->assertSee('Marcas');
        $response->assertSee('Toyota');
        $response->assertSee('Ford');
        $response->assertSee('BMW');
    }

    public function test_it_lists_colores(): void
    {
        $response = $this->get('/colores');
        $response->assertStatus(200);
        $response->assertSee('Colores');
        $response->assertSee('Rojo');
        $response->assertSee('Azul Metálico');
    }

    public function test_it_lists_clientes(): void
    {
        $response = $this->get('/cliente');
        $response->assertStatus(200);
        $response->assertSee('Clientes');
        $response->assertSee('Juan');
        $response->assertSee('Pérez');
    }

    public function test_it_lists_modelos(): void
    {
        $response = $this->get('/modelos');
        $response->assertStatus(200);
        $response->assertSee('Modelos');
        $response->assertSee('Corolla');
        $response->assertSee('Mustang');
    }

    public function test_it_lists_tipos(): void
    {
        $response = $this->get('/tipos');
        $response->assertStatus(200);
        $response->assertSee('Tipos');
        $response->assertSee('Sedán');
        $response->assertSee('SUV');
    }

    public function test_it_lists_productos(): void
    {
        $response = $this->get('/producto');
        $response->assertStatus(200);
        $response->assertSee('Productos');
        $response->assertSee('Mercedes-Benz C-Class C200');
        $response->assertSee('Toyota Corolla SE');
    }

    public function test_it_lists_empty_pedido_history(): void
    {
        $response = $this->get('/pedido');
        $response->assertStatus(200);
        $response->assertSee('No hay pedidos registrados.');
        $response->assertDontSee('#ORD-1024');
    }

    public function test_it_lists_empty_pago_history(): void
    {
        $response = $this->get('/pagos');
        $response->assertStatus(200);
        $response->assertSee('No hay pagos registrados.');
        $response->assertDontSee('PAY-78A3F');
    }

    public function test_it_lists_empty_productos_pedido(): void
    {
        $response = $this->get('/productos-pedido');
        $response->assertStatus(200);
        $response->assertSee('Productos de pedidos');
        $response->assertSee('No hay registros disponibles.');
    }

    public function test_product_form_loads_related_catalogs(): void
    {
        $response = $this->get('/producto/formulario');
        $response->assertStatus(200);
        $response->assertSee('BMW');
        $response->assertSee('Mustang');
        $response->assertSee('Deportivo');
        $response->assertSee('Rojo');
        $response->assertSee('AutoDistribuidora Global');
    }

    public function test_model_form_loads_marcas(): void
    {
        $response = $this->get('/modelos/formulario');
        $response->assertStatus(200);
        $response->assertSee('BMW');
        $response->assertSee('Toyota');
    }

    public function test_productos_pedido_form_loads_products(): void
    {
        $response = $this->get('/productos-pedido/formulario');
        $response->assertStatus(200);
        $response->assertSee('Ford Mustang GT Fastback');
        $response->assertSee('Toyota Corolla SE');
    }

    public function test_order_and_payment_forms_load_related_records(): void
    {
        $cliente = Cliente::first();
        $producto = Producto::first();
        $pedido = Pedido::create([
            'cliente_id' => $cliente->id,
            'fecha' => now()->toDateString(),
            'total' => 1000,
            'estado' => 'pendiente',
        ]);

        $this->get('/pedido/formulario')
            ->assertStatus(200)
            ->assertSee($cliente->nombres)
            ->assertSee($producto->nombre);

        $this->get('/pagos/formulario')
            ->assertStatus(200)
            ->assertSee('Pedido #'.$pedido->id);
    }

    public function test_home_loads_real_products_and_catalogs(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Mercedes-Benz C-Class C200');
        $response->assertSee('Toyota');
        $response->assertSee('Deportivo');
        $response->assertDontSee('Audi RS 7 Sportback');
    }

    public function test_forms_register_catalog_records(): void
    {
        Storage::fake('public');

        $this->post('/marcas', [
            'nombre' => 'Honda',
            'imagen' => $this->fakePng('honda.png'),
        ])
            ->assertRedirect('/marcas');
        $this->post('/colores', ['nombre' => 'Verde'])
            ->assertRedirect('/colores');
        $this->post('/tipos', ['nombre' => 'Convertible'])
            ->assertRedirect('/tipos');
        $this->post('/modelos', [
            'marca_id' => Marca::where('nombre', 'Honda')->value('id'),
            'nombre' => 'Civic',
        ])->assertRedirect('/modelos');

        $this->assertDatabaseHas('marcas', ['nombre' => 'Honda']);
        $this->assertDatabaseHas('colores', ['nombre' => 'Verde']);
        $this->assertDatabaseHas('tipos', ['nombre' => 'Convertible']);
        $this->assertDatabaseHas('modelos_vehiculos', ['nombre' => 'Civic']);
    }

    public function test_forms_store_uploaded_images(): void
    {
        Storage::fake('public');

        $this->post('/marcas', [
            'nombre' => 'Honda',
            'imagen' => UploadedFile::fake()->createWithContent(
                'honda.png',
                base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
            ),
        ])->assertRedirect('/marcas');

        $imagen = Marca::where('nombre', 'Honda')->value('imagen');

        $this->assertNotNull($imagen);
        Storage::disk('public')->assertExists(PublicImage::pathFromValue($imagen));
    }

    public function test_product_form_stores_three_uploaded_images(): void
    {
        Storage::fake('public');
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=');

        $this->post('/producto', [
            'nombre' => 'Auto con galeria',
            'numero_serie' => 'GALERIA-001',
            'precio' => 250000,
            'marca_id' => Marca::first()->id,
            'modelo_id' => ModeloVehiculo::first()->id,
            'tipo_id' => Tipo::first()->id,
            'color_id' => Color::first()->id,
            'proveedor_id' => Proveedor::first()->id,
            'existencia' => 1,
            'estado' => 'activo',
            'imagen_principal' => UploadedFile::fake()->createWithContent('principal.png', $png),
            'imagen_secundaria' => UploadedFile::fake()->createWithContent('secundaria.png', $png),
            'imagen_adicional' => UploadedFile::fake()->createWithContent('adicional.png', $png),
        ])->assertRedirect('/producto');

        $producto = Producto::where('numero_serie', 'GALERIA-001')->first();

        Storage::disk('public')->assertExists(PublicImage::pathFromValue($producto->imagen_principal));
        Storage::disk('public')->assertExists(PublicImage::pathFromValue($producto->imagen_secundaria));
        Storage::disk('public')->assertExists(PublicImage::pathFromValue($producto->imagen_adicional));
    }

    public function test_base_admin_cannot_see_or_access_delete_actions(): void
    {
        $base = Administrador::where('rol', Administrador::ROL_BASE)->first();
        $producto = Producto::first();

        $this->actingAs($base, 'admin');

        $this->get('/producto')
            ->assertStatus(200)
            ->assertDontSee('/producto/'.$producto->id.'/eliminar', false);

        $this->get('/producto/'.$producto->id.'/eliminar')
            ->assertForbidden();
    }

    public function test_vendedor_can_register_sales_and_view_inventory_without_managing_it(): void
    {
        $vendedor = Administrador::where('rol', Administrador::ROL_VENDEDOR)->first();
        $producto = Producto::first();

        $this->actingAs($vendedor, 'admin');

        $this->get('/producto')
            ->assertStatus(200)
            ->assertDontSee('/producto/formulario', false)
            ->assertDontSee('/producto/'.$producto->id.'/editar', false);

        $this->get('/producto/formulario')->assertForbidden();
        $this->get('/producto/'.$producto->id.'/editar')->assertForbidden();

        $this->get('/pedido')->assertStatus(200);
        $this->get('/pedido/formulario')->assertStatus(200);
        $this->get('/productos-pedido')->assertStatus(200);
        $this->get('/productos-pedido/formulario')->assertStatus(200);
    }

    public function test_almacenista_can_manage_inventory_catalogs_and_valuator_but_not_sales(): void
    {
        $almacenista = Administrador::where('rol', Administrador::ROL_ALMACENISTA)->first();

        $this->actingAs($almacenista, 'admin');

        $this->get('/producto')->assertStatus(200);
        $this->get('/producto/formulario')->assertStatus(200);
        $this->get('/catalogos')->assertStatus(200);
        $this->get('/marcas/formulario')->assertStatus(200);
        $this->get('/colores/formulario')->assertStatus(200);
        $this->get('/administrador/valuador')->assertStatus(200);

        $this->get('/pedido')->assertForbidden();
        $this->get('/pedido/formulario')->assertForbidden();
    }

    public function test_home_only_shows_one_card_for_a_repeated_serial_number(): void
    {
        $datos = [
            'nombre' => 'Auto duplicado',
            'numero_serie' => 'SERIE-REPETIDA',
            'precio' => 250000,
            'existencia' => 1,
            'estado' => 'activo',
        ];

        Producto::create($datos);
        Producto::create($datos);

        $response = $this->get('/');

        $response->assertStatus(200);
        $this->assertSame(1, substr_count($response->getContent(), '>Auto duplicado<'));
    }

    public function test_forms_register_people_and_provider(): void
    {
        Storage::fake('public');

        $this->post('/administrador', [
            'nombres' => 'Elena',
            'apellidos' => 'Ramos',
            'correo' => 'elena@example.com',
            'usuario' => 'elena.ramos',
            'contrasena' => 'secreto1',
            'imagen' => $this->fakePng('elena.png'),
            'rol' => Administrador::ROL_MASTER,
            'estado' => 'activo',
        ])->assertRedirect('/administrador');

        $this->post('/cliente', [
            'nombre' => 'Pedro Gomez',
            'email' => 'pedro@example.com',
            'telefono' => '555-0000',
            'password' => 'secreto1',
            'imagen' => $this->fakePng('pedro.png'),
        ])->assertRedirect('/cliente');

        $this->post('/proveedor', [
            'nombre' => 'Autos Centro',
            'telefono' => '555-1111',
            'correo' => 'ventas@autoscentro.com',
            'contacto' => 'Laura Perez',
            'imagen' => $this->fakePng('autos-centro.png'),
        ])->assertRedirect('/proveedor');

        $this->assertDatabaseHas('administradores', ['correo' => 'elena@example.com']);
        $this->assertDatabaseHas('clientes', ['correo' => 'pedro@example.com']);
        $this->assertDatabaseHas('proveedores', ['nombre' => 'Autos Centro']);
    }

    public function test_forms_register_product_and_order_detail(): void
    {
        Storage::fake('public');

        $this->post('/producto', [
            'nombre' => 'Vehiculo de prueba',
            'precio' => 250000,
            'marca_id' => Marca::first()->id,
            'modelo_id' => ModeloVehiculo::first()->id,
            'tipo_id' => Tipo::first()->id,
            'color_id' => Color::first()->id,
            'proveedor_id' => Proveedor::first()->id,
            'existencia' => 1,
            'estado' => 'activo',
            'imagen_principal' => $this->fakePng('principal.png'),
            'imagen_secundaria' => $this->fakePng('secundaria.png'),
            'imagen_adicional' => $this->fakePng('adicional.png'),
        ])->assertRedirect('/producto');

        $pedido = Pedido::create([
            'cliente_id' => Cliente::first()->id,
            'fecha' => now()->toDateString(),
            'total' => 250000,
            'estado' => 'pendiente',
        ]);

        $producto = Producto::where('nombre', 'Vehiculo de prueba')->first();

        $this->post('/productos-pedido', [
            'pedido_id' => $pedido->id,
            'producto_id' => $producto->id,
            'cantidad' => 1,
            'precio' => 250000,
            'descuento' => 0,
        ])->assertRedirect('/productos-pedido');

        $this->assertDatabaseHas('productos', ['nombre' => 'Vehiculo de prueba']);
        $this->assertDatabaseHas('pedido_producto', [
            'pedido_id' => $pedido->id,
            'producto_id' => $producto->id,
        ]);
    }

    public function test_forms_register_order_and_payment(): void
    {
        $producto = Producto::first();

        $this->post('/pedido', [
            'cliente_id' => Cliente::first()->id,
            'producto_id' => $producto->id,
            'fecha' => now()->toDateString(),
            'cantidad' => 1,
            'descuento' => 0,
            'iva' => 160,
            'estado' => 'pendiente',
            'metodo_pago' => 'efectivo',
            'monto_pago' => 1160,
            'estado_pago' => 'completado',
        ])->assertRedirect('/pedido');

        $pedido = Pedido::latest('id')->first();

        $this->assertDatabaseHas('pedidos', [
            'id' => $pedido->id,
            'estado' => 'pendiente',
        ]);
        $this->assertDatabaseHas('pagos', [
            'pedido_id' => $pedido->id,
            'metodo_pago' => 'efectivo',
        ]);
        $this->assertDatabaseHas('pedido_producto', [
            'pedido_id' => $pedido->id,
            'producto_id' => $producto->id,
        ]);
        $this->assertSame(1, Pago::where('pedido_id', $pedido->id)->count());
    }

    private function fakePng(string $name): UploadedFile
    {
        return UploadedFile::fake()->createWithContent(
            $name,
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
        );
    }
}
