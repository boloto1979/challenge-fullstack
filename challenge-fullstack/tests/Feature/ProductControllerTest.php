<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test; // <--- Importar o atributo

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_products(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    #[Test]
    public function it_can_create_a_product(): void
    {
        $data = [
            'name'        => 'Novo Produto',
            'description' => 'Descrição teste',
            'price'       => 99.99,
            'quantity'    => 10,
            'active'      => true,
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'name' => 'Novo Produto',
                 ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Novo Produto',
        ]);
    }

    #[Test]
    public function it_can_show_a_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $product->id]);
    }

    #[Test]
    public function it_can_update_a_product(): void
    {
        $product = Product::factory()->create();

        $updateData = [
            'name' => 'Nome Atualizado',
        ];

        $response = $this->putJson("/api/products/{$product->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Nome Atualizado']);

        $this->assertDatabaseHas('products', [
            'id'   => $product->id,
            'name' => 'Nome Atualizado',
        ]);
    }

    #[Test]
    public function it_can_delete_a_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
