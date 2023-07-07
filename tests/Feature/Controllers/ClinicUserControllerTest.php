<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ClinicUser;

use App\Models\Encounter;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClinicUserControllerTest extends TestCase
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
    public function it_displays_index_view_with_clinic_users(): void
    {
        $clinicUsers = ClinicUser::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('clinic-users.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.clinic_users.index')
            ->assertViewHas('clinicUsers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_clinic_user(): void
    {
        $response = $this->get(route('clinic-users.create'));

        $response->assertOk()->assertViewIs('app.clinic_users.create');
    }

    /**
     * @test
     */
    public function it_stores_the_clinic_user(): void
    {
        $data = ClinicUser::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('clinic-users.store'), $data);

        $this->assertDatabaseHas('clinic_users', $data);

        $clinicUser = ClinicUser::latest('id')->first();

        $response->assertRedirect(route('clinic-users.edit', $clinicUser));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_clinic_user(): void
    {
        $clinicUser = ClinicUser::factory()->create();

        $response = $this->get(route('clinic-users.show', $clinicUser));

        $response
            ->assertOk()
            ->assertViewIs('app.clinic_users.show')
            ->assertViewHas('clinicUser');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_clinic_user(): void
    {
        $clinicUser = ClinicUser::factory()->create();

        $response = $this->get(route('clinic-users.edit', $clinicUser));

        $response
            ->assertOk()
            ->assertViewIs('app.clinic_users.edit')
            ->assertViewHas('clinicUser');
    }

    /**
     * @test
     */
    public function it_updates_the_clinic_user(): void
    {
        $clinicUser = ClinicUser::factory()->create();

        $user = User::factory()->create();
        $encounter = Encounter::factory()->create();
        $encounter = Encounter::factory()->create();

        $data = [
            'user_id' => $user->id,
            'encounter_id' => $encounter->id,
            'encounter_id' => $encounter->id,
        ];

        $response = $this->put(
            route('clinic-users.update', $clinicUser),
            $data
        );

        $data['id'] = $clinicUser->id;

        $this->assertDatabaseHas('clinic_users', $data);

        $response->assertRedirect(route('clinic-users.edit', $clinicUser));
    }

    /**
     * @test
     */
    public function it_deletes_the_clinic_user(): void
    {
        $clinicUser = ClinicUser::factory()->create();

        $response = $this->delete(route('clinic-users.destroy', $clinicUser));

        $response->assertRedirect(route('clinic-users.index'));

        $this->assertModelMissing($clinicUser);
    }
}
