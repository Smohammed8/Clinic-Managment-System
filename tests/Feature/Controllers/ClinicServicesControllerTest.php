<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ClinicServices;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClinicServicesControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_clinic_services(): void
    {
        $allClinicServices = ClinicServices::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-clinic-services.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_clinic_services.index')
            ->assertViewHas('allClinicServices');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_clinic_services(): void
    {
        $response = $this->get(route('all-clinic-services.create'));

        $response->assertOk()->assertViewIs('app.all_clinic_services.create');
    }

    /**
     * @test
     */
    public function it_stores_the_clinic_services(): void
    {
        $data = ClinicServices::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-clinic-services.store'), $data);

        $this->assertDatabaseHas('clinic_services', $data);

        $clinicServices = ClinicServices::latest('id')->first();

        $response->assertRedirect(
            route('all-clinic-services.edit', $clinicServices)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_clinic_services(): void
    {
        $clinicServices = ClinicServices::factory()->create();

        $response = $this->get(
            route('all-clinic-services.show', $clinicServices)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_clinic_services.show')
            ->assertViewHas('clinicServices');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_clinic_services(): void
    {
        $clinicServices = ClinicServices::factory()->create();

        $response = $this->get(
            route('all-clinic-services.edit', $clinicServices)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_clinic_services.edit')
            ->assertViewHas('clinicServices');
    }

    /**
     * @test
     */
    public function it_updates_the_clinic_services(): void
    {
        $clinicServices = ClinicServices::factory()->create();

        $data = [
            'service_name' => $this->faker->text(255),
            'service_ description' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('all-clinic-services.update', $clinicServices),
            $data
        );

        $data['id'] = $clinicServices->id;

        $this->assertDatabaseHas('clinic_services', $data);

        $response->assertRedirect(
            route('all-clinic-services.edit', $clinicServices)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_clinic_services(): void
    {
        $clinicServices = ClinicServices::factory()->create();

        $response = $this->delete(
            route('all-clinic-services.destroy', $clinicServices)
        );

        $response->assertRedirect(route('all-clinic-services.index'));

        $this->assertModelMissing($clinicServices);
    }
}
