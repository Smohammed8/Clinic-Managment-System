<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Prescription;

use App\Models\MainDiagnosis;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrescriptionControllerTest extends TestCase
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
    public function it_displays_index_view_with_prescriptions(): void
    {
        $prescriptions = Prescription::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('prescriptions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.prescriptions.index')
            ->assertViewHas('prescriptions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_prescription(): void
    {
        $response = $this->get(route('prescriptions.create'));

        $response->assertOk()->assertViewIs('app.prescriptions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_prescription(): void
    {
        $data = Prescription::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('prescriptions.store'), $data);

        $this->assertDatabaseHas('prescriptions', $data);

        $prescription = Prescription::latest('id')->first();

        $response->assertRedirect(route('prescriptions.edit', $prescription));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_prescription(): void
    {
        $prescription = Prescription::factory()->create();

        $response = $this->get(route('prescriptions.show', $prescription));

        $response
            ->assertOk()
            ->assertViewIs('app.prescriptions.show')
            ->assertViewHas('prescription');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_prescription(): void
    {
        $prescription = Prescription::factory()->create();

        $response = $this->get(route('prescriptions.edit', $prescription));

        $response
            ->assertOk()
            ->assertViewIs('app.prescriptions.edit')
            ->assertViewHas('prescription');
    }

    /**
     * @test
     */
    public function it_updates_the_prescription(): void
    {
        $prescription = Prescription::factory()->create();

        $mainDiagnosis = MainDiagnosis::factory()->create();

        $data = [
            'drug_name' => $this->faker->text(),
            'dose' => $this->faker->text(255),
            'frequency' => $this->faker->text(255),
            'duration' => $this->faker->text(255),
            'other_info' => $this->faker->text(),
            'main_diagnosis_id' => $mainDiagnosis->id,
        ];

        $response = $this->put(
            route('prescriptions.update', $prescription),
            $data
        );

        $data['id'] = $prescription->id;

        $this->assertDatabaseHas('prescriptions', $data);

        $response->assertRedirect(route('prescriptions.edit', $prescription));
    }

    /**
     * @test
     */
    public function it_deletes_the_prescription(): void
    {
        $prescription = Prescription::factory()->create();

        $response = $this->delete(
            route('prescriptions.destroy', $prescription)
        );

        $response->assertRedirect(route('prescriptions.index'));

        $this->assertModelMissing($prescription);
    }
}
