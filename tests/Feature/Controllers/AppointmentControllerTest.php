<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Appointment;

use App\Models\Student;
use App\Models\Encounter;
use App\Models\ClinicUser;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentControllerTest extends TestCase
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
    public function it_displays_index_view_with_appointments(): void
    {
        $appointments = Appointment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('appointments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.appointments.index')
            ->assertViewHas('appointments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_appointment(): void
    {
        $response = $this->get(route('appointments.create'));

        $response->assertOk()->assertViewIs('app.appointments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_appointment(): void
    {
        $data = Appointment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('appointments.store'), $data);

        $this->assertDatabaseHas('appointments', $data);

        $appointment = Appointment::latest('id')->first();

        $response->assertRedirect(route('appointments.edit', $appointment));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_appointment(): void
    {
        $appointment = Appointment::factory()->create();

        $response = $this->get(route('appointments.show', $appointment));

        $response
            ->assertOk()
            ->assertViewIs('app.appointments.show')
            ->assertViewHas('appointment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_appointment(): void
    {
        $appointment = Appointment::factory()->create();

        $response = $this->get(route('appointments.edit', $appointment));

        $response
            ->assertOk()
            ->assertViewIs('app.appointments.edit')
            ->assertViewHas('appointment');
    }

    /**
     * @test
     */
    public function it_updates_the_appointment(): void
    {
        $appointment = Appointment::factory()->create();

        $encounter = Encounter::factory()->create();
        $clinicUser = ClinicUser::factory()->create();
        $student = Student::factory()->create();

        $data = [
            'a_date' => $this->faker->dateTime(),
            'reason' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 127),
            'encounter_id' => $this->faker->boolean(),
            'encounter_id' => $encounter->id,
            'clinic_user_id' => $clinicUser->id,
            'student_id' => $student->id,
        ];

        $response = $this->put(
            route('appointments.update', $appointment),
            $data
        );

        $data['id'] = $appointment->id;

        $this->assertDatabaseHas('appointments', $data);

        $response->assertRedirect(route('appointments.edit', $appointment));
    }

    /**
     * @test
     */
    public function it_deletes_the_appointment(): void
    {
        $appointment = Appointment::factory()->create();

        $response = $this->delete(route('appointments.destroy', $appointment));

        $response->assertRedirect(route('appointments.index'));

        $this->assertModelMissing($appointment);
    }
}
