<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Collage;

use App\Models\Campus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollageControllerTest extends TestCase
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
    public function it_displays_index_view_with_collages(): void
    {
        $collages = Collage::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('collages.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.collages.index')
            ->assertViewHas('collages');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_collage(): void
    {
        $response = $this->get(route('collages.create'));

        $response->assertOk()->assertViewIs('app.collages.create');
    }

    /**
     * @test
     */
    public function it_stores_the_collage(): void
    {
        $data = Collage::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('collages.store'), $data);

        $this->assertDatabaseHas('collage', $data);

        $collage = Collage::latest('id')->first();

        $response->assertRedirect(route('collages.edit', $collage));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_collage(): void
    {
        $collage = Collage::factory()->create();

        $response = $this->get(route('collages.show', $collage));

        $response
            ->assertOk()
            ->assertViewIs('app.collages.show')
            ->assertViewHas('collage');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_collage(): void
    {
        $collage = Collage::factory()->create();

        $response = $this->get(route('collages.edit', $collage));

        $response
            ->assertOk()
            ->assertViewIs('app.collages.edit')
            ->assertViewHas('collage');
    }

    /**
     * @test
     */
    public function it_updates_the_collage(): void
    {
        $collage = Collage::factory()->create();

        $campus = Campus::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'campus_id' => $campus->id,
        ];

        $response = $this->put(route('collages.update', $collage), $data);

        $data['id'] = $collage->id;

        $this->assertDatabaseHas('collage', $data);

        $response->assertRedirect(route('collages.edit', $collage));
    }

    /**
     * @test
     */
    public function it_deletes_the_collage(): void
    {
        $collage = Collage::factory()->create();

        $response = $this->delete(route('collages.destroy', $collage));

        $response->assertRedirect(route('collages.index'));

        $this->assertModelMissing($collage);
    }
}
