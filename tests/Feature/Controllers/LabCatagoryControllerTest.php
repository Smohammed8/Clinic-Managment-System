<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\LabCatagory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabCatagoryControllerTest extends TestCase
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
    public function it_displays_index_view_with_lab_catagories(): void
    {
        $labCatagories = LabCatagory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('lab-catagories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.lab_catagories.index')
            ->assertViewHas('labCatagories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_lab_catagory(): void
    {
        $response = $this->get(route('lab-catagories.create'));

        $response->assertOk()->assertViewIs('app.lab_catagories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_lab_catagory(): void
    {
        $data = LabCatagory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('lab-catagories.store'), $data);

        $this->assertDatabaseHas('lab_catagories', $data);

        $labCatagory = LabCatagory::latest('id')->first();

        $response->assertRedirect(route('lab-catagories.edit', $labCatagory));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_lab_catagory(): void
    {
        $labCatagory = LabCatagory::factory()->create();

        $response = $this->get(route('lab-catagories.show', $labCatagory));

        $response
            ->assertOk()
            ->assertViewIs('app.lab_catagories.show')
            ->assertViewHas('labCatagory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_lab_catagory(): void
    {
        $labCatagory = LabCatagory::factory()->create();

        $response = $this->get(route('lab-catagories.edit', $labCatagory));

        $response
            ->assertOk()
            ->assertViewIs('app.lab_catagories.edit')
            ->assertViewHas('labCatagory');
    }

    /**
     * @test
     */
    public function it_updates_the_lab_catagory(): void
    {
        $labCatagory = LabCatagory::factory()->create();

        $data = [
            'lab_name' => $this->faker->text(255),
            'lab_desc' => $this->faker->text(),
        ];

        $response = $this->put(
            route('lab-catagories.update', $labCatagory),
            $data
        );

        $data['id'] = $labCatagory->id;

        $this->assertDatabaseHas('lab_catagories', $data);

        $response->assertRedirect(route('lab-catagories.edit', $labCatagory));
    }

    /**
     * @test
     */
    public function it_deletes_the_lab_catagory(): void
    {
        $labCatagory = LabCatagory::factory()->create();

        $response = $this->delete(
            route('lab-catagories.destroy', $labCatagory)
        );

        $response->assertRedirect(route('lab-catagories.index'));

        $this->assertModelMissing($labCatagory);
    }
}
