<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CatalogListingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    /** @test */
    public function it_lists_administradores(): void
    {
        $response = $this->get('/administrador');
        $response->assertStatus(200);
        $response->assertSee('Administradores');
        $response->assertSee('Carlos');
        $response->assertSee('Gómez');
    }

    /** @test */
    public function it_lists_proveedores(): void
    {
        $response = $this->get('/proveedor');
        $response->assertStatus(200);
        $response->assertSee('Proveedores');
        $response->assertSee('AutoDistribuidora Global');
        $response->assertSee('Roberto Silva');
    }

    /** @test */
    public function it_lists_marcas(): void
    {
        $response = $this->get('/marcas');
        $response->assertStatus(200);
        $response->assertSee('Marcas');
        $response->assertSee('Toyota');
        $response->assertSee('Ford');
        $response->assertSee('BMW');
    }

    /** @test */
    public function it_lists_colores(): void
    {
        $response = $this->get('/colores');
        $response->assertStatus(200);
        $response->assertSee('Colores');
        $response->assertSee('Rojo');
        $response->assertSee('Azul Metálico');
    }

    /** @test */
    public function it_lists_clientes(): void
    {
        $response = $this->get('/cliente');
        $response->assertStatus(200);
        $response->assertSee('Clientes');
        $response->assertSee('Juan');
        $response->assertSee('Pérez');
    }

    /** @test */
    public function it_lists_modelos(): void
    {
        $response = $this->get('/modelos');
        $response->assertStatus(200);
        $response->assertSee('Modelos');
        $response->assertSee('Corolla');
        $response->assertSee('Mustang');
    }

    /** @test */
    public function it_lists_tipos(): void
    {
        $response = $this->get('/tipos');
        $response->assertStatus(200);
        $response->assertSee('Tipos');
        $response->assertSee('Sedán');
        $response->assertSee('SUV');
    }

    /** @test */
    public function it_lists_productos(): void
    {
        $response = $this->get('/producto');
        $response->assertStatus(200);
        $response->assertSee('Productos');
        $response->assertSee('Ford Mustang GT Fastback');
        $response->assertSee('Toyota Corolla SE');
    }
}
