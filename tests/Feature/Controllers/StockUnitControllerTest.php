<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\StockUnit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockUnitControllerTest extends TestCase
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
    public function it_displays_index_view_with_stock_units(): void
    {
        $stockUnits = StockUnit::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('stock-units.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.stock_units.index')
            ->assertViewHas('stockUnits');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_stock_unit(): void
    {
        $response = $this->get(route('stock-units.create'));

        $response->assertOk()->assertViewIs('app.stock_units.create');
    }

    /**
     * @test
     */
    public function it_stores_the_stock_unit(): void
    {
        $data = StockUnit::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('stock-units.store'), $data);

        $this->assertDatabaseHas('stock_units', $data);

        $stockUnit = StockUnit::latest('id')->first();

        $response->assertRedirect(route('stock-units.edit', $stockUnit));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_stock_unit(): void
    {
        $stockUnit = StockUnit::factory()->create();

        $response = $this->get(route('stock-units.show', $stockUnit));

        $response
            ->assertOk()
            ->assertViewIs('app.stock_units.show')
            ->assertViewHas('stockUnit');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_stock_unit(): void
    {
        $stockUnit = StockUnit::factory()->create();

        $response = $this->get(route('stock-units.edit', $stockUnit));

        $response
            ->assertOk()
            ->assertViewIs('app.stock_units.edit')
            ->assertViewHas('stockUnit');
    }

    /**
     * @test
     */
    public function it_updates_the_stock_unit(): void
    {
        $stockUnit = StockUnit::factory()->create();

        $data = [
            'unit_name' => $this->faker->text(255),
        ];

        $response = $this->put(route('stock-units.update', $stockUnit), $data);

        $data['id'] = $stockUnit->id;

        $this->assertDatabaseHas('stock_units', $data);

        $response->assertRedirect(route('stock-units.edit', $stockUnit));
    }

    /**
     * @test
     */
    public function it_deletes_the_stock_unit(): void
    {
        $stockUnit = StockUnit::factory()->create();

        $response = $this->delete(route('stock-units.destroy', $stockUnit));

        $response->assertRedirect(route('stock-units.index'));

        $this->assertModelMissing($stockUnit);
    }
}
