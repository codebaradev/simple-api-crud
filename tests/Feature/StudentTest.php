<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testFactory(): void
    {
        $student = Student::factory()->create();

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => $student->name,
            'nim' => $student->nim,
            'prodi' => $student->prodi,
        ]);
    }

    public function testIndex()
    {
        $student = Student::factory()->create();

        $response = $this->get('/api/students');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                [
                    'id' => $student->id,
                    'name' => $student->name,
                    'nim' => $student->nim,
                    'prodi' => $student->prodi,
                    'created_at' => $student->created_at->toISOString(),
                    'updated_at' => $student->updated_at->toISOString(),
                ],
            ],
        ]);
    }


    public function testCreate()
    {
        $response = $this->post('/api/students', [
            'name' => fake()->name(),
            'nim' => fake()->unique()->numerify('########'),
            'prodi' => fake()->randomElement(['IK', 'SI', 'MA', 'TP', 'TA', 'SD']),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            "status" => "success",
            "message" => "Student created successfully"
        ]);
    }

    public function testShow()
    {
        $student = Student::factory()->create();

        $response = $this->get('/api/students/' . $student->id);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $student->id,
                'name' => $student->name,
                'nim' => $student->nim,
                'prodi' => $student->prodi,
                'created_at' => $student->created_at->toISOString(),
                'updated_at' => $student->updated_at->toISOString(),
            ],
        ]);
    }

    public function testUpdate()
    {
        $student = Student::factory()->create();

        $response = $this->put('/api/students/'. $student->id, [
            'name' => fake()->name(),
            'nim' => fake()->unique()->numerify('#########'),
            'prodi' => fake()->randomElement(['IK', 'SI', 'MA', 'TP', 'TA', 'SD']),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Student updated successfully'
        ]);
    }

    public function testDelete()
    {
        $student = Student::factory()->create();

        $response = $this->delete('/api/students/'. $student->id);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Student deleted successfully'
        ]);
    }
}
