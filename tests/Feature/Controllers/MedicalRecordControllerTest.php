<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MedicalRecord;

use App\Models\Student;
use App\Models\Encounter;
use App\Models\ClinicUser;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicalRecordControllerTest extends TestCase
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
    public function it_displays_index_view_with_medical_records(): void
    {
        $medicalRecords = MedicalRecord::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('medical-records.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.medical_records.index')
            ->assertViewHas('medicalRecords');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_medical_record(): void
    {
        $response = $this->get(route('medical-records.create'));

        $response->assertOk()->assertViewIs('app.medical_records.create');
    }

    /**
     * @test
     */
    public function it_stores_the_medical_record(): void
    {
        $data = MedicalRecord::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('medical-records.store'), $data);

        $this->assertDatabaseHas('medical_records', $data);

        $medicalRecord = MedicalRecord::latest('id')->first();

        $response->assertRedirect(
            route('medical-records.edit', $medicalRecord)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_medical_record(): void
    {
        $medicalRecord = MedicalRecord::factory()->create();

        $response = $this->get(route('medical-records.show', $medicalRecord));

        $response
            ->assertOk()
            ->assertViewIs('app.medical_records.show')
            ->assertViewHas('medicalRecord');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_medical_record(): void
    {
        $medicalRecord = MedicalRecord::factory()->create();

        $response = $this->get(route('medical-records.edit', $medicalRecord));

        $response
            ->assertOk()
            ->assertViewIs('app.medical_records.edit')
            ->assertViewHas('medicalRecord');
    }

    /**
     * @test
     */
    public function it_updates_the_medical_record(): void
    {
        $medicalRecord = MedicalRecord::factory()->create();

        $encounter = Encounter::factory()->create();
        $clinicUser = ClinicUser::factory()->create();
        $student = Student::factory()->create();

        $data = [
            'subjective' => $this->faker->text(),
            'objective' => $this->faker->text(),
            'assessment' => $this->faker->text(),
            'plan' => $this->faker->text(),
            'encounter_id' => $encounter->id,
            'clinic_user_id' => $clinicUser->id,
            'student_id' => $student->id,
        ];

        $response = $this->put(
            route('medical-records.update', $medicalRecord),
            $data
        );

        $data['id'] = $medicalRecord->id;

        $this->assertDatabaseHas('medical_records', $data);

        $response->assertRedirect(
            route('medical-records.edit', $medicalRecord)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_medical_record(): void
    {
        $medicalRecord = MedicalRecord::factory()->create();

        $response = $this->delete(
            route('medical-records.destroy', $medicalRecord)
        );

        $response->assertRedirect(route('medical-records.index'));

        $this->assertModelMissing($medicalRecord);
    }
}
