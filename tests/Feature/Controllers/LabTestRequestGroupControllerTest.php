<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\LabTestRequestGroup;

use App\Models\Encounter;
use App\Models\ClinicUser;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabTestRequestGroupControllerTest extends TestCase
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
    public function it_displays_index_view_with_lab_test_request_groups(): void
    {
        $labTestRequestGroups = LabTestRequestGroup::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('lab-test-request-groups.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.lab_test_request_groups.index')
            ->assertViewHas('labTestRequestGroups');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_lab_test_request_group(): void
    {
        $response = $this->get(route('lab-test-request-groups.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.lab_test_request_groups.create');
    }

    /**
     * @test
     */
    public function it_stores_the_lab_test_request_group(): void
    {
        $data = LabTestRequestGroup::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('lab-test-request-groups.store'), $data);

        $this->assertDatabaseHas('lab_test_request_groups', $data);

        $labTestRequestGroup = LabTestRequestGroup::latest('id')->first();

        $response->assertRedirect(
            route('lab-test-request-groups.edit', $labTestRequestGroup)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_lab_test_request_group(): void
    {
        $labTestRequestGroup = LabTestRequestGroup::factory()->create();

        $response = $this->get(
            route('lab-test-request-groups.show', $labTestRequestGroup)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.lab_test_request_groups.show')
            ->assertViewHas('labTestRequestGroup');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_lab_test_request_group(): void
    {
        $labTestRequestGroup = LabTestRequestGroup::factory()->create();

        $response = $this->get(
            route('lab-test-request-groups.edit', $labTestRequestGroup)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.lab_test_request_groups.edit')
            ->assertViewHas('labTestRequestGroup');
    }

    /**
     * @test
     */
    public function it_updates_the_lab_test_request_group(): void
    {
        $labTestRequestGroup = LabTestRequestGroup::factory()->create();

        $clinicUser = ClinicUser::factory()->create();
        $encounter = Encounter::factory()->create();

        $data = [
            'status' => $this->faker->numberBetween(0, 127),
            'priority' => $this->faker->numberBetween(0, 127),
            'notification' => $this->faker->numberBetween(0, 127),
            'call_status' => $this->faker->numberBetween(0, 127),
            'requested_at' => $this->faker->dateTime(),
            'clinic_user_id' => $clinicUser->id,
            'encounter_id' => $encounter->id,
        ];

        $response = $this->put(
            route('lab-test-request-groups.update', $labTestRequestGroup),
            $data
        );

        $data['id'] = $labTestRequestGroup->id;

        $this->assertDatabaseHas('lab_test_request_groups', $data);

        $response->assertRedirect(
            route('lab-test-request-groups.edit', $labTestRequestGroup)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_lab_test_request_group(): void
    {
        $labTestRequestGroup = LabTestRequestGroup::factory()->create();

        $response = $this->delete(
            route('lab-test-request-groups.destroy', $labTestRequestGroup)
        );

        $response->assertRedirect(route('lab-test-request-groups.index'));

        $this->assertModelMissing($labTestRequestGroup);
    }
}
