<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Diagnosis;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiagnosisControllerTest extends TestCase
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
    public function it_displays_index_view_with_diagnoses(): void
    {
        $diagnoses = Diagnosis::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('diagnoses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.diagnoses.index')
            ->assertViewHas('diagnoses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_diagnosis(): void
    {
        $response = $this->get(route('diagnoses.create'));

        $response->assertOk()->assertViewIs('app.diagnoses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_diagnosis(): void
    {
        $data = Diagnosis::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('diagnoses.store'), $data);

        $this->assertDatabaseHas('diagnoses', $data);

        $diagnosis = Diagnosis::latest('id')->first();

        $response->assertRedirect(route('diagnoses.edit', $diagnosis));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_diagnosis(): void
    {
        $diagnosis = Diagnosis::factory()->create();

        $response = $this->get(route('diagnoses.show', $diagnosis));

        $response
            ->assertOk()
            ->assertViewIs('app.diagnoses.show')
            ->assertViewHas('diagnosis');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_diagnosis(): void
    {
        $diagnosis = Diagnosis::factory()->create();

        $response = $this->get(route('diagnoses.edit', $diagnosis));

        $response
            ->assertOk()
            ->assertViewIs('app.diagnoses.edit')
            ->assertViewHas('diagnosis');
    }

    /**
     * @test
     */
    public function it_updates_the_diagnosis(): void
    {
        $diagnosis = Diagnosis::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'desc' => $this->faker->text(),
        ];

        $response = $this->put(route('diagnoses.update', $diagnosis), $data);

        $data['id'] = $diagnosis->id;

        $this->assertDatabaseHas('diagnoses', $data);

        $response->assertRedirect(route('diagnoses.edit', $diagnosis));
    }

    /**
     * @test
     */
    public function it_deletes_the_diagnosis(): void
    {
        $diagnosis = Diagnosis::factory()->create();

        $response = $this->delete(route('diagnoses.destroy', $diagnosis));

        $response->assertRedirect(route('diagnoses.index'));

        $this->assertModelMissing($diagnosis);
    }
}
