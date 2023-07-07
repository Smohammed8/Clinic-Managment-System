<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\StockCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockCategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_stock_categories(): void
    {
        $stockCategories = StockCategory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('stock-categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.stock_categories.index')
            ->assertViewHas('stockCategories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_stock_category(): void
    {
        $response = $this->get(route('stock-categories.create'));

        $response->assertOk()->assertViewIs('app.stock_categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_stock_category(): void
    {
        $data = StockCategory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('stock-categories.store'), $data);

        $this->assertDatabaseHas('stock_categories', $data);

        $stockCategory = StockCategory::latest('id')->first();

        $response->assertRedirect(
            route('stock-categories.edit', $stockCategory)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_stock_category(): void
    {
        $stockCategory = StockCategory::factory()->create();

        $response = $this->get(route('stock-categories.show', $stockCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.stock_categories.show')
            ->assertViewHas('stockCategory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_stock_category(): void
    {
        $stockCategory = StockCategory::factory()->create();

        $response = $this->get(route('stock-categories.edit', $stockCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.stock_categories.edit')
            ->assertViewHas('stockCategory');
    }

    /**
     * @test
     */
    public function it_updates_the_stock_category(): void
    {
        $stockCategory = StockCategory::factory()->create();

        $data = [];

        $response = $this->put(
            route('stock-categories.update', $stockCategory),
            $data
        );

        $data['id'] = $stockCategory->id;

        $this->assertDatabaseHas('stock_categories', $data);

        $response->assertRedirect(
            route('stock-categories.edit', $stockCategory)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_stock_category(): void
    {
        $stockCategory = StockCategory::factory()->create();

        $response = $this->delete(
            route('stock-categories.destroy', $stockCategory)
        );

        $response->assertRedirect(route('stock-categories.index'));

        $this->assertModelMissing($stockCategory);
    }
}
