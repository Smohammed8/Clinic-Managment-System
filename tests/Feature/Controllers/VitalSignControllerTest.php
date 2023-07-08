<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\VitalSign;

use App\Models\Student;
use App\Models\Encounter;
use App\Models\ClinicUser;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VitalSignControllerTest extends TestCase
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
    public function it_displays_index_view_with_vital_signs(): void
    {
        $vitalSigns = VitalSign::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('vital-signs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.vital_signs.index')
            ->assertViewHas('vitalSigns');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_vital_sign(): void
    {
        $response = $this->get(route('vital-signs.create'));

        $response->assertOk()->assertViewIs('app.vital_signs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_vital_sign(): void
    {
        $data = VitalSign::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('vital-signs.store'), $data);

        $this->assertDatabaseHas('vital_signs', $data);

        $vitalSign = VitalSign::latest('id')->first();

        $response->assertRedirect(route('vital-signs.edit', $vitalSign));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_vital_sign(): void
    {
        $vitalSign = VitalSign::factory()->create();

        $response = $this->get(route('vital-signs.show', $vitalSign));

        $response
            ->assertOk()
            ->assertViewIs('app.vital_signs.show')
            ->assertViewHas('vitalSign');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_vital_sign(): void
    {
        $vitalSign = VitalSign::factory()->create();

        $response = $this->get(route('vital-signs.edit', $vitalSign));

        $response
            ->assertOk()
            ->assertViewIs('app.vital_signs.edit')
            ->assertViewHas('vitalSign');
    }

    /**
     * @test
     */
    public function it_updates_the_vital_sign(): void
    {
        $vitalSign = VitalSign::factory()->create();

        $encounter = Encounter::factory()->create();
        $clinicUser = ClinicUser::factory()->create();
        $student = Student::factory()->create();

        $data = [
            'temp' => $this->faker->randomNumber(1),
            'blood_pressure' => $this->faker->randomNumber(1),
            'pulse_rate' => $this->faker->randomNumber(1),
            'rr' => $this->faker->randomNumber(1),
            'weight' => $this->faker->randomFloat(2, 0, 9999),
            'height' => $this->faker->randomFloat(2, 0, 9999),
            'muac' => $this->faker->randomNumber(1),
            'encounter_id' => $encounter->id,
            'clinic_user_id' => $clinicUser->id,
            'student_id' => $student->id,
        ];

        $response = $this->put(route('vital-signs.update', $vitalSign), $data);

        $data['id'] = $vitalSign->id;

        $this->assertDatabaseHas('vital_signs', $data);

        $response->assertRedirect(route('vital-signs.edit', $vitalSign));
    }

    /**
     * @test
     */
    public function it_deletes_the_vital_sign(): void
    {
        $vitalSign = VitalSign::factory()->create();

        $response = $this->delete(route('vital-signs.destroy', $vitalSign));

        $response->assertRedirect(route('vital-signs.index'));

        $this->assertModelMissing($vitalSign);
    }
}
