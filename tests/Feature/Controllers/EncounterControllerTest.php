<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Encounter;

use App\Models\Clinic;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EncounterControllerTest extends TestCase
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
    public function it_displays_index_view_with_encounters(): void
    {
        $encounters = Encounter::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('encounters.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.encounters.index')
            ->assertViewHas('encounters');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_encounter(): void
    {
        $response = $this->get(route('encounters.create'));

        $response->assertOk()->assertViewIs('app.encounters.create');
    }

    /**
     * @test
     */
    public function it_stores_the_encounter(): void
    {
        $data = Encounter::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('encounters.store'), $data);

        $this->assertDatabaseHas('encounters', $data);

        $encounter = Encounter::latest('id')->first();

        $response->assertRedirect(route('encounters.edit', $encounter));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_encounter(): void
    {
        $encounter = Encounter::factory()->create();

        $response = $this->get(route('encounters.show', $encounter));

        $response
            ->assertOk()
            ->assertViewIs('app.encounters.show')
            ->assertViewHas('encounter');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_encounter(): void
    {
        $encounter = Encounter::factory()->create();

        $response = $this->get(route('encounters.edit', $encounter));

        $response
            ->assertOk()
            ->assertViewIs('app.encounters.edit')
            ->assertViewHas('encounter');
    }

    /**
     * @test
     */
    public function it_updates_the_encounter(): void
    {
        $encounter = Encounter::factory()->create();

        $clinic = Clinic::factory()->create();

        $data = [
            'check_in_time' => $this->faker->dateTime(),
            'status' => $this->faker->numberBetween(0, 127),
            'closed_at' => $this->faker->dateTime(),
            'priority' => $this->faker->numberBetween(0, 127),
            'clinic_id' => $clinic->id,
        ];

        $response = $this->put(route('encounters.update', $encounter), $data);

        $data['id'] = $encounter->id;

        $this->assertDatabaseHas('encounters', $data);

        $response->assertRedirect(route('encounters.edit', $encounter));
    }

    /**
     * @test
     */
    public function it_deletes_the_encounter(): void
    {
        $encounter = Encounter::factory()->create();

        $response = $this->delete(route('encounters.destroy', $encounter));

        $response->assertRedirect(route('encounters.index'));

        $this->assertModelMissing($encounter);
    }
}
