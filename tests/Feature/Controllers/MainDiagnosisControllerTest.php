<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MainDiagnosis;

use App\Models\Student;
use App\Models\Encounter;
use App\Models\Diagnosis;
use App\Models\ClinicUser;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainDiagnosisControllerTest extends TestCase
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
    public function it_displays_index_view_with_main_diagnoses(): void
    {
        $mainDiagnoses = MainDiagnosis::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('main-diagnoses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.main_diagnoses.index')
            ->assertViewHas('mainDiagnoses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_main_diagnosis(): void
    {
        $response = $this->get(route('main-diagnoses.create'));

        $response->assertOk()->assertViewIs('app.main_diagnoses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_main_diagnosis(): void
    {
        $data = MainDiagnosis::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('main-diagnoses.store'), $data);

        $this->assertDatabaseHas('main_diagnoses', $data);

        $mainDiagnosis = MainDiagnosis::latest('id')->first();

        $response->assertRedirect(route('main-diagnoses.edit', $mainDiagnosis));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_main_diagnosis(): void
    {
        $mainDiagnosis = MainDiagnosis::factory()->create();

        $response = $this->get(route('main-diagnoses.show', $mainDiagnosis));

        $response
            ->assertOk()
            ->assertViewIs('app.main_diagnoses.show')
            ->assertViewHas('mainDiagnosis');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_main_diagnosis(): void
    {
        $mainDiagnosis = MainDiagnosis::factory()->create();

        $response = $this->get(route('main-diagnoses.edit', $mainDiagnosis));

        $response
            ->assertOk()
            ->assertViewIs('app.main_diagnoses.edit')
            ->assertViewHas('mainDiagnosis');
    }

    /**
     * @test
     */
    public function it_updates_the_main_diagnosis(): void
    {
        $mainDiagnosis = MainDiagnosis::factory()->create();

        $clinicUser = ClinicUser::factory()->create();
        $student = Student::factory()->create();
        $encounter = Encounter::factory()->create();
        $diagnosis = Diagnosis::factory()->create();

        $data = [
            'clinic_user_id' => $clinicUser->id,
            'student_id' => $student->id,
            'encounter_id' => $encounter->id,
            'diagnosis_id' => $diagnosis->id,
        ];

        $response = $this->put(
            route('main-diagnoses.update', $mainDiagnosis),
            $data
        );

        $data['id'] = $mainDiagnosis->id;

        $this->assertDatabaseHas('main_diagnoses', $data);

        $response->assertRedirect(route('main-diagnoses.edit', $mainDiagnosis));
    }

    /**
     * @test
     */
    public function it_deletes_the_main_diagnosis(): void
    {
        $mainDiagnosis = MainDiagnosis::factory()->create();

        $response = $this->delete(
            route('main-diagnoses.destroy', $mainDiagnosis)
        );

        $response->assertRedirect(route('main-diagnoses.index'));

        $this->assertModelMissing($mainDiagnosis);
    }
}
