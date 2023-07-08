<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\LabTestRequest;

use App\Models\ClinicUser;
use App\Models\LabCatagory;
use App\Models\LabTestRequestGroup;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabTestRequestControllerTest extends TestCase
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
    public function it_displays_index_view_with_lab_test_requests(): void
    {
        $labTestRequests = LabTestRequest::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('lab-test-requests.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.lab_test_requests.index')
            ->assertViewHas('labTestRequests');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_lab_test_request(): void
    {
        $response = $this->get(route('lab-test-requests.create'));

        $response->assertOk()->assertViewIs('app.lab_test_requests.create');
    }

    /**
     * @test
     */
    public function it_stores_the_lab_test_request(): void
    {
        $data = LabTestRequest::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('lab-test-requests.store'), $data);

        $this->assertDatabaseHas('lab_test_requests', $data);

        $labTestRequest = LabTestRequest::latest('id')->first();

        $response->assertRedirect(
            route('lab-test-requests.edit', $labTestRequest)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_lab_test_request(): void
    {
        $labTestRequest = LabTestRequest::factory()->create();

        $response = $this->get(
            route('lab-test-requests.show', $labTestRequest)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.lab_test_requests.show')
            ->assertViewHas('labTestRequest');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_lab_test_request(): void
    {
        $labTestRequest = LabTestRequest::factory()->create();

        $response = $this->get(
            route('lab-test-requests.edit', $labTestRequest)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.lab_test_requests.edit')
            ->assertViewHas('labTestRequest');
    }

    /**
     * @test
     */
    public function it_updates_the_lab_test_request(): void
    {
        $labTestRequest = LabTestRequest::factory()->create();

        $labTestRequestGroup = LabTestRequestGroup::factory()->create();
        $clinicUser = ClinicUser::factory()->create();
        $clinicUser = ClinicUser::factory()->create();
        $labCatagory = LabCatagory::factory()->create();
        $clinicUser = ClinicUser::factory()->create();

        $data = [
            'sample_collected_at' => $this->faker->dateTime(),
            'sample_analyzed_at' => $this->faker->dateTime(),
            'status' => $this->faker->numberBetween(0, 127),
            'notification' => $this->faker->numberBetween(0, 127),
            'note' => $this->faker->text(),
            'result' => $this->faker->text(),
            'comment' => $this->faker->text(),
            'analyser_result' => $this->faker->text(255),
            'approved_at' => $this->faker->dateTime(),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'sample_id' => $this->faker->text(255),
            'ordered_on' => $this->faker->dateTime(),
            'lab_test_request_group_id' => $labTestRequestGroup->id,
            'sample_collected_by_id' => $clinicUser->id,
            'sample_analyzed_by_id' => $clinicUser->id,
            'lab_catagory_id' => $labCatagory->id,
            'approved_by_id' => $clinicUser->id,
        ];

        $response = $this->put(
            route('lab-test-requests.update', $labTestRequest),
            $data
        );

        $data['id'] = $labTestRequest->id;

        $this->assertDatabaseHas('lab_test_requests', $data);

        $response->assertRedirect(
            route('lab-test-requests.edit', $labTestRequest)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_lab_test_request(): void
    {
        $labTestRequest = LabTestRequest::factory()->create();

        $response = $this->delete(
            route('lab-test-requests.destroy', $labTestRequest)
        );

        $response->assertRedirect(route('lab-test-requests.index'));

        $this->assertModelMissing($labTestRequest);
    }
}
