<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public array $productJsonStructure;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->productJsonStructure = [
            'id',
            'title',
            'hashrate_unit',
            'weight',
            'price',
            'in_store_count',
            'image',
            'info' => [
                'id',
                'product_id',
                'notes',
                'overview',
                'payment',
                'warranty',
                'created_at',
                'updated_at',
            ],
        ];
    }

    /**
     * Успешное получение списка товаров, с пагинацией
     *
     * @test
     * @return void
     */
    public function successProductsIndex()
    {
        Product::factory()->hasInfo()->create();

        $this->get(route('products.index'))
            ->assertOk()
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    $this->productJsonStructure
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links' => [
                    [
                        'url',
                        'label',
                        'active',
                    ]
                ],
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ]);
    }

    /**
     * Успешное получение информации о конкретном товаре
     *
     * @test
     * @return void
     */
    public function successProductsShow()
    {
        $product = Product::factory()->hasInfo()->create();

        $this->get(route('products.show', $product))
            ->assertOk()
            ->assertJsonStructure($this->productJsonStructure);
    }

    /**
     * 404 on not found product by slug
     *
     * @test
     * @return void
     */
    public function productNotFoundBySlug()
    {
        $this->get(route('products.show', 'some-not-existing-slug'))
            ->assertNotFound()
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
