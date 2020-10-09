<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public array $productJsonStructure;

    /**
     * ProductTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName\
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

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
     * @return void
     */
    public function testSuccessProductsIndex()
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
     * @return void
     */
    public function testSuccessProductsShow()
    {
        $product = Product::factory()->hasInfo()->create();

        $this->get(route('products.show', $product))
            ->assertOk()
            ->assertJsonStructure($this->productJsonStructure);
    }
}
