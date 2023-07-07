<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Campus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CampusControllerTest extends TestCase
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
    public function it_displays_index_view_with_campuses(): void
    {
        $campuses = Campus::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('campuses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.campuses.index')
            ->assertViewHas('campuses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_campus(): void
    {
        $response = $this->get(route('campuses.create'));

        $response->assertOk()->assertViewIs('app.campuses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_campus(): void
    {
        $data = Campus::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('campuses.store'), $data);

        $this->assertDatabaseHas('campus', $data);

        $campus = Campus::latest('id')->first();

        $response->assertRedirect(route('campuses.edit', $campus));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_campus(): void
    {
        $campus = Campus::factory()->create();

        $response = $this->get(route('campuses.show', $campus));

        $response
            ->assertOk()
            ->assertViewIs('app.campuses.show')
            ->assertViewHas('campus');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_campus(): void
    {
        $campus = Campus::factory()->create();

        $response = $this->get(route('campuses.edit', $campus));

        $response
            ->assertOk()
            ->assertViewIs('app.campuses.edit')
            ->assertViewHas('campus');
    }

    /**
     * @test
     */
    public function it_updates_the_campus(): void
    {
        $campus = Campus::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->put(route('campuses.update', $campus), $data);

        $data['id'] = $campus->id;

        $this->assertDatabaseHas('campus', $data);

        $response->assertRedirect(route('campuses.edit', $campus));
    }

    /**
     * @test
     */
    public function it_deletes_the_campus(): void
    {
        $campus = Campus::factory()->create();

        $response = $this->delete(route('campuses.destroy', $campus));

        $response->assertRedirect(route('campuses.index'));

        $this->assertModelMissing($campus);
    }
}
