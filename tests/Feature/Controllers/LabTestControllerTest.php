<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\LabTest;

use App\Models\LabCatagory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabTestControllerTest extends TestCase
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
    public function it_displays_index_view_with_lab_tests(): void
    {
        $labTests = LabTest::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('lab-tests.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.lab_tests.index')
            ->assertViewHas('labTests');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_lab_test(): void
    {
        $response = $this->get(route('lab-tests.create'));

        $response->assertOk()->assertViewIs('app.lab_tests.create');
    }

    /**
     * @test
     */
    public function it_stores_the_lab_test(): void
    {
        $data = LabTest::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('lab-tests.store'), $data);

        $this->assertDatabaseHas('lab_tests', $data);

        $labTest = LabTest::latest('id')->first();

        $response->assertRedirect(route('lab-tests.edit', $labTest));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_lab_test(): void
    {
        $labTest = LabTest::factory()->create();

        $response = $this->get(route('lab-tests.show', $labTest));

        $response
            ->assertOk()
            ->assertViewIs('app.lab_tests.show')
            ->assertViewHas('labTest');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_lab_test(): void
    {
        $labTest = LabTest::factory()->create();

        $response = $this->get(route('lab-tests.edit', $labTest));

        $response
            ->assertOk()
            ->assertViewIs('app.lab_tests.edit')
            ->assertViewHas('labTest');
    }

    /**
     * @test
     */
    public function it_updates_the_lab_test(): void
    {
        $labTest = LabTest::factory()->create();

        $labCatagory = LabCatagory::factory()->create();

        $data = [
            'test_name' => $this->faker->text(255),
            'test_desc' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 127),
            'is_available ' => $this->faker->boolean(),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'lab_catagory_id' => $labCatagory->id,
        ];

        $response = $this->put(route('lab-tests.update', $labTest), $data);

        $data['id'] = $labTest->id;

        $this->assertDatabaseHas('lab_tests', $data);

        $response->assertRedirect(route('lab-tests.edit', $labTest));
    }

    /**
     * @test
     */
    public function it_deletes_the_lab_test(): void
    {
        $labTest = LabTest::factory()->create();

        $response = $this->delete(route('lab-tests.destroy', $labTest));

        $response->assertRedirect(route('lab-tests.index'));

        $this->assertModelMissing($labTest);
    }
}
