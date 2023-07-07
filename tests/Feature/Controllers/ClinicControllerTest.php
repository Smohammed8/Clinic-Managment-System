<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Clinic;

use App\Models\Campus;
use App\Models\Collage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClinicControllerTest extends TestCase
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
    public function it_displays_index_view_with_clinics(): void
    {
        $clinics = Clinic::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('clinics.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.clinics.index')
            ->assertViewHas('clinics');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_clinic(): void
    {
        $response = $this->get(route('clinics.create'));

        $response->assertOk()->assertViewIs('app.clinics.create');
    }

    /**
     * @test
     */
    public function it_stores_the_clinic(): void
    {
        $data = Clinic::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('clinics.store'), $data);

        $this->assertDatabaseHas('clinic', $data);

        $clinic = Clinic::latest('id')->first();

        $response->assertRedirect(route('clinics.edit', $clinic));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_clinic(): void
    {
        $clinic = Clinic::factory()->create();

        $response = $this->get(route('clinics.show', $clinic));

        $response
            ->assertOk()
            ->assertViewIs('app.clinics.show')
            ->assertViewHas('clinic');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_clinic(): void
    {
        $clinic = Clinic::factory()->create();

        $response = $this->get(route('clinics.edit', $clinic));

        $response
            ->assertOk()
            ->assertViewIs('app.clinics.edit')
            ->assertViewHas('clinic');
    }

    /**
     * @test
     */
    public function it_updates_the_clinic(): void
    {
        $clinic = Clinic::factory()->create();

        $campus = Campus::factory()->create();
        $collage = Collage::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'code_clinic' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'lat' => $this->faker->randomNumber(2),
            'long' => $this->faker->randomNumber(2),
            'status' => $this->faker->numberBetween(0, 127),
            'is_active' => $this->faker->numberBetween(0, 127),
            'campus_id' => $campus->id,
            'collage_id' => $collage->id,
        ];

        $response = $this->put(route('clinics.update', $clinic), $data);

        $data['id'] = $clinic->id;

        $this->assertDatabaseHas('clinic', $data);

        $response->assertRedirect(route('clinics.edit', $clinic));
    }

    /**
     * @test
     */
    public function it_deletes_the_clinic(): void
    {
        $clinic = Clinic::factory()->create();

        $response = $this->delete(route('clinics.destroy', $clinic));

        $response->assertRedirect(route('clinics.index'));

        $this->assertModelMissing($clinic);
    }
}
